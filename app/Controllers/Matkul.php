<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MatkulModel;


class Matkul extends Controller
{	
    public function index()
    {    	    	
    	$mtkl = new MatkulModel();    	

    	$list_matkul = $mtkl->findAll();    

    	$data['matkul'] = $list_matkul;

        $data['page'] = view('admin/matkul_view', $data);
        echo view('admin/homepage_view', $data);
    }        

    public function insert(){
    	$mtkl = new MatkulModel();

    	$id = $this->request->getPost('id');
    	$nama = $this->request->getPost('nama');
        $sks = $this->request->getPost('sks');
        $semester = $this->request->getPost('semester');

    	$data = [
		    'id' => $id,
		    'nama' => $nama,
            'sks' => $sks,
            'semester' => $semester
		];

		$result = $mtkl->insert_matkul($data);

		//Jika Input Data gagal
		if($result != 1){
			session()->setFlashdata('gagal', 'Input Data Gagal');
		}
		
		return redirect()->to(base_url('matkul'));	    
    }

    public function update(){
    	$mtkl = new MatkulModel();

    	$old_id = $this->request->getPost('old_id');
    	$id = $this->request->getPost('id');
    	$nama = $this->request->getPost('nama');
        $sks = $this->request->getPost('sks');
        $semester = $this->request->getPost('semester');

    	$data = [
    		'old_id' => $old_id,
		    'id' => $id,
		    'nama' => $nama,
            'sks' => $sks,
            'semester' => $semester
		];

		$result = $mtkl->update_matkul($data);

		//Jika Update Data gagal
		if($result != 1){
			session()->setFlashdata('gagal', 'Update Data Gagal');
		}
		
		return redirect()->to(base_url('matkul'));	
    }

    public function delete($id)
    {
   		$mtkl = new MatkulModel();  		
    	$result = $mtkl->delete_matkul($id);

    	//Jika Delete Data gagal
		if($result != 1){
			session()->setFlashdata('gagal', 'Delete Data Gagal');
		}
		
		return redirect()->to(base_url('matkul'));	      	  
    }
}