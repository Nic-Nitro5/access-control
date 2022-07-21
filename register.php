<?php 
require_once("config/db.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
  
  $query = "INSERT INTO `users`(`username`, `id_number`, `email`, `password`) VALUES ('".$_POST['username']."', '".$_POST['id_number']."', '".$_POST['email']."', '".password_hash($_POST['password'], PASSWORD_DEFAULT)."')";
  $result = mysqli_query($connection, $query);

  if($result){
    echo "<script>location.href='login.php';</script>";
  }else{
    die('Something went wrong, please reload and try again.');
  }
}
?>
<?php require_once("header.php"); ?>
<section class="form-signin text-center card rounded shadow-sm my-4 p-4">
    <p class="validation_errors d-none text-danger fw-bold"></p>
  <form action="" method="post" id="register_form">
    <h1 class="h3 mb-3 fw-normal">Please register</h1>
    <div class="form-floating">
      <input type="text" class="form-control" id="username" name="username" placeholder="name@example.com">
      <label for="username">Username</label>
    </div>
    <div class="form-floating">
      <input type="number" class="form-control" id="id_number" name="id_number" placeholder="Password">
      <label for="id_number">ID Number</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
      <label for="email">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      <label for="password">Password</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="name@example.com">
      <label for="confirm_password">Confirm Password</label>
    </div>
    <div class="checkbox mb-3">
      <label>
        <a href="login.php"><small>Already a user? Login</small></a>
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" id="register_btn" name="register_btn" type="submit">Submit</button>
    <p class="mt-5 mb-3 text-muted">© 2021</p>
  </form>
</section>
<script>
    $('#register_form').on('submit', function(e){
      
        var username = $('input[name="username"]').val().trim();
        var id_number = $('input[name="id_number"]').val().trim();
        var email = $('input[name="email"]').val().trim();
        var password = $('input[name="password"]').val().trim();
        var confirm_password = $('input[name="confirm_password"]').val().trim();

        $('.validation_errors').text('');

        if(username.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('Username is required');
            return;
        }

        if(id_number.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('ID number is required');
            return;
        }

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

        if(confirm_password.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('Confirm password is required');
            return;
        }

        if(password != confirm_password){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('Passwords dont match!!');
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