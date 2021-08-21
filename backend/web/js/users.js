getRequiredNumber = function(f) {
    var x=0;
    f.find('select,input,textarea').each(function(){
        if ($(this).prop('required')) {
            ++x;
        }
    });
    return x;
}

removeErrorMessage = function (e,b) {
    var p = e.parent();
    e.removeClass('form-control-danger');
    p.removeClass('has-danger');
    p.find('small').html('');
    let t = parseInt(b.html());
    if (t>0) {
        b.html(--t);
    }
}

addErrorMessage = function (f,e,b,m,) {
    var p = e.parent();
    e.addClass('form-control-danger');
    p.addClass('has-danger');
    p.find('small').html(m);
    let t = parseInt(b.html());
    let c = getRequiredNumber(f);
    if (t < c) {
        b.html(++t);
    }
}

