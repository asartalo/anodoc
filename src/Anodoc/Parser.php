<?php

namespace Anodoc;

class Parser {

  function parse($doc_comment) {
    $doc_comment = $this->cleanupLines($doc_comment);
    $lines = $this->getLines($doc_comment);
    $description = $this->getDescription($lines);
    return new DocComment(trim($description), $this->getTags($lines));
  }

  public function getLines($doc_comment) {
    return ($lines = preg_split('/\s*\n\s*/', $doc_comment)) ? $lines : array();
  }

  private function cleanupLines($str) {
    return preg_replace(array('/^\/\**/', '/\n[\/\* ]+\**/'), array('', "\n"), $str);
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
      $line = trim($line);
      if (empty($line)) {
        continue;
      }
      if (preg_match('/^@(\w+)\s*(.*)$/', $line, $line_parsed)) {
        $current_tag = $line_parsed[1];
        if (!isset($tags[$current_tag])) {
          $tags[$current_tag] = array();
        }
        $tags[$current_tag][] = $line_parsed[2];
        $tag_found = true;
      } elseif ($tag_found) {
        $tag_value = array_pop($tags[$current_tag]);
        $tags[$current_tag][] .= $tag_value . "\n" . $line;

      }
    }
    return $tags;
  }

  function startsWithTag($line) {
    return preg_match('/^@\w/', $line);
  }

}
