<?php

namespace Anodoc;
use Anodoc\Collection\TagGroup;

class NullDocComment extends DocComment {

  function __construct() {}

  function getDescription() {}

  function getShortDescription() {}

  function getLongDescription() {}

}
