<?php

define("CRYPT_KEY", "H!A@C#K%T^H&E*F!L@A#G");

class crypto { 
	public function encrypt($msg) { 
		$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		return (mcrypt_encrypt(	MCRYPT_BLOWFISH, CRYPT_KEY,
					$msg, 
					MCRYPT_MODE_ECB,
					$iv));
						
	} 

	public function decrypt($msg) { 
		$iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		return (mcrypt_decrypt(	MCRYPT_BLOWFISH, CRYPT_KEY,
					$msg, 
					MCRYPT_MODE_ECB,
					$iv));
	}

	public function one_way_crypt( $msg ) { 
		return crypt($msg, '$5$rounds=5000$'. $CRYPT_KEY. '$');
	}

	public function equal( $hash1, $hash2) { 
		return 	hash_equals($hash1, $hash2);
	}
}

?>
