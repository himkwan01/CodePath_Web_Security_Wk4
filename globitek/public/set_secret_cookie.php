<?php
  require_once('../private/initialize.php');
?>
<?php

  $string = "I have a secret to tell.";
  $encrypted_string = key_encrypt($string, "scrt");
  
  setcookie('scrt', sign_string($encrypted_string));
  echo "message = " . $string . "<br/>";
  echo "cookie set <br/>";
  echo "scrt = " . $_COOKIE['scrt'];
  
?>