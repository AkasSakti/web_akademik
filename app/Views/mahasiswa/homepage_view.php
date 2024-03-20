<!DOCTYPE html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?= base_url('assets/css/homepage.css')?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/tabel.css')?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css')?>">		
		<link rel="stylesheet" href="<?= base_url('assets/css/modal.css')?>">

		<!-- Datatables -->		
		<link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet" />
		
		<script src="<?= base_url('assets/js/jquery.min.js')?>" type="text/javascript"></script>
		<script src="<?= base_url('assets/js/datatables.min.js')?>"></script>

		<title>Mahasiswa</title>						
	</head>
	<body>
	<div class="container">
		<div id="page-h" class="page-header">
			<div class="page-logo">
				<img class="logo" src="<?= base_url('assets/image/logo.png')?>"/>
			</div>
			<h3 class="menu-heading">Home</h3>
			<a href="<?= base_url('mahasiswa')?>">
				<i class="fa fa-tachometer fa-icon" aria-hidden="true"></i>Dashboard
			</a>

			<h3 class="menu-heading">Dosen</h3>
	  		<a href="<?= base_url('mahasiswa/dosen')?>" >
	  			<i class="fa fa-user-o fa-icon" aria-hidden="true"></i>Daftar Dosen
	  		</a>	  

	  		<h3 class="menu-heading">Akademik</h3>
	  		<a href="<?= base_url('mahasiswa/matkul')?>">
	  			<i class="fa fa-book fa-icon" aria-hidden="true"></i>Daftar Mata Kuliah
	  		</a>
	  		<a href="<?= base_url('mahasiswa/nilai')?>">
	  			<i class="fa fa-graduation-cap fa-icon" aria-hidden="true"></i>Daftar Nilai
	  		</a>	  			  			  
		</div>	
		<div class="page-content">
			<div class="content-header">
				<div class="header-mobile">
					<img class="logo-mobile" src="<?= base_url('assets/image/logo_mobile.png')?>"/>					
					<a onclick="showHideNav()">
						<i class="fa fa-chevron-circle-down fa-2x" aria-hidden="true"></i>
					</a>
				</div>
				<!--  -->
				<div class="user-info">
					<span> <?= session()->get('nama')?></span>
					<img src="<?= base_url('assets/image/user.png')?>" class="icon" />
				</div>

				<div class="admin-icon">
					<a class="link" href="<?= base_url('mahasiswa/logout')?>">										
						<i class="fa fa-sign-out" aria-hidden="true"></i>
						<span>Logout</span>					
					</a>
				</div>			
			</div>
			<!-- Untuk Menampilkan Konten -->
			<div class="content">				
				<?php
					if(isset($page)){
						echo $page;	
					}
				?>
			</div>		
		</div>
	</div>	

	
	<script>		
		// In your Javascript (external .js resource or <script> tag)
		$(document).ready( function () {
    		$('#list-data').DataTable();
		} );
		$('#list-data').dataTable({
  			aaSorting: []
		})				
	</script>

	<script type="text/javascript" src="<?= base_url('assets/js/sidenav.js')?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/delete_alert.js')?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/modal.js')?>"></script>
	</body>
</html>