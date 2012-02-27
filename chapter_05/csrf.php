<?php
session_start();
if ($_POST && $_POST['token'] == $_SESSION['token']) {
  // process form submission
} else {
  $token = uniqid(rand(), true);
  $_SESSION['token'] = $token;
?>
<form method=”post” action=”http://example.com/oneclickpurchase.php”>
  <input type=”hidden” name=”token” value=”<?php echo $token; ?>” />
  <input type=”hidden” name=”product_id” value=”12345” />
  <input type=”submit” value=”1-Click Purchase” />
</form>
<?php
}
