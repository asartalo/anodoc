<?php

namespace Anodoc\Tags;

abstract class Tag {

  abstract function __construct($tag_name, array $values);

  abstract function getValue();

  abstract function getTagName();

}