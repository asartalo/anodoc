<?php

namespace Anodoc\Tests\Unit;

use Anodoc\Collection\TagGroup;
use Anodoc\Collection\TagGroupCollection;

class TagGroupCollectionTest extends \PHPUnit_Framework_TestCase {

  function testOnlyAcceptsTagGroup() {
    $tagGroup = new TagGroup('foo');
    $tagGroupCollection = new TagGroupCollection;
    $tagGroupCollection['foo'] = $tagGroup;
    $this->assertEquals($tagGroup, $tagGroupCollection['foo']);
  }

  function testThrowsExceptionWhenPassedWithNotATagGroup() {
    $tagGroupCollection = new TagGroupCollection;
    $this->setExpectedException('Anodoc\Collection\NotATagGroupException');
    $tagGroupCollection['tag'] = array();
  }

}