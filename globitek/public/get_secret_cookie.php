<?php
  require_once('../private/initialize.php');
?>
<?php
  $signed_string = $_COOKIE['scrt'];
  if(signed_string_is_valid($signed_string)){
    $pos = strpos($signed_string, "--");
    $encrypted_string = substr($signed_string,0,$pos);
    echo "Secret message: " . key_decrypt($encrypted_string, 'scrt');
  }
  else{
    echo "Error: invalid sign.";
    exit;
  }
?>