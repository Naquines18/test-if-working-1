<nav class="navbar navbar-expand navbar-light navbar-bg">
	<a class="sidebar-toggle d-flex">
      <i class="hamburger align-self-center"></i>
    </a>

	<div class="navbar-collapse collapse">
		<ul class="navbar-nav navbar-align">
			<li class="nav-item dropdown">
				<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

				<?php
					$getProfileImage = mysqli_query($conn,"SELECT client_image FROM client WHERE client_id = '$id' LIMIT 1");
					
					if(mysqli_num_rows($getProfileImage) === 1){
						while ($row = mysqli_fetch_assoc($getProfileImage)){
							$image = $row['client_image'];
							echo '
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
							<img src="'.$row['client_image'].'" class="avatar img-fluid rounded-circle me-1" alt="'.$firstname." ".$lastname.'" /> <span class="text-dark">'.$firstname." ".$lastname.'</span>
						  </a>
							';
						}		
					}else{
						echo '
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
							<img src="images/default.png" class="avatar img-fluid rounded-circle me-1" alt="'.$firstname." ".$lastname.'" /> <span class="text-dark">'.$firstname." ".$lastname.'</span>
						  </a>
							';
					}
					
				?>
				<div class="dropdown-menu dropdown-menu-end">
					<a class="dropdown-item" href="profile?page=profile"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" id="logout">Log out</a>
				</div>
			</li>
		</ul>
	</div>
</nav>