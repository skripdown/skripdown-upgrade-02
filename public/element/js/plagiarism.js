$('#popup_cek_plagiarisme').on('show.bs.modal',e=>{
    window.auth_id = $(e.relatedTarget).data('author');
    let score_b1 = $(e.relatedTarget).data('score-b1'),
        score_b2 = $(e.relatedTarget).data('score-b2'),
        score_b3 = $(e.relatedTarget).data('score-b3'),
        score_b4 = $(e.relatedTarget).data('score-b4'),
        score_b5 = $(e.relatedTarget).data('score-b5');
    let inputs = [
        $('#in-bab-i').get(0),
        $('#in-bab-ii').get(0),
        $('#in-bab-iii').get(0),
        $('#in-bab-iv').get(0),
        $('#in-bab-v').get(0)
    ];
    $(inputs[0]).val(score_b1+'');
    $(inputs[1]).val(score_b2+'');
    $(inputs[2]).val(score_b3+'');
    $(inputs[3]).val(score_b4+'');
    $(inputs[4]).val(score_b5+'');
    init_submitable_modal(inputs);
}).on('hidden.bs.modal',e=>{
    $(e.relatedTarget).data('score-b1',$('#in-bab-i').val());
    $(e.relatedTarget).data('score-b2',$('#in-bab-ii').val());
    $(e.relatedTarget).data('score-b3',$('#in-bab-iii').val());
    $(e.relatedTarget).data('score-b4',$('#in-bab-iv').val());
    $(e.relatedTarget).data('score-b5',$('#in-bab-v').val());
});
$('#submit-plag').on('click', ()=>{
    const token = $('meta[name=submit_token]').attr('content'),
        link  = $('meta[name=plag_link]').attr('content');
    const inp   = [
        $('#in-bab-i').get(0),
        $('#in-bab-ii').get(0),
        $('#in-bab-iii').get(0),
        $('#in-bab-iv').get(0),
        $('#in-bab-v').get(0)
    ];
    if (init_submitable_modal(inp)) {
        $.ajax({
            type    : 'POST',
            url     : ''+link+'',
            data    : {
                _token  : token,
                auth_id : window.auth_id,
                bab_i   : inp[0].value+'',
                bab_ii  : inp[1].value+'',
                bab_iii : inp[2].value+'',
                bab_iv  : inp[3].value+'',
                bab_v   : inp[4].value+''
            }
        });
    }
});
$('.plag-form').keyup(function () {
    const id  = this.getAttribute('id');
    const val = $(this).val();
    let target;
    let standard;
    if (id === 'in-bab-i') {
        target = this.children[2];
        standard = window.std_bab_i;
    }
    else if (id === 'in-bab-ii') {
        target = this.children[3];
        standard = window.std_bab_ii;
    }
    else if (id === 'in-bab-iii') {
        target = this.children[4];
        standard = window.std_bab_iii;
    }
    else if (id === 'in-bab-iv') {
        target = this.children[5];
        standard = window.std_bab_iv;
    }
    else {
        target = this.children[6];
        standard = window.std_bab_v;
    }
    if (val !== '') {
        if (/^(\d{1,2}(\.\d+)?|100|0)$/m.exec(val) != null) {
            $(this).removeClass('border-danger');
            const score = parseFloat(val);
            if (score <= standard)
                $(target).html('<span class="text-danger">'+score+'% / '+standard+'%</span>');
            else
                $(target).html('<span class="text-success">'+score+'% / '+standard+'%</span>');
        }
        else {
            $(this).addClass('border-danger');
            $(target).html('<span class="text-muted">belum</span>');
        }
    }
    else {
        $(this).removeClass('border-danger');
        $(target).html('<span class="text-muted">belum</span>');

    }
});

function init_submitable_modal(inputs) {
    let submitable = true;
    for (let i = 0; i < inputs.length; i++) {
        if (!submitable_plag_form(inputs[i].value)) {
            submitable = false;
            if (inputs[i].value !== '')
                $(inputs[i]).addClass('border-danger');
        }
        else
            $(inputs[i]).removeClass('border-danger');
    }
    return submitable;
}

function submitable_plag_form(value) {
    if (value === '') return false;
    return /^(\d{1,2}(\.\d+)?|100|0)$/m.exec(value) != null;
}
