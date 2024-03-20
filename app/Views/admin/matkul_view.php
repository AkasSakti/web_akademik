<!-- Check Status tambah data -->
<?php	
	if(!empty(session()->getFlashdata('gagal'))){
		echo '<script>alert("'.session()->getFlashdata('gagal').'")</script>'; 
	}
?>

<!-- Tabel Data Dosen -->
<div class="tabel-page">
	<div class="tabel-heading">
		Data Mata Kuliah		
	</div>
	<div class="button-container">
		<button class="button-input" id="myBtn" onclick="show_modal(0)">
			<i class="fa fa-plus" aria-hidden="true"></i> Tambah Data
		</button>
	</div>

	<table id="list-data" class="display">
		<thead>
			<tr>
				<th><h5>ID Matkul</h5></th>
				<th><h5>Nama Matkul</h5></th>
				<th><h5>SKS</h5></th>
				<th><h5>Semeter</h5></th>	
				<th><h5>Action</h5></th>		
			</tr>
		</thead>	
		<!-- Kode untuk mengambil data dosen -->
		<?php			
			$i = 1;		
		    foreach ($matkul as $key => $l_matkul) {		    			    
		?>
				<!-- Menampilkan Data Dosen -->
		        <tr>
		        	<td><?= $l_matkul["ID_Matkul"];?></td>
		        	<td><?= $l_matkul["Nama_Matkul"];?></td>
		        	<td><?= $l_matkul["SKS_Matkul"];?></td>
		        	<td><?= $l_matkul["Semester"];?></td>
		        	<td>		        		
		        		<button class="button-edit" id="buttonEdit" onclick="show_modal(<?php echo $i?>)">
							<i class="fa fa-pencil" aria-hidden="true"></i>		        			
						</button>	
						<a href='javascript:hapusData("<?= $l_matkul['ID_Matkul']?>", 2)'>		        			
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
					      <h2>Update Mata Kuliah</h2>
					      <hr>
					    </div>
					    <div class="modal-body">
					    	<form name="input" method="post" action="<?= base_url('matkul/update')?>">
						      	<input type="hidden" name="old_id" value="<?= $l_matkul['ID_Matkul']?>">
								<label for="fid">ID Matkul</label>
								<input type="text" id="fid" name="id" value="<?= $l_matkul['ID_Matkul']?>" maxlength="6" required>
								<label for="fnama">Nama</label>
								<input type="text" id="fnama" name="nama" value="<?= $l_matkul['Nama_Matkul']?>" required>
								<label for="fsks">SKS</label>
								<input type="number" id="fsks" name="sks" value="<?= $l_matkul['SKS_Matkul']?>" required min=1 max=4>
								<label for="fnama">Semeter</label>
								<input type="number" id="fsemester" name="semester" value="<?= $l_matkul['Semester']?>" required min=1>
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
      <h2>Tambah Data Mata Kuliah</h2>
      <hr>
    </div>
    <div class="modal-body">
      <form name="input" method="post" action="<?= base_url('matkul/insert')?>">
      	<label for="fid">ID Matkul</label>
		<input type="text" id="fid" name="id" placeholder="ID Matkul" maxlength="6" required>
		<label for="fnama">Nama</label>
		<input type="text" id="fnama" name="nama" placeholder="Nama Matkul" required>
		<label for="fsks">SKS</label>
		<input type="number" id="fsks" name="sks" placeholder="SKS" required min=1 max=4>
		<label for="fnama">Semeter</label>
		<input type="number" id="fsemester" name="semester" placeholder="Semester" required min=1>

		<input type="submit">
	</form>
    </div>    
  </div>
</div>