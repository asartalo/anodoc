<?php

namespace Anodoc\Tags;

class GenericTag extends Tag {

  private $tag_name, $value;

  function __construct($tag_name, $value) {
    $this->value = $value;
    $this->tag_name = $tag_name;
  }

  function getValue() {
    return $this->value;
  }

  function getTagName() {
    return $this->tag_name;
  }

  function __toString() {
    return (string) $this->value;
  }

}