<?php

use Anodoc\ClassDoc;
use Anodoc\DocComment;
use Anodoc\Parser;
use Anodoc\RawDocRetriever;

class Anodoc {

  private $parser;

  function __construct(Parser $parser) {
    $this->parser = $parser;
  }

  static function getNew() {
    return new self(new Parser);
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

  function registerTag($tag_name, $tag_class) {
    $this->parser->registerTag($tag_name, $tag_class);
  }

  /**
   * Used for easier classloading
   *
   * e.g.:
   * require_once 'Anodoc.php';
   * $classLoader->register('Anodoc', Anodoc::getSourceLocation());
   */
  static function getSourceLocation() {
    return __DIR__;
  }

}