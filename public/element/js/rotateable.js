$('.rotateable').click(function () {
    let el = this.children[0];
    if (el.getAttribute('class') === 'ti-arrow-up')
        el.setAttribute('class','ti-arrow-down');
    else
        el.setAttribute('class','ti-arrow-up');
    let target = this.parentElement.parentElement.parentElement.children[1].children[0];
    $(target).toggleClass('d-none');
});
