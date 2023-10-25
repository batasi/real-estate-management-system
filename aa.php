<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])){
    $user_id = $_COOKIE['user_id'];
    }else{
    $user_id = '';
    }

    if(isset($_GET['get_id'])){
    $get_id = $_GET['get_id'];
    }else{
    $get_id = '';
    header('location:home.php');
    }

    include 'components/save_send.php';

    date_default_timezone_set("Africa/Nairobi");

    session_start();

    if(!(isset($_SESSION['login']) && $_SESSION['login']==true)){
        redirect('home.php');
    }

    // $select_properties = $conn->prepare("SELECT * FROM `property` WHERE id = ? ORDER BY date DESC LIMIT 1");
    // $select_properties->execute([$get_id]);
    // if($select_properties->rowCount() > 0){
    //    while($fetch_property = $select_properties->fetch(PDO::FETCH_ASSOC)){

    //    $property_id = $fetch_property['id'];

    //    $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    //    $select_user->execute([$fetch_property['user_id']]);
    //    $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

    //    $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE property_id = ? and user_id = ?");
    //    $select_saved->execute([$fetch_property['id'], $user_id]);
    // }
    // }
    $select_properties = $conn->prepare("SELECT * FROM `property` WHERE id = ? ORDER BY date DESC LIMIT 1");
    $select_properties->execute([$get_id]);

    $fetch_property = null; // Initialize the variable

    if ($select_properties->rowCount() > 0) {
    $fetch_property = $select_properties->fetch(PDO::FETCH_ASSOC);
    $property_id = $fetch_property['id'];

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_user->execute([$fetch_property['user_id']]);
    $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

    $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE property_id = ? and user_id = ?");
    $select_saved->execute([$fetch_property['id'], $user_id]);
    }

    $TXN_AMOUNT = ($fetch_property !== null) ? $fetch_property['deposite'] : 0; // Use correct column name 'deposit'


    $ORDER_ID = $_SESSION['uId'].random_int(11111,99999999);
    $CUST_ID = $_SESSION['uId'];
    //$TXN_AMOUNT = ($fetch_property !== null) ? $fetch_property['deposite'] : 0; 
    $TXNID = $_SESSION['uId'] . '_' . uniqid();
    $RESPMSG = "Your Transaction has been confirmed";
    $STATUS = "TNX_SUCCESS";
    $booked = "booked";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mpesa stk push</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link rel="stylesheet" href="css/assets.css">
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<body>

<div class="container-fluid">
	<div class="row d-flex justify-content-center">
		<div class="col-sm-12">
			<div class="card mx-auto">
				<img src="css/mpesa.png" width="64px" height="80px" /></br>
                <div class="feedback" id="feedback"></div>
				<p class="heading">PAYMENT DETAILS</p>
					<form class="card-details " method="POST" action="./mpesa.php" id="form" name="form">
                        <table border="1">
                            <tbody>
                                <tr>
                                    <th>S.No</th>
                                    <th>Label</th>
                                    <th>Value</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td><label>ORDER_ID</label></td>
                                    <td><input id="ORDER_ID" tabindex="1" maxlength="20" size="20"
                                        name="ORDER_ID" autocomplete="off"
                                        value="<?php echo $ORDER_ID?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><label>CUST ID </label></td>
                                    <td><input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="CUST001"></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><label>INDUSTRY TYPE</label></td>
                                    <td><input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail"></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><label>NAME</label></td>
                                    <td><input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="<?= $fetch_property['property_name']; ?>"></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><label>TRANS AMOUNT</label></td>
                                    <td><input title="TXN_AMOUNT" id="TXN_AMOUNT" tabindex="10"
                                        type="text" name="TXN_AMOUNT" value="<?= $fetch_property['deposite']; ?>"></input>
                                    </td>
                                </tr>
                               
                            </tbody>
                        </table>
						<div class="form-group mt-2">
                                <p class="text-warning mb-2">Phone Number</p> 
                            <input type="text" name="phone-num" placeholder="254" size="17" id="cno" minlength="12" maxlength="12" id="phone">
                        </div>
                        <div class="form-group pt-2">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary" value="1" id="pay" class="pay-button" name="pay">Pay<i class="fas fa-arrow-right px-3 py-2"></i></button>   
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <button type="button" name="get_receipt" value="1" id="get-receipt-btn" class="btn btn-outline-success"> <a href="../../pay_status.php?order=<?php echo '.$_POST["ORDERID"];' ?>">Check Status and Receipt</a> </button> 
                                </div>
                            </div>
                        </div>		
					</form>
                    
			</div>
		</div>
	</div>
</div>

<script>
   $(() => {
        $("#pay").on('click', async (e) => {
            e.preventDefault()

            $("#pay").text('Please wait...').attr('disabled', true)
            const form = $('#form').serializeArray()

            var indexed_array = {};
            $.map(form, function(n, i) {
                indexed_array[n['name']] = n['value'];
            });

            const _response = await fetch('./mpesa.php', {
                method: 'post',
                body: JSON.stringify(indexed_array),
                mode: 'no-cors',
            })

            const response = await _response.json()
            $("#pay").text('Pay').attr('disabled', false)
            $("#pay").html(`Pay <i class="fas fa-arrow-right px-3 py-2"></i>`).attr('disabled', false)

            if (response && response.ResponseCode == 0) {
                $('#feedback').html(`
                <p class='alert alert-success'>${response.CustomerMessage}</br>
                 Enter M-PESA Pin Prompted on your phone 
                </p>
                `)
            } 
            else {
                $('#feedback').html(`<p class='alert alert-danger'>Error! ${response.errorMessage}</p>`)
            }
        })
    })
</script>
<?php


   

    $request_id = create_unique_id();
    $property_id = $_POST['property_id'];
    $property_id = filter_var($property_id, FILTER_SANITIZE_STRING);

   
 
    $conn->prepare("INSERT INTO `payment_details`(`booking_id`, `property_name`, `deposite`, `name`, `number`) VALUES(?,?,?,?,?,?)");
     $query->execute([$property_id, $fetch_property['name'], $fetch_property['deposite'], $fetch_user['name'],$fetch_user['number']] );
         

 
  
?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>


