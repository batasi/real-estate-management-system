<?php

   $db_name = 'mysql:host=localhost;dbname=health';
   $db_user_name = 'root';
   $db_user_pass = '';

   $conn = new PDO($db_name, $db_user_name, $db_user_pass);


//    function create_unique_id(){
//       $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//       $charactersLength = strlen($characters);
//       $randomString = '';
//       for ($i = 0; $i < 20; $i++) {
//           $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
//       }
//       return $randomString;
//   }
//   function filteration($data){
//     foreach($data as $key => $value){
//         $value = trim($value);
//         $value = stripslashes($value);
//         $value = htmlspecialchars($value);
//         $value = strip_tags($value);
//         $data[$key] = $value;
//      }
//     return $data;
//  }

//  function insert($sql, $values, $datatypes){
//     global $conn; // Use the global variable $conn instead of $GLOBALS['con']
//     $stmt = $conn->prepare($sql);
//     if($stmt){
//         $stmt->execute($values);
//         $res = $stmt->rowCount();
//         return $res;
//     } else {
//         die("Query cannot be prepared - Insert");
//     }
// }


?>