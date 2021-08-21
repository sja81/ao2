toStore = function(itemName, data){
    sessionStorage.setItem(itemName, JSON.stringify(data));
}

returnBack = function(itemName, url){
    let data = [];
    let i = 0;
    $('.to-store').each(function(){
        let id_name = $(this).attr('id');
        let id_elem = $(this).get(0).tagName.toLowerCase();

        let id_val = $(this).val();
        let id_type = $(this).attr('type');

        if ('input' == id_elem && 'checkbox' == id_type) {
            id_val = $(this).is(':checked');
        }

        data[i] = {
            name: id_name,
            value: id_val,
            elem: id_elem,
            type: id_type
        };
        i++;
    });
    toStore(itemName,data);
    window.location.replace(url);
}

restoreFormData = function(itemName){
    let data = sessionStorage.getItem('form-majitel');
    if (data != undefined) {
        sessionStorage.removeItem('form-majitel');
        data = JSON.parse(data);
        data.forEach(function(e){
            if(e.elem == 'select') {
                $('#' + e.name).val(e.value).change();
            }
            if(e.elem == 'input') {
                if (e.hasOwnProperty('type') && e.type == 'checkbox') {
                    $('#' + e.name).prop('checked', e.value);
                } else {
                    $('#' + e.name).val(e.value);
                }
            }
        });
    }
}