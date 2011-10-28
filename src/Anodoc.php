<?php

use Anodoc\ClassDocCollection;
use Anodoc\DocComment;

class Anodoc {

  function getDoc() {
    return new ClassDocCollection('', new DocComment);
  }

}