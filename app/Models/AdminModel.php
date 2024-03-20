<?php 
namespace App\Models;
use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'username';

    protected $allowedFields = ['ID_Dosen', 'Password_Admin'];    

    // Pengecekan Login
    public function cek_login($table, $data){
    	$db = db_connect();
    	
      $data = $db->query("SELECT * FROM admin where username='$data[username]' AND Password_Admin='$data[password]'");

      return $data;
    }
}