
$('#obh-firma-id').on('change',function(){
    let company = $(this).val();
    $.ajax({
        url: '/backoffice/office-ajax/get-details-with-agents',
        dataType: 'json',
        method: 'post',
        data: {officeid: company},
        success: function(res) {
            $('#obh-makler').empty();
            $.each(res.agents,function(k,v){
                $('#obh-makler').append($('<option>').val(v.user_id).text(v.name_first+' '+v.name_last));
            });
            $('#obh-firma-ulica').val(res.details.address);
            $('#obh-firma-psc').val(res.details.zip);
            $('#obh-firma-mesto').val(res.details.town);
            $('#obh-firma-ico').val(res.details.ico);
            $('#obh-firma-dic').val(res.details.dic);
            $('#obh-firma-phone').val(res.details.phone);
            $('#obh-firma-email').val(res.details.email);
        }
    });
});

onDateClick = function(date, jsEvent, view){
    $('#vis-date').val(date.format('DD.MM.YYYY'))
    $('#myModal').modal('show');
};

formatSingleResult = function(result) {
    if ($(result.element).hasClass('option-parent')) {
        let el = $('<span>');
        el.text(result.text);
        el.addClass($(result.element).attr('class'));
        return el;
    }
    if ($(result.element).hasClass('option-child')) {
        let el = $('<span>');
        el.text(result.text);
        el.addClass($(result.element).attr('class'));
        return el;
    }
    return result.text.trim();
}