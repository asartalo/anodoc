<?php

namespace Anodoc\Tests\Unit;

use Anodoc\DocComment;

class DocCommentTest extends \PHPUnit_Framework_TestCase {
  
  private function getDocComment($description, array $tags = array()) {
    $this->doc = new DocComment($description, $tags);
  }
  
  function testAddingAndGettingComments() {
    $this->getDocComment('This is the description');
    $this->assertEquals(
      'This is the description', $this->doc->getDescription()
    );
  }
  
  /**
   * @dataProvider dataSettingTags
   */
  function testSettingTags($tags, $tag, $expected_value) {
    $this->getDocComment('', $tags);
    $this->assertEquals($expected_value, $this->doc->getTag($tag));
  }
  
  function dataSettingTags() {
    return array(
      array(array('foo' => 'Foo string.'), 'foo', 'Foo string.'),
      array(
        array('foo' => '(baz="Some string here")'), 'foo',
        array('baz' => "Some string here")
      ),
      array(
        array('foo' => '(bar="a",baz="b")'), 'foo',
        array('bar' => "a", 'baz' => 'b')
      ),
      array(
        array('foo' => '(bar="a",baz="b", bat="x")'), 'foo',
        array('bar' => "a", 'baz' => 'b', 'bat' => 'x')
      ),
      array(
        array('foo' => '(some text in parenthesis)'), 'foo',
        '(some text in parenthesis)'
      )
    );
  }

}
