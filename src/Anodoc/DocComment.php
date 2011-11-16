<?php

namespace Anodoc;

use Anodoc\Collection\Collection;
use Anodoc\Collection\TagCollection;

class DocComment {

  private $description, $tags;

  function __construct($description = '', Collection $tags = null) {
    if (!$tags) {
      $tags = new Collection;
    }
    $this->description = $description;
    $this->parseTags($tags);
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
    if (
      $longDescription = preg_replace('/^.+\n/', '', $this->description)
    ) {
      return $longDescription != $this->description ? trim($longDescription) : '';
    }
  }

  function getTags($tag) {
    if ($this->hasTag($tag)) {
      return $this->tags[$tag];
    }
    return new TagCollection($tag);
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

  private function parseTags(Collection $tags) {
    foreach ($tags as $tag => $value) {
      if ($value instanceof TagCollection) {
        $this->tags[$tag]= $value;
      } else {
        if (is_object($value)) {
          $type = get_class($value);
        } else {
          $type = gettype($value);
        }
        throw new Exception("Tag '$tag' of type $type is not a TagCollection\n");
      }
    }
  }
}
