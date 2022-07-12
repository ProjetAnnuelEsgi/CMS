	
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Reset Password In PHP MySQL</title>
<!-- CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="card">
<div class="card-header text-center">
Reset Password In PHP MySQL
</div>
<div class="card-body">
<?php

if(isset($_GET['key']) && isset($_GET['token']))
{
    $curDate = date("Y-m-d H:i:s");
    $email = $_GET['key'];
    $token = $_GET['token'];
    $reset_link_token = $_GET['key'].$_GET['token'];
    $foundUser = $user->findOne(['reset_link_token'=>$reset_link_token]);
    $activation_expiry = $foundUser->getActivationExpiry();
    
    
    if($activation_expiry >= $curDate){?>
        
        <form action="/setpwd" method="post">
        <input type="hidden" name="email" value="<?php echo $email;?>">
        <input type="hidden" name="reset_link_token" value="<?php echo $token;?>">
        <div class="form-group">
        <label; for="exampleInputEmail1">Password</label; >
        <input type="password" name='password' id='password' class="form-control">
        </div>                
        <div class="form-group">
        <label for="exampleInputEmail1">Confirm Password</label>
        <input type="password" name='cpassword' id="cpassword" class="form-control">
        </div>
        <input type="submit" name="new-password" class="btn btn-primary">
        </form>
        <?php } else{ ?>
            <p>This forget password link has been expired</p>
            <?php } 
}
?>
</div>
</div>
</div>
</body>
</html>
<script>
var password = document.getElementById("password")
  , cpassword = document.getElementById("cpassword");

function validatePassword(){
  if(password.value != cpassword.value) {
    cpassword.setCustomValidity("Passwords Don't Match");
  }else if(password.value.length <= 8) {
      password.setCustomValidity("Your Password Must Contain At Least 8 Characters!");
  }else if(password.value.length <= 8) {
      password.setCustomValidity("Your Password Must Contain At Least 1 Number!");
  }else if(password.value.length <= 8) {
      password.setCustomValidity("Your Password Must Contain At Least 1 Capital Letter!");
  }else if(password.value.length <= 8) {
      password.setCustomValidity("Your Password Must Contain At Least 1 Lowercase Letter!");
  }else{
    cpassword.setCustomValidity('');
  }

  function CheckPassword(inputtxt) 
  { 
  var decimal=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
  if(inputtxt.value.match(decimal)) 
  { 
  alert('votre mot de passe doit contenir entre 8 et 15 characters')
  return true;
  }
  else
  { 
  alert('Wrong...!')
  return false;
  }
  } 
}

password.onchange = validatePassword;
cpassword.onkeyup = validatePassword;

</script>    
