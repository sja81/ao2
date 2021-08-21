function clearFloatStr(str){
    var s=1;
    if(str.charAt(0)=='-'){
        s=-1;
    }
    str=str.replace(',','.');
    str=str.replace(/[^0-9.]/gi,'');
    if(s==-1){
        str='-'+str;
    }
    return str;
}

function roundNum(num,dec){
    if(num<0){
        num=(num-0.01*Math.pow(0.1,dec)).toFixed(dec);
    }else{
        num=(num+0.01*Math.pow(0.1,dec)).toFixed(dec);
    }
    num=parseFloat(num);
    if(isNaN(parseFloat(num))){
        num=0;
    }
    return num;
}
function viewNum(num,dec){
    var numB=clearFloatStr(num.toString());
    var numB2=parseFloat(numB)+0;
    var r=roundNum(numB2,dec)+0;
    if(numB2!==r&&numB!='-'&&numB!=''){
        return r;
    }else{
        return numB;
    }
}

function ibaCisla(string) {
    return string.replace(/[^\d\+]/g,"");
}

function formatMoney(number, decPlaces, decSep, thouSep) {
    decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
        decSep = typeof decSep === "undefined" ? "." : decSep;
    thouSep = typeof thouSep === "undefined" ? "," : thouSep;
    var sign = number < 0 ? "-" : "";
    var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
    var j = (j = i.length) > 3 ? j % 3 : 0;

    return sign +
        (j ? i.substr(0, j) + thouSep : '') +
        i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
        (decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
}