<?php
// don't just scan the folder, this is safer
$libraries = [
  'architecture',
  'default'
];
$library = 'default';
if(isset($_REQUEST['library'])){
  $library = $_REQUEST['library'];
}
if(in_array($library,$libraries)){
  require_once("libraries/$library.php");
}else{
  require_once('libraries/default.php');
}
if(!isset($_REQUEST['output']) || ($_REQUEST['output']!='json')){
  echo '<form>'.
    'check <input type="text" name="word">'.
    ' against <select name="library">';
  foreach($libraries as $lib){
    echo "<option ".($library==$lib ? "selected ":"")."value=\"$lib\">$lib</option>";
  }
    echo '</select> library'.
    '<input type="submit"></form><pre>';
}
if(!isset($_REQUEST['word']))
  die();
$word = $_REQUEST['word'];
function cmp($a,$b){
  if($a == $b)
    return 0;
  return($a < $b)? -1 : 1;
}
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
if(isset($_REQUEST['output']) && ($_REQUEST['output']=='json')){
  echo json_encode($distances,JSON_PRETTY_PRINT);
}else{
  echo "$word\n";
  echo "--------------------\n";
  foreach($distances as $possibility=>$score){
    if($score==0){
      echo "spelled correctly";
      break;
    }
    echo "$possibility\t$score\n";
  }
}
