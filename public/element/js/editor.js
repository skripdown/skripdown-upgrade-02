let form;
let input_text;
let input_parse;
let input_department;
let input_university;
let input_faculty;
let input_conf_font;
let input_author;
let input_id;
let input_abstract;
let input_abs_key;
let input_url;
let input_title;
let input_lec1_id;
let input_lec1_name;
let input_lec2_id;
let input_lec2_name;
let skrip_input;
let preview_output;
let btn_setting;
let btn_font_up;
let btn_font_down;
let btn_live;
let btn_code;
let btn_disp_code;
let btn_disp_rendered;
let code_panel;
let preview_panel;
let preview_code;

let save_btn;
let skrip_d;
let skripd_link;
let skripd_autosave;
let skripd_token;

let conn_status;
let temp_conn_status;
let conn_bool;

let university,faculty,department;

let helper_warning;
let disp_warning;
let list_warning;

$(document).ready(()=>{

    form              = $('#form').get(0);
    input_text        = $('#text-val').get(0);
    input_parse       = $('#parse-val').get(0);
    input_department  = $('#department-val').get(0);
    input_university  = $('#university-val').get(0);
    input_faculty     = $('#faculty-val').get(0);
    input_author      = $('#author-val').get(0);
    input_id          = $('#id-val').get(0);
    input_abstract    = $('#abstract-val').get(0);
    input_abs_key     = $('#abstract-key-val').get(0);
    input_title       = $('#title-val').get(0);
    input_url         = $('#url-val').get(0);
    input_conf_font   = $('#conf-font-val').get(0);
    input_lec1_id     = $('#lec1-val').get(0);
    input_lec1_name   = $('#lec1-name-val').get(0);
    input_lec2_id     = $('#lec2-val').get(0);
    input_lec2_name   = $('#lec2-name-val').get(0);
    skrip_input       = $('#skrip').get(0);
    preview_output    = $('#preview-skrip').get(0);
    preview_code      = $('#preview-code').get(0);

    code_panel        = $('#panel-1').get(0);
    preview_panel     = $('#panel-2').get(0);

    btn_setting       = $('#btn-setting').get(0);
    btn_font_up       = $('#btn-font-up').get(0);
    btn_font_down     = $('#btn-font-down').get(0);
    btn_live          = $('#btn-display-live').get(0);
    btn_code          = $('#btn-display-code').get(0);
    btn_disp_code     = $('#display-code').get(0);
    btn_disp_rendered = $('#display-rendered').get(0);

    conn_status       = $('#connection-status').get(0);
    conn_bool         = false;

    save_btn          = $('#save').get(0);
    skrip_d           = new Skripdown('','');
    skripd_link       = $('meta[name=skripd_f_words]').attr('content');
    skripd_autosave   = $('meta[name=skripd_autosave]').attr('content');
    skripd_token      = $('meta[name=skripd_token]').attr('content');

    disp_warning      = $('#display-warning').get(0);
    list_warning      = $('#warning-list').get(0);

    helper_warning    = new Map();
    helper_warning.set('l1_id_corr',true);
    helper_warning.set('l1_name_corr',true);
    helper_warning.set('l1_name','');
    helper_warning.set('l2_id_corr',true);
    helper_warning.set('l2_name_corr',true);
    helper_warning.set('l2_name','');
    helper_warning.set('l1_verify',true);
    helper_warning.set('l2_verify',true);
    helper_warning.set('l1_progress','');
    helper_warning.set('l2_progress','');
    helper_warning.set('l_id_dup',false);

    temp_conn_status  = '';

    $(save_btn).click(()=>{
        const _text = $(skrip_input).html();
        const dept  = skrip_d.getDepartment();
        const fclt  = skrip_d.getFaculty();
        const univ  = skrip_d.getUniversity();
        const auth  = skrip_d.getAuthor();
        const id    = skrip_d.getId();
        const abst  = skrip_d.getAbstract();
        const ttle  = skrip_d.getTitle();
        $(input_text).val(_text);
        $(input_department).val(dept);
        $(input_faculty).val(fclt);
        $(input_university).val(univ);
        $(input_author).val(auth);
        $(input_id).val(id);
        $(input_abstract).val(abst);
        $(input_abs_key).val('no abstract key');
        $(input_title).val(ttle);
        $(input_conf_font).val($(skrip_input).data('font-editor'));
        $(form).submit();
    });

    $(btn_font_up).click(()=>{
        let size = parseInt($(skrip_input).data('font-editor'));
        if (size < 28) {
            size += 4;
            $(skrip_input).css('font-size',size+'pt');
            $(skrip_input).data('font-editor',size+'');
        }
    });

    $(btn_font_down).click(()=>{
        let size = parseInt($(skrip_input).data('font-editor'));
        if (size > 12) {
            size -= 4;
            $(skrip_input).css('font-size',size+'pt');
            $(skrip_input).data('font-editor',size+'');
        }
    });

    $(skrip_input).keydown(e=>{
        if ($(input_url).val() !== 'none') {
            const code = e.keyCode;
            if (code !== 37 && code !== 38 && code !== 39 && code !== 40) {
                if ($(conn_status).html() !== '<span class="text-info">Mengetik...</span>')
                    $(conn_status).html('<span class="text-info">Mengetik...</span>');
            }
        }
    });

    $(btn_live).click(()=>{
        $(btn_live).addClass('d-none');
        $(btn_code).removeClass('d-none');
        $(code_panel).removeClass('col-xl-12');
        $(code_panel).removeClass('col-lg-12');
        $(code_panel).removeClass('col-m-12');
        $(code_panel).removeClass('mr-auto');
        $(code_panel).removeClass('ml-auto');
        $(code_panel).addClass('col-6');
        $(preview_panel).removeClass('d-none');
        $(btn_disp_rendered).addClass('d-none');
        $(btn_disp_code).removeClass('d-none');
    });

    $(btn_code).click(()=>{
        $(btn_code).addClass('d-none');
        $(btn_live).removeClass('d-none');
        $(code_panel).addClass('col-xl-12');
        $(code_panel).addClass('col-lg-12');
        $(code_panel).addClass('col-m-12');
        $(code_panel).addClass('mr-auto');
        $(code_panel).addClass('ml-auto');
        $(code_panel).removeClass('col-6');
        $(preview_panel).addClass('d-none');
        $(btn_disp_rendered).addClass('d-none');
        $(btn_disp_code).addClass('d-none');
    });

    $(btn_disp_code).click(()=>{
        $(btn_disp_code).addClass('d-none');
        $(btn_disp_rendered).removeClass('d-none');
        $(preview_output).addClass('d-none');
        $(preview_code).removeClass('d-none');
    });

    $(btn_disp_rendered).click(()=>{
        $(btn_disp_rendered).addClass('d-none');
        $(btn_disp_code).removeClass('d-none');
        $(preview_code).addClass('d-none');
        $(preview_output).removeClass('d-none');
    });

    $(skrip_input).keyup(e=>{
        const code = e.keyCode;
        if (code !== 37 && code !== 38 && code !== 39 && code !== 40) {
            if ($(input_url).val() !== 'none') {
                const for_parse = skrip_d.parse(skrip_input.innerText+'\n');
                $(input_text).val(skrip_input.innerHTML);
                $(input_parse).val(for_parse);
                $(preview_output).html(for_parse);
                $(preview_code).text(for_parse);
                setTimeout(()=>{
                    if ($(conn_status).html() !== '<span class="text-info">Mengetik...</span>'
                        && $(conn_status).html() !== '<span class="text-info">Menyimpan...</span>')
                        $(conn_status).html('<span class="text-info">Menyimpan...</span>');
                    const dosen_data = skrip_d.getLecturer();
                    $.ajax({
                        type    : 'POST',
                        url     : ''+skripd_autosave+'',
                        data    : {
                            _token       : skripd_token,
                            title        : skrip_d.getTitle(),
                            author       : skrip_d.getAuthor(),
                            id_          : skrip_d.getId(),
                            abstract     : skrip_d.getAbstract(),
                            abstract_key : 'none',
                            text         : $(skrip_input).html(),
                            university   : skrip_d.getUniversity(),
                            department   : skrip_d.getDepartment(),
                            faculty      : skrip_d.getFaculty(),
                            parse        : skrip_d.getParsed(),
                            url          : $(input_url).val(),
                            l1_id        : dosen_data[0],
                            l1_name      : dosen_data[1],
                            l2_id        : dosen_data[2],
                            l2_name      : dosen_data[3],
                            conf_font    : $(input_conf_font).val()
                        },
                        success : response=>{
                            if (response.json_0 === '1') helper_warning.set('l1_id_corr', true);
                            else helper_warning.set('l1_id_corr', false);
                            if (response.json_1 === '1') helper_warning.set('l1_name_corr', true);
                            else helper_warning.set('l1_name_corr', false);
                            helper_warning.set('l1_name', response.json_2);
                            if (response.json_3 === '1') helper_warning.set('l2_id_corr', true);
                            else helper_warning.set('l2_id_corr', false);
                            if (response.json_4 === '1') helper_warning.set('l2_name_corr', true);
                            else helper_warning.set('l2_name_corr', false);
                            helper_warning.set('l2_name', response.json_5);
                            if (response.json_6 === '1') helper_warning.set('l1_verify', true);
                            else helper_warning.set('l1_verify', false);
                            if (response.json_7 === '1') helper_warning.set('l2_verify', true);
                            else helper_warning.set('l2_verify', false);
                            if (response.json_8 === '1') helper_warning.set('l1_progress', true);
                            else helper_warning.set('l1_progress', false);
                            if (response.json_9 === '1') helper_warning.set('l2_progress', true);
                            else helper_warning.set('l2_progress', false);
                            if (response.json_10 === '1') helper_warning.set('l_id_dup', true);
                            else helper_warning.set('l_id_dup', false);
                        }
                    });
                },500);
            }
        }
    });

});

window.setInterval(()=>{
    const temp = skrip_d.update_foreign_word();
    $.ajax({
        type    : 'POST',
        url     : ''+skripd_link+'',
        data    : {_token:skripd_token,foreign_word:temp[0],translate_word:temp[1]},
        success : data=>{
            skrip_d.set_foreign_word(data.foreign_word,data.translate_word);
            temp_conn_status = '';
            $(conn_status).html(temp_conn_status);
            $(skrip_input).removeClass('muted');
            $(skrip_input).attr('contenteditable','true');
            $(btn_setting).removeClass('d-none');
            conn_bool = true;
            if (helper_warning != null) {
                let warning_count = 0;
                let html_warning  = '';
                const _open       = '<span class="dropdown-item">';
                const _close      = '</span>';
                const dosen_data  = skrip_d.getLecturer();
                if (dosen_data[0] !== 'noid' && dosen_data[2] !== 'noid') {
                    if (!helper_warning.get('l1_verify') && helper_warning.get('l2_verify')) {
                        if (helper_warning.get('l1_id_corr'))
                            html_warning += _open + 'belum disetujui oleh ' + helper_warning.get('l1_name') + _close;
                        else
                            html_warning += _open + 'NID pembimbing 1 salah' + _close;
                        warning_count++;
                    }
                    else if (helper_warning.get('l1_verify') && !helper_warning.get('l2_verify')) {
                        if (helper_warning.get('l2_id_corr'))
                            html_warning += _open + 'belum disetujui oleh ' + helper_warning.get('l2_name') + _close;
                        else
                            html_warning += _open + 'NID pembimbing 2 salah' + _close;
                        warning_count++;
                    }
                    else if (!helper_warning.get('l1_verify') && !helper_warning.get('l2_verify')) {
                        if (helper_warning.get('l1_id_corr') && helper_warning.get('l2_id_corr')) {
                            html_warning += _open + 'belum disetujui oleh kedua pembimbing' + _close;
                        }
                        else if (!helper_warning.get('l1_id_corr') && helper_warning.get('l2_id_corr')) {
                            html_warning += _open + 'NID pembimbing 1 salah' + _close;
                            html_warning += _open + 'belum disetujui oleh ' + helper_warning.get('l2_name') + _close;
                            warning_count++;
                        }
                        else if (helper_warning.get('l1_id_corr') && !helper_warning.get('l2_id_corr')) {
                            html_warning += _open + 'belum disetujui oleh ' + helper_warning.get('l1_name') + _close;
                            html_warning += _open + 'NID pembimbing 2 salah' + _close;
                            warning_count++;
                        }
                        else {
                            html_warning += _open + 'NID kedua pembimbing salah' + _close;
                        }
                        warning_count++;
                    }
                }
                else {
                    html_warning += _open + 'tidak ada pembimbing' + _close;
                    warning_count++;
                }

                if (!skrip_d.hasBab_i()) {
                    html_warning += _open + 'BAB I tidak ada' + _close;
                    warning_count++;
                }
                if (!skrip_d.hasBab_ii()) {
                    html_warning += _open + 'BAB II tidak ada' + _close;
                    warning_count++;
                }
                if (!skrip_d.hasBab_iii()) {
                    html_warning += _open + 'BAB III tidak ada' + _close;
                    warning_count++;
                }
                if (!skrip_d.hasBab_iv()) {
                    html_warning += _open + 'BAB IV tidak ada' + _close;
                    warning_count++;
                }
                if (!skrip_d.hasBab_v()) {
                    html_warning += _open + 'BAB V tidak ada' + _close;
                    warning_count++;
                }
                if (!skrip_d.hasLatar_belakang()) {
                    html_warning += _open + 'tidak ada latar belakang' + _close;
                    warning_count++;
                }
                if (!skrip_d.hasRumusan_masalah()) {
                    html_warning += _open + 'tidak ada rumusan masalah' + _close;
                    warning_count++;
                }
                if (!skrip_d.hasTujuan_penelitian()) {
                    html_warning += _open + 'tidak ada tujuan penelitian' + _close;
                    warning_count++;
                }

                if (warning_count > 1) $(disp_warning).removeClass('d-none');
                else $(disp_warning).addClass('d-none');
                $(list_warning).html(html_warning);
            }
        },
        error: ()=>{
            temp_conn_status = '<span class="bg-danger text-white p-1 rounded">Tidak Terhubung !</span>';
            $(skrip_input).addClass('muted');
            $(skrip_input).attr('contenteditable','false');
            $(conn_status).html(temp_conn_status);
            $(btn_setting).addClass('d-none');
            conn_bool = false;
        }
    });
},500);
