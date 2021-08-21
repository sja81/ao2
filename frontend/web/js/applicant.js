$('#gdpr-consent').on('click',function(){
    if($('#gdpr-win').is(':visible')) {
        $('#gdpr-win').hide();
    } else {
        $('#gdpr-win').show();
    }
});
$('#application-source').on('change',function(){
    var v = $(this).val();
    if( v == 'nodef' && v != 'refcode') {
        $('#other-src').show();
        $('#referal-code').hide();
    } else if( v == 'refcode' && v != 'nodef') {
        $('#referal-code').show();
        $('#other-src').hide();
    } else {
        $('#referal-code').hide();
        $('#other-src').hide();
    }
});