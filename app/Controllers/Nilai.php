<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NilaiModel;
use App\Models\MahasiswaModel;
use App\Models\MatkulModel;

class Nilai extends Controller
{	
    public function index()
    {            
        $tingkat = $this->request->getGet('tingkat');
        $detail = $this->request->getGet('detail');

        $mhs = new MahasiswaModel();
        $nilai_model = new NilaiModel();
        $mtkl = new MatkulModel();


        $mahasiswa = $mhs->where('Tingkat', $tingkat)->findAll();
    	$nilai_mhs = $nilai_model->get_nilai_mahasiswa($detail);
        $list_matkul = $mtkl->findAll();

    	$data['mahasiswa'] = $mahasiswa;
        $data['tingkat'] = $tingkat;
        $data['detail'] = $detail;
        $data['nilai'] = $nilai_mhs;
        $data['matkul'] = $list_matkul;

        $data['page'] = view('admin/nilai_view', $data);
        echo view('admin/homepage_view', $data);
    }        

    public function insert(){
    	$nilai_model = new NilaiModel(); 

        $tingkat = $this->request->getPost('tingkat');
    	$nim = $this->request->getPost('nim');
    	$matkul = $this->request->getPost('matkul');
        $nilai = $this->request->getPost('nilai');

    	$data = [
		    'nim' => $nim,
		    'matkul' => $matkul,
            'nilai' => $nilai
		];

		$result = $nilai_model->insert_nilai($data);

		//Jika Input Data gagal
		if($result != 1){
			session()->setFlashdata('gagal', 'Input Data Gagal');
		}
		
		return redirect()->to(base_url('nilai?tingkat='.$tingkat.'&detail='.$nim));	    
    }

    public function update(){
    	$nilai_model = new NilaiModel(); 

    	$old_id = $this->request->getPost('old_id');
    	$old_nim = $this->request->getPost('old_nim');
    	$nilai = $this->request->getPost('nilai');
        $tingkat = $this->request->getPost('tingkat');


    	$data = [
    		'matkul' => $old_id,
		    'nim' => $old_nim,
		    'nilai' => $nilai
		];    

		$result = $nilai_model->update_nilai($data);

		//Jika Update Data gagal
		if($result != 1){
			session()->setFlashdata('gagal', 'Update Data Gagal');
		}
		
		return redirect()->to(base_url('nilai?tingkat='.$tingkat.'&detail='.$old_nim));	
    }

    public function delete()
    {
        $matkul = $this->request->getGet('id');
        $nim = $this->request->getGet('nim');
        $tingkat = $this->request->getGet('tingkat');

   		$nilai_model = new NilaiModel(); 		
    	$result = $nilai_model->delete_nilai($matkul, $nim);

    	//Jika Delete Data gagal
		if($result != 1){
			session()->setFlashdata('gagal', 'Delete Data Gagal');
		}
		
		return redirect()->to(base_url('nilai?tingkat='.$tingkat.'&detail='.$nim));    	      	  
    }
}
