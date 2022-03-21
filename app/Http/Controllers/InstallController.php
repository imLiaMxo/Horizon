<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstallRequest;
use App\Models\Configuration;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDOException;

class InstallController extends Controller
{
    private const DIRECTORY_PERMISSIONS = [
        'bootstrap/cache/' => 755,
        'storage/framework/' => 755,
        'storage/app/' => 755,
        'storage/logs/' => 755,
        '.env' => 644,
    ];

    private const REQUIRED_EXTENSIONS = [
        'json', 'bcmath', 'openssl', 'pdo', 'mbstring', 'tokenizer', 'xml', 'ctype', 'gmp', 'zip'
    ];

    public function __construct()
    {
        // Do not allow installation if the installation is already installed
        $this->middleware(function (Request $request, Closure $next) {
            if (Storage::exists('installed.txt')) {
                return redirect()->route('home');
            }

            return $next($request);
        });
    }

    public function index()
    {
        $phpVersion = phpversion();

        if (!file_exists('../.env')) {
            file_put_contents('../.env', '');
        }

        $directories = collect(self::DIRECTORY_PERMISSIONS)->mapWithKeys(function ($perm, $dir) {
            return [
                $dir => [substr(sprintf("%o", fileperms(base_path($dir))), -3), $perm]
            ];
        });

        $extensions = collect(self::REQUIRED_EXTENSIONS)->mapWithKeys(function ($ext) {
            return [$ext => extension_loaded($ext)];
        });

        return view('install.welcome', [
            'phpVersion' => $phpVersion,
            'directories' => $directories,
            'extensions' => $extensions
        ]);
    }

    public function install(InstallRequest $request): RedirectResponse
    {

        set_time_limit(0);

        config([
            'database.connections.mysql.host' => $request->input('db_host'),
            'database.connections.mysql.port' => $request->input('db_port'),
            'database.connections.mysql.database' => $request->input('db_database'),
            'database.connections.mysql.username' => $request->input('db_username'),
            'database.connections.mysql.password' => $request->input('db_password'),
        ]);

        try {
            app('db')->purge('mysql');
            DB::connection('mysql')->getPdo();
            toastr()->success('Database connection success, installing your application!');
        } catch (PDOException $e) {
            toastr()->error('Database connection failed, please make sure your credentials are correct!');
            toastr()->error($e->getMessage());
            return redirect()->route('install.welcome');
        }

        write_to_env($request->validated());

        Artisan::call('key:generate', ['--force' => true]);
        Artisan::call('migrate:refresh', ['--force' => true, '--seed' => true]);

        Configuration::where('key', 'steam_api_key')->update([
            'value' => $request->input('steam_api_key')
        ]);

        Configuration::where('key', 'bm_id')->update([
            'value' => $request->input('bm_id')
        ]);

        Storage::put('installed.txt', now());

        return redirect()->route('home');
    }
}
