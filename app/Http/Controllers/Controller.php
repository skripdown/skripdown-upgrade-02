<?php
/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection SpellCheckingInspection */
/** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Skripdown;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Services\Data;
use Services\Maker;

class Controller extends BaseController
{

    //-----------------------------ROOT-----------------------------//
    public function dashboard() {
        if (Auth::check()) {
            if (Auth::user()->role == 'student') {
                $doc_url = null;
                if (!Data::hasThesis(Auth::user()->identity))
                    $doc_url = Maker::makeDoc();
                else
                    $doc_url = Data::getDoc_url(Auth::user()->identity);

                return redirect()->route('editor',array('url'=>$doc_url));
            }
            elseif (Auth::user()->role == 'lecturer') {
                $data = Data::getStudents_data(Auth::user()->identity);
                return view('content.dashboard-lecturer',compact('data'));
            }
            elseif (Auth::user()->role == 'department') {
                $data = Data::getStudents_data(Auth::user()->identity);
                return view('content.dashboard-department',compact('data'));
            }
            else {
                $data = Data::getStudents_data(Auth::user()->identity);
                return view('content.dashboard-super',compact('data'));
            }
        }
        return view('welcome');
    }

    //-----------------------------STUDENT-----------------------------//

    public function submit(Request $request) {
        $urls = $this->makeDoc($request);
        return redirect('/editor/'.$urls);
    }

    public function submit_autosave(Request $request) {
        $this->makeDoc($request);
        return response()->json(array('status'=>'1'),200);
    }

    public function openDoc($url) {
        $check = DB::table('documents')->where('url',$url)->get()->count();
        if ($check == 1) {
            $doc = DB::table('documents')->where('url',$url)->first();
            return view('editor',compact('doc'));
        }
        else {
            return '404 NOT FOUND!';
        }
    }

    public function parseDoc($url) {
        $check = DB::table('documents')->where('url',$url)->get()->count();
        if ($check == 1) {
            $doc = DB::table('documents')->where('url',$url)->first();
            $result = array($doc->university,$doc->department,$doc->parse);
            return view('print.out',compact('result'));
        }
        else {
            return '404 NOT FOUND!';
        }
    }

    public function skripdownForeignWords(Request $request) {

        $skripdown = Skripdown::find(1);
        if ($request->foreign_word !== 'online|offline') {
            $skripdown->foreign_words = $request->foreign_word;
            $skripdown->translate_words = $request->translate_word;
            $skripdown->save();
        }

        return response()->json(
            array(
                'foreign_word'=>$skripdown->foreign_words,
                'translate_word'=>$skripdown->translate_words
            ),200
        );
    }

    //-----------------------------LECTURER-----------------------------//
    public function acceptThesis(Request $request) {

    }

    public function rejectThesis(Request $request) {

    }

    public function progresThesis(Request $request) {

    }

}
