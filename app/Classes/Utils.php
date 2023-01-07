<?php
namespace App\Classes;

class Utils {

    public static function getMemory($key) {
        return session()->get($key) ?? [];
    }

    public static function saveMemory($key, $data = []) {
        session()->put($key, array_merge(self::getMemory($key), $data));
    }

    public static function clearMemory($key) {
        session()->remove($key);
    }

}
