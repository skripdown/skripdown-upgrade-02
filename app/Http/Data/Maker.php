<?php
/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */

namespace App\Http\Data;

use App\Models\Document;
use App\Models\Revision;
use App\Models\RevisionMessage;
use App\Models\Skripdown;
use App\Models\Student;
use App\Models\SubmitRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Maker {

    public static function makeDoc() {
        $user = DB::table('students')->where('identity',Auth::user()->identity)->first();
        $user = Student::find($user->id);
        $item = new Document();
        $item->meta = '<div>@author : '.Auth::user()->name.'</div>'
                     .'<div>@id : '.$user->identity.'</div>'
                     .'<div>@department : '.$user->identity_dep.'</div>'
                     .'<div>@faculty : '.$user->identity_fac.'</div>'
                     .'<div>@university : '.$user->identity_univ.'</div>'
                     .'<div>@citation : APA</div>'
                     .'<div>@watermark : on</div>'
                     .'<div>@preface : default</div>'
                     .'<div>@date : 20-10-2020</div>'
                     .'<div>@location : Malang</div>';
        $item->text = '<div>//start writing now. 😉</div><div>//SKRIPDOWN : fast end thesis writing</div>'
                     .'<div>//this is a comment</div>'
                     .'<div><br></div>'
                     .'<div>@title : judul skripsi</div>';
        $item->university = $user->identity_univ;
        $item->department = $user->identity_dep;
        $item->faculty = $user->identity_fac;
        $item->parse = '';
        $item->conf_font = '16';
        $item->author = $user->name;
        $item->id_ = $user->identity;
        $item->title = '';
        $item->abstract = '';
        $item->abstract_key = '';

        $urls = '';
        $alp_ = 'abcdefghi__--jklmnopqrstuvwxyz__--ABCDEFGHIJK__--LMNOPQRSTUVWXYZ0123456789_-';
        $len  = strlen($alp_);
        for ($i = 0; $i < 20; $i++) {
            $urls .= $alp_[rand(0, $len - 1)];
        }

        $urls = date("s").date("h").$urls;
        $item->url = $urls;
        $user->doc_link = $urls;

        $item->save();
        $user->save();

        return $urls;
    }

    public static function saveDoc($request) {
        $user = DB::table('students')->where('identity',Auth::user()->identity)->first();
        $user = Student::find($user->id);
        $item = Data::getStudent_thesis(Auth::user()->identity);
        $item = Document::find($item->id);

        $item->text = $request->text;
        $item->parse = $request->parse;
        $item->conf_font = $request->conf_font;
        $item->title = $request->title;
        $item->abstract = $request->abstract;
        $item->abstract_key = $request->abstract_key;
        $user->doc_title = $request->title;
        if ($request->l1_id != 'noid') {
            if (Data::hasLecturer($request->l1_id))
                $user->identity_l1 = $request->l1_id;
        }
        if ($request->l2_id != 'noid') {
            if (Data::hasLecturer($request->l2_id))
                $user->identity_l2 = $request->l2_id;
        }

        $user->save();
        $item->save();
    }

    public static function parseDoc($url) {
        $check = DB::table('documents')->where('url',$url)->get()->count();
        if ($check == 1) {
            $doc = DB::table('documents')->where('url',$url)->first();
            $result = array('umm','037',$doc->parse);
            return view('print.out',compact('result'));
        }
        else {
            return '404 NOT FOUND!';
        }
    }

    public static function skripdown($request) {
        $skripdown = Skripdown::find(1);
        if ($request->foreign_word != 'online|offline') {
            $skripdown->foreign_words = $request->foreign_word;
            $skripdown->translate_words = $request->translate_word;
            $skripdown->save();
        }

        return array(
            'foreign_word'=>$skripdown->foreign_words,
            'translate_word'=>$skripdown->translate_words
        );
    }

    public static function setAdvisor($id, $type) {
        $writer   = Data::getWriter();
        $writer   = Student::find($writer->id);
        if ($writer->status_1 < 1 && $type == '1' && $writer->identity_l1 == null)
            $writer->identity_l1 = $id;
        if ($writer->status_2 < 1 && $type == '2' && $writer->identity_l2 == null)
            $writer->identity_l2 = $id;
        $writer->save();
    }

    public static function advisorVerify($student_id) {
        $writer = Data::getAdvisorWriter($student_id);
        if ($writer->identity_l1 == Auth::user()->identity) {
            $writer->status_1 = 1;
        }
        else {
            $writer->status_2 = 1;
        }
        $writer->save();
    }

    public static function makeRevision($author_id, $lec_1_id, $lec_2_id) {
        $revision = new Revision();
        $revision->author_id = $author_id;
        $revision->lec_1_id = $lec_1_id;
        $revision->lec_2_id = $lec_2_id;
        $revision->save();
    }

    public static function updateRevision($lectype) {
        $revision = Data::getRevision('');
        $student  = Data::getWriter();
        if (intval($lectype) == 1 ) {
            $idx = $revision->lec_1_revision + 1;
            $revision->lec_1_revision = $idx;
            $student->l1_revision_request = true;
        }
        else {
            $idx = $revision->lec_2_revision + 1;
            $revision->lec_2_revision = $idx;
            $student->l2_revision_request = true;
        }
        $revision->save();
        $student->save();
        return array('status'=>'1');
    }

    public static function makeRevisionMessage($student_id, $message) {
        $from = Auth::user()->identity;
        $revision = Data::getRevision($student_id);
        $revMsg = new RevisionMessage();
        if ($revision->lec_1_id == $from) {
            $index = $revision->lec_1_revision;
        }
        else {
            $index = $revision->lec_2_revision;
        }
        $revMsg->revision = $revision->id;
        $revMsg->index = $index;
        $revMsg->lec_id = $from;
        $revMsg->message = $message;

        $revMsg->save();
        $revision->save();
        return array('status'=>'1');
    }

    public static function readMessage($idMessage) {
        $message = Data::getRevisionMessage($idMessage);
        $message->read = true;
        $message->save();

        return array('status'=>'1');
    }

    public static function requestSubmit() {
        $student = Data::getWriter();
        if (Data::hasSubmitRequest())
            $request = Data::getSubmitRequest(Auth::user()->identity, '');
        else
            $request = new SubmitRequest();
        $request->author_id = $student->identity;
        $request->l1_id = $student->identity_l1;
        $request->l2_id = $student->identity_l2;
        $request->save();

        return array('status'=>'1');
    }

    public static function fireSubmit($author_id, $score) {
        $lecturer_id = Auth::user()->identity;
        $author = Data::getAdvisorWriter($author_id);
        $submit = Data::getSubmitRequest($author->identity, '');
        $score = floatval($score);
        if ($author->identity_l1 == $lecturer_id) {
            $author->status_1 = 2;
            $author->thesis_score_l1 = $score;
            $submit->l1_agreement = 2;
        }
        else {
            $author->status_2 = 2;
            $author->thesis_score_l2 = $score;
            $submit->l2_agreement = 2;
        }
        $author->save();
        if ($author->status_1 == 2 && $author->status_2 == 2) {
            $submit->delete();
            Data::getPlagiarism($author_id);
            return array('status'=>'1');
        }
        return array('status'=>'0');
    }

    public static function clearSubmit($author_id) {
        $lec_id = Auth::user()->identity;
        $submit = Data::getSubmitRequest($author_id,'');
        if ($lec_id == $submit->l1_id) {
            $submit->l1_agreement = 0;
        }
        else {
            $submit->l2_agreement = 0;
        }
        $submit->save();
        return array('status'=>'1');
    }

    public static function scorePlagiarism($request) {
        $author_id = $request->author_id;
        $plagiarism = Data::getPlagiarism($author_id);
        $plagiarism->bab_i = $request->bab_i;
        $plagiarism->bab_ii = $request->bab_i;
        $plagiarism->bab_iii = $request->bab_i;
        $plagiarism->bab_iv = $request->bab_i;
        $plagiarism->bab_v = $request->bab_i;
        $plagiarism->save();

        $department = Data::getDepartment($author_id,'s');
        if (
            $plagiarism->bab_i > $department->plagiarism_bi &&
            $plagiarism->bab_ii > $department->plagiarism_bii &&
            $plagiarism->bab_iii > $department->plagiarism_biii &&
            $plagiarism->bab_iv > $department->plagiarism_biv &&
            $plagiarism->bab_v > $department->plagiarism_bv
        ) {
            $plagiarism->pass = true;
            $status = Data::getAdvisorWriter($author_id);
            $status->status_1 = 3;
            $status->status_2 = 3;
            $status->save();
            $plagiarism->save();
            return array('status'=>'1');
        }
        return array('status'=>'0');
    }

    public static function acceptProposal($student_id) {
        $student  = Data::getAdvisorWriter($student_id);
        $lec_id   = Auth::user()->identity;
        if ($student->identity_l1 == $lec_id) {
            $student->status_1 = 1;
        }
        else {
            $student->status_2 = 1;
        }
        $student->save();
        if ($student->status_1 == 1 && $student->status_2 == 1) {
            self::makeRevision($student_id, $student->identity_l1, $student->identity_l2);
            return array('status'=>'1');
        }
        return array('status'=>'0');
    }

    public static function rejectProposal($student_id, $title) {
        $lec_id = Auth::user()->identity;
        if (!Data::wasRejected($student_id, $lec_id, $title))
            Data::newRejected($student_id, $title);
        return array('status'=>'1');
    }

    public static function confPlagiarism($request) {
        $conf = Data::getDepartment('','d');
        $conf->plagiarism_bi = $request->bi;
        $conf->plagiarism_bii = $request->bii;
        $conf->plagiarism_biii = $request->biii;
        $conf->plagiarism_biv = $request->biv;
        $conf->plagiarism_bv = $request->bv;
        $conf->save();
        return array('status'=>'1');
    }

    public static function confPassword($request) {
        $conf = Data::getDepartmentConf();
        $conf->password = Hash::make($request->password);
        $conf->save();
        return array('status'=>'1');
    }

    public static function setExaminer($request) {
        $exam = Data::getThesisExam($request->author_id,'s');
        $exam->examiner1_id = $request->examiner1_id;
        $exam->examiner2_id = $request->examiner2_id;
        $exam->save();
        return array('status'=>'1');
    }

    public static function examinerPass($request) {
        $exam = Data::getThesisExam($request->author_id,'s');
        if ($request->type == '1') {
            if ($request->pass == '1')
                $exam->examiner1_pass = true;
            $exam->examiner1_msg = $request->msg;
        }
        else {
            if ($request->pass == '1')
                $exam->examiner2_pass = true;
            $exam->examiner2_msg = $request->msg;
        }
        $exam->save();
        if ($exam->examiner1_pass && $exam->examiner2_pass) {
            $submit = Data::getSubmitRequest($request->author_id, '');
            $submit->status_1 = 4;
            $submit->status_2 = 4;
            $submit->save();
            try {
                $exam->delete();
            } catch (\Exception $e) {
                return array('status'=>'-1');
            }
            return array('status'=>'1');
        }
        return array('status'=>'0');
    }
}
