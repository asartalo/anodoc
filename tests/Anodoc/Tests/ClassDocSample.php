<?php
/**
 * This is the file that holds the dummy class
 *
 * And this is the description for that file.
 * How nice.
 *
 * @some
 * @tags are free
 */


namespace Anodoc\Tests;


/**
 * Dummy class for functional tests
 *
 * This dummy class is used in ClassDocSample
 * and can also be used anywhere you want.
 *
 * @author Wayne Duran
 * @foo Just another dummy tag
 */
class ClassDocSample {

  /**
   * A private variable named $var
   */
  private $var;

  /**
   * A private variable named $bar
   */
  private $bar;

  private $bbb; // Does not have a doc comment

  /**
   * This is a public method
   *
   * And this is a long description for this
   * public method.
   *
   * @param string $arg1 A string argument
   * @param array $arg2 An array argument
   * @return void
   */
  function publicMethod($var1, $var2) {}

}