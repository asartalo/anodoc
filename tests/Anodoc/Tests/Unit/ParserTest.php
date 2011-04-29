<?php

namespace Anodoc\Tests\Unit;

use Anodoc\Parser;
use Anodoc\DocComment;

class ParserTest extends \PHPUnit_Framework_TestCase {
  
  function setUp() {
    $this->parser = new Parser;
  }
  
  function multiline() {
    $lines = func_get_args();
    return implode("\n", $lines);
  }
  
  function testParserReturnsAnInstanceOfDocComment() {
    $this->assertInstanceOf('Anodoc\DocComment', $this->parser->parse(''));
  }
  
  /**
   * @dataProvider dataParsesDescriptionOutOfDocComments
   */
  function testParsesDescriptionOutOfDocComments($doc_comment, $description) {
    $this->assertEquals(
      $description, $this->parser->parse($doc_comment)->getDescription()
    );
  }
  
  function dataParsesDescriptionOutOfDocComments() {
    return array(
      array(
        $this->multiline(
          '/**',
          ' * This is my description',
          ' */'
        ),
        "This is my description"
      ),
      
      array(
        $this->multiline(
          '/**',
          ' * This is my description that spans',
          ' * multiple lines',
          ' */'
        ),
        $this->multiline(
          'This is my description that spans',
          'multiple lines'
        )
      ),
      array(
        $this->multiline(
          '/**',
          ' * This doc comment',
          ' * has tags',
          ' * @foo Bar',
          ' */'
        ),
        $this->multiline(
          'This doc comment',
          'has tags'
        )
      ),
    );
  }
  
  /**
   * @dataProvider dataParsesTagOutOfDocComments
   */
  function testParsesTagOutOfDocComments($doc_comment, $tag, $value) {
    $this->assertEquals(
      $value, $this->parser->parse($doc_comment)->getTag($tag)
    );
  }
  
  function dataParsesTagOutOfDocComments() {
    return array(
      array(
        $this->multiline(
          '/**',
          ' * @foo Foo Bar',
          ' */'
        ),
        'foo', 'Foo Bar'
      ),
      array(
        $this->multiline(
          '/**',
          ' *  @bar   Some tag value with none trimmed spaces    ',
          ' */'
        ),
        'bar', 'Some tag value with none trimmed spaces'
      ),
      array(
        $this->multiline(
          '/**',
          ' * @baz2 Some text that spans',
          ' *       multiple lines for tag',
          ' */'
        ),
        'baz2', "Some text that spans\nmultiple lines for tag"
      ),
      array(
        $this->multiline(
          '/**',
          ' * @foo_tag Another text that spans',
          ' *          multiple lines',
          ' *          and goes on and on',
          ' */'
        ),
        'foo_tag', "Another text that spans\nmultiple lines\nand goes on and on"
      ),
      array(
        $this->multiline(
          '/**',
          ' * @foo Some text that spans',
          ' *      multiple lines',
          ' * @bar Another tag',
          ' */'
        ),
        'foo', "Some text that spans\nmultiple lines"
      ),
      array(
        $this->multiline(
          '/**',
          ' * @foo Some text that spans',
          ' *      multiple lines',
          ' * @bar Another tag',
          ' */'
        ),
        'bar', "Another tag"
      ),
      array(
        $this->multiline(
          '/**',
          ' * With some description',
          ' * ',
          ' * @foo Some text that spans',
          ' *      multiple lines',
          ' * @bar Another tag',
          ' */'
        ),
        'bar', "Another tag"
      ),
      array(
        $this->multiline(
          '/**',
          ' * @foo(some text inside brackets)',
          ' */'
        ),
        'foo', "(some text inside brackets)"
      ),
    );
  }
  
}

