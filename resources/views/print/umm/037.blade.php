<style>

    /*DOCUMENT BODY*/

    body {
        margin: 0;
    }

    #frame {
        font-family: "Times New Roman",serif;
        font-size  : 1.2em;
        width: 90%;
        margin: 30px auto;
        counter-reset: bab;
    }

    /*DOCUMENT BAB CSS CONFIGURATION*/

    .bab {
        font-weight: bold;
        text-align: center;
        counter-increment: bab;
        counter-reset: sub_1;
        margin-bottom: 1.75em;
    }

    #bab-1::after{
        content: "BAB I \A\A PENDAHULUAN \A\A\A ";
        white-space: pre;
        display: inline;
    }

    #bab-2::after{
        content: "BAB II \A\A KAJIAN TEORI \A\A\A ";
        white-space: pre;
        display: inline;
    }

    #bab-3::after{
        content: "BAB III \A\A METODOLOGI PENELITIAN \A\A\A ";
        white-space: pre;
        display: inline;
    }

    #bab-4::after{
        content: "BAB IV \A\A IMPLEMENTASI DAN PENGUJIAN \A\A\A ";
        white-space: pre;
        display: inline;
    }

    #bab-5::after{
        content: "BAB V \A\A KESIMPULAN \A\A\A ";
        white-space: pre;
        display: inline;
    }

    /*DOCUMENT SUB BAB CSS CONFIGURATION*/

    .sub {
        font-weight: bold;
        text-transform: capitalize;
    }

    p + .sub, .group-alpha-list + .sub  {
        margin-top: 40px;
    }

    .sub + .sub{
        margin-top: 0.5em;
    }

    .sub-1 {
        counter-reset: sub_2;
    }

    .sub-2 {
        counter-reset: sub_3;
    }

    .sub-3 {
        counter-reset: sub_4;
    }

    .sub-4 {
        counter-reset: sub_5;
    }

    .sub-5 {
        counter-reset: sub_6;
    }

    .sub-1::before {
        content: counters(bab,"") "."
        counters(sub_1,"") ". ";
        counter-increment: sub_1;
    }

    .sub-2::before {
        content: counters(bab,"") "."
        counters(sub_1,"") "."
        counters(sub_2,"") ". ";
        counter-increment: sub_2;
    }

    .sub-3::before {
        content: counters(bab,"") "."
        counters(sub_1,"") "."
        counters(sub_2,"") "."
        counters(sub_3,"") ". ";
        counter-increment: sub_3;
    }

    .sub-4::before {
        content: counters(bab,"") "."
        counters(sub_1,"") "."
        counters(sub_2,"") "."
        counters(sub_3,"") "."
        counters(sub_4,"") ". ";
        counter-increment: sub_4;
    }

    .sub-5::before {
        content: counters(bab,"") "."
        counters(sub_1,"") "."
        counters(sub_2,"") "."
        counters(sub_3,"") "."
        counters(sub_4,"") "."
        counters(sub_5,"") ". ";
        counter-increment: sub_5;
    }

    .sub-6::before {
        content: counters(bab,"") "."
        counters(sub_1,"") "."
        counters(sub_2,"") "."
        counters(sub_3,"") "."
        counters(sub_4,"") "."
        counters(sub_5,"") "."
        counters(sub_6,"") ". ";
        counter-increment: sub_6;
    }

    /*DOCUMENT LOWER-ALPHABET NUMBERING CSS CONFIGURATION*/

    .group-alpha-list {
        padding: 0;
        margin-left: 68px;
        counter-reset: alpha_list;
    }

    .sub + .group-alpha-list{
        margin-top: 0.5em;
    }

    .alpha-list {
        line-height: 1.75em;
        text-align: justify;
        text-indent: -25px;
    }

    .alpha-list::before {
        content: counter(alpha_list,lower-alpha) ") ";
        counter-increment: alpha_list;
    }

    /*DOCUMENT PARAGRAPH CSS CONFIGURATION*/

    p {
        line-height: 1.75em;
        text-align: justify;
        text-indent: 60px;
        padding: 0;
        margin: 0 0 0 40px;
    }

    .sub + p{
        margin-top: 0.5em;
    }
</style>
