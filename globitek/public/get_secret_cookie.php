<?php
  require_once('../private/initialize.php');
?>
<?php
  $signed_string = $_COOKIE['scrt'];
  
  // check for valid signature
  if(signed_string_is_valid($signed_string)){
    $encrypted_string = explode("--", $signed_string);
    echo "Secret message: " . key_decrypt($encrypted_string[0], 'scrt');
  }
  else{
    echo "Error: invalid sign.";
    exit;
  }
?>