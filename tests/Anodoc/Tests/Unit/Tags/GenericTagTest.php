<?php

namespace Anodoc\Tests\Unit\Tags;

use Anodoc\Tags\GenericTag;

class GenericTagTest extends \PHPUnit_Framework_TestCase {

  function testBasicInstantiation() {
    $tag = new GenericTag('bar', 'foo');
    $this->assertEquals('foo', $tag->getValue());
  }

  function testGettingTagName() {
    $tag = new GenericTag('bar', 'foo');
    $this->assertEquals('bar', $tag->getTagName());
  }

}