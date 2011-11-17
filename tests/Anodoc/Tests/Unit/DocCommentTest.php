<?php

namespace Anodoc\Tests\Unit;

use Anodoc\DocComment;
use Anodoc\Collection\TagGroupCollection;
use Anodoc\Collection\TagGroup;
use Anodoc\Tags\GenericTag;

class DocCommentTest extends \PHPUnit_Framework_TestCase {

  function testAddingAndGettingDescription() {
    $doc = new DocComment('This is the description');
    $this->assertEquals(
      'This is the description', $doc->getDescription()
    );
  }

  function testGettingEmptyDescription() {
    $doc = new DocComment;
    $this->assertEquals(null, $doc->getDescription());
  }

  /**
   * @dataProvider dataSettingTags
   */
  function testSettingAndGettingTags($tags, $tag, $expected_value) {
    $tag_collections = new TagGroupCollection;
    foreach ($tags as $tag => $value) {
      $tag_collections[$tag] = new TagGroup($tag, array(new GenericTag($tag, $value)));
    }
    $doc = new DocComment('', $tag_collections);
    $this->assertEquals($expected_value, $doc->getTags($tag)->get(0)->getValue());
  }

  /**
   * //@dataProvider dataSettingTags
   */
  function testGettingJustOneTagValue($tags, $tag, $expected_value) {
    $tag_collections = new TagGroupCollection;
    foreach ($tags as $tag => $value) {
      $tag_collections[$tag] = new TagGroup($tag, array(new GenericTag($tag, $value)));
    }
    $doc = new DocComment('', $tag_collections);
    $this->assertEquals($expected_value, $doc->getTagValue($tag));
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

  private function getTagGroupForTest() {
    $tag_collections = new TagGroupCollection;
    $tag_collections['foo'] = new TagGroup(
      'foo',
      array(
        new GenericTag('foo', 'Foo 1'),
        new GenericTag('foo', 'Foo 2')
      )
    );
    return $tag_collections;
  }

  function testGettingJustOneTagWithMultipleValuesGetsLastValue() {
    $doc = new DocComment('', $this->getTagGroupForTest());
    $this->assertEquals('Foo 2', $doc->getTagValue('foo'));
  }

  function testGettingATagObjectReturnsLastTag() {
    $doc = new DocComment('', $this->getTagGroupForTest());
    $this->assertEquals(new GenericTag('foo', 'Foo 2'), $doc->getTag('foo'));
  }

  function testGettingTagsReturnEmptyCollectionWhenThereIsNoTag() {
    $doc = new DocComment('', $this->getTagGroupForTest());
    $this->assertTrue($doc->getTags('bar')->isEmpty());
  }

  function testGettingATagObjectReturnsNullTagByDefault() {
    $doc = new DocComment;
    $this->assertInstanceOf('Anodoc\Tags\NullTag', $doc->getTag('foo'));
  }

  function testCheckingIfDocCommentHasTagReturnsFalseForUnsetTags() {
    $doc = new DocComment('', new TagGroupCollection);
    $this->assertFalse($doc->hasTag('foo'));
  }

  function testHasTagReturnsTrueIfTagIsSet() {
    $tag_collections = new TagGroupCollection;
    $tag_collections['foo'] = new TagGroup(
      'foo',
      array(
        new GenericTag('foo', 'bar')
      )
    );
    $doc = new DocComment('', $tag_collections);
    $this->assertTrue($doc->hasTag('foo'));
  }

  function testGettingShortDescription() {
    $doc = new DocComment('Foo Bar');
    $this->assertEquals('Foo Bar', $doc->getShortDescription());
  }

  function testShortDescriptionReturnsNullByDefault() {
    $doc = new DocComment;
    $this->assertEquals(null, $doc->getShortDescription());
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

  function testGettingLongDescriptionReturnsNullByDefault() {
    $doc = new DocComment;
    $this->assertEquals(null, $doc->getLongDescription());
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
