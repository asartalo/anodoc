<?php

namespace Anodoc\Tags;

class ParamTag extends Tag {

  private $tag_name, $value;

  function __construct($tag_name, $value) {
    preg_match('/(\w+)\s+\$(\w+)\s+(.+)/ms', $value, $matches);
    $this->value = array(
      'type' => $matches[1],
      'name' => $matches[2],
      'description' => $matches[3]
    );
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