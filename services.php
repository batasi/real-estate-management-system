<?php  

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

include 'components/save_send.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>


<!-- services section starts  -->

<section class="services">

   <h1 class="heading">our services</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/icon-1.png" alt="">
         <h3>buy house</h3>
         <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque, incidunt.</p>
      </div>

      <div class="box">
         <img src="images/icon-2.png" alt="">
         <h3>rent house</h3>
         <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque, incidunt.</p>
      </div>

      <div class="box">
         <img src="images/icon-3.png" alt="">
         <h3>sell house</h3>
         <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque, incidunt.</p>
      </div>

      <div class="box">
         <img src="images/icon-4.png" alt="">
         <h3>flats and buildings</h3>
         <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque, incidunt.</p>
      </div>

      <div class="box">
         <img src="images/icon-5.png" alt="">
         <h3>shops and malls</h3>
         <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque, incidunt.</p>
      </div>

      <div class="box">
         <img src="images/icon-6.png" alt="">
         <h3>24/7 service</h3>
         <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque, incidunt.</p>
      </div>

   </div>

</section>

<!-- services section ends -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php require('chatbot.php'); ?>
<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<?php include 'components/message.php'; ?>

<script>

   let range = document.querySelector("#range");
   range.oninput = () =>{
      document.querySelector('#output').innerHTML = range.value;
   }

</script>

</body>
</html>