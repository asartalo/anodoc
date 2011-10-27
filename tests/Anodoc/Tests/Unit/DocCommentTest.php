<?php

namespace Anodoc\Tests\Unit;

use Anodoc\DocComment;

class DocCommentTest extends \PHPUnit_Framework_TestCase {

  function testAddingAndGettingComments() {
    $doc = new DocComment('This is the description');
    $this->assertEquals(
      'This is the description', $doc->getDescription()
    );
  }

  /**
   * @dataProvider dataSettingTags
   */
  function testSettingTags($tags, $tag, $expected_value) {
    $doc = new DocComment('', $tags);
    $this->assertEquals($expected_value, $doc->getTag($tag));
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

  function testGettingShortDescription() {
    $doc = new DocComment('Foo Bar');
    $this->assertEquals('Foo Bar', $doc->getShortDescription());
  }

  function testGettingShortDescriptionFromMultilineDescription()
  {
    $doc = new DocComment(
      $this->multiline(
        'Foo Bar',
        '',
        'When the going gets tough,',
        'the tough gets going.'
      )
    );
    $this->assertEquals('Foo Bar', $doc->getShortDescription());
  }

  function testGettingLongDescriptionFromSingleLineDescriptionReturnsEmpty() {
    $doc = new DocComment('Foo Bar');
    $this->assertEquals('', $doc->getLongDescription());
  }

  function testGettingLongDescriptionFromMultiLineDescReturnsLinesBeyond() {
    $doc = new DocComment(
      $this->multiline(
        'Foo Bar',
        '',
        'When the going gets tough,',
        'the tough gets going.'
      )
    );
    $this->assertEquals(
      $this->multiline(
        'When the going gets tough,',
        'the tough gets going.'
      ),
      $doc->getLongDescription()
    );
  }

  function testGettingLongDescriptionFromMultiLineDescReturnsLinesBeyond2() {
    $doc = new DocComment(
      $this->multiline(
        'Foo Bar',
        'When the going gets tough,',
        'the tough gets going.'
      )
    );
    $this->assertEquals(
      $this->multiline(
        'When the going gets tough,',
        'the tough gets going.'
      ),
      $doc->getLongDescription()
    );
  }

  function multiline() {
    $lines = func_get_args();
    return implode("\n", $lines);
  }

}
