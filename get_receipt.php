<?php
include 'components/connect.php';
require_once __DIR__ . '/admin/inc/vendor/autoload.php';


if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}

$select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
$select_user->execute([$user_id]);
$fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

$select_payment = $conn->prepare("SELECT * FROM `payment_details` LIMIT 1");
$select_payment->execute();

$fetch_payment = $select_payment->fetch(PDO::FETCH_ASSOC);





$uname = $fetch_user['name'];
$uemail = $fetch_user['email'];
$Property_name = $fetch_payment['property_name'];
$Property_address = $fetch_payment['name'];
$Property_type = $fetch_payment['number'];
$TXN_AMOUNT = $fetch_payment['deposite'];


$table_data = '
<div class="container-fluid">
    <p class="heading">RECEIPT DETAILS</p>
    <div class="table-wrapper">
    <table border="1">
        <tbody>
            <tr>
                <th>S.No</th>
                <th>Label</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>1</td>
                <td><label>CUSTOMER NAME</label></td>
                <td><input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" autocomplete="off" value="'.$uname.'"></td>
            </tr>
            <tr>
                <td>2</td>
                <td><label>CUSTOMER EMAIL</label></td>
                <td><input id="CUST_ID" tabindex="4" maxlength="20" size="20" name="CUST_ID" autocomplete="off" value="'.$uemail.'"></td>
            </tr>
            <tr>
                <td>3</td>
                <td><label>PROPERTY NAME</label></td>
                <td><input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="20" size="20" name="INDUSTRY_TYPE_ID" autocomplete="off" value="'.$Property_name.'"></td>
            </tr>
            <tr>
                <td>4</td>
                <td><label>PROPERTY_ADDRESS*</label></td>
                <td><input id="CHANNEL_ID" tabindex="4" maxlength="20" size="20" name="CHANNEL_ID" autocomplete="off" value="'.$Property_address.'"></td>
            </tr>
            <tr>
                <td>5</td>
                <td><label>TYPE</label></td>
                <td><input title="TXN_AMOUNT" id="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="'.$Property_type.'"></td>
            </tr>
            <tr>
                <td>6</td>
                <td><label>TRANS AMNT</label></td>
                <td><input title="TXN_AMOUNT" id="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT" value="'.$TXN_AMOUNT.'"></td>
            </tr>
        </tbody>
    </table> 
    </div>                      
</div>';


$html2pdf = new \Spipu\Html2Pdf\Html2Pdf();
$html2pdf->writeHTML($table_data);
$html2pdf->output();
?>
<style>
.table-wrapper {
    width: 80%; /* Adjust the width as per your preference */
    margin: 0 auto; /* Center the table horizontally */
}

.table-wrapper table {
    width: 100%;
}

.table-wrapper th,
.table-wrapper td {
    padding: 8px;
    text-align: center;
}
</style>

