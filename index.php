<pre>
<?php
require_once "str2digits.php";
if (isset($_POST['numbers'])) {
    $parser = new Str2Digits();
    $out = $parser->parse($_POST['numbers']);
    
    var_dump($out);
}
?>
</pre>
<form action="<?php print $_SERVER['PHP_SELF'];?>" method="post">
<input type="text" name="numbers"/>
<input type="submit" value="Test IT"/>
</form>