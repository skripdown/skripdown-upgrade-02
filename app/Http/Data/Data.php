<?php
/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */

namespace App\Http\Data;

use App\Models\Student;
use App\Models\SubmitRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Data {

    public static function getWriter() {
        return DB::table('students')
            ->where('identity',Auth::user()->identity)
            ->first();
    }

    public static function getAdvisorWriter($id_writer) {
        return DB::table('students')
            ->where('identity',$id_writer)
            ->first();
    }

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
        $student = self::getWriter();
        if ($student->identity_l1 != null) {
            if ($student->identity_l1 == $lecturer_id && $student->status_1 == 1)
                return true;
            elseif ($student->identity_l2 != null)
                return $student->identity_l2 == $lecturer_id && $student->status_2 == 1;
        }
        elseif ($student->identity_l2 != null) {
            return $student->identity_l2 == $lecturer_id && $student->status_2 == 1;
        }
        else
            return false;
        return false;
    }

    public static function getRevision() {
        return DB::table('revisions')->where('author_id',Auth::user()->identity)->first();
    }

    public static function getRevisionMessages($order) {
        $auth_id = Auth::user()->identity;
        $auth_id = DB::table('revisions')
            ->where('author_id', $auth_id)
            ->first()->id;
        return DB::table('revision_messages')
            ->where('revision', $auth_id)
            ->orderBy('index',$order)
            ->get();
    }

    public static function getRevisionMessage($idMessage) {
        $idRevision = DB::table('revisions')
            ->where('author_id', Auth::user()->identity)
            ->first()->id;
        $id = gmp_intval(gmp_init($idRevision));
        return DB::table('revision_messages')
            ->where('revision', $id)
            ->where('id',$idMessage)
            ->first();
    }

    public static function getSubmitRequest($identity, $role) {
        if ($role == 'l') {
            return DB::table('submit_requests')
                ->where('l1_id', $identity)
                ->orWhere('l2_id', $identity)
                ->first();
        }
        return DB::table('submit_requests')
            ->where('author_id', $identity)
            ->first();
    }

    public static function isSubmitedThesis($url) {
        $temp = DB::table('students')
            ->where('doc_link', $url)
            ->first();
        return $temp->status_1 != 2 && $temp->status_2 != 2;
    }
}
