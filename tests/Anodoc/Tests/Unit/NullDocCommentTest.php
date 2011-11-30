<?php

namespace Anodoc\Tests\Unit;

use Anodoc\NullDocComment;
use Anodoc\Tags\NullTag;
use Anodoc\Collection\TagGroup;

class NullDocCommentTest extends \PHPUnit_Framework_TestCase {

  function setUp() {
    $this->nullDoc = new NullDocComment;
  }

  function testHasNoDescription() {
    $this->assertEquals('', $this->nullDoc->getDescription());
    $this->assertEquals('', $this->nullDoc->getShortDescription());
    $this->assertEquals('', $this->nullDoc->getLongDescription());
  }

  function testHasNoTags() {
    $this->assertFalse($this->nullDoc->hasTag('foo'));
    $this->assertEquals(new TagGroup('foo'), $this->nullDoc->getTags('foo'));
    $this->assertEquals(new NullTag('foo', ''), $this->nullDoc->getTag('foo'));
  }

}
