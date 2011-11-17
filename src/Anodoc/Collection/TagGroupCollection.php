<?php

namespace Anodoc\Collection;

use Anodoc\Collection\Collection;
use Anodoc\Collection\TagGroup;

class TagGroupCollection extends Collection {

  private
    $tag_name,
    $store = array();

  function __construct($array = array()) {
    foreach ($array as $key => $value) {
      $this->offsetSet($key, $value);
    }
  }

  function offsetSet($key, $value) {
    if ($value instanceof TagGroup) {
      parent::offsetSet($key, $value);
    } else {
      throw new NotATagGroupException("Offset '$key' is not a tag group");
    }
  }

}