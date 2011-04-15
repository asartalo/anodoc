<?php

namespace Anodoc;

class Parser {

  function parse($doc_comment) {
    $description = trim(str_replace(array('/', '*'), '', $doc_comment));
    return new DocComment($description);
  }

}
