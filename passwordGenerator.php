<?php

/**
 * Generator random password according to $options
 * @param array $options
 * @return string
 */
function generatePassword($options = array()) {
	$characterGroups = array(
		'lowercase' => array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'),
		'uppercase'	=> array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'),
		'digits'	=> array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9),
		'specials'	=> array('-', '_', '/', '\\')
	);
	
	$selectedGroups = array();
	if(!isset($options['lowercase']) || true == $options['lowercase']) {
		$selectedGroups[] = 'lowercase';
	}
	if(!isset($options['uppercase']) || true == $options['uppercase']) {
		$selectedGroups[] = 'uppercase';
	}
	if(!isset($options['digits']) || true == $options['digits']) {
		$selectedGroups[] = 'digits';
	}
	if(!isset($options['specials']) || true == $options['specials']) {
		$selectedGroups[] = 'specials';
	}
	
	$countGroups = count($selectedGroups);
	
	if(isset($options['length'])) {
		$length = (int) $options['length'];
	} else {
		$length = rand(8, 20);
	}
	
	$password = '';
	
	while(strlen($password) < $length) {
		//choose character group
		$group	= $selectedGroups[rand(0, $countGroups - 1)];
		$chars	= $characterGroups[$group];
		$char	= $chars[rand(0, count($chars) - 1)];
		
		$password .= $char;
	}

	return $password;
}

echo generatePassword(array('specials' => false)) . PHP_EOL;
?>
