<?php

namespace Anodoc;

class DocComment {

  private $description, $tags;
  
  function __construct($description = '', array $tags = array()) {
    $this->description = $description;
    $this->parseTags($tags);
  }

  function getDescription() {
    return $this->description;
  }
  
  function getTag($tag) {
    if (isset($this->tags[$tag])) {
      return $this->tags[$tag];
    }
  }
  
  private function parseTags(array $tags) {
    foreach ($tags as $tag => $value) {
      if (preg_match('/^(\(.+\))/', $value, $match)) {
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
