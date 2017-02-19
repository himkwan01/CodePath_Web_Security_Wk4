<?php

// Symmetric Encryption

// Cipher method to use for symmetric encryption
const CIPHER_METHOD = 'AES-256-CBC';

//string openssl_encrypt ( string $data , string $method , string $password [, int $options = 0 [, string $iv = "" [, string &$tag = NULL [, string $aad = "" [, int $tag_length = 16 ]]]]] )
function key_encrypt($string, $key, $cipher_method=CIPHER_METHOD) {
  
  $key = str_pad($key, 32, '*');
  
  // Create an initialization vector which randomizes the
  // initial settings of the algorithm, making it harder to decrypt.
  // Start by finding the correct size of an initialization vector 
  // for this cipher method.
  $iv_length = openssl_cipher_iv_length($cipher_method);
  $iv = openssl_random_pseudo_bytes($iv_length);
  
  $encrypted = openssl_encrypt($string, $cipher_method, $key, OPENSSL_RAW_DATA, $iv);
  $message = $iv . $encrypted;
  
  return base64_encode($message);
}

function key_decrypt($string, $key, $cipher_method=CIPHER_METHOD) {
  
  $key = str_pad($key, 32, '*');
  
  // Base64 decode before decrypting
  $iv_with_ciphertext = base64_decode($string);
  
  // Separate initialization vector and encrypted string
  $iv_length = openssl_cipher_iv_length($cipher_method);
  $iv = substr($iv_with_ciphertext, 0, $iv_length);
  $ciphertext = substr($iv_with_ciphertext, $iv_length);

  // Decrypt
  $plaintext = openssl_decrypt($ciphertext, $cipher_method, $key, OPENSSL_RAW_DATA, $iv);
  
  return $plaintext;
}


// Asymmetric Encryption / Public-Key Cryptography

// Cipher configuration to use for asymmetric encryption
const PUBLIC_KEY_CONFIG = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);

function generate_keys($config=PUBLIC_KEY_CONFIG) {
  
  $resource = openssl_pkey_new($config);
  
  // Extract private key from the pair
  openssl_pkey_export($resource, $private_key);
  
  // Extract public key from the pair
  $key_details = openssl_pkey_get_details($resource);
  $public_key = $key_details["key"];

  return array('private' => $private_key, 'public' => $public_key);
}

function pkey_encrypt($string, $public_key) {
  openssl_public_encrypt($string, $encrypted, $public_key);
  
  // use base64_encode to make contents viewable/sharable
  $message = base64_encode($encrypted);
  return $message;
}

function pkey_decrypt($string, $private_key) {
  
  // decode from base64 to get raw data
  $ciphertext = base64_decode($string);
  
  openssl_private_decrypt($ciphertext, $decrypted, $private_key);
  return $decrypted;
}


// Digital signatures using public/private keys

function create_signature($data, $private_key) {
  
  openssl_sign($data, $raw_signature, $private_key);
  
  // Use base64_encode to make contents viewable/sharable
  $signature = base64_encode($raw_signature);
  return $signature;
}

function verify_signature($data, $signature, $public_key) {
  
  $raw_signature = base64_decode($signature);
  return openssl_verify($data, $raw_signature, $public_key);
}

function signing_checksum($string) {
  $salt = "qi02BcXzp639"; // makes process hard to guess
  return hash('sha1', $string . $salt);
}

function sign_string($string) {
  return $string . '--' . signing_checksum($string);
}

function signed_string_is_valid($signed_string) {
  $array = explode('--', $signed_string);
  // if not 2 parts it is malformed or not signed
  if(count($array) != 2) { return false; }

  $new_checksum = signing_checksum($array[0]);
  return ($new_checksum === $array[1]);
}

?>
