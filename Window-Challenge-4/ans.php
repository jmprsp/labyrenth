<?php
	$initstate = array(0,0,13,7);
	
	$paths = array();
	$paths[] = "33333333333333333333333333333333";
	
	$foundStates = array();
	$filterIndex = 0;
	
	for($index = 0; $index < 16; $index++){
		$start = sizeof($paths); // ignore the earlier paths
		$sizeofPath = sizeof($paths);
		for($pathIndex = $filterIndex; $pathIndex < $sizeofPath; $pathIndex++)
		{
			$input = $paths[$pathIndex];
			for($a3 = 1; $a3 <= 3; $a3++){
				$input[$index*2] = $a3;
				for($a4 = 1; $a4 <= 3; $a4++){
					$input[($index*2)+1] = $a4;
					pour($input);
				}
			}
		}
		$filterIndex = $start;
	}
	//echo "\nUnique States found:\n";
	//print_r($foundStates);
	echo "\nPossible Paths:\n";
	print_r($paths);
	
	function pour($input)
	{
		global $initstate, $foundStates, $paths;
		$state = $initstate;
		if(strlen($input) == 32)
		{
			for($i = 0; $i < strlen($input); $i+=2){
				$first = $input[$i];
				$second = $input[$i+1];
				
				// first char != second char
				if($first != $second){
					//echo "Testing inputs: {$input}\n";
					$r10d = 0;
					$temp_second = $second;
						
					$temp_second--;
					if($temp_second == 0){
						$r10d = 19;	
					}else{
						$temp_second--;
						if($temp_second == 0){
							$r10d = 13;	
						}else{
							$temp_second--;
							if($temp_second == 0){
								$r10d = 7;	
							}
						}				
					}
					
					$rax = $second;
					$ecx = $rax;
					$r8 = $rax;
					$rax = $first;
					$edx = $rax;
					$edx = $state[$edx] + $state[$ecx];
					$r9 = $rax ;
					if($edx <= $r10d){
						$state[$r8] = $edx;
						$state[$r9] = 0;
					}else{
						$edx = $edx - $r10d;
						$state[$r9] = $edx;
						$state[$r8] = $r10d;
					}
				
					// do not attempt to go down the same path
					if (!in_array($state, $foundStates) && $state != $initstate) {
						$foundStates[] = $state;
						$paths[] = $input;
					}
					$key = array_search($state, $foundStates);
					//echo"index: {$key}\n";
				}
			}
			
			if($state[1] == 0xA && $state[2] == 0xA){
				echo "\nINPUT: {$input}\n";
				print_r($state);
				echo "FOUND!\n";
			}
		}
	}	
?>