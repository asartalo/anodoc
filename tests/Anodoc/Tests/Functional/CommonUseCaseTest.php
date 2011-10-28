<?php

namespace Anodoc\Tests\Functional;

use Anodoc\Parser;
use Anodoc\DocComment;

class CommonUseCaseTest extends \PHPUnit_Framework_TestCase {

  function setUp() {
    $this->anodoc = new \Anodoc;
  }

  function testGettingClassDoc()
  {
    $docCollection = $this->anodoc->getDoc('Anodoc\Tests\ClassDocSample');
    $classDoc = $docCollection->getClassDoc();
    $this->markTestSkipped();
    $this->assertEquals(
        'Dummy class for functioanl tests',
        $classDoc->getShortDescription()
    );
  }

}