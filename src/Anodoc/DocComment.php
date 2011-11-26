<?php

namespace Anodoc;

use Anodoc\Collection\TagGroup;
use Anodoc\Collection\TagGroupCollection;

class DocComment {

  private $description, $tags;

  function __construct($description = '', TagGroupCollection $tags = null) {
    if (!$tags) {
      $tags = new TagGroupCollection;
    }
    $this->description = $description;
    foreach ($tags as $tag => $value) {
      $this->tags[$tag]= $value;
    }
  }

  function getDescription() {
    return $this->description;
  }

  function getShortDescription() {
    if (preg_match('/^(.+)\n/', $this->description, $matches)) {
      return $matches[1];
    }
    return $this->description;
  }

  function getLongDescription() {
    if ($longDescription = preg_replace('/^.+\n/', '', $this->description)) {
      return $longDescription != $this->description ?
        trim($longDescription) : '';
    }
  }

  function getTags($tag) {
    if ($this->hasTag($tag)) {
      return $this->tags[$tag];
    }
    return new TagGroup($tag);
  }

  function getTag($tag) {
    if ($this->hasTag($tag)) {
      return $this->tags[$tag][$this->tags[$tag]->count() -1];
    }
    return new Tags\NullTag('', '');
  }

  function getTagValue($tag) {
    if ($this->hasTag($tag)) {
      $last = $this->tags[$tag][$this->tags[$tag]->count() -1];
      return $last->getValue();
    }
  }

  function hasTag($tag) {
    return isset($this->tags[$tag]);
  }
}
