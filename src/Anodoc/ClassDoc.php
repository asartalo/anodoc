<?php

namespace Anodoc;

use Anodoc\ClassDoc\InvalidMethodDoc;

class ClassDoc {

  private
    $className,
    $classDoc,
    $methodDocs = array();

  function __construct(
    $className, DocComment $classDoc, array $methodDocs = array()
  ) {
    $this->className = $className;
    $this->classDoc = $classDoc;
    foreach ($methodDocs as $methodName => $docComment) {
      $this->setMethodDoc($methodName, $docComment);
    }
  }

  private function setMethodDoc($methodName, $docComment) {
    if ($docComment instanceof DocComment) {
      $this->methodDocs[$methodName] = $docComment;
      } else {
        throw new InvalidMethodDoc("'$methodName' is not a valid methodDoc");
      }
  }

  function getClassName() {
    return $this->className;
  }

  function getClassDoc() {
    return $this->classDoc;
  }

  function getMethodDoc($method) {
    if (isset($this->methodDocs[$method])) {
      return $this->methodDocs[$method];
    }
  }

}