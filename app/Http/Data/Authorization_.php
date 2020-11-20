<?php
/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */

namespace App\Http\Data;

use Illuminate\Support\Facades\Auth;

class Authorization_{
    private static function login() {
        return Auth::check();
    }

    public static function student() {
        if (self::login())
            return Auth::user()->role == 'student';
        return false;
    }

    public static function advisor() {
        if (self::login())
            return Auth::user()->role == 'lecturer';
        return false;
    }

    public static function department() {
        if (self::login())
            return Auth::user()->role == 'department';
        return false;
    }

    public static function super() {
        if (self::login())
            return Auth::user()->role == 'super';
        return false;
    }

    public static function user() {
        return self::login();
    }

    public static function data() {
        return Auth::user();
    }
}
