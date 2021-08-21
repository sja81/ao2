<ul id="<?= $id ?>">
    <?= $tree ?>
</ul>

<?php

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
.pdf {
    color: red;
}
a.doc-edit {
    color: black;
    margin-left: 10px;
}
span.doc-view,
span.doc-delete,
span.cat-edit {
    cursor:pointer; 
    margin-left: 5px;
    color: black;
}
a.doc-edit:hover,
span.doc-view:hover,
span.doc-delete:hover,
span.cat-edit:hover {
    color: coral;
}

CSS;
$this->registerCSS($css);
