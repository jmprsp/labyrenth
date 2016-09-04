<?php
	for($i = 0; $i <= 255; $i++){
		for($k = 0; $k <= 255; $k++){
			for($j = 0; $j <= 255; $j++){
				$num = $i;
				$num2 = $k;
				$num3 = $j;
				
				$num4 = $num2 * $num3;
				$num5 = $num * 3;
				if (((((($num + $num4) - $num2) + (($num * $num) * $num2)) - $num3) == (($num2 * (($num3 * 0x22) + ($num5 - $num))) + 0xea0)) && ($num > 60))
				{
					echo $num."\n";
					echo $num2."\n";
					echo $num3."\n";
				}
			}
		}			
	}
?>