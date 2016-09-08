<?php
	$contents = trim(file_get_contents("exfiltratedData"));
	echo "base64: {$contents}\n\n";
	$default = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
	$custom  = "qtgJYKa8y5L4flzMQ/BsGpSkHIjhVrm3NCAi9cbeXvuwDx+R6dO7ZPEno21T0UFW";
	$decoded = base64_decode(strtr($contents,$custom, $default ));
	echo "Decrypted: ".decrypt(strToHex($decoded), strlen(strToHex($decoded)));
	
	function wildkey_encrypt($string, $length)
	{
		$wildkey = "AWildKeyAppears!";
		$decrypted = "";
		for($i = 0; $i <= $length/8; $i++){
			$key = encryptData(32, substr($string, 8 * $i,8),$wildkey);
			$decrypted .= $key;
			echo $key . " ";
		}
		echo "Encoded: ".$decrypted."\n\n";
		echo hexToStr($decrypted);
		echo "Decrypted: ".decrypt($decrypted, strlen($decrypted));
	}
	
	function encryptData($size, $subkey, $wildkey)
	{
		$constant1 = 0xBADA55;
		$constant2 = 0x9E3769B9;
		$constant3 = 0x4913092;
		$constant4 = 0x12345678;
		$constant5 = 0xDEADBEEF;
		
		$first = substr($subkey,0,4);
		$second = substr($subkey,4,4);
		$v6 = 0;
		for($i = 0;$i < $size; $i++)
		{
			$second_hex = strToHex($second);
			$second_dec = hexdec($second_hex);
			$xorkey_2 = (($second_dec << 4) ^ (logical_right_shift($second_dec,5))) + $second_dec; 
			$xorkey_1 = substr($wildkey, 4*($v6&3),4);
			$xorkey_1 = hexdec(strToHex($xorkey_1));
			$xorkey_1 = hexdec(strToHex(pack("V", $xorkey_1))) + $v6;
			$xored = $xorkey_1 ^ $xorkey_2;
			$first = hexdec(strToHex($first))+$xored;
			
			$constant1 += 4092;
			for($j =8; $j < 32; $j++)
			{
				$constant4 *= 8;
				$constant1 -= 64;
				$constant3 -= 8;
			}
			$c5 = 64;
			$v6 += $constant2 + 4096;
			
			$first_dec = $first;
			$xorkey_2 = (($first_dec << 4)^(logical_right_shift($first_dec,5))) + $first_dec;
			
			$xorkey_1 = substr($wildkey, 4*((logical_right_shift($v6,11))&3),4);
			$xorkey_1 = hexdec(strToHex($xorkey_1));
			$xorkey_1 = hexdec(strToHex(pack("V", $xorkey_1))) + $v6;
			
			$xored = $xorkey_1 ^ $xorkey_2;
			$second = hexdec(strToHex($second))+$xored;
			$first = hexToStr(str_pad(dechex($first), 8, "0", STR_PAD_LEFT));
			$second = hexToStr(str_pad(dechex($second), 8, "0", STR_PAD_LEFT));
		}
		$r1 = pack("V", hexdec(strToHex($first)));
		$r2 = pack("V", hexdec(strToHex($second)));
		return strToHex($r1) . "" . strToHex($r2) . "";
	}
	
	function decrypt($string, $length)
	{
		$wildkey = "AWildKeyAppears!";
		$decrypted = "";
		for($i = 0; $i < $length/16; $i++){
			$decrypted .= decryptData(32, substr($string, 16 * $i,16), $wildkey);
		}
		return $decrypted;		
	}
	
	function decryptData($size, $subkey, $wildkey)
	{
		$testKey = $subkey;
		$testKey1 = substr($testKey,0,8);
		$testKey2 = substr($testKey,8,8);
		
		$testKey1 = strToHex(pack("V", hexdec($testKey1)));
		$testKey2 = strToHex(pack("V", hexdec($testKey2)));
		
		$first = ($testKey1);
		$second = ($testKey2);
		$constant1 = 0xBADA55;$constant2 = 0x9E3769B9;$constant3 = 0x4913092;$constant4 = 0x12345678;$constant5 = 0xDEADBEEF;
		
		$v6 = 0;
		// reset the constants;
		for($i = 0;$i < $size; $i++)
		{	
			$constant1 += 4092;
			for($j =8; $j < 32; $j++)
			{
				$constant4 *= 8;
				$constant1 -= 64;
				$constant3 -= 8;
			}
			$v6 += $constant2 + 4096;	
		}
		
		for($i = 0;$i < $size; $i++)
		{		
			$first_dec = hexdec(($first));
			$xorkey_2 = (($first_dec << 4)^(logical_right_shift($first_dec,5))) + $first_dec;			
			$xorkey_1 = substr($wildkey, 4*((logical_right_shift($v6,11))&3),4);
			$xorkey_1 = hexdec(strToHex($xorkey_1));
			$xorkey_1 = hexdec(strToHex(pack("V", $xorkey_1))) + $v6;
			$xored = $xorkey_1 ^ $xorkey_2;
			$second = hexdec(($second))-$xored;
			
			$constant1 -= 4092;
			for($j =8; $j < 32; $j++)
			{
				$constant4 /= 8;
				$constant1 += 64;
				$constant3 += 8;
			}
			$v6 -= $constant2 + 4096;
			
			$second_dec = $second;
			$xorkey_2 = (($second_dec << 4) ^ (logical_right_shift($second_dec,5))) + $second_dec;
			$xorkey_1 = substr($wildkey, 4*($v6&3),4);
			$xorkey_1 = hexdec(strToHex($xorkey_1));
			$xorkey_1 = hexdec(strToHex(pack("V", $xorkey_1))) + $v6;
			$xored = $xorkey_1 ^ $xorkey_2;
			$first = hexdec(($first))-$xored;
			
			$first = dechex($first);
			$second = dechex($second);
		}
		$r1 = pack("V", hexdec(($first)));
		$r2 = pack("V", hexdec(($second)));
		return $r1.$r2;
	}
	
	function logical_right_shift( $int , $shft ) {
		return ( $int >> $shft )   //Arithmetic right shift
			& ( PHP_INT_MAX >> ( $shft - 1 ) );   //Deleting unnecessary bits
	}
	
	function strToHex($string){
		$hex = '';
		for ($i=0; $i<strlen($string); $i++){
			$ord = ord($string[$i]);
			$hexCode = dechex($ord);
			$hex .= substr('0'.$hexCode, -2);
		}
		return strToUpper($hex);
	}
	
	function hexToStr($hex){
		$string='';
		for ($i=0; $i < strlen($hex)-1; $i+=2){
			$string .= chr(hexdec($hex[$i].$hex[$i+1]));
		}
		return $string;
	}
?>