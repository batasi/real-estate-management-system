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
 
  
     

date_default_timezone_set("Africa/Nairobi");

session_start();




$select_properties = $conn->prepare("SELECT * FROM `property` WHERE id = ? ORDER BY date DESC LIMIT 1");
$select_properties->execute([$get_id]);
if($select_properties->rowCount() > 0){
    while($fetch_property = $select_properties->fetch(PDO::FETCH_ASSOC)){

    $property_id = $fetch_property['id'];

    $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_user->execute([$fetch_property['user_id']]);
    $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

    $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE property_id = ? and user_id = ?");
    $select_saved->execute([$fetch_property['id'], $user_id]);
   
       function create_unique_id(){
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < 20; $i++) {
          $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }
    
$ORDER_ID = $_SESSION['user_id'].random_int(11111,99999999);
// $CUST_ID = $_SESSION['uId'];
$TXN_AMOUNT = $fetch_property['deposite'];
$Property_name = $fetch_property['property_name'];
$Property_address = $fetch_property['address'];
$Property_type = $fetch_property['type'];
// $TXNID = $_SESSION['uId'] . '_' . uniqid();
$RESPMSG = "Your Transaction has been confirmed";
$STATUS = "TNX_SUCCESS";
$booked = "booked";
    }}
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
                                    <td><label>ORDER_ID::*</label></td>
                                    <td><input id="ORDER_ID" tabindex="1" maxlength="20" size="20"
                                        name="ORDER_ID" autocomplete="off"
                                        value="<?php echo $ORDER_ID?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><label>CUSTID ::*</label></td>
                                    <td><input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="CUST001"></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><label>PROPERTY NAME</label></td>
                                    <td><input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="<?php echo $Property_name?>"></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><label>PROPERTY_ADDRESS*</label></td>
                                    <td><input id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" autocomplete="off" value="<?php echo $Property_address?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><label>TYPE</label></td>
                                    <td><input title="TXN_AMOUNT" id="TXN_AMOUNT" tabindex="10"
                                        type="text" name="TXN_AMOUNT" value="<?php echo $Property_type?>"></input>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td><label>TRANS AMNT</label></td>
                                    <td><input title="TXN_AMOUNT" id="TXN_AMOUNT" tabindex="10"
                                        type="text" name="TXN_AMOUNT" value="<?php echo $TXN_AMOUNT?>"></input>
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
                                    <button type="button" name="get_receipt" value="1" id="get-receipt-btn" class="btn btn-outline-success"> <a href="get_receipt.php">Check Status and Receipt</a> </button> 
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

include 'components/connect.php';
function filteration($data){
    foreach($data as $key => $value){
        $value = trim($value);
        $value = stripcslashes($value);
        $value = htmlspecialchars($value);
        $value = strip_tags($value);
        $data[$key] = $value;
    }
    return $data;
}
function insert($sql, $values, $datatypes) {
    $conn = $GLOBALS['conn'];
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->execute($values);
        $res = $stmt->rowCount();
        $stmt->closeCursor();
        return $res;
    } else {
        die("Query cannot be prepared or executed - Insert");
    }
}
$frm_data = filteration($_POST);

$query = "INSERT INTO `payment_details`(`booking_id`, `property_name`, `deposite`, `name`, `number`) VALUES (?,?,?,?,?)";

insert($query, [$ORDER_ID, $Property_name, $TXN_AMOUNT, $Property_address, $Property_type], 'issss');

  
?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>


