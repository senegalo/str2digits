This is a basic library written in php that transforms digits written in text to digits...
for example if you have a sentence like:
"well we have two out of one million two thousand and seventy two people sick."
this when parsed will return and array containing all the numbers detected in the sentence
array(2, 2002072);

to use the library all you have to do is include the class
initiate it and run the parse command

require_once "str2digits.php";
$parser = new Str2Digits();
$out = $parser->parse("well we have two out of one million two thousand and seventy two people sick."
);
var_dump ($out);

a working example can be found here: http://goo.gl/uhtUy
