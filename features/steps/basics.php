<?php

$steps->Given('/^I have a doc comment$/', function($world, $doc_comment_text) {
  $world->doc_comment_text = $doc_comment_text;
});

$steps->And('/^I have a  doc comment parser$/', function($world) {
  $world->doc_comment_parser = new \Anodoc\Parser;
});

$steps->And('/^I parse the doc comment with the parser$/', function($world) {
  $world->doc_comment_obj = $world->doc_comment_parser->parse(
    $world->doc_comment_text
  );
});

$steps->Then(
  '/^when I ask for the doc comment description, I should get "([^"]*)"$/',
  function($world, $description) {
    assertEquals($description, $world->doc_comment_obj->getDescription());
  }
);


