<?php
/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */

namespace App\Http\Data;

use App\Models\Document;
use App\Models\Skripdown;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Maker {

    public static function makeDoc() {
        $user = DB::table('students')->where('identity',Auth::user()->identity)->first();
        $user = Student::find($user->id);
        $item = new Document();

        $item->text = '<div>//start writing now. 😉</div><div>//SKRIPDOWN : fast end thesis writing</div>'
                     .'<div>//this is a comment</div>'
                     .'<div><br></div>'
                     .'<div>@title : </div>'
                     .'<div>@author : '.Auth::user()->name.'</div>'
                     .'<div>@id : '.$user->identity.'</div>'
                     .'<div>@department : '.$user->identity_dep.'</div>'
                     .'<div>@faculty : '.$user->identity_fac.'</div>'
                     .'<div>@university : '.$user->identity_univ.'</div>'
                     .'<div>@citation : APA</div>'
                     .'<div>@watermark : on</div>'
                     .'<div>@preface : default</div>'
                     .'<div>@date : 20 - 10 - 2020</div>'
                     .'<div>@location : malang</div>';
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
}
