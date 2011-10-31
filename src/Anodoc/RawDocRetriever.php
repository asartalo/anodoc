<?php

namespace Anodoc;

class RawDocRetriever {

  private
    $classDoc,
    $attrDocs,
    $methodDocs;

  function __construct($className) {
    $reflection = new \ReflectionClass($className);
    $this->classDoc = $reflection->getDocComment();
    $this->attrDocs = $this->getAttrDocs($reflection);
    $this->methodDocs = $this->getMethodDocs($reflection);
    unset($reflection);
  }

  function rawClassDoc() {
    return $this->classDoc;
  }

  function rawAttrDocs() {
    return $this->attrDocs;
  }

  function rawMethodDocs() {
    return $this->methodDocs;
  }

  private function getAttrDocs($reflection) {
    $properties = $reflection->getProperties();
    $docs = array();
    foreach ($properties as $property) {
      $docs[$property->getName()] = preg_replace(
        "/\n\s\s+/", "\n ", $property->getDocComment()
      );
    }
    return $docs;
  }

  private function getMethodDocs($reflection) {
    $methods = $reflection->getMethods();
    $docs = array();
    foreach ($methods as $method) {
      $docs[$method->getName()] = preg_replace(
        "/\n\s\s+/", "\n ", $method->getDocComment()
      );
    }
    return $docs;
  }

}