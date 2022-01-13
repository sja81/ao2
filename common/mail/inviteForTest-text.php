<div class="student-invite">
    <p>Dobrý deň <?= $studentName ?>!</p>

    <p>
        Pre úspešné dokončenie prijímacieho konania prosím tlačítkom <strong>Prejsť na testy</strong> prejdite na testy.
    </p>

    <a href="https://www.aoreal.sk/students/tests/<?= $id ?>" target="_blank">
        <img src="https://www.aoreal.sk/images/tests.png" alt="" width="198">
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

