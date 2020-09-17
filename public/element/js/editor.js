$(document).ready(()=>{

    const form = $('#form').get(0);
    const input_text = $('#text-val').get(0);
    const input_department = $('#department-val').get(0);
    const input_university = $('#university-val').get(0);
    const input_faculty    = $('#faculty-val').get(0);
    const skrip_input      = $('#skrip').get(0);

    const save_btn = $('#save').get(0);

    let text;
    let university,faculty,department;
    let temp_text;
    $(save_btn).click(()=>{
        temp_text = $(skrip_input).text();
        text = parse(temp_text);
        let temp;
        if ((temp = /^ *@university *: *([\w\S ]+) *$/m.exec(temp_text)) != null)
            university = temp[1];
        else
            university = 'umm';
        if ((temp = /^ *@faculty *: *([\w\S ]+) *$/m.exec(temp_text)) != null)
            faculty = temp[1];
        else
            faculty = 'teknik';
        if ((temp = /^ *@department *: *([\w\S ]+) *$/m.exec(temp_text)) != null)
            department = temp[1];
        else
            department = 'informatika';
        $(input_text).val(text);
        $(input_department).val(department);
        $(input_faculty).val(faculty);
        $(input_university).val(university);
        $(form).submit();
    });

});
