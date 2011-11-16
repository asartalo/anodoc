Anodoc
======

Anodoc is a lightweight doc comment/block parser written in
PHP. Doc comments are usually written in the style

```php
<?php
/**
 * A test summary
 *
 * And here's a longer description that explains in detail
 * what this section is all about.
 *
 * @param  foo bar
 * @param  boo far
 * @return baz
 */
?>
```

and are created to document source code. Anodoc parses these
comments as where you can access, the description, the short
description, the long description, and the tags.


Usage
-----
For the example doc comment before, you can get the data
like:

```php
<?php
$parser = new Anodoc\Parser;

// This returns a new Anodoc\DocComment object.
$doc = $parser->parse(
	"/**\n" .
	" * A test summary\n" .
	" *\n" .
	" * And here's a longer description that explains in detail\n" .
	" * what this section is all about.\n" .
	" *\n" .
	" * @param  foo bar\n" .
	" * @param  boo far\n" .
	" * @return baz\n" .
	" */"
);

echo $doc->getShortDescription();
// "A test summary"

echo $doc->getLongDescription();
// And here's a longer description that explains in detail
// what this section is all about.

echo $doc->getTagValue('return');
// baz

$doc->getTag('return');
// A Tag object with value 'baz'

echo $doc->getTagValue('param'); // this will return the last defined value
// boo far

var_dump($doc->getTags('param'));
// a dump of a TagCollection that has 2 values

?>
```

You can also get all the docComments on a class by
using Anodoc

```php
<?php

// Factory instantiates a new Anodoc object
// With a Parser
$anodoc = Anodoc::getNew();

$classDoc = $anodoc->getDoc('FooClass');

// Get the main class doc comment description
echo $classDoc->getMainDoc();

// Get the doc comment for method FooClass::fooMethod()
$classDoc->getMethodDoc('fooMethod')

// Get the doc comment for the attribute $bar
$classDoc->getAttributeDoc('bar');
?>
```

Custom Tags
-----------

Anodoc does not define any syntactic customizations for
tag values. By default, each value retrieved from the parser
returns an instance of Anodoc\Tags\GenericTag. You can
register a new Tag type by creating a class that extends
the abstract class 'Anodoc\Tags\Tag' and registering it
through the parser or Anodoc object. Then you can set your
custom syntax there.

For example, Anodoc comes with a custom tag for handling
params named "Anodoc\Tags\ParamTag". The definition is:

```php
<?php

namespace Anodoc\Tags;

class ParamTag extends Tag {

  private $tag_name, $value;

  function __construct($tag_name, $value) {
    preg_match('/(\w+)\s+\$(\w+)\s+(.+)/ms', $value, $matches);
    $this->value = array(
      'type' => $matches[1],
      'name' => $matches[2],
      'description' => $matches[3]
    );
    $this->tag_name = $tag_name;
  }

  function getValue() {
    return $this->value;
  }

  function getTagName() {
    return $this->tag_name;
  }

  function __toString() {
    return (string) $this->value;
  }

}
?>
```
This is not registered by default so you must register it
yourself to be useful.

```php
<?php

$anodoc = Anodoc::getNew();
$anodoc->register('param', 'Anodoc\Tags\ParamTag');
$classDoc = $anodoc->getDoc('FooClass');

$classDoc->getMethodDoc('fooMethod')->getTag('param');
// returns an 'Anodoc\Tags\ParamTag' object

?>
```

Limitations
-----------

Anodoc doesn't parse inline tags as of the moment.