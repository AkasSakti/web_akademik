<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\RuanganModel;


class Ruangan extends Controller
{	
    public function index()
    {    	    	
    	$ruang = new RuanganModel();    	

    	$list_ruang = $ruang->findAll();    

    	$data['ruangan'] = $list_ruang;

        $data['page'] = view('admin/ruangan_view', $data);
        echo view('admin/homepage_view', $data);
    }        

    public function insert(){
    	$ruang = new RuanganModel(); 

    	$id = $this->request->getPost('id');
    	$nama = $this->request->getPost('nama');

    	$data = [
		    'id' => $id,
		    'nama' => $nama
		];
		$result = $ruang->insert_ruangan($data);

		//Jika Input Data gagal
		if($result != 1){
			session()->setFlashdata('gagal', 'Input Data Gagal');
		}
		
		return redirect()->to(base_url('ruangan'));	    
    }

    public function update(){
    	$ruang = new RuanganModel(); 

    	$old_id = $this->request->getPost('old_id');
    	$id = $this->request->getPost('id');
    	$nama = $this->request->getPost('nama');

    	$data = [
    		'old_id' => $old_id,
		    'id' => $id,
		    'nama' => $nama
		];
		$result = $ruang->update_ruangan($data);

		//Jika Update Data gagal
		if($result != 1){
			session()->setFlashdata('gagal', 'Update Data Gagal');
		}
		
		return redirect()->to(base_url('ruangan'));	
    }

    public function delete($id)
    {
   		$ruang = new RuanganModel();  		
    	$result = $ruang->delete_ruangan($id);

    	//Jika Delete Data gagal
		if($result != 1){
			session()->setFlashdata('gagal', 'Delete Data Gagal');
		}
		
		return redirect()->to(base_url('ruangan'));	      	  
    }
}