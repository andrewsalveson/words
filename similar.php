<?php
require_once('word_library.php');
echo '<form><input type="text" name="word"><input type="submit"></form><pre>';
if(!isset($_REQUEST['word']))
  die();
$word = $_REQUEST['word'];
function cmp($a,$b){
  if($a == $b)
    return 0;
  return($a < $b)? -1 : 1;
}
echo "$word\n";
echo "--------------------\n";
function word_in_lib($word,$lib){
  $metaphone = salMetaphone($word);
  if(isset($lib[$metaphone])){
    return $lib[$metaphone];
    $possibilities = [];
    foreach($lib[$metaphone] as $possible){
      $diff = levenshtein($possible,$word);
      $possibilities[$possible] = $diff;
    }
    uasort($possibilities,"cmp");
    return $possibilities;
  }else{
    if(strlen($word) > 1){
      $len = strlen($word) - 1;
      $trunc = substr($word,0,$len);
      return word_in_lib($trunc,$lib);
    }else
      return [];
  }
}
$possibilities = word_in_lib($word,$metaphones);
$distances = [];
foreach($possibilities as $possible){
  $diff = levenshtein($possible,$word);
  $distances[$possible] = $diff;
}
uasort($distances,"cmp");
foreach($distances as $possibility=>$score){
  if($score==0){
    echo "spelled correctly";
    break;
  }
  echo "$possibility\t$score\n";
}
