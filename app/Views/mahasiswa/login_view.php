	<!DOCTYPE html>
	<html>
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Login Form</title>			
			
			<link rel="stylesheet" href="<?= base_url('assets/css/login.css'); ?>">
		</head>
		<body>						
			<div class="login-container">
				<div class="user-icon">
					<img src="<?= base_url('assets/image/user.png')?>" id="icon" alt="User Icon"/>
				</div>
				<div class="message-wrapper">
				<?php	
					if(!empty(session()->getFlashdata('salah')))
					{
				?>
					<div class="message"> 
						<p><?= session()->getFlashdata('salah')?></p>
					</div>
				<?php
					}
				?>
				</div>
				
				<div class="login-form">
					<form name="login" method="post" action="<?= base_url('mahasiswa/login')?>">
						<div>							
							<input type="text" name="nim" placeholder="NIM" required>
						</div>
						<div>							
							<input type="password" name="password" placeholder="Password" required>
						</div>						
						<div>
					 		<input type="submit" name="submit" value="LOGIN">
					   </div>
					</form>

				</div>

			</div>			
		</body>
	</html>