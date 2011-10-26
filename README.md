Anodoc
======

Anodoc is a doc comment parser written in PHP. Doc comments are usually written in the style

```php
<?php
/**
 * A test class
 *
 * @param  foo bar
 * @return baz
 */
?>
```

and are created to document source code.


TODO
----

Parse summaries with description. e.g.:

```php
<?php
/**
 * This is the summary
 *
 * This is the longer description that most often
 * spans multiple lines.
 *
 * @param tag
 */
?>
```