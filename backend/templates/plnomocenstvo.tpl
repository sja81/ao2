<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Untitled Document</title>
    <style>
        body{
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
        }
        @media print {
            body {
                width: 21cm;
                height: 29.7cm;
                font-family: 'Times New Roman', Times, serif;
                font-size: 10pt;
            }
        }
        .dochead {
            width:100%;
            padding: 5px;
            text-align: center;
        }
        .dochead-bold {
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 5px;
        }
        .mt-40 {
            margin-top: 40px;
        }
        .mt-20 {
            margin-top: 20px;
        }
        .mt-10 {
            margin-top: 10px;
        }
        .mt-5 {
            margin-top: 5px;
        }
        .w-100 {
            width: 100%;
        }
        .blb-1 {
            border-bottom: thin solid black;
        }
        .w-70{
            width: 70%;
        }
        .rows tr td{
            padding-top: 3px;
            padding-bottom: 3px;
        }
        p{
            text-align: justify;
        }
        ul{
            margin: 0;
            padding: 0px 0px 0px 0px;
            list-style-type: none;
        }
    </style>
</head>

<body>
<table class="dochead">
    <tr class="dochead-bold"><td>PROTOKOL o vykonaní asanačných prác</td></tr>
    <tr><td>(udelené splnomocnencovi podľa § 31 a nasl. Občianskeho zákonníka, zákona č.40/1964 Zb., v znení neskorších predpisov)</td></tr>
</table>

<table class="mt-20 w-70 rows">
    <tr>
        <td width="50%" valign="top">Splnomocniteľ v 1.rade (predávajúci):</td>
        <td>
            {{osoba.meno}}<br>
            narodený: {{osoba.rodne_meno}}, rod. č.: {{osoba.rodne_cislo}}<br>
            trvale bytom: {{osoba.trvaly_pobyt}}<br>
            Č.OP.: {{osoba.cislo_op}}
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            {{osoba.meno}}<br>
            narodený: {{osoba.rodne_meno}}, rod. č.: {{osoba.rodne_cislo}}<br>
            trvale bytom: {{osoba.trvaly_pobyt}}<br>
            Č.OP.: {{osoba.cislo_op}}
        </td>
    </tr>
</table>
a
<table class="mt-10 w-70 rows">
    <tr>
        <td width="50%" valign="top">Splnomocniteľ v 2.rade (kupujúci):</td>
        <td>
            {{osoba.meno}}<br>
            narodený: {{osoba.rodne_meno}}, rod. č.: {{osoba.rodne_cislo}}<br>
            trvale bytom: {{osoba.trvaly_pobyt}}<br>
            Č.OP.: {{osoba.cislo_op}}
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            {{osoba.meno}}<br>
            narodený: {{osoba.rodne_meno}}, rod. č.: {{osoba.rodne_cislo}}<br>
            trvale bytom: {{osoba.trvaly_pobyt}}<br>
            Č.OP.: {{osoba.cislo_op}}
        </td>
    </tr>
</table>

<table class="mt-20 w-70 rows">
    <tr>
        <td width="50%" valign="top">Splnomocnenec:</td>
        <td>
            {{osoba.meno}}<br>
            narodený: {{osoba.rodne_meno}}, rod. č.: {{osoba.rodne_cislo}}<br>
            trvale bytom: {{osoba.trvaly_pobyt}}<br>
            Č.OP.: {{osoba.cislo_op}}
        </td>
    </tr>
</table>

<p class="mt-40">
    Splnomocniteľ v 1.rade ako predávajúci previedol kúpnou zmluvou zo dňa {{objekt.detail}}
    ……... 201.. na kupujúceho vlastnícke právo k nehnuteľnosti - rodinného domu so súp. číslom …….. na ul. …………, v ..............., nachádzajúci sa na pozemku s par. č. ............., ak aj k pozemku s par. č. ..........., druh pozemku .........., s výmerou ...............m2, druh pozemku..................., parcela registra "C" , ak ako je zapísané na LV č. ………, vedený Okresným úradom ............., katastrálny odbor, pre okres: ……….., obec ………… - m.č. ………….., katastrálne územie: ……………… (ďalej len „nehnuteľnosti“).
</p>

<p class="mt-20">
    <b>
        Splnomocniteľia týmto spoločne splnomocňujú splnomocnenca, aby v ich mene odhlásil služby súvisiace s užívaným vyššie uvedených nehnuteľností a tieto následne prehlásil na splnomocniteľa v 2. rade ako kupujúceho.
    </b>
</p>

<p class="mt-20">
    <b>
        Za týmto účelom je splnomocnenec oprávnený v mene splnomocniteľa konať, podpisovať, podávať návrhy, žiadosti (oznámenia, podania a pod.) alebo ich brať späť, podávať riadne a mimoriadne opravné prostriedky, najmä vo vzťahu k:
    </b>
</p>

<ol>
    <li>
        <b>Dodávateľa vody –</b> {{sluzba.voda}}
    </li>
    <li>
        <b>Dodávateľa elektrickej energie –</b> {{sluzba.elektrina}}
    </li>
    <li>
        <b>Dodávateľa plynu –</b> {{sluzba.plyn}}
    </li>
    <li>
        <b>Osobe uskutočňujúcej odvoz a likvidáciu odpadu –</b> {{sluzba.olo}}
    </li>
    <li>
        <b>Poskytovateľa káblového televízneho pripojenia -</b> {{sluzba.tv}}
    </li>
    <li>
        <b>Poskytovateľa telefonického pripojenia (pevné telefónne alebo internetové pripojenie) –</b> {{sluzba.telefon}}
    </li>
    <li>
        <b>iným orgánom</b>, spoločnostiam (inštitúciám), ktoré vykonávajú alebo majú vykonávať službu (služby), ktoré sa dotýkajú predmetných nehnuteľností.
    </li>
</ol>
<p class="mt-10">
    Splnomocnenec uvedené plnomocenstvo v plnom rozsahu prijíma a zaväzuje sa prihlásiť splnomocniteľa v 2. rade ako poberateľa, resp. prijímateľa/užívateľa služieb súvisiacich v užívaním vyššie určenej nehnuteľnosti.
</p>
</body>
</html>
