<!doctype html>
<html lang="en">
<head>
    <title>Horizon Installer</title>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="og:title" content="Horizon Installer">
    <meta name="description" content="Welcome to your new installation of Horizon, the all in one suite">
    <meta name="og:description" content="Welcome to your new installation of Horizon, the all in one suite">
    <meta name="theme-color" content="#0984e3">

    <!-- SCRIPTS -->
    <link rel="stylesheet" href="{{ asset('css/installer.css') }}">
    @toastr_css
</head>
<body>
<div class="container d-flex my-auto">
    <div class="card h-100 w-100 shadow border-0 p-5">
        <div class="row justify-content-center">
            <div class="col-md-4" id="pills">
                <h2 class="title text-white text-truncate mt-1 mb-3"><u>Horizon Installation</u></h2>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" href="#tab-req" id="pill-req-tab" data-toggle="pill">
                        Application Requirements
                    </a>
                    <a class="nav-link" href="#tab-perm" id="pill-perm-tab" data-toggle="pill">
                        File Permissions
                    </a>
                    <a class="nav-link" href="#tab-settings" id="pill-settings-tab" data-toggle="pill">
                        Settings
                    </a>
                </div>
            </div>


            <div class="col-md-8 my-auto">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-req">
                            <h4 class="title">Application Requirements</h4>
                            <ul>
                                @foreach($extensions as $name => $enabled)
                                    <li><b>{{ $name }}</b> -
                                        <code class="{{ $enabled ? 'enabled' : 'disabled' }}">
                                            {{ $enabled ? 'enabled' : 'disabled' }}
                                        </code>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="text-right">
                                <a class="btn btn-outline-success" onclick="gotoPerms()">Continue</a>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-perm">
                            <h4 class="title">Directory Permissions</h4>
                            <ul>
                                @foreach($directories as $name => [$perm, $requiredPerm])
                                    <li>
                                        <b>{{ $name }}</b>
                                        -
                                        <code class="{{ $perm >= $requiredPerm ? 'enabled' : 'disabled' }}">
                                            {{ $perm }}
                                        </code>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="text-right">
                                <a class="btn btn-outline-success" onclick="gotoMysql()">Continue</a>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="tab-settings">
                            <h4 class="title"> Configuration </h4>
                            <form action="{{ route('install.complete') }}" method="POST" id="install">
                                @CSRF
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="app_name">APP Name</label>
                                            <input class="form-control" type="text" name="app_name" id="app_name"
                                                   placeholder="Horizon" value="Horizon" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="app_url">APP URL</label>
                                            <input class="form-control" type="text" name="app_url" id="app_url"
                                                   placeholder="https://yourdomain.com" value="{{ request()->root() }}"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="db_host">Database Host</label>
                                            <input class="form-control" type="text" name="db_host" id="db_host"
                                                   placeholder="127.0.0.1" value="127.0.0.1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="db_port">Database Port</label>
                                            <input class="form-control" type="text" name="db_port" id="db_port"
                                                   placeholder="3306" value="3306" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="db_username">Database Username</label>
                                            <input class="form-control" type="text" name="db_username" id="db_username"
                                                   placeholder="root" value="root" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="db_password">Database Password</label>
                                            <input class="form-control" type="password" name="db_password"
                                                   id="db_password" placeholder="Pa$$w0rd1">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="db_database">Database Name</label>
                                            <input class="form-control" type="text" name="db_database" id="db_database"
                                                   placeholder="cosmo" value="horizon" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="steam_api_key">
                                                Steam API Key (get yours <a target="_blank" href="https://steamcommunity.com/dev/apikey">here</a>)
                                            </label>
                                            <input class="form-control" type="text" name="steam_api_key" id="steam_api_key"
                                                   placeholder="<api key>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="bm_id">
                                                BattleMetrics Auth Key (get yours <a target="_blank" href="https://www.battlemetrics.com/developers/token">here</a>)
                                            </label>
                                            <input class="form-control" type="text" name="bm_id" id="bm_id"
                                                   placeholder="<auth key>" required>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row justify-content-between">
                                    <div class="col-md-6 mr-auto text-left">
                                        <a class="btn btn-outline-danger w-50" href="#tab-req" data-toggle="pill"
                                           aria-controls="v-pills-home" aria-selected="true" onclick="startOver()">
                                            Start Over </a>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button class="btn btn-outline-success w-50" type="submit" id="install-btn">
                                            Install Horizon
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    
<!-- SCRIPTS -->
<script src="{{ asset('js/installer.js') }}"></script>

@toastr_js
@toastr_render

    <script type="text/javascript">
        $(document).ready(function() {
            $('#install-btn').click(function() {
                $(this).prop('disabled', true);
                console.log("started");
                $( "#install" ).submit();
            });
        });

        function gotoPerms() {
            $('#pill-perm-tab').tab('show');
        }

        function gotoMysql() {
            $('#pill-settings-tab').tab('show');
        }

        function startOver() {
            window.history.pushState("string", "Title", "/install");
            location.reload();
        }
    </script>
</div>
</body>
</html>