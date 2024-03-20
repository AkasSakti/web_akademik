<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DosenModel;
use App\Models\MatkulModel;
use App\Models\RuanganModel;
use App\Models\JadwalModel;

class Jadwal extends Controller
{	
    public function index()
    {    	    	
      $id = $this->request->getGet('dosen');
        
    	$dsn = new DosenModel();  
      $mtkl = new MatkulModel();
      $ruang = new RuanganModel();  	

    	$list_dosen = $dsn->findAll();    
      $list_matkul = $mtkl->findAll();    
      $list_ruang = $ruang->findAll();
      $list_jadwal = $dsn->get_jadwal_dosen($id);    

    	$data['dosen'] = $list_dosen;
      $data['matkul'] = $list_matkul;
      $data['ruangan'] = $list_ruang;
      $data['jadwal'] = $list_jadwal;

      $data['page'] = view('admin/jadwal_view', $data);
      echo view('admin/homepage_view', $data);
    }        

    public function insert(){
      $jdwl = new JadwalModel();  

      $dosen = $this->request->getPost('dosen');
      $matkul = $this->request->getPost('matkul');
      $hari = $this->request->getPost('hari');
      $j_masuk = $this->request->getPost('j_masuk');
      $j_keluar = $this->request->getPost('j_keluar');
      $ruangan = $this->request->getPost('ruangan');

      $data = [
  		   'dosen' => $dosen,
  		   'matkul' => $matkul,
         'hari' => $hari,
         'j_masuk' => $j_masuk,
         'j_keluar' => $j_keluar,
         'ruangan' => $ruangan
    	];
      if($j_masuk < $j_keluar){
        $result = $jdwl->insert_jadwal($data);

        //Jika Input Data gagal
        if($result == -1){
          session()->setFlashdata('gagal', 'Input Data Gagal');
        }  
      }
    	else{
        session()->setFlashdata('gagal', 'Update Data Gagal');
      }
    		
    	return redirect()->to(base_url('jadwal?dosen='.$dosen)); 
    }

    public function update(){
    	$jdwl = new JadwalModel();

    	$old_id = $this->request->getPost('old_id');  
      $dosen = $this->request->getPost('old_id_dosen'); 
      $ruangan = $this->request->getPost('ruangan'); 
      $hari = $this->request->getPost('hari'); 
      $j_masuk = $this->request->getPost('j_masuk'); 
      $j_keluar = $this->request->getPost('j_keluar');

    	$data = [
        'id' => $old_id,    		
        'hari' => $hari,
        'j_masuk' => $j_masuk,
        'j_keluar' => $j_keluar,
        'ruangan' => $ruangan
		  ];

      if($j_masuk < $j_keluar){
    		$result = $jdwl->update_jadwal($data);

    		//Jika Update Data gagal
    		if($result != 1){
    			session()->setFlashdata('gagal', 'Update Data Gagal');
    		}
      }
      else{
        session()->setFlashdata('gagal', 'Update Data Gagal');
      }
  		
  		return redirect()->to(base_url('jadwal?dosen='.$dosen)); 
    }

    public function delete()
    {
      $id = $this->request->getGet('id');
      $dosen = $this->request->getGet('dosen');
      $mengajar = $this->request->getGet('matkul');

   		$jdwl = new JadwalModel();   		
    	$result = $jdwl->delete_jadwal($id, $dosen, $mengajar);

    	//Jika Delete Data gagal
  		if($result == -1){
  			session()->setFlashdata('gagal', 'Delete Data Gagal');
  		}
  		
  		return redirect()->to(base_url('jadwal?dosen='.$dosen)); 	      	  
    }
}
