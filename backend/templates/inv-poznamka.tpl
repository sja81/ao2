<div class="p-t-20">
    <div style="float: left; width: 60%">
        <a href="#"></a>
        <p>Vystavil: {{faktura.vystavil}}</p>
    </div>
    <div style="float: left; width: 40%">
        <p class="m-b-10 fs-1_2em">Rekapitulácia</p>
        <table width="100%" cellpadding="0" cellspacing="0">
            {{rekap.zalohy}}
            {{rekap.celkova}}
            <tr>
                <td colspan="2" class="m-t-5" style="padding-top: 5px">K úhrade:</td>
            </tr>
            <tr>
                <td colspan="2" align="right" class="ta-right fs-1_5em">
                    {{rekap.kuhrade}}
                </td>
            </tr>
        </table>
    </div>
</div>
<div style="clear: both"></div>
<p class="m-t-20 p-t-10 border-top">
    {{faktura.poznamka}}
</p>