<?php

namespace Anodoc\Tags;

abstract class Tag {

  abstract function __construct($tag_name, $value);

  abstract function getValue();

  abstract function getTagName();

  abstract function __toString();

  function isNull() {
    return false;
  }

}