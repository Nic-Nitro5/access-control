<?php 
require_once("config/db.php");
session_start();
if(!isset($_SESSION['user'])){
    echo "<script>location.href='login.php';</script>";
}
$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $query = "INSERT INTO `visitors`(`name`, `email`, `contact_number`, `reason`) VALUES ('".$_POST['name']."', '".$_POST['email']."', '".$_POST['contact_number']."', '".$_POST['reason']."')";
    $result = mysqli_query($connection, $query);
  
    if($result){
      $success = "Visitor added successfully.";
    }else{
      $error = "Something went wrong, please try again.";
    }
}
?>
<?php require_once("header.php"); ?>
<section class="text-center">
    <div class="container card rounded shadow-sm my-4 p-4">
        <?php if(!empty($error)){ ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <?php if(!empty($success)){ ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php } ?>
        <p class="validation_errors d-none text-danger fw-bold"></p>
        <form action="" method="post" id="add_product_form">
            <h1 class="h3 mb-3 fw-normal">Add Visitor</h1>
            <div class="form-floating">
                <input type="text" class="form-control" id="name" name="name" placeholder="Jared Naidoo">
                <label for="name">Name</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="jared@examplemail.co.za">
                <label for="email">Email</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="0761234567">
                <label for="contact_number">Contact Number</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="reason" name="reason" placeholder="Work, contractor, etc.">
                <label for="reason">Reason for Entry</label>
            </div>
            <div class="checkbox mb-3">
                <label>
                    <a href="<?php echo $base_url; ?>/index.php"><small>View All Visitors</small></a>
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Add New Visitor</button>
            <p class="mt-5 mb-3 text-muted">© 2021</p>
        </form>
    </div>
</section>
<script>
    $('#add_product_form').on('submit', function(e){
        var name = $('input[name="name"]').val().trim();
        var email = $('input[name="email"]').val().trim();
        var contact_number = $('input[name="contact_number"]').val().trim();
        var reason = $('input[name="reason"]').val().trim();

        $('.validation_errors').text('');

        if(name.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('Name is required');
            return;
        }

        if(email.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('Email is required');
            return;
        }

        if(contact_number.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('Contact Number is required');
            return;
        }

        if(reason.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('Reason for entry is required');
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