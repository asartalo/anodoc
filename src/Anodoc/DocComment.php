<?php

namespace Anodoc;

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

  function getTag($tag) {
    if (isset($this->tags[$tag])) {
      return $this->tags[$tag];
    }
  }

  private function parseTags(Collection $tags) {
    foreach ($tags as $tag => $value) {
      if (is_string($value) && preg_match('/^(\(.+\))/', $value, $match)) {
        $this->tags[$tag] = $this->parseParentheticalValue($match[1]);
      } else {
        $this->tags[$tag]= $value;
      }
    }
  }

  private function parseParentheticalValue($str) {
    preg_match_all('/(\w+)="([^"]+)"/', $str, $matches);
    if (count($matches[0]) > 0) {
      return array_combine($matches[1], $matches[2]);
    }
    return $str;
  }

}
