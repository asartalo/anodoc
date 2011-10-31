<?php

namespace Anodoc\Tests\Functional;

use Anodoc\Parser;
use Anodoc\DocComment;

class CommonUseCaseTest extends \PHPUnit_Framework_TestCase {

  function setUp() {
    $this->anodoc = new \Anodoc;
  }

  function testGettingClassDoc() {
    $classDoc = $this->anodoc->getDoc('Anodoc\Tests\ClassDocSample');
    $mainDoc = $classDoc->getMainDoc();
    $this->assertEquals(
      'Dummy class for functional tests',
      $mainDoc->getShortDescription()
    );
  }

  function testGettingClassDocRetrievesAttributeDocs() {
    $classDoc = $this->anodoc->getDoc('Anodoc\Tests\ClassDocSample');
    $barDoc = $classDoc->getAttributeDoc('bar');
    $this->assertEquals(
      'A private variable named $bar',
      $barDoc->getDescription()
    );
  }

  function testGettingClassDocRetrievesMethodDocs() {
    $classDoc = $this->anodoc->getDoc('Anodoc\Tests\ClassDocSample');
    $methodDoc = $classDoc->getMethodDoc('publicMethod');
    $this->assertEquals(
      "And this is a long description for this\npublic method.",
      $methodDoc->getLongDescription()
    );
  }

}