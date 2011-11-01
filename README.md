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
	" * @return baz\n" .
	" */"
);

echo $doc->getShortDescription();
// "A test summary"

echo $doc->getLongDescription();
// And here's a longer description that explains in detail
// what this section is all about.

echo $doc->getTag('param');
// foo bar

echo $doc->getTag('return');
// baz

?>
```

You can also get all the docComments on a class by
using Anodoc

```php
<?php

$anodoc = new Anodoc;

$classDoc = $anodoc->getDoc('FooClass');

// Get the main class doc comment description
echo $classDoc->getMainDoc();

// Get the doc comment for method FooClass::fooMethod()
$classDoc->getMethodDoc('fooMethod')

// Get the doc comment for the attribute $bar
$classDoc->getAttributeDoc('bar');
?>
```


Limitations
-----------

Currently, Anodoc\DocComments can't parse multiple instances
of a tag. So for example, if a method has multiple parameters,
like:

```php
<?php
/**
 * A method with multiple parameters
 *
 * @param string $foo Foo parameter
 * @param string $bar Bar parameter
 */
 ?>
 ```
 the parser will only be able to parse the last param value