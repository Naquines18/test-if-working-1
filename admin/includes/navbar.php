<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle d-flex">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <?php

            // if($role == "1"){
            //     echo '
            //     <li class="nav-item dropdown">
            //     <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
            //         <div class="position-relative">
            //             <i class="align-middle" data-feather="message-square"></i>
            //             <div id="message_count">

            //             </div>
            //         </div>
            //     </a>
            //     <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
            //         <div class="dropdown-menu-header">
            //             <div class="position-relative">
            //                 Messages
            //             </div>
            //         </div>
            //         <div class="list-group" id="message_list" style="overflow-x: auto; height: 300px;">


            //         </div>
            //         <div class="dropdown-menu-footer">
            //             <a href="#" class="text-muted">Show all messages</a>
            //         </div>
            //     </div>
            // </li>
            //     ';
            // }else{
            //     echo '';
            // }
            ?>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <?php
							$getprofileimage = mysqli_query($conn,"SELECT profile_image FROM advance_user WHERE advance_user_id = '$id' LIMIT 1");
							while($getimage = mysqli_fetch_assoc($getprofileimage)){
									echo '
									<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
										<img src="'.$getimage["profile_image"].'" class="avatar img-fluid rounded-circle me-1" alt="'.$username.'" /> <span class="text-dark">'.$username.'</span>
									</a>';
							}	
						?>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="profile?page=profile"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="src/logout.php">Log out</a>
                    </div>
            </li>
        </ul>
    </div>
</nav>