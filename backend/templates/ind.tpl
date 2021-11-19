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

        .w-100 {
            width: 100%;
        }
        .table1,
        .table2,
        .table3 {
            border-spacing: 0;
        }
        .table1 td {
            padding: 5px;
        }
        .inv-head-title {
            text-transform: uppercase;
        }
        .fs-2em {
            font-size: 2em;
        }
        .fs-1_5em {
            font-size: 1.5em;
        }
        .fs-1_2em {
            font-size: 1.2em;
        }
        .w-40 {
            width: 40%;
        }
        .table2 td {
            padding: 0px !important;
            margin: 0px !important;
        }
        .table3 td {
            padding: 10px;
            margin: 0;
        }
        .m-b-10 {
            margin-bottom: 10px !important;
        }
        .p-5 {
            padding: 5px !important;
        }
        p {
            margin: 0px;
            padding: 0px;
        }
        .bb-1b {
            border-bottom: 1px solid black;
        }
        .mt-30 {
            margin-top: 30px;
        }
        .mb-100 {
            margin-bottom: 100px;
        }
        .mb-20 {
            margin-bottom: 20px;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

<table class="w-100 table1 m-b-10">
    <tr>
        <td colspan="3" class="fs-2em inv-head-title w-40">{{ind.firma_nazov}}</td>
        <td colspan="3" align="right" class="fs-2em">Interný doklad č. {{ind.cislo}}</td>
    </tr>
</table>

<table style="border: 1px solid black;" class="w-100 table3">
    <tr>
        <td width="50%" style="border-right: 1px solid black;" valign="top">
            <p class="m-b-10 fs-1_2em">Dodávateľ:</p>
            <p class="fs-1_5em m-b-10">{{dod.nazov}}</p>
            <p class="fs-1_2em m-b-10">
                {{dod.ulica}}<br>
                {{dod.psc}} {{dod.mesto}}<br>
                {{dod.stat}}
            </p>
            <table class="table2 w-100 mt-30 mb-100">
                <tr>
                    <td>IČO:</td><td>{{dod.ico}}</td>
                </tr>
                <tr>
                    <td>DIČ:</td><td>{{dod.dic}}</td>
                </tr>
                <tr>
                    <td>IČ DPH:</td><td>{{dod.icdph}}</td>
                </tr>
            </table>
            <table class="table2 w-100 mb-20">
                <tr>
                    <td>Dátum vyhotovenia:</td><td>{{ind.vyhotovene}}</td>
                </tr>
                <tr>
                    <td>Dátum dodania tovaru/služby, prijatie platby:</td><td>{{ind.datprijate}}</td>
                </tr>
            </table>
        </td>
        <td width="50%" valign="top">
            <p class="m-b-10 fs-1_2em">Odberateľ:</p>
            <p class="fs-1_5em m-b-10">{{odb.nazov}}</p>
            <p class="fs-1_2em m-b-10">
                {{odb.ulica}}<br>
                {{odb.psc}} {{odb.mesto}}<br>
                {{odb.stat}}
            </p>
            <table class="table2 w-100 mt-30" style="margin-bottom: 100px">
                <tr>
                    <td>IČO:</td><td>{{odb.ico}}</td>
                </tr>
                <tr>
                    <td>DIČ:</td><td>{{idb.dic}}</td>
                </tr>
                <tr>
                    <td>IČ DPH:</td><td>{{odb.icdph}}</td>
                </tr>
            </table>
            <table class="table2 w-100 mb-20">
                <tr>
                    <td>Končnečný príjemca:</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table class="w-100 table3" style="border-left:1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;" cellspacing="0">
    <tr>
        <td class="bb-1b">Označenie dodávky</td>
        <td class="bb-1b">Množstvo</td>
        <td class="bb-1b">J.cena</td>
        <td class="bb-1b">Zľava</td>
        <td class="bb-1b">Cena</td>
        <td class="bb-1b">%DPH</td>
        <td class="bb-1b">DPH</td>
        <td class="bb-1b">EUR Celkom</td>
    </tr>
    <tr>
        <td colspan="8" class="fs-1_2em">
            Daňový doklad k prijatej platbe (zálohová faktúra č. {{inv.cislo}})
        </td>
    </tr>
    <tr>
        <td class="bb-1b">{{ind.popis}}</td>
        <td class="bb-1b">{{ind.mnozstvo}}</td>
        <td class="bb-1b">{{ind.jcena}}</td>
        <td class="bb-1b">{{ind.zlava}}</td>
        <td class="bb-1b">{{ind.cenabezdph}}</td>
        <td class="bb-1b">{{ind.perdph}}</td>
        <td class="bb-1b">{{ind.dph}}</td>
        <td class="bb-1b">{{ind.celkom}}</td>
    </tr>
    <tr>
        <td colspan="4">
            Súčet
        </td>
        <td colspan="2">
            {{ind.cenabezdph}}
        </td>
        <td>{{ind.dph}}</td>
        <td>{{ind.celkom}}</td>
    </tr>
    <tr>
        <td colspan="7" class="fs-1_5em bb-1b">CELKOM</td>
        <td class="bb-1b fs-1_5em"></td>
    </tr>
    <tr>
        <td colspan="8" class="bb-1b">
            Vystavil: {{ind.vystavil}}
        </td>
    </tr>
    <tr>
        <td colspan="3" class="text-center">
            Rekapitulácia v EUR:
        </td>
        <td>Základ v EUR</td>
        <td>Sadzba</td>
        <td>DPV v EUR</td>
        <td colspan="2">Spolu s DPH v EUR</td>
    </tr>
    {{ind.recaprows}}
</table>
</body>
</html>