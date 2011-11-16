<?php

namespace Anodoc\Tests\Functional;

use Anodoc;
use Anodoc\Parser;
use Anodoc\DocComment;

class CommonUseCaseTest extends \PHPUnit_Framework_TestCase {

  function setUp() {
    $this->anodoc = Anodoc::getNew();
    $this->classDoc = $this->anodoc->getDoc('Anodoc\Tests\ClassDocSample');
  }

  function testGettingClassDoc() {
    $mainDoc = $this->classDoc->getMainDoc();
    $this->assertEquals(
      'Dummy class for functional tests',
      $mainDoc->getShortDescription()
    );
  }

  function testGettingClassDocRetrievesAttributeDocs() {
    $barDoc = $this->classDoc->getAttributeDoc('bar');
    $this->assertEquals(
      'A private variable named $bar',
      $barDoc->getDescription()
    );
  }

  function testGettingClassDocRetrievesMethodDocs() {
    $methodDoc = $this->classDoc->getMethodDoc('publicMethod');
    $this->assertEquals(
      "And this is a long description for this\npublic method.",
      $methodDoc->getLongDescription()
    );
  }

  function testGettingATag() {
    $methodDoc = $this->classDoc->getMethodDoc('publicMethod');
    $this->assertEquals(
      'void', $methodDoc->getTagValue('return')
    );
  }

  function testGettingATagWithMultipleValues() {
    $methodDoc = $this->classDoc->getMethodDoc('publicMethod');
    $tags = $methodDoc->getTags('param');
    $this->assertEquals(
      'string $arg1 A string argument', $tags[0]->getValue()
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

  function testGettingSourceDirectory() {
    $this->assertEquals(
      realpath(__DIR__ . '/../../../../') . '/src',
      Anodoc::getSourceLocation()
    );
  }

}