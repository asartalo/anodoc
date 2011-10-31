<?php

use Anodoc\ClassDoc;
use Anodoc\DocComment;

class Anodoc {

  function getDoc() {
    return new ClassDoc('', new DocComment);
  }

}