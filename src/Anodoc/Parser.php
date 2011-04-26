<?php

namespace Anodoc;

class Parser {

  function parse($doc_comment) {
    $lines = preg_split('/\s*\n\s*/', $doc_comment);
    array_walk($lines, array($this, 'cleanupLine'));
    $this->trimLines($lines);
    $description = $this->getDescription($lines);
    $tags = $this->getTags($lines);
    return new DocComment(trim($description), $tags);
  }
  
  function cleanupLine(&$line) {
    $line = trim(str_replace(array('/', '*'), '', $line));
  }
  
  function trimLines($lines) {
    
  }
  
  private function getDescription(&$lines) {
    $description = '';
    while (is_string($line = array_shift($lines)) && !$this->startsWithTag($line)) {
      $description .= "$line\n";
    }
    array_unshift($lines, $line);
    return $description;
  }
  
  private function getTags($lines) {
    $tags = array();
    $tag_found = false;
    foreach ($lines as $line) {
      if (trim($line) == '') {
        continue;
      }
      if ($tag_found && !$this->startsWithTag($line)) {
        $tags[$current_key] .= "\n" . trim($line);
      }
      if (preg_match('/^@(\w+)\s*(.*)$/', $line, $line_parsed)) {
        $current_key = $line_parsed[1];
        $tags[$current_key] = $line_parsed[2];
        $tag_found = true;
      }
    }
    return $tags;
  }
  
  function startsWithTag($line) {
    return preg_match('/^@\w/', $line);
  }

}
