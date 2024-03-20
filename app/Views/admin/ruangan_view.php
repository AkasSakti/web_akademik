<!-- Check Status tambah data -->
<?php	
	if(!empty(session()->getFlashdata('gagal'))){
		echo '<script>alert("'.session()->getFlashdata('gagal').'")</script>'; 
	}
?>

<!-- Tabel Data Dosen -->
<div class="tabel-page">
	<div class="tabel-heading">
		Data Ruangan		
	</div>
	<div class="button-container">
		<button class="button-input" id="myBtn" onclick="show_modal(0)">
			<i class="fa fa-plus" aria-hidden="true"></i> Tambah Data
		</button>
	</div>

	<table id="list-data" class="display">	
		<thead>
			<tr>
				<th><h5>ID Ruangan</h5></th>
				<th><h5>Nama Ruangan</h5></th>
				<th><h5>Action</h5></th>
			</tr>
		</thead>
		<!-- Kode untuk mengambil data dosen -->
		<?php
			
			$i = 1;		
		    foreach ($ruangan as $key => $l_ruang) {		    			    
		?>
				<!-- Menampilkan Data Dosen -->
		        <tr>
		        	<td><?= $l_ruang["ID_Ruangan"];?></td>
		        	<td><?= $l_ruang["Nama_Ruangan"];?></td>
		        	<td>		        		
		        		<button class="button-edit" id="buttonEdit" onclick="show_modal(<?php echo $i?>)">
							<i class="fa fa-pencil" aria-hidden="true"></i>
		        			
						</button>	
						<a href='javascript:hapusData("<?php echo $l_ruang['ID_Ruangan']?>", 3)'>		        			
		        			<button class="button-delete">
								<i class="fa fa-trash" aria-hidden="true"></i> 
							</button>
		        		</a>	        								
		        	</td>	        	
		        </tr>

		        <!-- Modal Update Data -->
				<div id="myModal<?php echo $i?>" class="modal">
					<!-- Modal content -->
					<div class="modal-content">
					    <div class="modal-header">
					      <span class="close" id="close<?php echo $i?>">&times;</span>
					      <h2>Update Data Ruangan</h2>
					      <hr>
					    </div>
					    <div class="modal-body">
					    	<form name="input" method="post" action="<?= base_url('ruangan/update')?>">
						      	<input type="hidden" name="old_id" value="<?= $l_ruang['ID_Ruangan']?>">
								<label for="fid">ID Ruangan</label>
								<input type="text" id="fid" name="id" value="<?= $l_ruang['ID_Ruangan']?>" maxlength="7" required>
								<label for="fnama">Nama</label>
								<input type="text" id="fnama" name="nama" value="<?= $l_ruang['Nama_Ruangan']?>" required>
								<input type="submit" value="Update">
							</form>
					    </div>    
					</div>
				</div>
		<?php			
				$i++;
		    	}			
		?>

	</table>
</div>

<!-- Modal Input Data -->
<div id="myModal0" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="close0">&times;</span>
      <h2>Tambah Data Ruangan</h2>
      <hr>
    </div>
    <div class="modal-body">
      <form name="input" method="post" action="<?= base_url('ruangan/insert')?>">
		<label for="fid">ID Ruangan</label>
		<input type="text" id="fid" name="id" placeholder="ID Ruangan" maxlength="7" required>
		<label for="fnama">Nama</label>
		<input type="text" id="fnama" name="nama" placeholder="Nama" required>
		<input type="submit">
	</form>
    </div>    
  </div>
</div>