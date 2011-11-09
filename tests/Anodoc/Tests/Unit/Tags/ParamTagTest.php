<?php

namespace Anodoc\Tests\Unit\Tags;

use Anodoc\Tags\ParamTag;

class ParamTagTest extends \PHPUnit_Framework_TestCase {

  function setUp() {
    $this->tag = new ParamTag('bar', 'string $var This is a description');
    $this->value = $this->tag->getValue();
  }

  function testGettingTypeOfParam() {
    $this->assertEquals('string', $this->value['type']);
  }

  function testGettingVariableNameOfParam() {
    $this->assertEquals('var', $this->value['name']);
  }

  function testGettingDescription() {
    $this->assertEquals('This is a description', $this->value['description']);
  }

  function testGettingMultilineDescription() {
    $this->tag = new ParamTag('bar', "string \$var This is\na\ndescription");
    $this->value = $this->tag->getValue();
    $this->assertEquals("This is\na\ndescription", $this->value['description']);
  }

}