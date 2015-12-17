<?php
require_once('word_library.php');
echo '<form><input type="text" name="word"><input type="submit"></form><pre>';
if(!isset($_REQUEST['word']))
	die();
$word = $_REQUEST['word'];
$metaphone = salMetaphone($word);
echo "possible alternatives for $word:\n<pre>";
if(isset($metaphones[$metaphone])){
	foreach($metaphones[$metaphone] as $possible){
		echo "$possible\n";
	}
}