<?php
require_once('../../../private/initialize.php');
require_login();
if(!isset($_GET['id'])) {
  redirect_to('index.php');
}
$users_result = find_user_by_id($_GET['id']);
// No loop, only one result
$user = db_fetch_assoc($users_result);

if(is_post_request()) {
  
  // check for same domain
  if(!request_is_same_domain()){
    echo "Error: request is not the same domain";
    exit;
  }
  // check if token is valid
  if(!csrf_token_is_valid()){
    echo "Error: invalid request";
    exit;
  }
  
  // check if token is recent
  if(!csrf_token_is_recent()){
    echo "Error: session timeout.";
    exit;
  }
  
  $result = delete_user($user);
  if($result === true) {
    redirect_to('index.php');
  }
}

?>
<?php $page_title = 'Staff: Delete User ' . $user['first_name'] . " " . $user['last_name']; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="main-content">
  <a href="show.php?id=<?php echo h(u($user['id'])); ?>">Back to User Details</a><br />

  <h1>Delete User: <?php echo h($user['first_name']) . " " . h($user['last_name']); ?></h1>

  <form action="delete.php?id=<?php echo h(u($user['id'])); ?>" method="post">
    <p>Are you sure you want to <strong>permanently delete</strong> the user:</p>
    <p>
      &bull;&nbsp;<?php echo h($user['first_name']) . " " . h($user['last_name']); ?>
    </p>
    <?php echo csrf_token_tag() ?>
    <input type="submit" name="submit" value="Delete"  />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
