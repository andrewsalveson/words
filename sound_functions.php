<?php
function salMetaphone($word){
	$word = strtolower($word);
	$word = preg_replace('/[^a-z ]/','',$word);
	$word = preg_replace('/(\w)\1+/','\1',$word);
	$word = preg_replace('/sch/','sk',$word);
	$word = preg_replace('/ng/','n',$word);
	$word = preg_replace('/ck/','k',$word);
	$word = preg_replace('/kn/','n',$word);
	$word = preg_replace('/dg/','j',$word);
	$word = preg_replace('/wr/','r',$word);
	$word = preg_replace('/wh/','w',$word);
	$word = preg_replace('/t?ch/','c',$word);
	$word = preg_replace('/sc?h/','s',$word);
	$word = preg_replace('/[zt]h/','t',$word);
	$word = preg_replace('/ph/','f',$word);
	$word = preg_replace('/ou?(gh)?|ow/','o',$word);
	$word = preg_replace('/ou/','o',$word);
	$word = preg_replace('/[ae]ight/','8',$word);
	$word = preg_replace('/igh/','',$word);;
	if(strlen($word) > 2){
		$word = preg_replace('/[aeiouy]/','',$word);
	}
	$word = preg_replace('/[bfpv]/','b',$word);
	$word = preg_replace('/[cgjkqx]/','c',$word);
	$word = preg_replace('/[sz]/','s',$word);
	$word = preg_replace('/[dt]/','d',$word);
	$word = preg_replace('/[mn]/','n',$word);
	return $word;
}
function c2SoundEx($word){
	$result = '';
	$word = strtolower($word);
	$word = preg_replace("/\s/",'',$word);
	$chars = str_split($word);
	$prev = '';
	foreach($chars as $char){
		$code = '';
		switch(true){
			case preg_match("/$char/",'bfpv'):
				$code = '1';
				break;
			case preg_match("/$char/",'cgjkqsxz'):
				$code = '2';
				break;
			case preg_match("/$char/",'dt'):
				$code = '3';
				break;
			case 'l':
				$code = '4';
				break;
			case preg_match("/$char/",'mn'):
				$code = '5';
				break;
			case 'r':
				$code = '6';
				break;
		}
		if($code != $prev){
			$result .= $code;
		}
		$prev = $code;
	}
	$result .= '0000';
	return substr($result,0,4);
}