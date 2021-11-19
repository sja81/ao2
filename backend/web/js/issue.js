showMyToast = function(r,m) {
    let msg = r.message !== undefined ? r.message : ( (r.message === undefined && m !== undefined) ? m : 'No message');
    let icon = r.status == 'error' ? 'error' : 'success';
    $.toast({
        text: msg,
        position: 'top-right',
        loaderBg: '#ff6849',
        icon: icon,
        hideAfter: 2500,
        stack: 6
    });
}