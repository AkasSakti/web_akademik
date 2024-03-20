<!-- Check Status tambah data -->
<?php
	if(!empty(session()->getFlashdata('gagal'))){
		echo '<script>alert("'.session()->getFlashdata('gagal').'")</script>'; 
	}
?>

<!-- Tabel List Mahasiswa -->
<div class="tabel-page">
	<div class="tabel-heading">
		Data Nilai		
	</div>
	<div class="search-box">		
		<form method="get" action="#">			
			<label for="ftingkat">Tingkat: <input list="tingkat" name="tingkat" type="text">
			</label>
			<datalist id="tingkat">					
				<option value="1">1</option>			
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
			</datalist>	
			<button class="button-input" id="myBtn" type="submit">
			<i class="fa fa-search" aria-hidden="true"></i>Search
		</button>
		</form>				
	</div>
	<div class="data-result">		
		<table id="list-data" class="display">	
			<thead>
				<tr>
					<th><h5>NIM</h5></th>
					<th><h5>Nama</h5></th>					
					<th><h5>Detail Nilai</h5></th>									
				</tr>
			</thead>
			<!-- Kode untuk mengambil data dosen -->
			<?php											
				$i = 1;
			    foreach ($mahasiswa as $key => $mhs) 
			    {			
			?>
					<!-- Menampilkan Data Mahasiswa -->
			        <tr>
			        	<td><?php echo $mhs["NIM"];?></td>
			        	<td><?php echo $mhs["Nama_Mhs"];?></td>			        	        				        
			        	<td>		        					        	
			        		<a href="<?= base_url('nilai?tingkat='.$tingkat.'&detail='.$mhs["NIM"])?>">	        		
			        		<button class="button-edit" id="buttonEdit" >
								<i class="fa fa-info" aria-hidden="true"></i>			        			
							</button>		        								
							</a>
			        	</td>		        		               
			        </tr>		        
			<?php							
					$i++;
			    }
										
			?>
		</table>
	</div>

	<div style="clear: both;"></div>
</div>
<!-- Menampilkan Detail Nilai Mahasiswa -->
<?php
if($detail != null){	
?>
	<div class="tabel-page">
		<div class="tabel-heading">
			<b>Detail Nilai</b> : <?php echo $detail ?>	
		</div>
		<div class="button-container">
			<button class="button-input" id="myBtn" onclick="show_modal(0)">
				<i class="fa fa-plus" aria-hidden="true"></i> Tambah Data
			</button>
		</div>
		<table id="list-data" class="display">	
			<thead>
				<tr>
					<th><h5>Mata Kuliah</h5></th>
					<th><h5>Nilai</h5></th>
					<th><h5>Action</h5></th>
				</tr>
			</thead>		
			<?php									
				$i = 1;				
		    	foreach ($nilai as $key => $l_nilai) 
				{
			?>				
		        <tr>
		        	<td><?php echo $l_nilai->Nama_Matkul;?></td>
		        	<td><?php echo $l_nilai->Nilai;?></td>
		        	<td>		        		
		        		<button class="button-edit" id="buttonEdit" onclick="show_modal(<?php echo $i?>)">
							<i class="fa fa-pencil" aria-hidden="true"></i>		        			
						</button>		        								
						<a href='javascript:hapusDataNilai("<?= $l_nilai->NIM?>", "<?= $l_nilai->ID_Matkul?>", "<?= $tingkat?>")'>        			
		        			<button class="button-delete">
								<i class="fa fa-trash" aria-hidden="true"></i>
							</button>
		        		</a>
		        	</td>		        				        		              
		        </tr>	

		        <!-- Modal Update Data Nilai -->
				<div id="myModal<?php echo $i?>" class="modal">
					<!-- Modal content -->
					<div class="modal-content">
					    <div class="modal-header">
					      <span class="close" id="close<?php echo $i?>">&times;</span>
					      <h2>Update Nilai Mahasiswa</h2>
					      <hr>
					    </div>
					    <div class="modal-body">
					    	<form name="input" method="post" action="<?= base_url('nilai/update')?>">
						      	<input type="hidden" name="old_nim" value="<?= $l_nilai->NIM ?>">
						      	<input type="hidden" name="old_id" value="<?= $l_nilai->ID_Matkul ?>">
						      	<input type="hidden" name="tingkat" value="<?= $tingkat ?>">
								
								<label for="fnama">Nama</label>
								<input type="text" id="fnama" name="nama" value="<?= $l_nilai->Nama_Mhs?>" readonly>
								<label for="fmatkul">Mata Kuliah</label>
								<input type="text" id="falamat" name="matkul" value="<?= $l_nilai->Nama_Matkul?>" readonly>
								<label for="fnilai">Nilai</label>
								<input type="text" id="fnilai" name="nilai" list="nilai" value="<?= $l_nilai->Nilai?>">
								<datalist id="nilai">					
									<option value="A">A</option>			
									<option value="AB">AB</option>
									<option value="B">B</option>
									<option value="BC">BC</option>
									<option value="C">C</option>
									<option value="CD">CD</option>
									<option value="D">D</option>
									<option value="E">E</option>
								</datalist>	
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
	<!-- Modal untuk input data nilai -->
	<div id="myModal0" class="modal">
	  <div class="modal-content">
	    <div class="modal-header">
	      <span class="close" id="close0">&times;</span>
	      <h2>Tambah Data Nilai Mata Kuliah</h2>
	      <hr>
	    </div>
	    <div class="modal-body">
	      <form name="login" method="post" action="<?= base_url('nilai/insert')?>">
	      	<input type="hidden" name="tingkat" value="<?= $tingkat ?>">
			<label for="fnim">NIM</label>
			<input type="text" id="fnim" name="nim" value="<?= $detail ?>" readonly>			
			<label for="fmatkul">Mata Kuliah</label>
			<input type="text" id="fmatkul" name="matkul" list="matkul" placeholder="Mata Kuliah">
				<datalist id="matkul">					
				<?php						
				foreach ($matkul as $key => $l_matkul) {						    		
				?>			
					<option value="<?= $l_matkul['ID_Matkul']?>">
						<?= $l_matkul['Nama_Matkul']?>	
					</option>

				<?php					
				}
				?>
				</datalist>	
			<label for="ftingkat">Nilai</label>
			<input type="text" id="fnilai" name="nilai" list="nilai" placeholder="Nilai">
				<datalist id="nilai">					
					<option value="A">A</option>			
					<option value="AB">AB</option>
					<option value="B">B</option>
					<option value="BC">BC</option>
					<option value="C">C</option>
					<option value="CD">CD</option>
					<option value="D">D</option>
					<option value="E">E</option>
				</datalist>	

			<input type="submit">
		</form>
	    </div>    
	  </div>
	</div>
	
<?php
	}
?>

