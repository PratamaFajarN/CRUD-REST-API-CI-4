<?php

namespace App\Controllers\Admin;

use App\Models\Login_Model;
use CodeIgniter\Controller;

class LoginController extends Controller{

    protected $Login_model;

     public function __construct()
        {
            $this->Login_model = new Login_model();
        }


    public function index()
    {
         helper(['form']);
         $link = current_url().'/';
       
            $data = array(
                'register' => $link.'register/',     
            );
          return view('admin/loginhandler/formlogin', $data);
    }
     public function loginAuth(){
        $usersModel = new Login_model();
		$email = $this->request->getPost('email');
	    $password = md5($this->request->getPost('password'));
	    $user = $usersModel->where('email', $email)->first();

	    if(empty($user)){
	    	session()->setFlashdata('message', 'email atau Password Salah');
	    	return redirect()->to('/');
	    }
	    if($user['password']!=$password){
	    	session()->setFlashdata('message', 'email atau Password Salah');
	    	return redirect()->to('/');
	    }
	    session()->set('email',$email);
	    return redirect()->to('dashboard');
        
     }
     public function register(){
        
        $model =  new Login_model;
        $data = [
            'fullname' => $this->request->getVar('fullnamesend'),
            'email'  => $this->request->getVar('emailsend'),
             'password'  => md5($this->request->getVar('passwordsend')),
        ];
        $model->insert($data);
       
        return $this->response->setJSON($data);

    }
}
