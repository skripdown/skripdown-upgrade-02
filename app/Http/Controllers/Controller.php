<?php
/** @noinspection PhpUndefinedMethodInspection */
/** @noinspection SpellCheckingInspection */
/** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Http\Data\ExcHandler;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Data\Data;
use App\Http\Data\Maker;
use App\Http\Data\Helper;
use App\Http\Data\Authorization_;

class Controller extends BaseController
{

    //-----------------------------ROOT-----------------------------//
    public function home() {
        return view('welcome');
    }

    public function dashboard() {
        if (Authorization_::student()) {
            $doc_url = null;
            if (!Data::hasThesis(Authorization_::data()->identity))
                $doc_url = Maker::makeDoc();
            else
                $doc_url = Data::getDoc_url(Authorization_::data()->identity);

            return redirect()->route('editor',array('url'=>$doc_url));
        }
        elseif (Authorization_::advisor()) {
            $data = Data::dataRouteDashboard_lecturer();
            return view('content.dashboard-lecturer',compact('data'));
        }
        elseif (Authorization_::department()) {
            $data = Data::dataRouteDashboard_department();
            return $data;
            return view('content.dashboard-department',compact('data'));
        }
        elseif (Authorization_::super()) {
            $data = Data::dataRouteDashboard_super();
            return view('content.dashboard-super',compact('data'));
        }
        return redirect()->route('home');
    }

    //-----------------------------STUDENT-----------------------------//
    public function submit_autosave(Request $request) {
        if (Authorization_::student()) {
            Maker::saveDoc($request);
            return response()->json(Helper::check($request),200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    public function editor_update(Request $request) {
        if (Authorization_::student()) {
            return response()->json(Data::getNotification(),200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    public function openDoc($url) {
        if (Authorization_::student()) {
            if (Data::isURL_thesis($url)) {
                if (Data::isSubmitedThesis($url))
                    return ExcHandler::getException(env('ERR_EDIT_SUBMITED_DOC'),array($url));
                $doc = Data::getStudent_thesis(Authorization_::data()->identity);
                return view('editor',compact('doc'));
            }
            return ExcHandler::getException(env('ERR_WRONG_URL_DOC'),array());
        }
        return 'authorization error';
    }

    public function parseDoc($url) {
        if (Authorization_::user()) {
            return Maker::parseDoc($url);
        }
        return 'authorization error';
    }

    public function proposeAdvisor(Request $request) {
        if (Authorization_::student()) {
            return response()->json(
                array(
                    'status'=>Data::checkProposal($request->lecturer_id, $request->lecturer_type)
                ), 200
            );
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    public function submitRevision(Request $request) {
        if (Authorization_::student()) {
            return response()->json(Maker::updateRevision($request->lectype),200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    public function submitRepository(Request $request) {
        if (Authorization_::student()) {
            return response()->json(Maker::requestSubmit(), 200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    public function readMessage(Request $request) {
        if (Authorization_::student()) {
            return response()->json(Maker::readMessage(), 200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    public function skripdownForeignWords(Request $request) {
        if (Authorization_::student()) {
            $response = Maker::skripdown($request);
            return response()->json($response,200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    //-----------------------------LECTURER-----------------------------//
    public function bimbinganHistory() {
        if (Authorization_::advisor()) {
            $data = Data::dataRouteBimbinganHistory_lecturer();
            return view('content.bimbingan-lecturer', compact('data'));
        }
        return 'authorization error';
    }

    public function ujianSkripsi() {
        if (Authorization_::advisor()) {
            $data = Data::ujianSkripsi_lecturer();
            return view('content.ujianSkripsi-lecturer', compact('data'));
        }
        return 'authorization error';
    }

    public function acceptSubmit(Request $request) {
        if (Authorization_::advisor()) {
            return response()->json(Maker::fireSubmit($request->author_id, $request->score), 200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    public function rejectSubmit(Request $request) {
        if (Authorization_::advisor()) {
            return response()->json(Maker::clearSubmit($request->author_id),200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    public function acceptThesis(Request $request) {
        if (Authorization_::advisor()) {
            return response()->json(Maker::acceptProposal($request->author_id), 200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    public function rejectThesis(Request $request) {
        if (Authorization_::advisor()) {
            return response()->json(Maker::rejectProposal($request->author_id, $request->title),200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    public function progresThesis(Request $request) {
        if (Authorization_::advisor()) {
            return response()->json(Maker::makeRevisionMessage($request->author_id,$request->message), 200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    public function exam(Request $request) {
        if (Authorization_::advisor()) {
            return response()->json(Maker::examinerPass($request),200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    //-----------------------------DEPARTMENT-----------------------------//
    public function deptSetting() {
        if (Authorization_::department()) {
            $title = Authorization_::data()->name;
            return view('content.setting-department',compact($title));
        }
        return 'authorization error';
    }

    public function ujianPlagiasi() {
        if (Authorization_::department()) {
            $data = '';
            return view('content.ujianPlagiasi-department',compact('data'));
        }
        return 'authorization error';
    }

    public function plagiarismCheck(Request $request) {
        if (Authorization_::department()) {
            return response()->json(Maker::scorePlagiarism($request), 200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    public function getPlagiarism(Request $request) {
        if (Authorization_::department()) {
            return response()->json(Data::getDepartmentPlagiarism(),200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    public function plagiarismConf(Request $request) {
        if (Authorization_::department()) {
            return response()->json(Maker::confPlagiarism($request), 200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    public function deptPassword(Request $request) {
        if (Authorization_::department()) {
            return response()->json(Maker::confPassword($request),200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    public function initExaminer(Request $request) {
        if (Authorization_::department()) {
            return response()->json(Maker::setExaminer($request),200);
        }
        return response()->json(array('auth'=>'authorization error!'),200);
    }

    //-----------------------------UNIVERSITY-----------------------------//

}
