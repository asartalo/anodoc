<?php

namespace Anodoc\Tests\Unit;

use Anodoc\Collection\TagCollection;

class TagCollectionTest extends \PHPUnit_Framework_TestCase {

  function testSettingTagNameOfTagCollection() {
    $collection = new TagCollection('foo', array());
    $this->assertEquals('foo', $collection->getTagname());
  }

}