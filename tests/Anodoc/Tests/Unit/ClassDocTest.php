<?php

namespace Anodoc\Tests\Unit;

use Anodoc\ClassDoc;
use Anodoc\DocComment;

class ClassDocTest extends \PHPUnit_Framework_TestCase {

  function setUp() {
    $this->docCollection = new ClassDoc(
      'FooClass',
      new DocComment('Foo Bar'),
      array(
        'method1' => new DocComment('method1 description'),
        'method2' => new DocComment('method2 description')
      ),
      array(
        'attribute1' => new DocComment('attribute1 description'),
        'attribute2' => new DocComment('attribute2 description')
      )
    );
  }

  function testGettingClassName() {
    $this->assertEquals('FooClass', $this->docCollection->getClassName());
  }

  function testGettingClassDocReturnsDocComment() {
    $this->assertInstanceOf('Anodoc\DocComment', $this->docCollection->getClassDoc());
  }

  function testGettingClassDocReturnsCorrectDocComment() {
    $this->assertEquals(
      'Foo Bar', $this->docCollection->getClassDoc()->getDescription()
    );
  }

  function testGettingMethodDoc() {
    $this->assertEquals(
      'method1 description',
      $this->docCollection->getMethodDoc('method1')->getDescription()
    );
  }

  function testGettingMethodDocForUnknownMethodReturnsNull() {
    $this->assertSame(
      null, $this->docCollection->getMethodDoc('fooMethod')
    );
  }


  function testAddingNonDocCommentAsMethodDocThrowsException() {
    $this->setExpectedException('Anodoc\ClassDoc\InvalidMethodDoc');
    new ClassDoc('Foo', new DocComment, array('foo', 'b'));
  }

}