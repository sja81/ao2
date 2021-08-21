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
            /*border: 2px solid black;*/
        }
        .table1 td {
            padding-top: 5px;
            padding-left: 5px;
            padding-bottom: 5px;
            padding-right: 5px;
        }
        .table1 p {
            padding-left: 5px;
            margin: 0px;
        }
        .border-bottom{
            border-bottom: 1px solid black;
        }
        .border-right {
            border-right: 1px solid black;
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
        .p-l-5 {
            padding-left: 5px;
        }
        .w-40p {
            width: 40%;
        }
        .table2{
            width: 100%;
        }
        .table2 td {
            padding: 0px;
            margin: 0px;
        }
        .m-b-10{
            margin-bottom: 10px !important;
        }
        .m-b-20 {
            margin-bottom: 20px !important;
        }
        .m-t-5 {
            margin-top: 5px !important;
        }
        .m-t-10 {
            margin-top: 10px !important;
        }
        .p-t-10 {
            padding-top: 10px !important;
        }
        .p-t-20 {
            padding-top: 20px !important;
        }
        .p-t-40 {
            padding-top: 40px !important;
        }
        .p-5 {
            padding: 5px !important;
        }
        .m-t-20 {
            margin-top: 20px !important;
        }
        p{
            margin: 0px;
        }
        .m-l-20 {
            margin-left: 20px !important;
        }
        .border-top {
            border-top: 1px solid black;
        }
        .ta-center {
            text-align: center;
        }
        .ta-right {
            text-align: right;
        }
    </style>
</head>
<body>

<table class="table1 m-b-10" cellspacing="0">
    <tr>
        <td colspan="3" class="fs-2em inv-head-title w-40p">{{faktura.nadpis}}</td>
        <td colspan="3" align="right" class="fs-2em">{{faktura.cislo}}</td>
    </tr>
</table>

<div style="width:100%;" class="p-t-10 border-top">
    <div style="width: 48%; float:left;" class="p-l-5">
        <p class="m-b-10 fs-1_2em">Dodávateľ:</p>
        <p class="fs-1_5em m-b-10">{{dod.nazov}}</p>
        <p class="fs-1_2em m-b-10">
            {{dod.ulica}}<br>
            {{dod.psc}} {{dod.mesto}}<br>
            {{dod.stat}}
        </p>
        <p class="fs-1_2em m-b-10">
            {{dod.info}}
        </p>

        <table class="table2">
            <tr>
                <td>IČO:</td><td>{{dod.ico}}</td>
            </tr>
            <tr>
                <td>DIČ:</td><td>{{dod.dic}}</td>
            </tr>
            <tr>
                <td>IČ DPH:</td><td>{{dod.icdph}}</td>
            </tr>
            <tr>
                <td>Telefón:</td>
                <td>{{dod.telefon}}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{dod.email}}</td>
            </tr>
            <tr>
                <td>Web:</td>
                <td>{{dod.web}}</td>
            </tr>
            <tr>
                <td>IBAN:</td><td>{{dod.iban}}</td>
            </tr>
            <tr>
                <td>SWIFT:</td><td>{{dod.swift}}</td>
            </tr>
            <tr>
                <td>Banka:</td><td>{{dod.banka}}</td>
            </tr>
        </table>
        <p class="fs-1_5em m-b-10 m-t-10">
            {{dodav.platca}}
        </p>
    </div>
    <div style="width: 48%; float:left;" class="p-l-5">
        <p class="m-b-10 fs-1_2em">Odberateľ:</p>
        <p class="fs-1_5em m-b-10">{{odb.nazov}}</p>
        <p class="fs-1_2em m-b-10">
            {{odb.ulica}}<br>
            {{odb.psc}} {{odb.mesto}}<br>
            {{odb.stat}}
        </p>

        {{dodacia}}
        {{odbico}}

        <p class="fs-1_2em m-b-10">
            {{odb.info}}
        </p>
        <table class="table2" cellsapcing="0" cellpadding="0">
            <tr>
                <td width="50%">Forma úhrady:</td><td>{{uhrada}}</td>
            </tr>
            <tr>
                <td width="50%">Variabilný symbol:</td><td>{{symbol.var}}</td>
            </tr>
            <tr>
                <td width="50%">Konštantný symbol:</td><td>{{symbol.konst}}</td>
            </tr>
            <tr>
                <td width="50%">Dátum vystavenia</td><td>{{datum.vystavenia}}</td>
            </tr>
            <tr>
                <td width="50%">Dátum dodania</td><td>{{datum.dodania}}</td>
            </tr>
            <tr>
                <td width="50%">Dátum splatnosti</td><td>{{datum.splatnosti}}</td>
            </tr>
        </table>
    </div>
</div>
<div style="clear:both"></div>
<div style="width:100%;min-height: 550px" class="m-t-10 p-t-10">
    <table style="width:100%; border: 1px solid black;" cellspacing="0" cellpadding="0">
