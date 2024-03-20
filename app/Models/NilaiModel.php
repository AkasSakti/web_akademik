<?php namespace App\Models;
use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $table = 'nilai';
    protected $primaryKey = 'ID_Nilai';

    protected $allowedFields = ['ID_Matkul','NIM','Nilai'];

    // Get Data Nilai
    public function get_data_nilai($nim){
        $db = \Config\Database::connect();

        $data = $db->query(" SELECT * FROM nilai as n  
            INNER JOIN mahasiswa as m ON m.NIM = '$nim' AND m.NIM = n.NIM
            INNER JOIN mata_kuliah as mk ON mk.ID_Matkul = n.ID_Matkul
            ORDER BY mk.Semester");

        return $data->getResult();
    }

    // Perhitungan IPK
    public function calculate_ipk($nilai){
        $array = array(
            "A" => 4,
            "AB" => 3.5,
            "B" => 3,
            "BC" => 2.5,
            "C" => 2,
            "CD" => 1.5,
            "D" => 1,
            "E" => 0,
        );

        $sum = 0;
        $sum_sks = 0;    
        $ipk = 0; 

        foreach ($nilai as $key => $l_nilai) {
            $nilai = $array[$l_nilai->Nilai];
            $mutu = $nilai * $l_nilai->SKS_Matkul;

            $sum_sks = $sum_sks + $l_nilai->SKS_Matkul;
            $sum = $sum + $mutu;
        }
        if($sum_sks != 0)
            $ipk = number_format($sum / $sum_sks, 2, '.', '');

        return array(
            "ipk" => $ipk, 
            "sks" => $sum_sks,
        );
    }
    
    public function get_nilai_mahasiswa($nim){
        $db = db_connect();

        $data = $db->query("SELECT * FROM nilai as n  
		INNER JOIN mahasiswa as m ON m.NIM = '$nim' AND m.NIM = n.NIM
		INNER JOIN mata_kuliah as mk ON mk.ID_Matkul = n.ID_Matkul
		ORDER BY mk.Semester");

        return $data->getResult();
    }      

    public function insert_nilai($data_nilai){
        $db = \Config\Database::connect();        

        $sql = "SELECT * FROM nilai WHERE ID_Matkul='$data_nilai[matkul]' AND NIM='$data_nilai[nim]'";                
        $data = $db->query($sql);
        $row = $data->getFirstRow();

        if($row == null){
            $sql = "INSERT INTO nilai VALUES ('$data_nilai[matkul]','$data_nilai[nim]','$data_nilai[nilai]')";                
            $data = $db->query($sql);

            return $db->affectedRows();     
        }
        else{
            return -1;
        }                        
    }

    public function delete_nilai($matkul, $nim){
        $db = \Config\Database::connect();        

        $sql = "DELETE FROM nilai WHERE ID_Matkul='$matkul' AND NIM='$nim'";        
        
        $data = $db->query($sql);

        return $db->affectedRows();
    }

    public function update_nilai($data_nilai){
        $db = \Config\Database::connect();        
        $sql = "UPDATE nilai SET Nilai='$data_nilai[nilai]' WHERE ID_Matkul='$data_nilai[matkul]' AND NIM='$data_nilai[nim]'";                
        
        $data = $db->query($sql);

        return $db->affectedRows();       
    }    


}