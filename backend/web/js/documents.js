$('#save-other-data').on('click',function(){
    let f = $('#odata-frm').serialize();
    window.sessionStorage.setItem('odata', f);
});

$('#dalsie-udaje').on('click',function(){
    $('#otherDataModal').modal('show');
});

openCommentWindow = function() {
    $('#commentModal').modal('show');
}

changeBuyerType = function(d) {
    var t = $('#bt-'+d).val();
    if (t == 'osoba') {
        $('#bc-om-'+d).hide();
        $('#bc-tax-'+d).hide();
        $('#bc-icdph-'+d).hide();
        $('#bp-rp-'+d).show();
        $('#bp-gend-'+d).show();
        $('#bp-dat-'+d).show();
        $('#bp-op1-'+d).show();
        $('#bp-op2-'+d).show();
        $('.ku-op-load-'+d).show();
    } else if(t == 'szco') {
        $('#bc-om-'+d).show();
        $('#bc-tax-'+d).show();
        $('#bc-icdph-'+d).show();
        $('#bp-rp-'+d).show();
        $('#bp-gend-'+d).show();
        $('#bp-dat-'+d).show();
        $('#bp-op1-'+d).show();
        $('#bp-op2-'+d).show();
        $('.ku-op-load-'+d).show();
    } else {
        $('#bc-om-'+d).show();
        $('#bc-tax-'+d).show();
        $('#bc-icdph-'+d).show();
        $('#bp-rp-'+d).hide();
        $('#bp-gend-'+d).hide();
        $('#bp-dat-'+d).hide();
        $('#bp-op1-'+d).hide();
        $('#bp-op2-'+d).hide();
        $('.ku-op-load-'+d).hide();
    }
}

changeSellerType = function(d) {
    var t = $('#st-'+d).val();
    if (t == 'osoba') {
        $('#sc-om-'+d).hide();
        $('#sc-tax-'+d).hide();
        $('#sc-icdph-'+d).hide();
        $('#sp-rp-'+d).show();
        $('#sp-gend-'+d).show();
        $('#sp-dat-'+d).show();
        $('#sp-op1-'+d).show();
        $('#sp-op2-'+d).show();
        $('.sc-op-load-'+d).show();
    } else if(t == 'szco') {
        $('#sc-om-'+d).show();
        $('#sc-tax-'+d).show();
        $('#sc-icdph-'+d).show();
        $('#sp-rp-'+d).show();
        $('#sp-gend-'+d).show();
        $('#sp-dat-'+d).show();
        $('#sp-op1-'+d).show();
        $('#sp-op2-'+d).show();
        $('.sc-op-load-'+d).show();
    } else {
        $('#sc-om-'+d).show();
        $('#sc-tax-'+d).show();
        $('#sc-icdph-'+d).show();
        $('#sp-rp-'+d).hide();
        $('#sp-gend-'+d).hide();
        $('#sp-dat-'+d).hide();
        $('#sp-op1-'+d).hide();
        $('#sp-op2-'+d).hide();
        $('.sc-op-load-'+d).hide();
    }
}

