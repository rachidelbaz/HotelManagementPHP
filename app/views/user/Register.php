<?php 
require_once(APPROOT."/views/includes/Header.php");
?>
<div class="container my-3">
<h3> <strong>Register</strong><br> Create a new account</h3>
<form action="<?php echo URLROOT?>/Users/Register" method="post">
<div class="form-group mt-2">
  <label for="exampleFormControlInput1">CIN <span class="text-danger">*</span> </label>
  <input type="text" class="form-control" name="CIN">
</div>
<span class="text-danger"><?php echo $data["CINError"];?></span>
<div class="form-group">
  <label for="exampleFormControlInput1">Full name </label>
  <input type="text" class="form-control" name="Fullname">
</div>
<div class="form-group">
  <label for="exampleFormControlInput1">Email address <span class="text-danger">*</span></label>
  <input type="email" class="form-control" name="Email">
</div>
<span class="text-danger"><?php echo $data["EmailError"];?></span>
<div class="form-group">
  <label for="exampleFormControlInput1">Confirm Email address <span class="text-danger">*</span></label>
  <input type="email" class="form-control" name="ConfirmEmail">
</div>
<span class="text-danger"><?php echo $data["ConfirmEmailError"];?></span>
<div class="form-group">
  <label for="exampleFormControlInput1">Phone Number </label>
  <input type="phone" class="form-control" name="NumberPhone">
</div>
<div class="form-group">
  <label for="exampleFormControlInput1">Password <span class="text-danger">*</span></label>
  <input type="password" class="form-control" name="Password" >
</div>
<span class="text-danger"><?php echo $data["PasswordError"];?></span>
<div class="form-group">
  <label for="exampleFormControlInput1">Confirm Password <span class="text-danger">*</span></label>
  <input type="password" class="form-control" name="ConfirmPassword">
</div>
<span class="text-danger"><?php echo $data["ConfirmPasswordError"];?></span></br>
<p>Aready have account? <a href="<?php echo URLROOT; ?>/Users/Login">Log in!</a></p>
<button class="contact_button" type="submit">Register</button>
</form>
</div>
<?php 
require_once(APPROOT."/views/includes/Footer.php");
?>