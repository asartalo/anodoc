<?php

namespace Anodoc\Tests\Unit;

use Anodoc\RawDocRetriever;

class RawDocRetrieverTest extends \PHPUnit_Framework_TestCase {

  function setUp() {
    $this->rawDoc = new RawDocRetriever('Anodoc\Tests\ClassDocSample');
  }

  function testGettingClassDoc() {
    $this->assertEquals(
      $this->multiline(
        '/**',
        ' * Dummy class for functional tests',
        ' *',
        ' * This dummy class is used in ClassDocSample',
        ' * and can also be used anywhere you want.',
        ' *',
        ' * @author Wayne Duran',
        ' * @foo Just another dummy tag',
        ' */'
      ),
      $this->rawDoc->rawClassDoc()
    );
  }

  function testGettingAnAtrributeDoc() {
    $attrDocs = $this->rawDoc->rawAttrDocs();
    $this->assertEquals(
      $this->multiline(
        '/**',
        ' * A private variable named $var',
        ' */'
      ),
      $attrDocs['var']
    );
  }

  function testGettingAMethodDoc() {
    $methodDocs = $this->rawDoc->rawMethodDocs();
    $this->assertEquals(
      $this->multiline(
        '/**',
        ' * This is a public method',
        ' *',
        ' * And this is a long description for this',
        ' * public method.',
        ' *',
        ' * @param string $arg1 A string argument',
        ' * @param array $arg2 An array argument',
        ' * @return void',
        ' */'
      ),
      $methodDocs['publicMethod']
    );
  }

  private function multiline() {
    $lines = func_get_args();
    return implode("\n", $lines);
  }

}