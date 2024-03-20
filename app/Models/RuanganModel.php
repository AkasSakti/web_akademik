<?php namespace App\Models;
use CodeIgniter\Model;

class RuanganModel extends Model
{
    protected $table = 'ruangan';
    protected $primaryKey = 'ID_Ruangan';

    protected $allowedFields = ['Nama_Ruangan'];

	public function insert_ruangan($data_ruang){
        $db = \Config\Database::connect();        

        $sql = "INSERT INTO ruangan VALUES ('$data_ruang[id]','$data_ruang[nama]')";        
        
        $data = $db->query($sql);

        return $db->affectedRows();       
    }

    public function delete_ruangan($id){
        $db = \Config\Database::connect();        

        $sql = "DELETE FROM ruangan WHERE ID_Ruangan='$id'";        
        
        $data = $db->query($sql);

        return $db->affectedRows();
    }

    public function update_ruangan($data_ruang){
        $db = \Config\Database::connect();        
        $sql = "UPDATE ruangan SET ID_Ruangan='$data_ruang[id]', Nama_Ruangan='$data_ruang[nama]' WHERE ID_Ruangan='$data_ruang[old_id]'";        
        
        $data = $db->query($sql);

        return $db->affectedRows();       
    }    
   
}