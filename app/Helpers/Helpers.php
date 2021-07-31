<?php

function getConfigValue( $configKey ) {
    $setting = \App\Models\SettingModel::where('config_key', $configKey)->first();
    if (!empty($setting)) {
        return $setting->config_value;
    }
    return null;

}
