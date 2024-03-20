<!-- Tabel Data Matkul -->
<div class="tabel-page">
	<div class="tabel-heading">
		Daftar Mata Kuliah yang diambil
	</div>	
	<table id="list-data" class="display">	
		<thead>
			<tr>
				<th><h5>Kode Matkul</h5></th>
				<th><h5>Nama Matkul</h5></th>
				<th><h5>SKS</h5></th>
				<th><h5>Semester</h5></th>						
			</tr>
		</thead>
		<!-- Kode untuk mengambil data Matkul -->
		<?php			
			foreach ($matkul as $key => $l_matkul) 
			{							
		?>
				<!-- Menampilkan Data Matkul -->
		        <tr>
		        	<td><?=  $l_matkul->ID_Matkul;?></td>
		        	<td><?=  $l_matkul->Nama_Matkul;?></td>
		        	<td><?=  $l_matkul->SKS_Matkul;?></td>
		        	<td><?=  $l_matkul->Semester;?></td>		        		        
		        </tr>
		<?php							
		    }					
		?>

	</table>
</div>
