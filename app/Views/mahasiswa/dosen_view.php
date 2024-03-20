<!-- Tabel Data Dosen -->
<div class="tabel-page">
	<div class="tabel-heading">
		Daftar Dosen yang Mengajar
	</div>	
	<table id="list-data" class="display">	
		<thead>
			<tr>
				<th><h5>ID Dosen</h5></th>
				<th><h5>Nama Dosen</h5></th>						
			</tr>
		</thead>
		<!-- Kode untuk mengambil data dosen -->
		<?php			
			foreach ($dosen as $key => $l_dosen) 
			{							
		?>
				<!-- Menampilkan Data Dosen -->
		        <tr>
		        	<td><?= $l_dosen->ID_Dosen;?></td>
		        	<td><?= $l_dosen->Nama_Dosen;?></td>		        		        
		        </tr>
		<?php							
		    }
			
		?>

	</table>
</div>
