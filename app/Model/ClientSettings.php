<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Model\ClientSettings;

class ClientSettings extends Model
{
    public static function is_setting_checked($setting_name, $client_id)
    {
        $feature = ClientSettings::where('name', $setting_name)->first();

        if ($feature != null) {
            return true;
        }
        
        return '';
    }
}
