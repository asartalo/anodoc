<?php

namespace Anodoc\Collection;

use Anodoc\Tags\Tag;

class TagCollection extends Collection {

  private
    $tag_name,
    $store = array();

  function __construct($tag_name, $array = array()) {
    $this->tag_name = $tag_name;
    foreach ($array as $key => $value) {
      $this->offsetSet($key, $value);
    }
  }

  function offsetSet($key, $value) {
    if ($value instanceof Tag) {
      parent::offsetSet($key, $value);
    }
  }

}