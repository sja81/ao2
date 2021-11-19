<div class="student-invite">
    <p>Dobrý deň <?= $studentName ?>!</p>

    <p>
        Ponúkame Vám možnosť zúčastniť sa duálneho štúdia, ktorým si môžete získať cenné skúsenosti z praxe.
        Ak máte záujem, stlačte tlačítko <strong>Registrovať sa</strong>, ktorá Vás presmeruje na náš registračný formulár.
    </p>

    <a href="https://www.aoreal.sk/students" target="_blank">
        <img src="https://www.aoreal.sk/images/regbut.png" alt="" width="198">
    </a>

    <p>
        S pozdravom
    </p>

    <p>
        Tím AOReal

    </p>
</div>
<?php
$css = <<<CSS
        a > img{
            text-decoration: none;
        }
CSS;
$this->registerCSS($css);

