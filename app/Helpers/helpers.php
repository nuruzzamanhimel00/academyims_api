<?php


use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
/**
 * generateSlug
 *
 * @param  mixed $value
 * @return void
 */
function generateSlug($value)
{
    try {
        return preg_replace('/\s+/u', '-', trim($value));
    } catch (\Exception $e) {
        return '';
    }
}

function getStorageImage($path, $name, $is_user = false, $resizable = false)
{
    if ($name && Storage::disk('public')->exists($path . '/' . $name)) {
        if ($resizable) {
            $full_path = 'storage/' . $path . '/' . $name;
            if ($name) {
                return $full_path;
            }
        }
        if (strpos(php_sapi_name(), 'cli') !== false || defined('LARAVEL_START_FROM_PUBLIC')) :
            return app('url')->asset('storage/' . $path . '/' . $name);
        else :
            return app('url')->asset('public/storage/' . $path . '/' . $name);
        endif;
    }
    return $is_user ? getUserDefaultImage() : getDefaultImage();
}
function getUserDefaultImage()
{
    return static_asset('images/user_default.png');
}

/**
 * getDefaultImage
 *
 * @return void
 */
function getDefaultImage()
{
    return static_asset('images/default.png');
}


if (!function_exists('static_asset')) {

    function static_asset($path = null, $secure = null)
    {
        if (strpos(php_sapi_name(), 'cli') !== false || defined('LARAVEL_START_FROM_PUBLIC')) :
            return app('url')->asset($path, $secure);
        else :
            $all_null = ($path == null && $secure == null) ? '/' : '';
            return app('url')->asset('public/' . $path, $secure) . $all_null;
        endif;
    }
}
