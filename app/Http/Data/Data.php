<?php
/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */

namespace Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Data {
    public static function getStudent_thesis($identity) {
        return DB::table('documents')
            ->where('id_',$identity)
            ->first();
    }

    public static function getStudents_data($id) {
        if (Auth::user()->role == 'lecturer')
            return DB::table('students')
                ->where('identity_l1',$id)
                ->orWhere('identity_l2',$id)
                ->get();
        if (Auth::user()->role == 'department')
            return DB::table('students')
                ->where('identity_dep',$id)
                ->get();
        if (Auth::user()->role == 'super')
            return DB::table('students')
                ->where('identity_univ',$id)
                ->get();
        return DB::table('students')
            ->where('identity',$id)
            ->first();
    }
}
