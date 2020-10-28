<?php
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;

function escape_like($string)
{
    $search = ['%', '_', '&'];
    $replace = ['\%', '\_', '\&'];

    return str_replace($search, $replace, $string);
}

function get_guard_name()
{
    $host = Request::getHttpHost();
    $pieces = explode('-', $host);

    if ($pieces[0] == 'nguoibaoho') {
        return 'nguoibaoho';
    } elseif ($pieces[0] == 'admin') {
        return 'admin';
    }

    echo 'Guard not found!';

    exit;
}

if (! function_exists('get_guard_current')) {
    function get_guard_current()
    {
        return get_guard_name();
    }
}

if (!function_exists('route_g')) {
    function route_g($name, $param = [])
    {
        $guard = get_guard_current();
        return route($guard . '.' . $name, $param);
    }
}

if (!function_exists('show_img')) {
    function show_original_img($dir, $url_image)
    {
        return 'storage/' . $dir . '/original' . '/' . $url_image;
    }
}