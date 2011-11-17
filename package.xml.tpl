<?php echo '<'. '?xml version="1.0"?>' ?>
<package version="2.0" xmlns="http://pear.php.net/dtd/package-2.0"
    xmlns:tasks="http://pear.php.net/dtd/tasks-1.0"
    xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://pear.php.net/dtd/tasks-1.0
http://pear.php.net/dtd/tasks-1.0.xsd
http://pear.php.net/dtd/package-2.0
http://pear.php.net/dtd/package-2.0.xsd">
<name>Anodoc</name>
<channel>pear.brainchildprojects.org</channel>
<summary>Easy doc comment parser for PHP</summary>
<description>
Anodoc is a doc comment / doc block / parser written for PHP
</description>
<lead>
  <name>Wayne Duran</name>
  <user>asartalo</user>
  <email>asartalo@projectweb.ph</email>
  <active>yes</active>
</lead>
<date><?php echo $date ?></date>
<time><?php echo $time ?></time>
<version>
  <release>0.2.0</release>
  <api>0.2.0</api>
</version>
<stability>
<release>beta</release>
<api>beta</api>
</stability>
<license uri="http://www.opensource.org/licenses/mit-license.php">MIT</license>
<notes>https://github.com/asartalo/cibo/blob/master/README.md</notes>
<contents>
  <dir name="/">
    <file name="README.md" role="doc" />
    <?php echo $sources ?>
  </dir>
</contents>

<dependencies>
  <required>
    <php>
      <min>5.3.0</min>
    </php>
    <pearinstaller>
      <min>1.9.0</min>
    </pearinstaller>
  </required>
</dependencies>

<phprelease>
  <filelist>
    <?php echo $release ?>
  </filelist>
</phprelease>

</package>

