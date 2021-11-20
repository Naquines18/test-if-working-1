<?php

require '../../src/config.php';

if(isset($_POST["payment_method"]) && $_POST["payment_method"] == "Payment"){
     // check if the qr code value is set
     if(isset($_POST['payment_user'])){
     // variable payment 
     $payment = $_POST['payment_user'];

     // select all the data from money_accumulated table
     $getMoney = mysqli_query($conn,"SELECT * FROM money_accumulated WHERE id='1'");
     // fetch all the data
     $getMoneyRow = mysqli_fetch_array($getMoney);

     $money_count = $getMoneyRow['money'];

     // update money_accumulated with plus 100 
     $pay = mysqli_query($conn,"UPDATE money_accumulated SET money = $money_count+100 WHERE id= '1' ");
     // if the query is true else false 
     if($pay == true){

               $selectUser = mysqli_query($conn,"SELECT * FROM qrcodes INNER JOIN client ON qrcodes.qr_user_id = client.client_id INNER JOIN client_profile ON client_profile.client_id = client.client_id WHERE qrcodes.id_no = '$payment' LIMIT 1");
               $row = mysqli_fetch_assoc($selectUser);
               
               $fullname = $row['client_firstname']." ". $row['client_lastname'];
               $qr_id    = $row['id_no'];
               $phone    = $row['client_profile_phone'];
               $address  = $row['client_profile_address'];


               $insertPaymentLog = mysqli_query($conn,"INSERT INTO `money_report`(`fullname`, `amount_payed`, `id_no`, `address`, `phone`, `date_payed`) VALUES ('$fullname','100','$qr_id','$address','$phone',CURRENT_TIME())");


               switch ($insertPaymentLog) {
                    case true:
                         header("location: ../pay?success");
                         break;
                    case false:
                         header("location: ../pay?failed12");
                         break;
                    
                    default:
                    header("location: ../pay?no_action");
                         break;
               }
          
     }else{
          header("location: ../pay?failed");
     }
     }

}else{
     if(isset($_POST["payment_user"]) && isset($_POST["establishments"])){

          $qrcode_id          = $_POST["payment_user"];
          $establishment_name = $_POST["establishments"];


          $selectEstablishment = $conn->prepare("SELECT * FROM establishments WHERE establishments_name = ? LIMIT 1");
          $selectEstablishment->bind_param("s",$establishment_name);
          $selectEstablishment->execute();
          $result            = $selectEstablishment->get_result();
          $row_establishment = $result->fetch_assoc();

          // payment needed or amount
          $amount = $row_establishment["establishment_payment_amout"];


          $selectUser = $conn->prepare("SELECT * FROM qrcodes INNER JOIN client ON qrcodes.qr_user_id = client.client_id INNER JOIN appointments ON appointments.appointment_email = client.client_email WHERE qrcodes.id_no = ? LIMIT 1");

          $selectUser->bind_param("s",$qrcode_id);
          $selectUser->execute();
          $result = $selectUser->get_result();
          $row = $result->fetch_assoc();

          // user info
          $gender  = $row["client_gender"];
          $age     = $row["age"];
          $staff   = $row["patient_doctor"];
          $address = $row["address"];
          $city    = $row["city"];
          $name    = $row["appointment_fullname"];
          


          $insert = $conn->prepare("INSERT INTO `establisment_payments`(`establishment`, `paid_by`, `amount`, `gender`, `age`, `address`, `city`, `staff`) VALUES (?,?,?,?,?,?,?,?)");
          $insert->bind_param("ssssssss",$establishment_name,$name,$amount,$gender,$age,$address,$city,$staff);
          if($insert->execute()){
               header("location: ../pay.php?sucess_payment");
               die();
          }else{
               header("location: ../pay.php?error_payment");
               die();
          }



     }
}