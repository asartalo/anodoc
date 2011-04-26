<?php

namespace Anodoc;

class DocComment {

  private $description, $tags;
  
  function __construct($description = '', array $tags = array()) {
    $this->description = $description;
    $this->tags = $tags;
  }

  function getDescription() {
    return $this->description;
  }
  
  function getTag($tag) {
    if (isset($this->tags[$tag])) {
      return $this->tags[$tag];
    }
  }

}
