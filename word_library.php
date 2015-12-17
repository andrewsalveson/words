<?php
require_once('words.php');
require_once('sound_functions.php');
$metaphones = [];
foreach($words as $word){
	$metaphone = salMetaphone($word[0]);
	if(!isset($metaphones[$metaphone]))
		$metaphones[$metaphone] = [];
	$metaphones[$metaphone][] = $word[0];
}