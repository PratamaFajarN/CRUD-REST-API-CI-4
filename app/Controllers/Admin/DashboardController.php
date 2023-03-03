<?php

namespace App\Controllers\Admin;

use App\Models\Login_Model;
use CodeIgniter\Controller;

class DashboardController extends Controller{
   
   
    protected $Login_model;

     public function __construct()
        {
            $this->Login_model = new Login_model();
        }




    public function index()
    {
         $link = current_url().'/';
       
            $data = array(
                'getdatauser' => $link.'getdatauser/',  
                'getdatauserpost' => $link.'getdatauserpost/',   
                'updatedatauser' => $link.'updatedatauser/', 
                'deleteuser'     => $link.'deleteuser/',
            );
       
          return view('admin/dashboard/getdata',$data);
    }

     public function getdatauser()
    {
        $usersModel = new Login_model();

        $data['data'] = $usersModel->findAll();

        return $this->response->setJSON($data);
    }

    public function updatedatauser()
    {
        $userModel = new Login_model();
        $id = $this->request->getVar('id_user');
        $data = [
      
            'fullname' => $this->request->getVar('fullnames'),
            'email'  => $this->request->getVar('emails'),
        ];
        $userModel->update($id, $data);
      

        return $this->response->setJSON($userModel);
    }

    public function deleteuser()
    {
         $id = $this->request->getVar('id_user');
        $userModel = new Login_model();
        $data['user'] = $userModel->where('id', $id)->delete($id);
  
        return $this->response->setJSON($userModel);
    }

     public function getdatauserpost()
    {
         $usersModel = new Login_model();
         $des =   $data['data'] = $usersModel->findAll();
         

        $dataArray = array();
        foreach($des as $row){
           $id = $row['id'];
            $fullname = $row['fullname'];
            $email = $row['email'];
             $created_at = $row['created_at'];
             $updated_at = $row['updated_at'];
             $deleted_at = $row['deleted_at'];
    
       

        $temp_data = [
                    'id' => $id,
                    'fullname' => $fullname,
                    'email'  => $email,
                    'created_at'  =>  $created_at,
                    'updated_at'  =>  $updated_at,
                    'deleted_at'  =>  $deleted_at,
        ];
         array_push($dataArray, $temp_data);
        
           }  
          $draw_json = [
            'data' => $dataArray,
          ];
          return $this->response->setJSON($draw_json);
    }
}