<div class="tabel-page">
	<div class="tabel-heading">
		<b>Daftar Nilai Akademis</b>
	</div>
	
	<table id="list-data" class="display">	
		<thead>
			<tr>
				<th><h5>Mata Kuliah</h5></th>
				<th><h5>SKS</h5></th>
				<th><h5>Semester</h5></th>
				<th><h5>Nilai</h5></th>													
			</tr>
		</thead>		
		<?php								
			foreach ($nilai as $key => $l_nilai) 
			{			
		?>				
		        <tr>
		        	<td><?= $l_nilai->Nama_Matkul;?></td>
		        	<td><?= $l_nilai->SKS_Matkul;?></td>
		        	<td><?= $l_nilai->Semester;?></td>
		        	<td><?= $l_nilai->Nilai;?></td>
		        			        		              
		        </tr>			       
		<?php											
	    	}		
		?>
	</table>
</div>