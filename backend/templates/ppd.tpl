<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>
    <style>
        body{
            font-size: 12px;
            font-family: arial;
        }
        @media print {
            body {
                width: 21cm;
                height: 29.7cm;
                font-family: arial;
                font-size: 11px;
            }
        }
        .table1 {
            width: 100%;
            border: 1px solid black;
        }
        .table2 {
            width: 100%;
            border-left: 1px solid black;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
        }
        .pad-5{
            padding: 5px;
        }
        .pad-10{
            padding: 10px;
        }
        .pad-20{
            padding: 20px;
        }
        .table3{
            border-top: 1px solid black;
            border-right: 1px solid black;
            width: 100%;
        }
        .table3 td {
            padding-top: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid black;
            border-left: 1px solid black;
        }
        .p-l-5 {
            padding-left: 5px;
        }
    </style>
</head>
<body>
<table class="table1" cellspacing="0">
    <tr>
        <td valign="top" style="padding-left: 10px;padding-top:10px;">
            Firma
        </td>
        <td>
            {{dodavatel.nazov}}<br>
            {{dodavatel.ulica}}<br>
            {{dodavatel.psc}} {{dodavatel.mesto}}<br>
            {{dodavatel.stat}}
        </td>
        <td colspan="2" valign="middle" style="font-size: 16px; border-left: 1px solid black;padding-left: 10px;padding-top:10px;">PRÍJMOVÝ POKLADNIČNÝ DOKLAD</td>
    </tr>
    <tr>
        <td style="padding-left: 10px;padding-top:10px;">DIČ / IČDPH:</td style="padding-left: 10px;padding-top:10px;">
        <td>{{dodavatel.dic}} / {{dodavatel.icdph}}</td>
        <td style="border-left: 1px solid black;padding-left: 10px;padding-top:10px;">číslo:</td>
        <td>{{doklad.cislo}}</td>
    </tr>
    <tr>
        <td style="padding-left: 10px;padding-top:10px;">IČO:</td>
        <td>{{dodavatel.ico}}</td>
        <td style="border-left: 1px solid black;padding-left: 10px;padding-top:10px;">zo dňa:</td style="border-left: 1px solid black">
        <td>{{doklad.zo_dna}}</td>
    </tr>
</table>
<table class="table2 pad-10">
    <tr>
        <td colspan="2">Prijaté od:</td>
        <td colspan="2">{{odberatel.meno}}, {{odberatel.ulica}}, {{odberatel.psc}} {{odberatel.mesto}}</td>
    </tr>
    <tr>
        <td style="width: 5%">IČO:</td>
        <td style="width: 15%">{{odberatel.ico}}</td>
        <td style="width: 10%">DIČ / IČDPH:</td style="width: 2%">
        <td>{{odberatel.dic}} / {{odberatel.icdph}}</td>
    </tr>
</table>
<table class="table2 pad-10">
    <tr>
        <td style="padding: 10px;">
            {{doklad.sumar}}
        </td>
    </tr>
</table>
<table class="table2 pad-20">
    <tr>
        <td width="15%">Účel platby:</td>
        <td>{{doklad.ucel}}</td>
        <td rowspan="5" width="50%">
            <table class="table3" cellspacing="0">
                <tr>
                    <td colspan="2" align="center">ÚČTOVACÍ PREDPIS</td>
                </tr>
                <tr>
                    <td width="50%" align="center">Dal - účet</td>
                    <td width="50%" align="center">Suma</td>
                </tr>
                <tr style="height: 20px;"><td></td><td></td></tr>
                <tr><td></td><td></td></tr>
                <tr><td></td><td></td></tr>
                <tr><td></td><td></td></tr>
                <tr><td></td><td></td></tr>
                <tr><td></td><td></td></tr>
                <tr>
                    <td style="padding-left: 10px;">
                        Dátum
                    </td>
                    <td style="padding-left: 10px;">
                        Podpis
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="15%">Vyhotovil:</td with="10">
        <td>{{doklad.vyhotovil}}</td>
    </tr>
    <tr>
        <td width="15%">Schválil:</td with="10">
        <td>{{doklad.schvalil}}</td>
    </tr>
    <tr>
        <td width="15%">Podpis príjemcu:</td with="10">
        <td>..............................................................</td>
    </tr>
    <tr>
        <td>Zaúčtované v denníku pod por. č.:</td>
        <td></td>
    </tr>
</table>
</body>
</html>
