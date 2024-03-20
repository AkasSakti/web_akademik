<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
 
class MahasiswaLoginFilter implements FilterInterface
{
    public function before(RequestInterface $request,  $arguments = null)
    {
        if (!session('logged_in') || session('logged_in') != "mahasiswa") 
        {
            return redirect()->to(base_url('mahasiswa'));
        }    
    }
 
    //--------------------------------------------------------------------
 
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}