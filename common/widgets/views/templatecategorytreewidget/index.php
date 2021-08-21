<ul id="<?= $id ?>">
    <?= $tree ?>
</ul>

<?php
$js = <<<JS

    var toggler = document.getElementsByClassName("caret");
    var i;
        
    for (i = 0; i < toggler.length; i++) {
      toggler[i].addEventListener("click", function() {
        this.parentElement.querySelector(".nested").classList.toggle("active");
        this.classList.toggle("caret-down");
      });
    }
JS;
$this->registerJS($js);

$css = <<<CSS
ul, #{$id} {
  list-style-type: none;
}
#{$id} {
  margin: 0;
  padding: 15px;
}
.caret {
  cursor: pointer;
  user-select: none; /* Prevent text selection */
}
.caret::before {
  content: "▶";
  color: black;
  display: inline-block;
  margin-right: 6px;
}
.caret-down::before {
  transform: rotate(90deg);
}
.nested {
  display: none;
}
.active {
  display: block;
} 
CSS;
$this->registerCSS($css);
