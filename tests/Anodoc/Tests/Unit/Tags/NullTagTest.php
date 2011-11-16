<?php

namespace Anodoc\Tests\Unit\Tags;

use Anodoc\Tags\NullTag;

class NullTagTest extends \PHPUnit_Framework_TestCase {

  function testNullTagIsNull() {
    $tag = new NullTag('bar', 'foo');
    $this->assertTrue($tag->isNull());
  }

  function testNullTagHasNothing() {
    $tag = new NullTag('', '');
    $this->assertNull($tag->getValue());
    $this->assertNull($tag->getTagName());
    $this->assertNull($tag->__toString());
  }

}