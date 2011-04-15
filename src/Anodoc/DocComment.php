<?php

namespace Anodoc;

class DocComment {

  private $description;
  
  function __construct($description) {
    $this->description = $description;
  }

  function getDescription() {
    return $this->description;
  }

}
