<?php

use Anodoc\ClassDoc;
use Anodoc\DocComment;
use Anodoc\Parser;
use Anodoc\RawDocRetriever;

class Anodoc {

  function __construct() {
    $this->parser = new Parser;
  }

  function getDoc($class) {
    $retriever = new RawDocRetriever($class);
    return new ClassDoc(
      $class, $this->parser->parse($retriever->rawClassDoc()),
      $this->getParsedDocs($retriever->rawMethodDocs()),
      $this->getParsedDocs($retriever->rawAttrDocs())
    );
  }

  private function getParsedDocs($rawDocs) {
    $docs = array();
    foreach ($rawDocs as $name => $doc) {
      $docs[$name] = $this->parser->parse($doc);
    }
    return $docs;
  }

}