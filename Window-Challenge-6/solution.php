<?php
	$password = "b00!00000j0";
	
	// refer to https://msdn.microsoft.com/en-us/library/windows/desktop/ms724832(v=vs.85).aspx
	$major = array(5); //6, 10
	$minor = array(0,1,2);
 
	// break down last password char to sets (for distributed processing).
	$lang = array();
	for($i = intval($argv[1]); $i <= intval($argv[2]); $i++)
		$lang[] = $i;
	
	echo "Lang array:\n";
	var_dump($lang);
		
	for($a = 0x2d+12; $a > 0x2d;$a--){
		for($b = 0x5e; $b <= 0x5e+ 31;$b++)
			for($c = 0x42; $c <= 0x42 + 23;$c++)
				for($d = 0; $d < sizeof($major);$d++)
					for($e = 0; $e < sizeof($minor);$e++)
						for($f = 0; $f < sizeof($lang);$f++)
						{
							$password[4] = chr($a);
							$password[5] = chr($b);
							$password[6] = chr($c);
							$password[7] = chr($major[$d]+0x3C);
							$password[8] = chr($minor[$e]+0x3F);
							$password[10] = chr($lang[$f]+0x5e);
							$output = exec("..\python.exe my_test.py \"{$password}\"");
						 
							if (strpos($output, 'Decoded') !== false) {
								echo "found: {$password}.\n{$output}";
								cli_beep();
								exit;
							}
						}
	}
	
	function cli_beep()
	{
		echo "\x07";
	}