<?php

namespace App\Models;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

/**
 * @mixin IdeHelperConfiguration
 */
class Configuration extends Model
{
    private static array $encryptedKeys = [
        'paypal_client_id',
        'paypal_client_secret',
    ];

    private static array $environmentalKeys = [];

    protected $fillable = [
        'value'
    ];

    public function getEncryptedAttribute(): bool
    {
        return in_array($this->key, static::$encryptedKeys);
    }

    public function getEnvironmentalAttribute(): bool
    {
        return array_key_exists($this->key, static::$environmentalKeys);
    }

    public function getValueAttribute($attr)
    {
        if ($this->encrypted && !empty($attr)) {
            try {
                return Crypt::decrypt($attr);
            } catch (DecryptException $ex) {
                $this->update([
                    'value' => $attr
                ]);

                return null;
            }
        }

        return $attr;
    }

    public function setValueAttribute($attr)
    {
        if ($this->environmental) {
            $envKey = static::$environmentalKeys[$this->key];

            write_to_env([
                $envKey => $attr,
            ]);
        }

        if ($this->encrypted && !empty($attr)) {
            $attr = Crypt::encrypt($attr);
        }

        $this->attributes['value'] = $attr;
    }
}
