<?php
/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */

namespace App\Http\Data;

use Illuminate\Support\Facades\Auth;

class Helper {

    //JSON RETURN STRUCTURE
    //0: lecturer_1 id correctness
    //1: lecturer_1 name correctness
    //2: lecturer_1 name
    //3: lecturer_2 id correctness
    //4: lecturer_2 name correctness
    //5: lecturer_2 name
    //6: lecturer_1 verification
    //7: lecturer_2 verification
    //8: lecturer_1 progress
    //9: lecturer_2 progress
    //10: lecturer identity duplicated
    //11: lecturer_1 identity
    //12: lecturer_2 identity
    //13: lecturer_1 reject proposal
    //14: lecturer_2 reject proposal

    public static function check($request) {
        $l1_id = $request->l1_id;
        $l2_id = $request->l2_id;
        $l1_nm = $request->l1_name;
        $l2_nm = $request->l2_name;

        $json_0  = '0';
        $json_1  = '0';
        $json_2  = 'noname';
        $json_3  = '0';
        $json_4  = '0';
        $json_5  = 'noname';
        $json_6  = '0';
        $json_7  = '0';
        $json_8  = '0';
        $json_9  = '0';
        $json_10 = '0';
        $json_11 = 'noid';
        $json_12 = 'noid';
        $json_13 = '0';
        $json_14 = '0';

        if (Data::hasLecturer($l1_id)) {
            $lect_1 = Data::getLecturer($l1_id);
            $json_0 = '1';
            $json_2 = $lect_1->name;
            if (!Data::wasRejected(Auth::user()->identity,$l1_id,Data::getWriter()->doc_title))
                Maker::setAdvisor($l1_id, '1');
            else
                $json_13 = '1';
            if ($json_2 == $l1_nm)
                $json_1 = '1';
        }
        if (Data::hasLecturer($l2_id)) {
            $lect_2 = Data::getLecturer($l2_id);
            $json_3 = '1';
            $json_5 = $lect_2->name;
            if (!Data::wasRejected(Auth::user()->identity,$l2_id,Data::getWriter()->doc_title))
                Maker::setAdvisor($l2_id, '2');
            else
                $json_14 = '1';
            if ($json_5 == $l2_nm)
                $json_4 = '1';
        }

        if ($json_0 == '1' && Data::isVerified_thesis_by($l1_id)) {
            $json_6  = '1';
            $json_11 = $request->l1_id;
        }
        if ($json_3 == '1' && Data::isVerified_thesis_by($l2_id)) {
            $json_7  = '1';
            $json_12 = $request->l2_id;
        }

        if ($json_0 == '1' && $json_3 == '1' && $l1_id == $l2_id) $json_10 = '1';

        return array(
            'json_0'=>$json_0,
            'json_1'=>$json_1,
            'json_2'=>$json_2,
            'json_3'=>$json_3,
            'json_4'=>$json_4,
            'json_5'=>$json_5,
            'json_6'=>$json_6,
            'json_7'=>$json_7,
            'json_8'=>$json_8,
            'json_9'=>$json_9,
            'json_10'=>$json_10,
            'json_11'=>$json_11,
            'json_12'=>$json_12,
            'json_13'=>$json_13,
            'json_14'=>$json_14
        );
    }
}
