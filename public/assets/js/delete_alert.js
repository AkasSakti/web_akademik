// Untuk komfirmasi delete data
function hapusData(id, identifier){
	console.log(id);
    if (confirm("Apakah anda yakin akan menghapus data ini?")){
    	switch(identifier) {
		  case 1:
		    window.location.href = 'dosen/delete/' + id;
		    break;
		  case 2:
		    window.location.href = 'matkul/delete/' + id;
		    break;
		  case 3:
		    window.location.href = 'ruangan/delete/' + id;
		    break;				 		 
		}	          
    }
}

function hapusDataJadwal(id_jadwal, id_dosen, id_matkul){    
    if (confirm("Apakah anda yakin akan menghapus data ini?")){
      window.location.href = 'jadwal/delete?id=' +id_jadwal+'&dosen='+id_dosen+'&matkul='+id_matkul;
    }
}

function hapusDataNilai(nim, id_matkul, tingkat){
	console.log(nim);
    if (confirm("Apakah anda yakin akan menghapus data ini?")){
      window.location.href = 'nilai/delete?nim='+nim+'&id='+id_matkul+'&tingkat='+tingkat;
    }
}

function hapusDataMhs(nim){
    if (confirm("Apakah anda yakin akan menghapus data ini?")){
      window.location.href = '../mahasiswa/delete/' + nim;
    }
}

function show_form(id){
	var form = document.getElementById(id);

	form.style.display = "block";
}
