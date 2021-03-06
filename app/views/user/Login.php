<?php
require_once(APPROOT . "/views/includes/Header.php");
?>
<div class="container my-3">
  <h3> <strong>Login</strong><br> use your authentication</h3>
  <form action="<?php echo URLROOT ?>/Users/Login" method="post">
    <div class="form-group">
      <label for="exampleFormControlInput1">Email address</label>
      <input type="email" class="form-control" name="Email">
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput1">Password</label>
      <input type="password" class="form-control" name="Password">
    </div>
    <span class="text-danger"><?php echo $data["Error"]; ?></span>
    </br>
    <p>Not registered yet? <a href="<?php echo URLROOT; ?>/Users/Register">Create an account!</a></p>
    <button class="contact_button" type="submit">Login</button>
  </form>
</div>
<?php
require_once(APPROOT . "/views/includes/Footer.php");
?>