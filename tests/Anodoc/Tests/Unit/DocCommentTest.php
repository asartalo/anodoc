<?php

namespace Anodoc\Tests\Unit;

use Anodoc\DocComment;
use Anodoc\Collection\Collection;
use Anodoc\Collection\TagCollection;
use Anodoc\Tags\GenericTag;

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
  function testSettingAndGettingTags($tags, $tag, $expected_value) {
    $tag_collections = new Collection;
    foreach ($tags as $tag => $value) {
      $tag_collections[$tag] = new TagCollection($tag, array(new GenericTag($tag, $value)));
    }
    $doc = new DocComment('', $tag_collections);
    $this->assertEquals($expected_value, $doc->getTags($tag)->get(0)->getValue());
  }

  /**
   * //@dataProvider dataSettingTags
   */
  function testGettingJustOneTag($tags, $tag, $expected_value) {
    $tag_collections = new Collection;
    foreach ($tags as $tag => $value) {
      $tag_collections[$tag] = new TagCollection($tag, array(new GenericTag($tag, $value)));
    }
    $doc = new DocComment('', $tag_collections);
    $this->assertEquals($expected_value, $doc->getTag($tag));
  }

  function dataSettingTags() {
    return array(
      array(
        array('foo' => 'Foo string.'),
        'foo',
        'Foo string.'
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
