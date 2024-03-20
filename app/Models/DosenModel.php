<?php namespace App\Models;
use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'ID_Dosen';

    protected $allowedFields = ['Nama_Dosen'];

    public function get_dosen_mahasiswa($nim){
        $db = \Config\Database::connect();

        $data = $db->query(" SELECT * from dosen as d
                    INNER JOIN mengajar as me ON d.ID_Dosen = me.ID_Dosen
                    INNER JOIN nilai as n ON n.ID_Matkul = me.ID_Matkul AND n.NIM = '$nim'");

        return $data->getResult();
    }    

    public function get_jadwal_dosen($id){
        $db = \Config\Database::connect();

        $data = $db->query("SELECT * from dosen as d 
                        INNER JOIN mengajar as me ON d.ID_Dosen = '$id' AND d.ID_Dosen = me.ID_Dosen
                        INNER JOIN mata_kuliah as m ON m.ID_Matkul = me.ID_Matkul
                        INNER JOIN jadwal as j ON j.ID_Matkul = me.ID_Matkul AND j.ID_Dosen = d.ID_Dosen
                        INNER JOIN ruangan as r ON r.ID_Ruangan = j.ID_Ruangan

                        ORDER BY FIELD(j.Hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu')");

        return $data->getResult();
        

    }

    public function insert_dosen($data_dosen){
        $db = \Config\Database::connect();        

        $sql = "INSERT INTO dosen VALUES ('$data_dosen[id]','$data_dosen[nama]')";        
        
        $data = $db->query($sql);

        return $db->affectedRows();       
    }

    public function delete_dosen($id){
        $db = \Config\Database::connect();        

        $sql = "DELETE FROM dosen WHERE ID_Dosen='$id'";        
        
        $data = $db->query($sql);

        return $db->affectedRows();
    }

    public function update_dosen($data_dosen){
        $db = \Config\Database::connect();        

        $sql = "UPDATE dosen SET ID_Dosen='$data_dosen[id]', Nama_Dosen='$data_dosen[nama]' WHERE ID_Dosen='$data_dosen[old_id]'";        
        
        $data = $db->query($sql);

        return $db->affectedRows();       
    }
   
}