var toRemove = {
    '<o:p>&nbsp;</o:p>':'',
    '<p\\s{0,}class="MsoNormal"><\\/p>': '',
    'class\\s{0,}=\\s{0,}"MsoNormal"':'',
    '<o:p>\\s{0,}<\/o:p>':'',
    '<p\\s{1,}>':'<p>',
    'style="\\s{0,}"':'',
    'font-family:\\s{0,}Arial,\\s{0,}sans-serif\\s{0,};':'',
    'line-height:\\s{0,}normal[;]{0,}': '',
    'line-height:[0-9]{1,}%': '',
    '<span lang="HU">\\s{0,}</span>':'',
    '<p>\\s{0,}<span\\s{1,}style\\s{0,}=\\s{0,}"font-size:\\s{0,}[0-9]{1,}\\.[0-9]{0,2}\\s{0,}pt[;]{0,}">\\s{0,}<\\/span>\\s{0,}<\\/p>':'',
    '<span\\s{1,}style\\s{0,}=\\s{0,}"font-size:\\s{0,}[0-9]{1,}\\.[0-9]{0,2}\\s{0,}pt[;]{0,}">\\s{0,}<\\/span>':'',
    'mso-margin-bottom-alt:\\s{0,}auto;':'',
    'mso-height-rule:\\s{0,}exactly[\\s;]{0,}':'',
    '<p>\\s{0,}<\\/p>': '',
    'font-family:\\s{0,}["]{0,1}[a-zA-Z\\s]{1,}["]{0,1},\\s{0,}sans-serif;':'',
    'font-family:\\s{0,}["]{0,1}[a-zA-Z\\s]{1,}["]{0,1},\\s{0,}serif;':'',
    'background-image:\\s{0,}initial;' : '',
    'background-size:\\s{0,}initial;' : '',
    'background-position:\\s{0,}initial;' : '',
    'background-repeat:\\s{0,}initial;' : '',
    'background-attachment:\\s{0,}initial;' : '',
    'background-origin:\\s{0,}initial;' : '',
    'background-clip:\\s{0,}initial;' : '',
    ';\\s{1,}"': ';"',
    'mso-ansi-language:\\s{0,}[A-Z]{1,2}[;]{0,1}':'',
    'mso-element:\\s{0,}frame;': '',
    'mso-element-wrap:\\s{0,}around;': '',
    'mso-outline-level:\\s{0,}[0-9]{1,}': '',
    '<span\\s{0,}style\\s{0,}=\\s{0,}"font-size:[\\.\\s0-9]{1,}pt[;]{0,}\\s{0,}"><\\/span>': '',
    'mso-fareast-language:\\s{0,}[A-Z]{1,2}\\s{0,}': '',
    'align\\s{0,}=\\s{0,}"center"': '',
    '<p\\s{2,}': '<p ',
    'lang\\s{0,}=\\s{0,}"[A-Z]{1,2}"': '',
    'mso-fareast-font-family:\\s{0,}"[a-zA-Z\\s0-9]{1,}";':'',
    'mso-pagination:\\s{0,}none[;]{0,}': '',
    '\\s{1,}lang="[a-zA-Z]{0,2}"\\s{0,}': '',
    'mso-hyphenate:\\s{0,}none[;]{0,}':'',
    'mso-hansi-theme-font:\\s{0,}major-latin[;]{0,}':'',
    'mso-ascii-theme-font:\\s{0,}major-latin[;]{0,}':'',
    'text-autospace:\\s{0,}none[;]{0,}':'',
    '[;]{2,}':';',
    'mso-element-.*:\\s{0,}.*[;]{0,1}':''
};

/**
 *  s - input string
 *  d - regexp strings and replacements
*/
templateCleaner = (s) => {
    let s1=s;
    for(const k in toRemove) {
        let r = new RegExp(k,'gmi');
        let m = r.exec(s1);
        if(m !== null) {
            s1 = s1.replaceAll(r,toRemove[k]);
        }
    }
    return s1;
}


