<?php
/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */

namespace App\Http\Data;

use App\Models\Exam;
use App\Models\Plagiarism;
use App\Models\Proposal;
use App\Models\RejectedProposal;
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

    public static function getDepartment($identity,$role) {
        if ($role == 's') {
            $stud = DB::table('students')->where('identity', $identity)->first();
            return DB::table('departments')->where('identity',$stud->identity_dep)->first();
        }
        return DB::table('departments')->where('identity',Auth::user()->identity)->first();
    }

    public static function getDepartmentConf() {
        return DB::table('users')->where('id',Auth::user()->id)->first();
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

    public static function getRevision($student_id) {
        if ($student_id == '')
            return DB::table('revisions')->where('author_id',Auth::user()->identity)->first();
        return DB::table('revisions')->where('author_id',$student_id)->first();
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
        return $temp->status_1 >= 2 && $temp->status_2 >= 2;
    }

    public static function getThesisExam($identity, $role) {
        if ($role == 'l') {
            return DB::table('exams')
                ->where('examiner1_id',$identity)
                ->orWhere('examiner2_id',$identity)
                ->first();
        }
        if (DB::table('exams')->where('examiner1_id',$identity)->count() < 1) {
            $exam = new Exam();
            $exam->author_id = $identity;
            $exam->save();
            return $exam;
        }
        return DB::table('exams')
            ->where('author_id_id',$identity)
            ->first();
    }

    public static function getPlagiarism($identity) {
        $data = null;
        if (DB::table('plagiarisms')->where('author_id', $identity)->count() < 1) {
            $data = new Plagiarism();
            $data->author_id = $identity;
            $data->save();
        }
        else {
            $data = DB::table('plagiarisms')
                ->where('author_id',$identity)
                ->first();
        }
        return $data;
    }

    public static function getDepartmentPlagiarism() {
        $temp = DB::table('departments')
            ->where('identity',Auth::user()->identity)
            ->first();
        $data['bi']     = $temp->plagiarism_bi.'';
        $data['bii']    = $temp->plagiarism_bii.'';
        $data['biii']   = $temp->plagiarism_biii.'';
        $data['biv']    = $temp->plagiarism_biv.'';
        $data['bv']     = $temp->plagiarism_bv.'';
        return $data;
    }

    public static function getNotification() {
        $role = Auth::user()->role;
        if ($role == 'student') {
            $user = self::getWriter();
            $request_revision_1 = '0';
            $request_revision_2 = '0';
            $request_submit     = '0';
            if ($user->l1_revision_request)
                $request_revision_1 = '1';
            if ($user->l2_revision_request)
                $request_revision_2 = '1';
            if (DB::table('submit_requests')
                ->where('author_id', $user->identity)
                ->count() > 0)
                $request_submit = '1';
            return array(
                'revision_1'=>$request_revision_1,
                'revision_2'=>$request_revision_2,
                'request_submit'=>$request_submit,
                'message'=>self::getRevisionMessages('desc')->toArray()
            );
        }
        elseif ($role == 'lecturer') {

        }
        elseif ($role == 'department') {

        }
        else {

        }
    }

    public static function checkProposal($lecturer_id, $lectype) {
        $proposal =
            DB::table('proposals')
                ->where('author_id', Auth::user()->identity)
                ->where('lecturer_id', $lecturer_id)
                ->count();
        if ($proposal > 0)
            $proposal =
                DB::table('proposals')
                    ->where('author_id', Auth::user()->identity)
                    ->where('lecturer_id', $lecturer_id)
                    ->first();
        else {
            $proposal = new Proposal();
            $proposal->author_id = Auth::user()->identity;
            $proposal->lecturer_id = Auth::user()->identity;
            $proposal->advisor_type = intval($lectype);
        }
        $proposal->lecturer_id = $lecturer_id;
        $proposal->save();

        return '1';
    }

    public static function wasRejected($author_id, $lecturer_id, $title) {
        return DB::table('rejected_proposals')
            ->where('author_id', $author_id)
            ->where('lec_id', $lecturer_id)
            ->where('title', $title)
            ->count() > 0;
    }

    public static function newRejected($author_id, $title) {
        $rejected = new RejectedProposal();
        $rejected->author_id = $author_id;
        $rejected->lec_id = Auth::user()->identity;
        $rejected->title = $title;
        $rejected->save();
    }

    public static function dataRouteDashboard_lecturer() {
        $temp = DB::table('students')
            ->whereRaw('status_1 < 2')
            ->orWhereRaw('status_2 < 2')
            ->where('identity_l1',Auth::user()->identity)
            ->orWhere('identity_l2',Auth::user()->identity)
            ->join('revisions','students.identity_l1','=','revisions.lec1_id')
            ->join('revisions','students.identity_l2','=','revisions.lec2_id')
            ->join('revisions','students.identity_l1','=','submit_requests.l1_id')
            ->join('revisions','students.identity_l2','=','submit_requests.l2_id')
            ->select(
                'students.id','students.name','students.status_1','students.status_2','students.doc_title',
                'students.identity_l1','students.identity_l2',
                'students.doc_link','students.l1_revision_request','students.l2_revision_request',
                'revisions.lec_1_revision','revisions.lec_2_revision','submit_requests.l1_agrement','submit_requests.l2_agrement')
            ->get();
        $temp["_identity"] = Auth::user()->identity;
        return $temp;
    }

    public static function dataRouteBimbinganHistory_lecturer() {
        $temp = DB::table('students')
            ->whereRaw('status_1 >= 2')
            ->whereRaw('status_2 >= 2')
            ->where('identity_l1', Auth::user()->identity)
            ->orWhere('identity_l2', Auth::user()->identity)
            ->join('documents', 'students.doc_url', '=', 'url')
            ->select(
                'students.id','students.name','students.doc_title',
                'students.thesis_score_l1','students.thesis_score_l2',
                'students.doc_link','students.identity_l1','students.identity_l2','documents.abstract_key'
            )
            ->get();
        $temp['_id'] = Auth::user()->identity;
        return $temp;
    }

    public static function dataRouteDashboard_department() {
        $department = Auth::user()->name;
        $thesis = DB::select("SELECT students.identity,students.name,documents.title,(SELECT name FROM lecturers WHERE lecturers.identity = students.identity_l1) AS lec_1, (SELECT name FROM lecturers WHERE lecturers.identity = students.identity_l2) AS lec_2 FROM documents,students,lecturers WHERE documents.id_ = students.identity AND students.identity_dep = '?' AND students.identity_l1 IN (lecturers.identity) OR students.identity_l2 IN (lecturers.identity)",[$department]);
        $advisors_ = DB::select("SELECT lecturer_deps.lecturer_id AS identity,lecturers.name FROM lecturer_deps,lecturers WHERE lecturers.identity = lecturer_deps.lecturer_id AND lecturer_deps.department_id = '?'",[$department]);
        foreach ($advisors_ as $advisor) {
            $advising = DB::select("SELECT DISTINCT students.name,students.identity,documents.title AS doc_title,users.photo_url,documents.url AS doc_url FROM students,documents,users WHERE students.identity_dep = '?' AND students.identity = documents.id_ AND students.identity_l1 = '?' OR students.identity_l2 = '?' AND students.identity = users.identity;",[$department,$advisor->identity,$advisor->identity]);
            $advisor['advising'] = $advising;
        }
        return array(
            $department,
            $thesis,
            $advisors_
        );
    }

    public static function dataRouteDashboard_super() {
        return '';
    }
}
