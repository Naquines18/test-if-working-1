<?php
//appointment
$countAppointment = mysqli_query($conn,"SELECT * FROM `appointments`");
$countAppointmentsRows = htmlspecialchars(mysqli_num_rows($countAppointment));

//client
$countClient = mysqli_query($conn,"SELECT * FROM `client`");
$countClientRows = htmlspecialchars(mysqli_num_rows($countClient));


//pending
$countpending = mysqli_query($conn,"SELECT * FROM `appointments` WHERE status='Pending' ");
$countPendingRows = htmlspecialchars(mysqli_num_rows($countpending));



//approved
$countapproved = mysqli_query($conn,"SELECT * FROM `appointments` WHERE status='Approved' ");
$countApprovedRows = htmlspecialchars(mysqli_num_rows($countapproved));

//Money Accumulated
$CountAccu = mysqli_query($conn,"SELECT money FROM `money_accumulated` ");
$moneyAccumulated = mysqli_fetch_array($CountAccu);





