<?php
/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection SpellCheckingInspection */
/** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Http\Data\Data;
use App\Http\Data\Maker;
use App\Http\Data\Helper;

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

    public function editor_update(Request $request) {
        return response()->json(Data::getNotification(),200);
    }

    public function openDoc($url) {
        if (Data::isURL_thesis($url)) {
            if (Data::isSubmitedThesis($url))
                return 'THESIS HAS BEEN SUBMITED AND CAN NOT BE EDITED!';
            $doc = Data::getStudent_thesis(Auth::user()->identity);
            return view('editor',compact('doc'));
        }
        return '404 NOT FOUND!';
    }

    public function parseDoc($url) {
        return Maker::parseDoc($url);
    }

    public function proprseAdvisor(Request $request) {
        return response()->json(
            array(
                'status'=>Data::checkProposal($request->lecturer_id, $request->lecturer_type)
            ), 200
        );
    }

    public function submitRevision(Request $request) {
        return response()->json(Maker::updateRevision($request->lectype),200);
    }

    public function submitRepository(Request $request) {
        return response()->json(Maker::requestSubmit(), 200);
    }

    public function readMessage(Request $request) {
        return response()->json(Maker::readMessage($request->idMsg), 200);
    }

    public function skripdownForeignWords(Request $request) {
        $response = Maker::skripdown($request);
        return response()->json($response,200);
    }

    //-----------------------------LECTURER-----------------------------//
    public function acceptSubmit(Request $request) {
        return response()->json(Maker::fireSubmit($request->student_id, $request->score), 200);
    }

    public function acceptThesis(Request $request) {
        return response()->json(Maker::acceptProposal($request->student_id), 200);
    }

    public function rejectThesis(Request $request) {
        return response()->json(Maker::rejectProposal($request->student_id, $request->title),200);
    }

    public function progresThesis(Request $request) {
        return response()->json(Maker::makeRevisionMessage($request->message), 200);
    }

    public function exam(Request $request) {
        return response()->json(Maker::examinerPass($request),200);
    }

    //-----------------------------DEPARTMENT-----------------------------//
    public function plagiarismCheck(Request $request) {
        return response()->json(Maker::scorePlagiarism($request), 200);
    }

    public function plagiarismConf(Request $request) {
        return response()->json(Maker::confPlagiarism($request), 200);
    }

    public function deptPassword(Request $request) {
        return response()->json(Maker::confPassword($request),200);
    }

    public function initExaminer(Request $request) {
        return response()->json(Maker::setExaminer($request),200);
    }

    //-----------------------------UNIVERSITY-----------------------------//

}
