<?php
/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */

namespace App\Http\Data;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Data {
    public static function getStudent_thesis($identity) {
        return DB::table('documents')
            ->where('id_',$identity)
            ->first();
    }

    public static function isURL_thesis($url) {
        $identity = Auth::user()->identity;
        return DB::table('documents')
            ->where('id_',$identity)
            ->where('url',$url)
            ->count() > 0;
    }

    public static function hasThesis($identity) {
        return DB::table('documents')
            ->where('id_',$identity)
            ->count() > 0;
    }

    public static function getDoc_url($identity) {
        return DB::table('documents')
            ->where('id_',$identity)
            ->first()->url;
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

    public static function hasLecturer($id) {
        return DB::table('lecturers')
            ->where('identity',$id)
            ->count() > 0;
    }

    public static function getLecturer($id) {
        return DB::table('lecturers')
                ->where('identity',$id)
                ->first();
    }

    public static function isVerified_thesis_by($lecturer_id) {
        $student = Student::find(Auth::user()->identity);
        if ($student->identity_l1 == null) {
            if ($student->identity_l2 == null) return false;
            return $student->identity_l2 == $lecturer_id;
        }
        return $student->identity_l1 == $lecturer_id;
    }
}
