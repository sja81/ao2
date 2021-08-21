<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9pt;
        }
        @media print {
            body {
                width: 21cm;
                height: 29.7cm;
                font-family: arial;
                font-size: 11px;
            }
        }
        .dokument_nazov {
            width:100%;
            padding: 5px;
            background-color: black;
            color: white;
            text-align: center;
            font-size: 24pt;
            font-weight: bold;
        }
        table.t1 {
            width:100%;
            border: 0.15em solid black;
            border-spacing: 0;
        }
        table.t2 {
            width: 100%;
            margin-top: 1px;
            border: 0.1em solid black;
            border-spacing: 0;
        }
        table tr td {
            padding: 5px;
        }
        td.btm-brd {
            border-bottom: 1px solid black;
        }
        td.left-brd {
            border-left: 1px solid black;
        }
        table.t0 {
            width: 100%;
            border-spacing: 0;
        }
    </style>
</head>

<body>
<table class="dokument_nazov">
    <tr><td>PRACOVNÝ LIST – BYT</td></tr>
</table>
<br>
<table>
    <tr>
        <td>
            správu domu vykonáva {{spravca}}, IČO: {{spravca_ico}}, so sídlom: {{spravca_sidlo}}
        </td>
    </tr>
</table>
<br>
<table class="t1">
    <tr>
        <td colspan="4" class="btm-brd">
            <b>Adresa (názov ulice):</b>&nbsp;{{nazov_ulice}}
        </td>
        <td class="btm-brd left-brd">
            <b>Číslo:</b><br>AO&nbsp;{{cislo_zmluvy}}
        </td>
        <td colspan="5" class="btm-brd left-brd">
            <b>Počet obytných izieb:</b>&nbsp;&nbsp;&nbsp;{{pocet_izieb}}
        </td>
    </tr>
    <tr>
        <td width="20%"><b>Poschodie z poschodí:</b></td>
        <td width="10%" style="text-align: right; padding-right: 10px;">{{poschodie}}</td>
        <td width="1%"><b>/</b></td>
        <td width="10%" style="text-align: left">{{pocet_poschodi}}</td>
        <td width="15%">&nbsp;</td>
        <td class="left-brd">&nbsp;<b>Výťah:</b></td>
        <td colspan="4">{{vytah}}</td>
    </tr>
</table>

<table class="t2">
    <tr>
        <td class="btm-brd" valign="top">
            <b>Vek</b><br>(rok kolaudácie):&nbsp;&nbsp;{{kolaudacia}}
        </td>
        <td colspan="2" class="btm-brd left-brd" valign="top">
            <b>Orientácie bytu - svetové strany:</b>&nbsp;&nbsp;{{orientacia}}
        </td>
        <td colspan="2" class="btm-brd left-brd" valign="top">
            <b>Obytná plocha v m<sup>2</sup>:</b>&nbsp;&nbsp;{{plocha}}
        </td>
    </tr>
    <tr>
        <td class="btm-brd" valign="top">
            <b>Materiál:</b><br><br>
            {{material}}
        </td>
        <td class="left-brd btm-brd" valign="top">
            <b>Vstup do domu:</b><br><br>
            {{vstup_do_domu}}
        </td>
        <td class="left-brd btm-brd" valign="top">
            <b>Parkovanie:</b><br><br>
            {{parkovanie}}
        </td>
        <td class="left-brd btm-brd" valign="top">
            <b>Exteriér:</b><br><br>
            {{exterier}}
        </td>
        <td class="left-brd btm-brd" valign="top">
            <b>Byt je:</b><br><br>
            {{stav_bytu}}
        </td>
    </tr>
    <tr>
        <td class="btm-brd" valign="top">
            <b>Kúrenie:</b><br><br>
            {{kurenie}}
        </td>
        <td class="left-brd btm-brd" valign="top">
            <b>Okná:</b><br><br>
            {{okno}}
            <br><br>
            <b>Vchodové dvere:</b><br><br>
            {{vchodove_dvere}}
        </td>
        <td class="left-brd btm-brd" valign="top">
            <b>Súčasťou je:</b><br>
            <ul>{{property_basic}}</ul>
        </td>
        <td class="left-brd btm-brd" valign="top">
            <b>Vlastníctvo:</b><br><br>
            {{vlastnictvo}}
        </td>
        <td class="left-brd btm-brd" valign="top">
            <b>Financovanie:</b><br><br>
            {{financovanie}}
        </td>
    </tr>
    <tr>
        <td colspan="5" class="btm-brd">
            <b>Ďalší popis nehnuteľnosti </b>(zariadenie bytu a pod):<br>
            {{dalsi_popis}}
        </td>
    </tr>
    <tr>
        <td colspan="5" class="btm-brd">
            <b>Prevod nehnuteľnosti je podmienený </b>:<br><br>
            {{prevod_nehnutelnosti}}
        </td>
    </tr>
    <tr>
        <td colspan="5" class="btm-brd">
            <b>Prenájom nehnuteľnosti je podmienený </b>:<br><br>
            {{prenajom_nehnutelnosti}}
        </td>
    </tr>
    <tr>
        <td>
            <b>Dátum:</b>
            <br>
            {{datum}}
        </td>
        <td colspan="4" class="left-brd">
            <b>Meno makléra:</b>&nbsp;&nbsp;{{meno_maklera}}
        </td>
    </tr>
</table>
</body>
</html>
