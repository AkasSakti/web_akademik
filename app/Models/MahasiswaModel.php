<?php namespace App\Models;
use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'NIM';

    protected $allowedFields = ['Nama_Mhs', 'Tingkat', 'Password', 'Alamat'];

    // Pengecekan Login
    public function cek_login($table, $data){
    	$db = db_connect();
    	
		$data = $db->query("SELECT * FROM $table where NIM='$data[nim]' AND Password='$data[password]'");

		return $data;
    }    
    
    // CRUD
    public function get_all_mahasiswa(){
        $db = db_connect(); 
        $sql = "SELECT * FROM mahasiswa";

        $data = $db->query($sql);

        return $data->getResult();       
    }

    public function insert_mhs($data_mhs){
        $db = db_connect();        

        $sql = "INSERT INTO mahasiswa VALUES ('$data_mhs[nim]','$data_mhs[nama]','$data_mhs[tingkat]','$data_mhs[password]','$data_mhs[alamat]')";        
        
        $data = $db->query($sql);

        return $db->affectedRows();       
    }

     public function update_mhs($data_mhs){
        $db = \Config\Database::connect();        

        $sql = "UPDATE mahasiswa SET NIM='$data_mhs[nim]', Nama_Mhs='$data_mhs[nama]', Tingkat='$data_mhs[tingkat]', Alamat='$data_mhs[alamat]'  WHERE NIM='$data_mhs[old_nim]'";        
        
        $data = $db->query($sql);

        return $db->affectedRows();       
    }

     public function delete_mhs($nim){
        $db = \Config\Database::connect();        

        $sql = "DELETE FROM mahasiswa WHERE NIM='$nim'";        
        
        $data = $db->query($sql);

        return $db->affectedRows();
    }
   
}