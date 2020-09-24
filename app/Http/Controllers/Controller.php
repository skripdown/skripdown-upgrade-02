<?php
/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection SpellCheckingInspection */
/** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Services\Data;
use Services\Helper;
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
    public function submit_autosave(Request $request) {
        Maker::saveDoc($request);
        return response()->json(Helper::check($request),200);
    }

    public function openDoc($url) {
        if (Data::isURL_thesis($url)) {
            $doc = Data::getStudent_thesis(Auth::user()->identity);
            return view('editor',compact('doc'));
        }
        return '404 NOT FOUND!';
    }

    public function parseDoc($url) {
        return Maker::parseDoc($url);
    }

    public function skripdownForeignWords(Request $request) {
        $response = Maker::skripdown($request);
        return response()->json($response,200);
    }

    //-----------------------------LECTURER-----------------------------//
    public function acceptThesis(Request $request) {

    }

    public function rejectThesis(Request $request) {

    }

    public function progresThesis(Request $request) {

    }

}
