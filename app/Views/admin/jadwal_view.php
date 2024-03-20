<!-- Check Status tambah data -->
<?php
	if(!empty(session()->getFlashdata('gagal'))){
		echo '<script>alert("'.session()->getFlashdata('gagal').'")</script>'; 
	}
?>

<!-- Tabel Data Jadwal Mengajar -->
<div class="tabel-page">
	<div class="tabel-heading">
		Data Jadwal Mengajar		
	</div>
	<div class="search-box">		
		<form method="get" action="#">			
			<label for="fdosen">Dosen: <input list="dosen" name="dosen" type="text">
			</label>
			<datalist id="dosen">
			<!-- Select Data Dosen -->
			<?php
			foreach ($dosen as $key => $l_dosen) 
			{		 	    	
			?>
				<option value="<?= $l_dosen['ID_Dosen'];?>">
					<?= $l_dosen['Nama_Dosen'];?>
				</option>
			<?php						    	
			} 						
			?>			 
			</datalist>	
			<button class="button-input" id="myBtn" type="submit">
			<i class="fa fa-search" aria-hidden="true"></i>Search
		</button>
		</form>				
	</div>
	<div class="data-result">
		<div class="button-container">			
			<button class="button-input" id="myBtn" onclick="show_modal(0)" >
			<i class="fa fa-plus" aria-hidden="true"></i> Tambah Data
			</button>			
		</div>
	<table id="list-data" class="display" cellspacing="0">	
		<thead>
			<tr>
				<th><h5>Dosen</h5></th>
				<th><h5>Mata Kuliah</h5></th>
				<th><h5>Hari</h5></th>
				<th><h5>Waktu</h5></th>
				<th><h5>Ruangan</h5></th>				
				<th><h5>Action</h5></th>				
			</tr>
		</thead>
		<!-- Kode untuk mengambil data dosen -->
		<?php						
			$i = 1;
		    foreach ($jadwal as $key => $l_jadwal) 
		    {
		?>
				<!-- Menampilkan Data Dosen -->
		        <tr>
		        	<td><?php echo $l_jadwal->Nama_Dosen;?></td>
		        	<td><?php echo $l_jadwal->Nama_Matkul;?></td>
		        	<td><?php echo $l_jadwal->Hari;?></td>
		        	<td><?php echo $l_jadwal->Jam_Masuk."-".$l_jadwal->Jam_Keluar;?></td>
		        	<td><?php echo $l_jadwal->Nama_Ruangan;?></td>

		        	
		        	<td>		        		
		        		<button class="button-edit" id="buttonEdit" onclick="show_modal(<?php echo $i?>)">
							<i class="fa fa-pencil" aria-hidden="true"></i>		        			
						</button>		        								
						<a href='javascript:hapusDataJadwal("<?= $l_jadwal->ID_Jadwal?>", "<?= $l_jadwal->ID_Dosen?>", "<?= $l_jadwal->ID_Matkul?>")'>		        			
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
					      <h2>Update Jadwal Mengajar</h2>
					      <hr>
					    </div>
					    <div class="modal-body">
					    	<form name="input" method="post" action="<?= base_url('jadwal/update')?>">
					    		<!-- ID Jadwal Sebelumnya -->
						      	<input type="hidden" name="old_id" value="<?= $l_jadwal->ID_Jadwal?>">				
						      	<input type="hidden" name="old_id_dosen" value="<?= $l_jadwal->ID_Dosen?>">		      	
						      	<!-- Nama Dosen -->
								<label for="fid">Nama Dosen</label>
								<input type="text" id="fid" value="<?= $l_jadwal->Nama_Dosen?>" maxlength="7" required>
								<!-- Nama Matkul -->
								<label for="fnama">Nama Mata Kuliah</label>
								<input type="text" id="fnama" value="<?= $l_jadwal->Nama_Matkul?>" required>
								<!-- Hari -->
								<label for="fhari">Hari</label>
								<input type="text" id="fhari" list="hari" name="hari" value="<?= $l_jadwal->Hari?>" required>
								<datalist id="hari">
									<option value="Senin"></option>
									<option value="Selasa"></option>
									<option value="Rabu"></option>=
									<option value="Kamis"></option>
									<option value="Jumat"></option>
									<option value="Sabtu"></option>									
								</datalist>
								<!-- Ruangan -->
								<label for="fdosen">Ruangan <input list="ruangan" name="ruangan" type="text" value="<?= $l_jadwal->ID_Ruangan?>">
								</label>
								<datalist id="ruangan">									
									<!-- Select Data Ruangan -->
									<?php						
								    foreach ($ruangan as $key => $l_r) 
									{		    	
									?>
										<option value="<?php echo $l_r['ID_Ruangan']?>">
											<?php echo $l_r['Nama_Ruangan']?>
										</option>
									<?php					    	
									} 						
									?>				 
								</datalist>			
								<!-- Jam -->
								<label for="fjam">Jam</label>
								<br>
								<input type="time" name="j_masuk" step="1" value="<?= $l_jadwal->Jam_Masuk?>"> - <input type="time" name="j_keluar" step="1" value="<?= $l_jadwal->Jam_Keluar?>">
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
	<div style="clear: both;"></div>
</div>

<!-- Modal Input Data -->
<div id="myModal0" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="close0">&times;</span>
      <h2>Input Jadwal Mengajar</h2>
      <hr>
    </div>
    <div class="modal-body">
     <form name="input" method="post" action="<?= base_url('jadwal/insert')?>">
		<!-- Data Dosen -->
      	<label for="fdosen">Dosen: <input list="dosen" name="dosen" type="text">
		</label>
		<datalist id="dosen">	
		<!-- Select Data Dosen -->
		<?php
		foreach ($dosen as $key => $l_dosen) 
		{		 	    	
		?>
			<option value="<?= $l_dosen['ID_Dosen'];?>">
				<?= $l_dosen['Nama_Dosen'];?>
			</option>
		<?php						    	
		} 						
		?>			 
		</datalist>	
		<!-- Data Mata Kuliah -->
		<label for="fmatkul">Mata Kuliah: <input list="matkul" name="matkul" type="text">
		</label>
		<datalist id="matkul">
		<!-- Select Data Mata Kuliah -->
		<?php			
		foreach ($matkul as $key => $l_matkul) 
		{
		?>
			<option value="<?= $l_matkul['ID_Matkul']?>">
				<?= $l_matkul['Nama_Matkul']?>
			</option>
		<?php					    	
		} 						
		?>			 
		</datalist>
		<!-- Data Mata Ruangan -->
		<label for="fruangan">Ruangan: <input list="ruangan" name="ruangan" type="text">
		</label>
		<datalist id="ruangan">
		<!-- Select Data Ruangan -->
		<?php						
	    foreach ($ruangan as $key => $l_r) 
		{		    	
		?>
			<option value="<?php echo $l_r['ID_Ruangan']?>">
				<?php echo $l_r['Nama_Ruangan']?>
			</option>
		<?php					    	
		} 						
		?>			 
		</datalist>		

		<!-- Data Hari -->
		<label for="fhari">Hari: <input list="hari" name="hari" type="text">
		</label>
		<datalist id="hari">			
			<option value="Senin"></option>
			<option value="Selasa"></option>
			<option value="Rabu"></option>
			<option value="Kamis"></option>
			<option value="Jumat"></option>
			<option value="Sabtu"></option>					
		</datalist>
		<!-- Jam -->
		<label for="fjam">Jam</label>
		<br>
		<input type="time" name="j_masuk" step="1"> - <input type="time" name="j_keluar" step="1">
		<input type="submit" value="Input">
	</form>
    </div>    
  </div>
</div>