<?php
/** @noinspection PhpUndefinedFieldInspection */
/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlDialectInspection */

namespace Services;

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

    public static function check($request) {
        $l1_id = $request->l1_id;
        $l2_id = $request->l2_id;
        $l1_nm = $request->l1_name;
        $l2_nm = $request->l2_name;

        $json_0 = '0';
        $json_1 = '0';
        $json_2 = 'none';
        $json_3 = '0';
        $json_4 = '0';
        $json_5 = 'none';
        $json_6 = '0';
        $json_7 = '0';
        $json_8 = '0';
        $json_9 = '0';

        if (Data::hasLecturer($l1_id)) {
            $lect_1 = Data::getLecturer($l1_id);
            $json_0 = '1';
            $json_2 = $lect_1->name;
            if ($json_2 == $l1_nm)
                $json_1 = '1';
        }
        if (Data::hasLecturer($l2_id)) {
            $lect_2 = Data::getLecturer($l2_id);
            $json_3 = '1';
            $json_5 = $lect_2->name;
            if ($json_5 == $l2_nm)
                $json_4 = '1';
        }


        return '';
    }
}
