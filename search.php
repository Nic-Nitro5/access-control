<?php 
require_once("config/db.php");
session_start();
if(!isset($_SESSION['user'])){
    $_SESSION['guest'] = true;
}
// Get all visitors
$error = "";
$query = "SELECT * FROM `visitors` WHERE `contact_number` LIKE '%". $_REQUEST['contact_number'] ."%'";
$result = mysqli_query($connection, $query);
if($result->num_rows < 0){
    $error = "Could Not fetch data.";
}
?>
<?php require_once("header.php"); ?>
<section>
    <div class="container card rounded bg-white shadow-sm my-4 p-4">
        <?php if(!empty($error)){ ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <h3>Search Visitors</h3>
        <h6>These visitors have a contact number like <span class="text-primary fw-bold fst-italic"><?php echo $_REQUEST['contact_number']; ?></span></h6>
        <table class="table table-striped table-hover"> 
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Reason</th>
                <th>Time Of Entry</th>
                <th>Time Of Exit</th>
                <th>Created Date</th>
                <?php if(isset($_SESSION['user'])){ ?>
                    <th>Action</th>
                <?php } ?>
            </tr>
            <?php 
            if($result->num_rows > 0){
                while($all_visitors = mysqli_fetch_array($result)){
            ?>
            <tr>
                <td><?php echo $all_visitors['id']; ?></td>
                <td><?php echo $all_visitors['name']; ?></td>
                <td><?php echo $all_visitors['email']; ?></td>
                <td><?php echo $all_visitors['contact_number']; ?></td>
                <td><?php echo $all_visitors['reason']; ?></td>
                <td><?php echo $all_visitors['time_of_entry'] ; ?></td>
                <td><?php echo $all_visitors['time_of_exit']; ?></td>
                <td><?php echo $all_visitors['created']; ?></td>
                <td class="nowrap">
                    <?php if(isset($_SESSION['user']) && $_SESSION['user']['admin'] == 1){ ?>
                        <a class="btn btn-primary mx-1" href="edit_visitor.php?id=<?php echo $all_visitors['id']; ?>">Edit</a>
                        <?php if(empty($all_visitors['time_of_exit'])){ ?>
                            <a class="btn btn-warning mx-1" href="edit_visitor.php?id=<?php echo $all_visitors['id']; ?>&exit=true">Record Exit Time</a>
                        <?php } ?>
                    <?php } ?> 
                </td>
            </tr>
            <?php }}else{
                echo '<h6 class="text-danger">No visitor information found.</h6>';
            } ?>
        </table>
    </div>
</section>
<?php require_once("footer.php"); ?>