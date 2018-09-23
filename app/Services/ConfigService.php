<?php
/**
 * ContactService
 * @category  Service
 * @package   Contact
 * @author    minhkq <minh.kq@altplus.com.vn>
 * @license   Altplus
 * @version   1
 * @link      url
 */
namespace App\Services;

use App\Models\Search;
use App\Models\Config;
use Carbon\Carbon;

class ConfigService
{
    public static function getConfig()
    {
        $config = Config::first();
        if (is_null($config)) {
            Config::insert([
                'is_show_nf' => true,
                'style_notification' => CONFIG_STYLE_NOTIFICATION_BASIC,
            ]);
        };
        return Config::first();
    }

    public function updateConfig($data)
    {
        $config = $this->getConfig();
        $config->is_show_nf = 0;
        if (isset($data['is_show_nf'])) {
            if ($data['is_show_nf'] == 'on') {
                $config->is_show_nf = 1;
            }
        } 
        if (isset($data['style_notification'])) $config->style_notification = $data['style_notification'];
        $config->save();
        return true;
    }


}
