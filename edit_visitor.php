<?php 
require_once("config/db.php");
session_start();
if(!isset($_SESSION['user'])){
    echo "<script>location.href='login.php';</script>";
}
$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])){
    $query = "UPDATE `visitors` SET `name` = '".$_POST['name']."', email = '".$_POST['email']."', contact_number = '".$_POST['contact_number']."', reason = '".$_POST['reason']."' WHERE id = ". $_REQUEST['id'];
    $result = mysqli_query($connection, $query);
  
    if($result){
      $success = "Vistor updated successfully.";
    }else{
      $error = "Something went wrong, please try again.";
    }
}

// get product details
$query_product = "SELECT * FROM `visitors` WHERE id = " . $_REQUEST['id'];
$visitor_result = mysqli_query($connection, $query_product);
if($visitor_result->num_rows < 0){
    $error = "Could Not fetch data.";
}

// Delete product
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_visitor'])){
    $delete_query = "DELETE FROM visitors WHERE id = ".$_REQUEST['id'];
    $delete_result = mysqli_query($connection, $delete_query);

    if($delete_result){
        $success = "Visitor deleted successfully.";
        echo "<script>setTimeout(function(){location.href='".$base_url."/index.php';}, 3000);</script>";
    }else{
        $error = "Could Not delete visitor.";
    }
}

// Record time of exit of visitor
if(isset($_REQUEST['id']) && isset($_REQUEST['exit']) && $_REQUEST['exit'] == true){
    $query = "UPDATE `visitors` SET `time_of_exit` = now() WHERE id = ". $_REQUEST['id'];
    $result = mysqli_query($connection, $query);
  
    if($result){
        echo "<script>location.href='".$base_url."/index.php';</script>";
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
        <?php 
            if($visitor_result->num_rows > 0){
                while($visitor_info = mysqli_fetch_array($visitor_result)){
        ?>
        <!-- delete product button -->
        <div>
            <form action="" method="post" id="delete_visitor_form">
                <button class="btn btn-danger float-end" name="delete_visitor" type="submit">Delete this visitor</button>
            </form>
        </div>
        <form action="" method="post" id="update_product_form">
            <h1 class="h3 mb-3 fw-normal">Update Visitor</h1>
            <div class="form-floating">
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $visitor_info['name'] ?>">
                <label for="name">Name</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $visitor_info['email'] ?>">
                <label for="email">Email</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo $visitor_info['contact_number'] ?>">
                <label for="contact_number">Contact Number</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" id="reason" name="reason" value="<?php echo $visitor_info['reason'] ?>">
                <label for="reason">reason</label>
            </div>
            <?php }} ?>
            <div class="checkbox mb-3">
                <label>
                    <a href="<?php echo $base_url; ?>/index.php"><small>View All Visitors</small></a>
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Update Visitor</button>
            <p class="mt-5 mb-3 text-muted">© 2021</p>
        </form>
    </div>
</section>
<script>
    $('#update_product_form').on('submit', function(e){
        var name = $('input[name="name"]').val().trim();
        var email = $('input[name="email"]').val().trim();
        var contact_number = $('input[name="contact_number"]').val().trim();
        var reason = $('input[name="reason"]').val().trim();

        $('.validation_errors').text('');

        if(name.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('Item code is required');
            return;
        }

        if(email.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('email is required');
            return;
        }

        if(contact_number.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('contact_number is required');
            return;
        }

        if(reason.length <= 0){
            e.preventDefault();
            hideShowValidation();
            $('.validation_errors').text('reason is required');
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