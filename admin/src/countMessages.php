<?php
require_once '../../src/config.php';
session_start();
if(isset($_POST['count_message'])){
    if($_POST['count_message'] == 0){      
        $countData = mysqli_query($conn,"SELECT * FROM messages WHERE seen = '0' AND receiver = '1' ");
        $countRow  = mysqli_num_rows($countData);

        if($countRow > 0){
            echo '<span class="indicator">'.$countRow.'</span>' ;
        }else{
            echo "";
        }
    }

}


if(isset($_POST['GetMessages'])){
    $output = "";
    if($_POST['GetMessages'] == "GetMessages"){      
        $countMessages = mysqli_query($conn,"SELECT * FROM messages INNER JOIN client ON messages.from = client.client_email WHERE seen = '0' ");
        if(mysqli_num_rows($countMessages) > 0){
            while($row = mysqli_fetch_assoc($countMessages)){
                $output .= '
                <a href="#" class="list-group-item">
                    <div class="row g-0 align-items-center">
                        <div class="col-2">
                            <img src="../'.$row['client_image'].'" class="avatar img-fluid rounded-circle" alt="'.$row['client_firstname'].' '.$row['client_lastname'].'">
                        </div>
                        <div class="col-10 ps-2">
                            <div class="text-dark text-muted">'.$row['client_firstname'].' '.$row['client_lastname'].'</div>
                            <div class="text-muted small mt-1">'.$row['body'].'</div>
                            <div class="text-muted small mt-1">'.$row['message_date'].'</div>
                        </div>
                    </div>
                </a>
                ';
            }
        }else{
                $output .= '
                <a href="#" class="list-group-item">
                    <div class="row g-0 align-items-center">
                        <div class="col-2">
                            <img src="../notification.png" class="avatar img-fluid rounded-circle" alt="'.$_SESSION['advance_user_name'].'">
                        </div>
                        <div class="col-10 ps-2">
                        <div class="text-dark">Hi '.$_SESSION['advance_user_name'].' you dont have a message yet.</div>
                        <div class="text-muted small mt-1">You dont have any message yet from the clients.</div>
                        </div>
                    </div>
                </a>
                ';
            
        }

        echo $output;

    }

}


if(isset($_POST['update_message'])){
    if($_POST['update_message'] == '1'){      
        $countMessages = mysqli_query($conn,"UPDATE messages SET seen = '1' WHERE receiver = '1' ");
    }
}




