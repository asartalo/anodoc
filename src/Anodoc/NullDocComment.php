<?php

namespace Anodoc;

class NullDocComment extends DocComment {

  private $description, $tags;

  function __construct() {}

  function getDescription() {}

  function getShortDescription() {}

  function getLongDescription() {}

  function getTag($tag) {}

}
