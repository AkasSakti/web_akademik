<?php 
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MahasiswaModel;
use App\Models\JadwalModel;
use App\Models\DosenModel;
use App\Models\MatkulModel;
use App\Models\NilaiModel;

class Mahasiswa extends Controller
{
	function __construct(){
		$this->mhs = new MahasiswaModel();
		$this->jadwal = new JadwalModel();
		$this->n_mhs = new NilaiModel();
	}

    public function index()
    {
    	if(session('logged_in') == "mahasiswa"){
    		return redirect()->to('mahasiswa/dashboard');
    	}
        return view('mahasiswa/login_view');
    }    

    public function login(){    
    	 $nim = $this->request->getPost('nim');
    	 $password = $this->request->getPost('password');

    	 $where = array(
			'nim' => $nim,			
			'password' => $password
		 );

		 $user = $this->mhs->cek_login("mahasiswa", $where);
		
		 $logged_in_mhs = $user->getFirstRow();	
		 if($logged_in_mhs != null){
		 	session()->set('logged_in', "mahasiswa");
			session()->set('nim', $logged_in_mhs->NIM);
			session()->set('nama', $logged_in_mhs->Nama_Mhs);

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
		// Data IPK dan SKS
		$nim = session()->get('nim');
		$nilai = $this->n_mhs->get_nilai_mahasiswa($nim);
		$ipk = $this->n_mhs->calculate_ipk($nilai);		

		// Data Jadwal Hari ini
		$hari = date("w");		
		$jadwal_mhs = $this->jadwal->get_jadwal_mahasiswa($nim, $hari);
		
		// Parsing data ke view dashboard
		$data['ipk'] = $ipk['ipk'];
		$data['sks'] = $ipk['sks'];
		$data['jadwal'] = $jadwal_mhs;
		$data['page'] = view('mahasiswa/dashboard_view', $data);

		echo view('mahasiswa/homepage_view', $data);					
	}

	public function dosen(){
		$dsn = new DosenModel();

		$nim = session()->get('nim');

		// Data dosen yang mengajar
		$list_dosen = $dsn->get_dosen_mahasiswa($nim);

		// Parsing data ke view dosen		
		$data['dosen'] = $list_dosen;
		$data['page'] = view('mahasiswa/dosen_view', $data);

		echo view('mahasiswa/homepage_view', $data);	
	}

	public function matkul(){
		$mtkl = new MatkulModel();

		$nim = session()->get('nim');

		// Data mata kuliah yang diambil
		$list_matkul = $mtkl->get_matkul_mahasiswa($nim);

		// Parsing data ke view dosen		
		$data['matkul'] = $list_matkul;
		$data['page'] = view('mahasiswa/matkul_view', $data);

		echo view('mahasiswa/homepage_view', $data);	
	}

	public function nilai(){		
		$nim = session()->get('nim');

		// Data nilai yang diambil
		$list_nilai = $this->n_mhs->get_nilai_mahasiswa($nim);

		// Parsing data ke view dosen		
		$data['nilai'] = $list_nilai;
		$data['page'] = view('mahasiswa/nilai_view', $data);

		echo view('mahasiswa/homepage_view', $data);	
	}

	// CRUD Mahasiswa (Admin)
	public function show()
    {    	    	
    	$list_mahasiswa = $this->mhs->get_all_mahasiswa();    

    	$data['mahasiswa'] = $list_mahasiswa;

        $data['page'] = view('admin/mahasiswa_view', $data);
        echo view('admin/homepage_view', $data);
    }        

    public function insert(){    	    	
    	$nim = $this->request->getPost('nim');
    	$nama = $this->request->getPost('nama');
    	$tingkat = $this->request->getPost('tingkat');
    	$alamat = $this->request->getPost('alamat');
    	$password = $this->request->getPost('password');

    	$data = [    		
		    'nim' => $nim,
		    'nama' => $nama,
		    'tingkat' => $tingkat,
		    'alamat' => $alamat,
		    'password' => $password
		];
		$result = $this->mhs->insert_mhs($data);

		// Jika Input Data gagal
		if($result != 1){
			session()->setFlashdata('gagal', 'Input Data Gagal');
		}
		
		return redirect()->to(base_url('mahasiswa/show'));   
    }

    public function update(){    	
    	$old_nim = $this->request->getPost('old_nim');
    	$nim = $this->request->getPost('nim');
    	$nama = $this->request->getPost('nama');
    	$tingkat = $this->request->getPost('tingkat');
    	$alamat = $this->request->getPost('alamat');

    	$data = [
    		'old_nim' => $old_nim,
		    'nim' => $nim,
		    'nama' => $nama,
		    'tingkat' => $tingkat,
		    'alamat' => $alamat
		];
		$result = $this->mhs->update_mhs($data);

		//Jika Update Data gagal
		if($result != 1){
			session()->setFlashdata('gagal', 'Update Data Gagal');
		}
		
		return redirect()->to(base_url('mahasiswa/show'));	
    }

    public function delete($nim)
    {   		
    	$result = $this->mhs->delete_mhs($nim);

    	//Jika Delete Data gagal
		if($result != 1){
			session()->setFlashdata('gagal', 'Delete Data Gagal');
		}
		
		return redirect()->to(base_url('mahasiswa/show'));	        
    }
}