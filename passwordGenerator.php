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
		'specials'	=> array('-', '_', '/', '\\', '.', '"', "'", ';')
	);
	
	if(isset($options['myCharacters']) && is_array($options['myCharacters'])) {
		$characterGroups[] = $options['myCharacters'];
	}
	
	$selectedGroups = array();
	foreach(array_keys($characterGroups) as $groupName) {
		if(!isset($options[$groupName]) || false !== $options[$groupName]) {
			$selectedGroups[] = $groupName;
		}
	}
	
	$countGroups = count($selectedGroups);
	
	if(isset($options['length'])) {
		$length = (int) $options['length'];
	} else {
		$length = rand(8, 20);
	}
	
	$password = array();
	
	$i = 0;
	
	while(count($password) < $length) {
		//choose character group
		$chars	= $characterGroups[$selectedGroups[$i]];
		$char	= $chars[rand(0, count($chars) - 1)];

		do {
			$characterPosition = rand(0, $length - 1);
		} while(!empty($password[$characterPosition]));
		
		$password[$characterPosition] = $char;
		
		if($i < count($selectedGroups) - 1) {
			$i++;
		} else {
			$i = 0;
		}
		
	}
	return implode('', $password);
}

echo generatePassword(array('specials' => false, 'length' => 16)) . PHP_EOL;
?>
