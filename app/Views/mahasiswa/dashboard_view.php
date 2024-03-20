<div class="info">
	<div class="ipk-item">
		<i class="fa fa-graduation-cap" aria-hidden="true"></i> IPK : <?= $ipk; ?>
	</div>
	<div class="sks-item">
		<i class="fa fa-book" aria-hidden="true"></i>Jumlah SKS : <?= $sks ?>
	</div>
</div>

<!-- Tabel Jadwal Kuliah -->
<div class="tabel-page">
	<div class="tabel-heading">
		Jadwal Kuliah Hari ini
	</div>	
	<table id="list-data" class="display">	
		<thead>
			<tr>
				<th><h5>Dosen</h5></th>
				<th><h5>Mata Kuliah</h5></th>
				<th><h5>Ruangan</h5></th>
				<th><h5>Waktu</h5></th>						
			</tr>
		</thead>
		<!-- Kode untuk mengambil data dosen -->
		<?php
			foreach ($jadwal as $key => $l_jadwal) {
		?>
				<!-- Menampilkan Data Dosen -->
		        <tr>
		        	<td><?= $l_jadwal->Nama_Dosen;?></td>
		        	<td><?= $l_jadwal->Nama_Matkul;?></td>		        		        
		        	<td><?= $l_jadwal->Nama_Ruangan;?></td>
		        	<td><?= $l_jadwal->Jam_Masuk."-".$l_jadwal->Jam_Keluar;?></td>
		        </tr>
		<?php							
		    }
			
		?>

	</table>
</div>