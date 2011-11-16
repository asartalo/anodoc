<?php

namespace Anodoc\Tags;

class NullTag extends Tag {

  function __construct($tag_name, $value) {}

  function getValue() {}

  function getTagName() {}

  function __toString() {}

  function isNull() {
    return true;
  }
}