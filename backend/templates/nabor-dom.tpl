<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>
    <style>
        body{
            font-family: arial;
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
    <tr><td>PRACOVNÝ LIST – RODINNÝ DOM, VILA, CHATA</td></tr>
</table>
<br>
<table class="t1">
    <tr>
        <td colspan="4" class="btm-brd">
            <b>Mesto / Mestská časť (štvrť):</b> {{mesto}}
        </td>        
        <td class="btm-brd left-brd">
            <b>Počet obytných izieb:</b>&nbsp;&nbsp;&nbsp;{{pocet_izieb}}
        </td>
    </tr>
    <tr>
        <td colspan="3" class="btm-brd">
            <b>Adresa (názov ulice):</b>&nbsp;{{nazov_ulice}}
        </td>
        <td class="btm-brd left-brd">
            <b>Číslo:</b><br>AO&nbsp;{{cislo_zmluvy}}
        </td>
        <td class="btm-brd left-brd">
            <b>Počet podlaží:</b><br>{{pocet_podlazi}}
        </td>
    </tr>
</table>

<table class="t2">
    <tr>
        <td class="btm-brd" valign="top">
            <b>Vek</b><br>(rok kolaudácie):&nbsp;&nbsp;{{kolaudacia}}
        </td>
        <td class="btm-brd left-brd">
            <b>Orientácie bytu - svetové strany:</b>&nbsp;&nbsp;{{orientacia}}
        </td>
        <td class="btm-brd left-brd">
            <b>Podlahová plocha v m<sup>2</sup>:</b>&nbsp;&nbsp;{{podlahova_plocha}}
        </td>
        <td class="btm-brd left-brd">
            <b>Zastavaná plocha v m<sup>2</sup>:</b>&nbsp;&nbsp;{{zastavana_plocha}}
        </td>
        <td class="btm-brd left-brd">
            <b>Celková plocha pozemku v m<sup>2</sup>:</b>&nbsp;&nbsp;{{celkova_plocha_pozemku}}
        </td>
    </tr>
    <tr>
        <td class="btm-brd" valign="top">
            <b>Materiál:</b><br><br>
            {{material}}
        </td>
        <td class="left-brd btm-brd" valign="top">
            <b>Parkovanie - garáž:</b><br><br>
            {{parkovanie}}
        </td>
        <td class="left-brd btm-brd" valign="top">
            <b>Strecha:</b><br><br>
            {{strecha}}
        </td>
        <td class="left-brd btm-brd" valign="top">
            <b>Exteriér:</b><br><br>
            {{exterier}}
        </td>
        <td class="left-brd btm-brd" valign="top">
            <b>Stav:</b><br><br>
            {{stav_domu}}
        </td>
    </tr>
    <tr>
        <td class="btm-brd" valign="top">
            <b>Kúrenie:</b><br><br>
            {{kurenie}}
            <br>
            <br>
            <b>Okná:</b><br><br>
            {{okno}}
            <br>
            <br>
            <b>Vchodové dvere:</b><br><br>
            {{vchodove_dvere}}
        </td>
        <td class="left-brd btm-brd" style="width: 35%" colspan="2" valign="top">
            <b>Súčasťou domu je:</b><br><br>
            <ul>
                {{property_basic}}
            </ul>
        </td>
        <td class="left-brd btm-brd" valign="top">
            <b>Umiestnenie domu:</b><br><br>
            {{umiestnenie}}
            <br>
            <br>
            <b>Kanalizácia:</b><br><br>
            {{kanalizacia}}
        </td>
        <td class="left-brd btm-brd" valign="top">
            <b>Vlastníctvo:</b><br><br>
            {{vlastnictvo}}
            <br>
            <br>
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
