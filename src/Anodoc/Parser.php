<?php

namespace Anodoc;

class Parser {

  function parse($doc_comment) {
    $description = trim(str_replace(array('/', '*', "\n"), '', $doc_comment));
    $description = str_replace('  ', ' ', $description);
    return new DocComment($description);
  }

}
