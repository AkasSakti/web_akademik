<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\DosenModel;


class Dosen extends Controller
{	
    public function index()
    {    	    	
    	$dsn = new DosenModel();    	

    	$list_dosen = $dsn->findAll();    

    	$data['dosen'] = $list_dosen;

        $data['page'] = view('admin/dosen_view', $data);
        echo view('admin/homepage_view', $data);
    }        

    public function insert(){
    	$dsn = new DosenModel();

    	$id = $this->request->getPost('id');
    	$nama = $this->request->getPost('nama');

    	$data = [
		    'id' => $id,
		    'nama' => $nama
		];
		$result = $dsn->insert_dosen($data);

		//Jika Input Data gagal
		if($result != 1){
			session()->setFlashdata('gagal', 'Input Data Gagal');
		}
		
		return redirect()->to(base_url('dosen'));	    
    }

    public function update(){
    	$dsn = new DosenModel();

    	$old_id = $this->request->getPost('old_id');
    	$id = $this->request->getPost('id');
    	$nama = $this->request->getPost('nama');

    	$data = [
    		'old_id' => $old_id,
		    'id' => $id,
		    'nama' => $nama
		];
		$result = $dsn->update_dosen($data);

		//Jika Update Data gagal
		if($result != 1){
			session()->setFlashdata('gagal', 'Update Data Gagal');
		}
		
		return redirect()->to(base_url('dosen'));	
    }

    public function delete($id)
    {
   		$dsn = new DosenModel();   		
    	$result = $dsn->delete_dosen($id);

    	//Jika Delete Data gagal
		if($result != 1){
			session()->setFlashdata('gagal', 'Delete Data Gagal');
		}
		
		return redirect()->to(base_url('dosen'));	      	  
    }
}