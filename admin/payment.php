<?php

include '../components/connect.php';

if(isset($_COOKIE['admin_id'])){
   $admin_id = $_COOKIE['admin_id'];
}else{
   $admin_id = '';
   header('location:login.php');
}

if(isset($_POST['delete'])){

   $delete_id = $_POST['delete_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_delete = $conn->prepare("SELECT * FROM `payment_details` WHERE booking_id = ?");
   $verify_delete->execute([$delete_id]);

   if($verify_delete->rowCount() > 0){
      $delete_admin = $conn->prepare("DELETE FROM `payment_details` WHERE booking_id = ?");
      $delete_admin->execute([$delete_id]);
      $success_msg[] = 'Property payment deleted!';
   }else{
      $warning_msg[] = 'Property payment deleted already!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admins</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include '../components/admin_header.php'; ?>
<!-- header section ends -->

<!-- admins section starts  -->

<section class="grid">

   <h1 class="heading">Paid Properties</h1>

   <form action="" method="POST" class="search-form">
      <input type="text" name="search_box" placeholder="search properties paid..." maxlength="100" required>
      <button type="submit" class="fas fa-search" name="search_btn"></button>
   </form>

   <div class="box-container">

   <?php
      if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
         $search_box = $_POST['search_box'];
         $search_box = filter_var($search_box, FILTER_SANITIZE_STRING);
         $select_properties = $conn->prepare("SELECT * FROM `payment_details` WHERE property_name LIKE '%{$search_box}%'");
         $select_properties->execute();
      }else{
         $select_properties = $conn->prepare("SELECT * FROM `payment_details`");
         $select_properties->execute();
      }
      if($select_properties->rowCount() > 0){
         while($fetch_properties = $select_properties->fetch(PDO::FETCH_ASSOC)){
   ?>

   <div class="box">
      <p>Name : <span><?= $fetch_properties['property_name']; ?></p>
      <p>Deposit : <span><?= $fetch_properties['deposite']; ?></p>
      <p>Booking ID : <span><?= $fetch_properties['booking_id']; ?></p>
      <p>Address : <span><?= $fetch_properties['name']; ?></p>
      <p>Type : <span><?= $fetch_properties['number']; ?></p>
      <form action="" method="POST">
         <input type="hidden" name="delete_id" value="<?= $fetch_properties['booking_id']; ?>">
         <input type="submit" value="delete property payment" onclick="return confirm('delete this property payment?');" name="delete" class="option-btn">
      </form>
   </div>
   <?php  ?>
   <?php
      }
   }elseif(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
      echo '<p class="empty">no results found!</p>';
   }else{
   ?>
      <p class="empty">no properties paid yet!</p>
      
   <?php
      }
   ?>

   </div>

</section>

<!-- admins section ends -->
















<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

<?php include '../components/message.php'; ?>

</body>
</html>