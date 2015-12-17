<?php
require('sound_functions.php');
$word = '';
if(isset($argv))
	$word = $argv[1];
if(isset($_REQUEST['word'])){
	$word = $_REQUEST['word'];
	echo '<form><input type="text" name="word"><input type="submit"></form><pre>';
}
?>
soundexes for <?php echo $word;?>:

Library		Output
----------------------
PHP		<?php echo soundex($word);?>

C2.com		<?php echo c2SoundEx($word);?>



metaphones for <?php echo $word;?>:

Library		Output
----------------------
PHP		<?php echo metaphone($word);?>

Andrew		<?php echo salMetaphone($word);?>