<?php

namespace Anodoc;
use Anodoc\Collection\TagGroup;

class NullDocComment extends DocComment {

  private $description, $tags;

  function __construct() {}

  function getDescription() {}

  function getShortDescription() {}

  function getLongDescription() {}

}
