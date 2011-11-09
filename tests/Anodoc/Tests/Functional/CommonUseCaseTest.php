<?php

namespace Anodoc\Tests\Functional;

use Anodoc;
use Anodoc\Parser;
use Anodoc\DocComment;

class CommonUseCaseTest extends \PHPUnit_Framework_TestCase {

  function setUp() {
    $this->anodoc = Anodoc::getNew();
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

  function testRegisteringATagRegistersThroughParser() {
    $parser = $this->getMock('Anodoc\Parser', array('registerTag'));
    $anodoc = new Anodoc($parser);
    $parser->expects($this->once())
      ->method('registerTag')
      ->with('foo', 'FooTagClass');
    $anodoc->registerTag('foo', 'FooTagClass');
  }

}