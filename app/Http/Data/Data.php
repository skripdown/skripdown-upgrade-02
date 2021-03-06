<?php
/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */

namespace App\Http\Data;

use App\Models\Department;
use App\Models\Exam;
use App\Models\Plagiarism;
use App\Models\Proposal;
use App\Models\RejectedProposal;
use App\Models\Revision;
use App\Models\RevisionMessage;
use App\Models\Student;
use App\Models\SubmitRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Data {

    public static function getWriter() {
        $temp =  DB::table('students')
            ->where('identity',Auth::user()->identity)
            ->first();
        return Student::find($temp->id);
    }

    public static function getAdvisorWriter($id_writer) {
        $temp = DB::table('students')
            ->where('identity',$id_writer)
            ->first();
        return Student::find($temp->id);
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
            $stud = DB::table('departments')->where('identity',$stud->identity_dep)->first();
        }
        else
            $stud = DB::table('departments')->where('identity',Auth::user()->identity)->first();
        return Department::find($stud->id);
    }

    public static function getDepartmentConf() {
        $temp = DB::table('users')->where('id',Auth::user()->id)->first();
        return User::find($temp->id);
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
            $temp = DB::table('revisions')->where('author_id',Auth::user()->identity)->first();
        else
            $temp = DB::table('revisions')->where('author_id',$student_id)->first();
        return Revision::find($temp->id);
    }

    public static function getRevisionMessages($order) {
        $auth_id = Auth::user()->identity;
        if (DB::table('revisions')
            ->where('author_id', $auth_id)
            ->count() > 0) {
            $auth_id = DB::table('revisions')
                ->where('author_id', $auth_id)
                ->first()->id;
            return DB::table('revision_messages')
                ->where('revision', $auth_id)
                ->orderBy('index',$order)
                ->get();
        }
        return null;
    }

    public static function getRevisionMessage($idMessage) {
        $idRevision = DB::table('revisions')
            ->where('author_id', Auth::user()->identity)
            ->first()->id;
        $id = $idRevision;
        $temp = DB::table('revision_messages')
            ->where('revision', $id)
            ->where('id',$idMessage)
            ->first();
        return RevisionMessage::find($temp->id);
    }

    public static function hasSubmitRequest() {
        return $temp = DB::table('submit_requests')
            ->where('author_id', Auth::user()->identity)
            ->count() > 0;
    }

    public static function getSubmitRequest($identity, $role) {
        if ($role == 'l') {
            $temp = DB::table('submit_requests')
                ->where('l1_id', $identity)
                ->orWhere('l2_id', $identity)
                ->first();
            return SubmitRequest::find($temp->id);
        }
        $temp = DB::table('submit_requests')
            ->where('author_id', $identity)
            ->first();
        return SubmitRequest::find($temp->id);
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
            $data = Plagiarism::find($data->id);
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
            $message = self::getRevisionMessages('desc');
            if ($message != null)
                $message = $message->toArray();
            else
                $message = array();
            return array(
                'revision_1'=>$request_revision_1,
                'revision_2'=>$request_revision_2,
                'request_submit'=>$request_submit,
                'message'=>$message
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
        if ($proposal > 0) {
            $proposal =
                DB::table('proposals')
                    ->where('author_id', Auth::user()->identity)
                    ->where('lecturer_id', $lecturer_id)
                    ->first();
            $proposal = Proposal::find($proposal->id);
        }
        else {
            $proposal = new Proposal();
            $proposal->author_id = Auth::user()->identity;
        }
        $proposal->lecturer_id = $lecturer_id;
        $proposal->advisor_type = $lectype;
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

    public static function dataWelcome_guest() {
        $total_dokumen = DB::table('documents')->count();
        $total_active  = DB::table('students')
            ->where('status_1','!=', 5)
            ->orWhere('status_2','!=',5)
            ->where('doc_title','!=',null)
            ->count();
        return array(
            $total_dokumen,
            $total_active
        );
    }

    public static function dataRouteDashboard_lecturer() {
        $identity  = Auth::user()->identity;
        $bimbingan = DB::select("SELECT students.id AS id, students.identity AS identity,students.name AS name, students.status_1 AS status_1, students.status_2 AS status_2, students.doc_title AS doc_title, students.doc_link AS doc_link, students.identity_l1 AS identity_l1, students.identity_l2 AS identity_l2, students.l1_revision_request AS l1_request_revision, students.l2_revision_request AS l2_request_revision, revisions.lec_1_revision AS lec_1_revision, revisions.lec_2_revision AS lec_2_revision, submit_requests.l1_agreement AS l1_agrement, submit_requests.l2_agreement AS l2_agrement, proposals.id FROM students LEFT JOIN revisions ON students.identity = revisions.author_id LEFT JOIN submit_requests ON students.identity = submit_requests.author_id LEFT JOIN proposals ON proposals.lecturer_id = ? WHERE students.identity_l1 = ? OR students.identity_l2 = ?",[$identity,$identity,$identity]);
        return array($identity, $bimbingan);
    }

    public static function dataRouteBimbinganHistory_lecturer() {
        $identity = Auth::user()->identity;
        $history = DB::select("SELECT students.id AS id, students.identity AS identity, students.name AS name, students.doc_title AS doc_title, students.doc_link AS doc_link, students.identity_l1 AS identity_l1, students.identity_l2 AS identity_l2, students.thesis_score_l1 AS thesis_score_l1, students.thesis_score_l2 AS thesis_score_l2, documents.abstract_key AS abstract_key FROM students LEFT JOIN documents ON students.identity = documents.id_ WHERE students.status_1 > 1 AND students.status_2 > 1 AND students.identity_l1 = ? OR students.identity_l2 = ?",[$identity, $identity]);
        return array($identity, $history);
    }

    public static function ujianSkripsi_lecturer() {
        $identity = Auth::user()->identity;
        $exams = DB::select("SELECT * FROM exams WHERE examiner1_id = ? OR examiner2_id = ? AND examiner1_pass = false OR examiner2_pass = false",[$identity,$identity]);
        return array($identity,$exams);
    }

    public static function dataRouteDashboard_department() {
        $department = Auth::user()->name;
        $thesis = DB::select("SELECT DISTINCT students.identity,students.name,documents.title,(SELECT name FROM lecturers WHERE lecturers.identity = students.identity_l1) AS lec_1, (SELECT name FROM lecturers WHERE lecturers.identity = students.identity_l2) AS lec_2 FROM documents,students,lecturers WHERE documents.id_ = students.identity AND students.identity_dep = ? AND students.identity_l1 IN (lecturers.identity) OR students.identity_l2 IN (lecturers.identity)",[$department]);
        $advisors_ = DB::select("SELECT lecturer_deps.lecturer_id AS identity, users.photo_url AS photo_url,lecturers.name FROM lecturer_deps,lecturers,users WHERE lecturers.identity = lecturer_deps.lecturer_id AND users.identity = lecturers.identity AND lecturer_deps.department_id = ?",[$department]);
        foreach ($advisors_ as $advisor) {
            $advising = DB::select("SELECT DISTINCT students.name,students.identity,documents.title AS doc_title,users.photo_url,documents.url AS doc_url FROM students,documents,users WHERE students.identity_dep = ? AND students.identity = documents.id_ AND students.identity_l1 = ? OR students.identity_l2 = ? AND students.identity = users.identity AND students.status_1 > 0 AND students.status_2 > 0;",[$department,$advisor->identity,$advisor->identity]);
            $advisor->advising = $advising;
            $advisor->advising_total = count($advising);
        }
        return array(
            $department,
            $thesis,
            $advisors_
        );
    }

    public static function dataUjianPlagiasi_department() {
        $department = Auth::user()->name;
        $standard = DB::select('SELECT departments.plagiarism_bi AS bab_i, departments.plagiarism_bii AS bab_ii, departments.plagiarism_biii AS bab_iii, departments.plagiarism_biv AS bab_iv, departments.plagiarism_bv AS bab_v, departments.examiner_quo AS examiner_quo, departments.identity AS identity FROM departments where departments.identity = ? LIMIT 1',[$department]);
        $standard = $standard[0];
        $qouta_examiner = $standard->examiner_quo;
        $plag = DB::select('SELECT users.name AS name, users.photo_url AS photo_url, students.doc_title AS doc_title, students.identity AS identity, students.doc_link AS doc_url, plagiarisms.bab_i AS bab_i, plagiarisms.bab_ii AS bab_ii, plagiarisms.bab_iii AS bab_iii, plagiarisms.bab_iv AS bab_iv, plagiarisms.bab_v AS bab_v FROM students RIGHT JOIN plagiarisms ON plagiarisms.author_id = students.identity LEFT JOIN users ON users.identity = students.identity WHERE students.identity_dep = ?',[$department]);
        $exam = DB::select('SELECT users.name AS author, users.identity AS author_id, students.doc_title AS doc_title, students.doc_link AS doc_url, users.photo_url AS photo_url, exams.id AS exam_id, exams.examiner1_id AS examiner1_id, exams.examiner2_id AS examiner2_id FROM students LEFT JOIN exams ON exams.author_id = students.identity LEFT JOIN users ON users.identity = students.identity WHERE exams.examiner1_pass = false OR exams.examiner2_pass = false AND students.status_1 >= 4 AND students.status_2 >= 4 AND students.identity_dep = ?',[$department]);
        $lect = DB::select('SELECT lecturer_deps.lecturer_id AS identity, users.photo_url AS photo_url,lecturers.name AS name FROM lecturer_deps,lecturers,users WHERE lecturers.identity = lecturer_deps.lecturer_id AND users.identity = lecturers.identity AND lecturer_deps.department_id = ?',[$department]);
        foreach ($lect as $item) {
            $item->tot_bimbingan = DB::table('students')->where('identity_l1',$item->identity)
                ->orWhere('identity_l2',$item->identity)
                ->where('status_1','>',0)
                ->where('status_2','>',0)
                ->count();
        }
        return array(
            $department,
            $plag,
            $standard,
            $exam,
            $lect,
            $qouta_examiner
        );
    }

    public static function dataRouteDashboard_super() {
        return '';
    }
}
