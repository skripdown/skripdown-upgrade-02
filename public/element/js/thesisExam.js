class Dosen {
    constructor(url_photo, name, identity, total_bimbingan) {
        this.url_ph = url_photo;
        this.name = name;
        this.identity = identity;
        this.total_bimbingan = total_bimbingan;
        this.map_bimbingan = new Map();
    }
}
function generatePopupList(dosens, identity) {
    let tbody = '';
    let status = '';
    for (let i= 0; i < dosens.length; i++) {
        tbody += '<tr data-id="'+dosens[i].identity+'" ';
        if (dosens[i].map_bimbingan.has(identity)) {
            tbody += 'class="clicked-row"';
            status = 'dipilih';
        }
        else {
            status = 'sedang menguji '+dosens[i].total_bimbingan+ 'skripsi';
        }
        tbody += '><td class="border-top-0 px-2">' +
            '<div class="d-flex no-block align-items-center">' +
            '<div class="mr-3"><img src="'+dosens[i].url_ph+'" ' +
            'alt="user" class="rounded-circle" width="45" height="45" /></div>' +
            '<div class=""><h5 class="text-dark mb-0 font-16 font-weight-medium">'+dosens[i].name+'</h5>' +
            '<span class="text-muted font-14">NID PENGUJI</span></div></div></td>' +
            '<td class="border-top-0 px-2"><div class="opacity-7 text-muted text-center">'+status +
            '.</div></td></tr>';
    }

    return tbody;
}
function deleteAction(dosens, dosens_id, identity) {
    for (let i = 0; i < dosens.length; i++) {
        if (dosens[i].identity === dosens_id) {
            dosens[i].map_bimbingan.delete(identity);
            dosens[i].total_bimbingan = dosens[i].total_bimbingan - 1;
            break;
        }
    }
}
function addAction(dosens, dosens_id, identity) {
    let name = '';
    for (let i = 0; i < dosens.length; i++) {
        if (dosens[i].identity === dosens_id) {
            dosens[i].map_bimbingan.set(identity, true);
            dosens[i].total_bimbingan = dosens[i].total_bimbingan + 1;
            name = dosens[i].name;
            break;
        }
    }
    return name;
}
$(document).on('mouseenter','.btn-danger-2',function () {
    window.danger_btn_tmp = $(this).html();
    $(this).html(window.danger_btn_tmp+'<i class="ti-trash"></i>');
}).on('mouseout','.btn-danger-2',function () {
    $(this).html(window.danger_btn_tmp);
});
$(document).on('click','.active-row > tr',function () {
    if (this.getAttribute('class') !== 'clicked-row') {
        let submit_btn = $('#pilih-penguji-sbmt').get(0);
        let children = $('.active-row').get(0).children;
        let clicked;
        for (let i = 0; i < children.length; i++) {
            if (children[i].getAttribute('class') === 'clicked-row') {
                clicked = children[i];
                if (clicked === this) {
                    $(this).removeClass('clicked-row');
                    $(submit_btn).addClass('opacity-7');
                    $(submit_btn).data('clickable','0');
                    window.clicked_examiner = null;
                }
                else {
                    $(clicked).removeClass('clicked-row');
                    $(this).addClass('clicked-row');
                    $(submit_btn).removeClass('opacity-7');
                    $(submit_btn).data('clickable','1');
                    window.clicked_examiner = $(this).data('id');
                }
            }
        }
    }
});
$(document).on('click','.active-row-add',function () {
    window.student_identity = $(this.parentElement).data('identity');
    window.student_row = this.parentElement;
    $('#examiner-list').html(generatePopupList(window.dosens, window.student_identity));
});
$(document).on('click','.active-row-del',function () {
    const parent = this.parentElement;
    const dosen_id = $(this).data('identity');
    deleteAction(window.dosens,dosen_id,$(parent).data('identity'));
    parent.removeChild(this);
    const amount_examiner = parseInt($(parent).data('amount-examiner'))-1;
    $(parent).data('amount-examiner',amount_examiner+'');
    $(parent.lastChild).removeClass('d-none');
    const btn_sub = window.student_row.nextSibling.children[0];
    $(btn_sub).addClass('opacity-7');
    $(btn_sub).data('clickable','0');
    let examiner_str = $(btn_sub).data('examiner');
    examiner_str = examiner_str.replace(dosen_id,'');
    if (examiner_str.length > 0) {
        if (examiner_str.charAt(examiner_str.length-1) === ';')
            examiner_str = examiner_str.slice(0,-1);
    }
    $(btn_sub).data('examiner',examiner_str);
});
$(document).on('click','.active-row-sbm',function () {
    if ($(this).data('clickable') === '1') {
        const row       = this.parentElement.parentElement;
        const parent    = row.parentElement;
        const examiners = $(this).data('examiner');
        const author_id = $(this).data('identity');
        $.ajax({
            type    : 'POST',
            url     : window.exam_link,
            data    : {_token:'{{csrf_token()}}',examiners:examiners ,author_id:author_id},
            success : ()=>{
                parent.removeChild(row);
            }
        });
    }
});
$('#pilih-penguji-sbmt').click(function () {
    if ($(this).data('clickable') !== '0') {
        const name = addAction(window.dosens, window.clicked_examiner, window.student_identity);
        const amount_examiner = parseInt($(window.student_row).data('amount-examiner'))+1;
        $(window.student_row).data('amount-examiner',amount_examiner+'');
        const btn_examiner = document.createElement('BUTTON');
        btn_examiner.setAttribute('class','btn btn-secondary btn-info btn-danger-2 active-row-del');
        btn_examiner.setAttribute('data-identity',window.clicked_examiner+'');
        btn_examiner.innerText = name;
        window.student_row.insertBefore(btn_examiner,window.student_row.children[window.student_row.children.length-1]);
        if (amount_examiner >= window.examiner_amount) {
            $(window.student_row.lastChild).addClass('d-none');
            const btn_sub = window.student_row.nextSibling.children[0];
            $(btn_sub).removeClass('opacity-7');
            $(btn_sub).data('clickable','1');
            if ($(btn_sub).data('examiner') === '')
                $(btn_sub).data('examiner',window.clicked_examiner);
            else
                $(btn_sub).data('examiner',';'+window.clicked_examiner);
        }
    }
});
