<table class="table3" cellspacing="0">
    <tr>
        <td class="p-l-5">Suma</td>
        <td class="p-l-5">DPH {{doklad.dph}}%</td>
        <td class="p-l-5">Nepodlieha DPH</td>
        <td class="p-l-5">Celkom k úhrade</td>
    </tr>
    <tr>
        <td class="p-l-5">{{doklad.suma}} {{doklad.mena}}</td>
        <td class="p-l-5">{{doklad.suma_dph}} {{doklad.mena}}</td>
        <td class="p-l-5">{{doklad.nepodlieha_dph}} {{doklad.mena}}</td>
        <td class="p-l-5">{{doklad.k_uhrade}} {{doklad.mena}}</td>
    </tr>
    <tr>
        <td colspan="4" class="p-l-5">
            Suma slovom <span style="margin-left: 10px;">{{doklad.suma_text}} {{doklad.mena}} ,-</span>
        </td>
    </tr>
</table>