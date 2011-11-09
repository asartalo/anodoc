<?php

namespace Anodoc\Tests\Unit;

use Anodoc\Collection;

class CollectionTest extends \PHPUnit_Framework_TestCase {


  function setUp() {
    $this->collection = new Collection;
  }

  function testAddingStuff() {
    $this->collection[] = 'foo';
    $this->assertEquals('foo', $this->collection[0]);
  }

  function testGettingStuffByGetMethod() {
    $this->collection[] = 'foo';
    $this->assertEquals('foo', $this->collection->get(0));
  }

  function testAddingStuffSetsLength() {
    $this->collection[] = 'foo';
    $this->collection[] = 'bar';
    $this->collection[] = 'baz';
    $this->assertEquals(3, $this->collection->length());
  }

  function testAddingStuffWithStringKey() {
    $this->collection['foo'] = 'bar';
    $this->assertEquals('bar', $this->collection['foo']);
  }

  function testCollectionIsCountable() {
    $this->collection[] = 'foo';
    $this->collection[] = 'bar';
    $this->collection['b'] = 'baz';
    $this->assertEquals(3, count($this->collection));
  }

  function testCheckingAKeExists() {
    $this->collection['foo'] = 'bar';
    $this->assertTrue(isset($this->collection['foo']));
  }

  function testCheckingUnknownKeyExists() {
    $this->assertFalse(isset($this->collection['foo']));
  }

  function testUnsettingAStuff() {
    $this->collection['foo'] = 'bar';
    unset($this->collection['foo']);
    $this->assertFalse(isset($this->collection['foo']));
  }

  function testImportingAnArray() {
    $collection = new Collection(
      array(
        'foo' => 'bar', 1, 2, 'three'
      )
    );
    $this->assertEquals(4, count($collection));
    $this->assertEquals('bar', $collection['foo']);
    $this->assertEquals(2, $collection[1]);
  }

}