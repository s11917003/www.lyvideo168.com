<?php
namespace App\Lib;

class GoogleRsaChk {

	private $PUBKEY;
	private $_pubKey;
	
	public function __construct() {
		
	}
	
	public function setPubKey($pubkey) {
		$this->PUBKEY = $pubkey;
		$this->setupPubKey();
	}
	
	private function setupPubKey() {		
		$pem = chunk_split($this->PUBKEY,64,"\n");
		$pem = "-----BEGIN PUBLIC KEY-----\n".$pem."-----END PUBLIC KEY-----\n";
		$this->_pubKey = openssl_pkey_get_public ( $pem );
		return true;
	}
	
	public function verify($dataString,$signString) {
		$this->setupPubKey();
		$signature =base64_decode($signString);
		$flg = openssl_verify($dataString, $signature, $this->_pubKey );
		return $flg;
	}
	
	public function __destruct() {
		openssl_free_key($this->_pubKey);
	}
}