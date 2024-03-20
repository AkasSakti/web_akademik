<?php namespace App\Models;
use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table = 'jadwal';
    protected $primaryKey = 'ID_Jadwal';

    protected $allowedFields = ['Kode_Ruangan', 'Kode_Matkul', 'Hari', 'Jam_Masuk', 'Jam_Keluar'];

    public function get_jadwal_mahasiswa($nim, $id_hari){
        // Array Nama Hari
        $arr_hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");

        $db = db_connect();

        $data = $db->query("SELECT * FROM nilai as n
            INNER JOIN jadwal as j ON n.NIM = '$nim' AND n.ID_Matkul = j.ID_Matkul AND j.Hari = '$arr_hari[$id_hari]'
            INNER JOIN mata_kuliah as mk ON j.ID_Matkul = mk.ID_Matkul
            INNER JOIN mengajar as m ON mk.ID_Matkul = m.ID_Matkul
            INNER JOIN dosen as d ON d.ID_Dosen = m.ID_Dosen
            INNER JOIN ruangan as r ON r.ID_Ruangan = j.ID_Ruangan

            ORDER BY j.Jam_Masuk");

        return $data->getResult();
    	
    }   

    public function insert_jadwal($data_jdwl){
        $db = \Config\Database::connect();        

        $sql = "SELECT * FROM mengajar WHERE Kode_Matkul ='$data_jdwl[matkul]' AND Kode_Dosen = '$data_jdwl[dosen]'";
                
        $data = $db->query($sql);
        $row = $data->getFirstRow();

        if($row == null){
            $sql = "INSERT INTO mengajar VALUES ('$data_jdwl[dosen]', '$data_jdwl[matkul]')";
            $data = $db->query($sql);

            $sql_jadwal = "INSERT INTO jadwal VALUES ('', '$data_jdwl[dosen]', '$data_jdwl[matkul]', '$data_jdwl[ruangan]', '$data_jdwl[hari]', '$data_jdwl[j_masuk]', '$data_jdwl[j_keluar]')";

            $data = $db->query($sql_jadwal);

            return $db->affectedRows();     
        }
        else{
            return -1;
        }            
    }

    public function delete_jadwal($id, $dosen, $id_matkul){
        $db = \Config\Database::connect();        

        // Delete Jadwal
        $sql = "DELETE FROM jadwal WHERE ID_Jadwal='$id'";                
        $data = $db->query($sql);

        // Delete Mengajar
        $sql = "DELETE FROM mengajar WHERE ID_DOSEN='$dosen' AND ID_Matkul = '$id_matkul'";      
                  
        $data = $db->query($sql);

        return $db->affectedRows();
    }

    public function update_jadwal($data_jdwl){
        $db = \Config\Database::connect();        
        $sql = "UPDATE jadwal SET ID_Ruangan='$data_jdwl[ruangan]', Hari='$data_jdwl[hari]', Jam_Masuk ='$data_jdwl[j_masuk]', Jam_Keluar ='$data_jdwl[j_keluar]' WHERE ID_Jadwal=$data_jdwl[id]";                
        
        $data = $db->query($sql);

        return $db->affectedRows();       
    }

   
}