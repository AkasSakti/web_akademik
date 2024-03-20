<?php 

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;
use App\Models\MahasiswaModel;
use App\Models\RuanganModel;
use App\Models\DosenModel;
use App\Models\MatkulModel;

class Admin extends Controller
{
    public function index()
    {
    	if(session('logged_in') == "admin"){
    		return redirect()->to(base_url('admin/dashboard'));
    	}
        return view('admin/login_view');
    }    

    public function login(){
    	$admin = new AdminModel();

    	 $username = $this->request->getPost('username');
    	 $password = $this->request->getPost('password');

    	 $where = array(
			'username' => $username,			
			'password' => $password
		 );

		 $user = $admin->cek_login("admin", $where);
		
		 $logged_in_adm = $user->getFirstRow();	

		 if($logged_in_adm != null){
		 	session()->set('logged_in', "admin");			 	
		 	return redirect()->to('dashboard');
		 }
		 else{
		 	session()->setFlashdata('salah', 'Username atau Password salah');
		 	return redirect()->to('index');
		 }
		 
	}	

	public function logout(){
		session()->destroy();
		return redirect()->to('index');
	}

	public function dashboard(){
		$mhs = new MahasiswaModel();		
		$dsn = new DosenModel();
		$ruang = new RuanganModel();
		$mtkl = new MatkulModel();

		// Data 
		$jmhs = $mhs->countAll();
		$jdsn = $dsn->countAll();
		$jruang = $ruang->countAll();
		$jmtkl = $mtkl->countAll();
						
		// Parsing data ke view dashboard
		$data['jumlah_dosen'] = $jdsn;
		$data['jumlah_mhs'] = $jmhs;
		$data['jumlah_matkul'] = $jmtkl;
		$data['jumlah_r'] = $jruang;

		$data['page'] = view('admin/dashboard_view', $data);

		echo view('admin/homepage_view', $data);					
	}

	
}