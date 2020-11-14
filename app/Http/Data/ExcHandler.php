<?php
/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */

namespace App\Http\Data;

use Illuminate\Support\Facades\DB;

class ExcHandler {
    public static function getException($code, $option) {
        $exception = DB::table('exceptions')
            ->where('error_code',$code)
            ->first();
        $callback = $exception->callback;
        if ($callback != '') {
            $len = sizeof($option);
            for ($i = 0; $i < $len;$i++) {
                $pointer = '#REP'.($i+1);
                $callback = str_replace($pointer,$option[$i],$callback);
            }
        }
        $err_type  = $exception->error_type;
        $err_mssg  = $exception->error_message;
        $err_call  = $callback;
        $exception = null;
        $exception['type'] = $err_type;
        $exception['message'] = $err_mssg;
        $exception['callback'] = $err_call;

        return view('exception',compact('exception'));
    }
}
