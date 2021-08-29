displayErrorMessage = function(e,m,i) {
    let y=$(e).data('item');
    $('.' + y + '-error-'+i).html(m).show();
}
hideErrorMessage = function(e,i) {
    let y= $(e).data('item');
    $('.'+y+'-error-'+i).hide();
}

$('#school-origin').on('change',function(){
    checkRequiredElement($(this),0);
});

$('#study-field').on('change',function(){
    checkRequiredElement($(this),0);
});

$('#stud-surname').on('blur',function(){
    checkRequiredElement($(this),0);
});

$('#stud-name').on('blur',function(){
    checkRequiredElement($(this),0);
});

$('#stud-address').on('blur',function(){
    checkRequiredElement($(this),0);
});

$('#stud-zip').on('blur',function(){
    checkRequiredElement($(this),0);
});

$('#stud-town').on('blur',function(){
    checkRequiredElement($(this),0);
});

$('#stud-email').on('blur',function(){
    checkRequiredElement($(this),0);
});

$('#stud-birthdate').on('blur',function(){
    checkRequiredElement($(this),0);
});

$('#stud-phoneNumber').on('blur',function(){
    checkRequiredElement($(this),0);
});

$('#legal-name').on('blur',function(){
    checkRequiredElement($(this),1);
});

$('#legal-surname').on('blur',function(){
    checkRequiredElement($(this),1);
});

$('#legal-birthdate').on('blur',function(){
    checkRequiredElement($(this),1);
});

$('#legal-address').on('blur',function(){
    checkRequiredElement($(this),1);
});

$('#legal-zip').on('blur',function(){
    checkRequiredElement($(this),1);
});

$('#legal-town').on('blur',function(){
    checkRequiredElement($(this),1);
});

$('#legal-email').on('blur',function(){
    checkRequiredElement($(this),1);
});

$('#legal-phone').on('blur',function(){
    checkRequiredElement($(this),1);
});

$('#op-upload-stud').on('click',function(){
    uploadIdCard('stud');
});

$('#op-upload-legal').on('click',function(){
    uploadIdCard('legal');
});






