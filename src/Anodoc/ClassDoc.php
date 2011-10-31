<?php

namespace Anodoc;

use Anodoc\NullDocComment;
use Anodoc\ClassDoc\InvalidMethodDoc;
use Anodoc\ClassDoc\InvalidAttributeDoc;

class ClassDoc {

  private
    $className,
    $classDoc,
    $methodDocs = array(),
    $attributeDocs = array();

  function __construct(
    $className, DocComment $classDoc, array $methodDocs = array(),
    array $attributeDocs = array()
  ) {
    $this->className = $className;
    $this->classDoc = $classDoc;
    foreach ($methodDocs as $methodName => $docComment) {
      $this->setMethodDoc($methodName, $docComment);
    }
    foreach ($attributeDocs as $attribute => $docComment) {
      $this->setAttributeDoc($attribute, $docComment);
    }
  }

  private function setMethodDoc($methodName, $docComment) {
    if ($docComment instanceof DocComment) {
      $this->methodDocs[$methodName] = $docComment;
    } else {
      throw new InvalidMethodDoc("'$methodName' is not a valid method doc.");
    }
  }

  private function setAttributeDoc($attribute, $docComment) {
    if ($docComment instanceof DocComment) {
      $this->attributeDocs[$attribute] = $docComment;
    } else {
      throw new InvalidAttributeDoc("'$attribute' is not a valid attribute doc.");
    }
  }

  function getClassName() {
    return $this->className;
  }

  function getMainDoc() {
    return $this->classDoc;
  }

  function getMethodDoc($method) {
    return $this->getItemDoc($this->methodDocs, $method);
  }

  function getAttributeDoc($attribute) {
    return $this->getItemDoc($this->attributeDocs, $attribute);
  }

  private function getItemDoc($collection, $key) {
    if (isset($collection[$key])) {
      return $collection[$key];
    }
    return new NullDocComment;
  }

}