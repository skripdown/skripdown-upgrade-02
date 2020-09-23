<?php
/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */

namespace Services;

use App\Models\Document;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class Maker {

    public static function makeDoc() {
        $user = Student::find(Auth::user()->id);
        $item = new Document();

        $item->text = '<div>//start writing now. 😉</div><div>//SKRIPDOWN : fast end thesis writing</div>'
                     .'<div>//this is a comment</div>'
                     .'<div><br></div>'
                     .'<div>@title : </div>'
                     .'<div>@author : </div>'
                     .'<div>@id : </div>';
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
        $user = Student::find(Auth::user()->id);
        $item = Data::getStudent_thesis(Auth::user()->identity);

        $item->text = $request->text;
        $item->parse = $request->parse;
        $item->conf_font = $request->conf_font;
        $item->title = $request->title;
        $item->abstract = $request->abstract;
        $item->abstract_key = $request->abstract_key;
        $user->doc_title = $request->title;

        $user->save();
        $item->save();
    }
}
