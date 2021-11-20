<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="dashboard.php">
          <span class="align-middle">Reservation System</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Main
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="dashboard?page=dashboard">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>


					<?php
						if($_SESSION['advance_user_role'] == "2"){
							echo '';
						}else{
							echo '<li class="sidebar-item active">
							<a class="sidebar-link" href="clients?page=client">
				  <i class="align-middle" data-feather="user-check"></i> <span class="align-middle"> Clients Information</span>
				</a>
						</li>';
						}
					?>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="appointments?page=reservation">
              <i class="align-middle" data-feather="book"></i> <span class="align-middle">Reservations</span>
            </a>
					</li>

					<?php
						if($_SESSION['advance_user_role'] == "2"){
							echo '';
						}else{
							echo '<li class="sidebar-item active">
						<a class="sidebar-link" href="staff?page=staff">
              <i class="align-middle" data-feather="plus-square"></i> <span class="align-middle">Staff / Administrator</span>
            </a>
					</li>';
						}
					?>

					


					

					<?php
						if($_SESSION['advance_user_role'] == "2"){
							echo '';
						}else{
							echo '<li class="sidebar-item active">
						<a class="sidebar-link" href="establishments?page=establishments">
              <i class="align-middle" data-feather="plus-square"></i> <span class="align-middle">Establishments</span>
            </a>
					</li>';
						}
					?>


					

					<?php
						if($_SESSION['advance_user_role'] == "2"){
							echo '';
						}else{
							echo '<li class="sidebar-item active">
						<a class="sidebar-link" href="list_payment?page=list_payment">
              <i class="align-middle" data-feather="plus-square"></i> <span class="align-middle">List of Payments</span>
            </a>
					</li>';
						}
					?>

					<li class="sidebar-header">
						Actions
					</li>

					<?php
						if($_SESSION['advance_user_role'] == "2"){
							echo '';
						}else{
							echo '<li class="sidebar-item active">
						<a class="sidebar-link" href="money_report?page=money_report">
              <i class="align-middle" data-feather="database"></i> <span class="align-middle">Money Report</span>
            </a>
					</li>';
						}
					?>

						

					<li class="sidebar-item active">
						<a class="sidebar-link" href="scan?page=scan">
              <i class="align-middle" data-feather="video"></i> <span class="align-middle">Scan QR CODE</span>
            </a>
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="pay?page=pay">
              <i class="align-middle" data-feather="info"></i> <span class="align-middle">Payment Method</span>
            </a>
					</li>

					<?php
						if($_SESSION['advance_user_role'] == "2"){
							echo '';
						}else{
							echo '<li class="sidebar-item active">
						<a class="sidebar-link" href="backup?page=backup_data">
              <i class="align-middle" data-feather="database"></i> <span class="align-middle">Backup Database</span>
            </a>
					</li>';
						}
					?>

					

					<li class="sidebar-header">
						Profile
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="profile?page=profile">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
            </a>
					</li>


				

					<?php
						if($_SESSION['advance_user_role'] == "2"){
							echo '';
						}else{
							echo '
								<li class="sidebar-header">
						Manage
					</li>
							<li class="sidebar-item active">
						<a class="sidebar-link" href="log?page=log">
              <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">QR CODES Log</span>
            </a>
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="qrcodes?page=qrcodes">
              <i class="align-middle" data-feather="info"></i> <span class="align-middle">QR CODES</span>
            </a>
					</li>
					

					<li class="sidebar-item active">
						<a class="sidebar-link" href="messages?page=messages">
              <i class="align-middle" data-feather="plus-square"></i> <span class="align-middle">Messages</span>
            </a>
					</li>';
						}
					?>

						

					

					

					

				
					

				</ul>

			</div>
		</nav>
