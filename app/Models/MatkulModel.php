<?php namespace App\Models;
use CodeIgniter\Model;

class MatkulModel extends Model
{
    protected $table = 'mata_kuliah';
    protected $primaryKey = 'ID_Matkul';

    protected $allowedFields = ['Nama_Matkul','SKS_Matkul','Semester'];


    public function get_matkul_mahasiswa($nim){
        $db = \Config\Database::connect();

        $data = $db->query(" SELECT * FROM nilai as n
					INNER JOIN mata_kuliah as mk ON n.ID_Matkul = mk.ID_Matkul AND n.NIM = '$nim'");

        return $data->getResult();
    }      

    public function insert_matkul($data_matkul){
        $db = \Config\Database::connect();        

        $sql = "INSERT INTO mata_kuliah VALUES ('$data_matkul[id]','$data_matkul[nama]','$data_matkul[sks]','$data_matkul[semester]')";                
        $data = $db->query($sql);

        return $db->affectedRows();       
    }

    public function delete_matkul($id){
        $db = \Config\Database::connect();        

        $sql = "DELETE FROM mata_kuliah WHERE ID_Matkul='$id'";        
        
        $data = $db->query($sql);

        return $db->affectedRows();
    }

    public function update_matkul($data_matkul){
        $db = \Config\Database::connect();        
        $sql = "UPDATE mata_kuliah SET ID_Matkul='$data_matkul[id]', Nama_Matkul='$data_matkul[nama]', SKS_Matkul='$data_matkul[sks]', Semester='$data_matkul[semester]' WHERE ID_Matkul='$data_matkul[old_id]'";        
        
        $data = $db->query($sql);

        return $db->affectedRows();       
    }    
}