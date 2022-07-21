<?php 
require_once("config/db.php");
$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $query = "SELECT * FROM `users` WHERE `email` = '".$_POST['email']."'";
  $result = mysqli_query($connection, $query);
  if($result->num_rows > 0){
    $result = mysqli_fetch_array($result);
    $verify = password_verify($_POST['password'], $result['password']);
    if($verify == true){
        // Logged in
        session_start(); 
        $_SESSION['user'] = array(
          'id' => $result['id'],
          'username' => $result['username'],
          'id_number' => $result['id_number'],
          'email' => $result['email'],
          'admin' => $result['admin'],
          'created' => $result['created']
        );
        $_SESSION['guest'] = false;
        echo "<script>location.href='index.php';</script>";
    }else{
        $error = "Email / Password incorrect!";
    }
  }else{
    $error = "Email / Password incorrect!";
  }
}
?>
<?php require_once("header.php"); ?>
<section class="form-signin text-center card rounded shadow-sm my-4 p-4">
  <?php if(!empty($error)){ ?>
    <p class="validation_errors text-danger fw-bold"><?php echo $error; ?></p>
  <?php } ?>
  <p class="validation_errors d-none text-danger fw-bold"></p>
  <form action="" method="post" id="login_form">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <div class="form-floating">
      <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
      <label for="email">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      <label for="password">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <a href="register.php"><small>Dont have account? Register</small></a>
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">© 2021</p>
  </form>
</section>
<script>
    $('#login_form').on('submit', function(e){
        var email = $('input[name="email"]').val().trim();
        var password = $('input[name="password"]').val().trim();

        $('.validation_errors').text('');

        if(email.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('Email is required');
            return;
        }

        if(password.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('Password is required');
            return;
        }
    });

    function hideShowValidation(){
        if($('.validation_errors').hasClass('d-none')){
            $('.validation_errors').removeClass('d-none');
            $('.validation_errors').addClass('d-block');
        }else{
            $('.validation_errors').addClass('d-none');
        }
    }
</script>
<?php require_once("footer.php"); ?>