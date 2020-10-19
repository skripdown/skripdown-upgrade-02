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
        if ($writer->status != 1) {
            if ($type == '1' && $writer->identity_l1 == null)
                $writer->identity_l1 = $id;
            if ($type == '2' && $writer->identity_l2 == null)
                $writer->identity_l2 = $id;
            $writer->save();
        }
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

    public static function makeRevision($lec_1_id, $lec_2_id) {
        $revision = new Revision();
        $revision->author_id = Auth::user()->identity;
        $revision->lec_1_id = $lec_1_id;
        $revision->lec_2_id = $lec_2_id;
        $revision->save();
    }

    public static function updateRevision($lectype) {
        $revision = Data::getRevision();
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

    public static function makeRevisionMessage($message, $from) {
        $revision = Data::getRevision();
        $revMsg = new RevisionMessage();
        if ($revision->lec_1_id == $from) {
            $index = $revision->lec_1_revision;
            $index += 1;
            $revision->lec_1_revision = $index;
        }
        else {
            $index = $revision->lec_2_revision;
            $index += 1;
            $revision->lec_2_revision = $index;
        }
        $revMsg->index = $index;
        $revMsg->lec_id = $from;
        $revMsg->message = $message;

        $revMsg->save();
        $revision->save();
    }

    public static function readMessage($idMessage) {
        $message = Data::getRevisionMessage($idMessage);
        $message->read = true;
        $message->save();

        return array('status'=>'1');
    }

    public static function requestSubmit() {
        $student = Data::getWriter();
        $request = new SubmitRequest();
        $request->author_id = $student->identity;
        $request->l1_id = $student->identity_l1;
        $request->l2_id = $student->identity_l2;
        $request->save();

        return array('status'=>'1');
    }

    public static function fireSubmit($author_id, $lecturer_id, $score) {
        $author = Data::getAdvisorWriter($author_id);
        $score = floatval($score);
        if ($author->identity_l1 == $lecturer_id) {
            $author->status_1 = 2;
            $author->thesis_score_l1 = $score;
        }
        else {
            $author->status_2 = 2;
            $author->thesis_score_l2 = $score;
        }
        $author->save();
        if ($author->status_1 == 2 && $author->status_2 == 2) {
            $submit = Data::getSubmitRequest($author->identity, '');
            $submit = SubmitRequest::find($submit->id);
            $submit->delete();
        }

    }
}
