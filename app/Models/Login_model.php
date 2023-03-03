<?php 
namespace App\Models;
use CodeIgniter\Model;
 
class Login_Model extends Model
{
   protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['fullname', 'email','password','created_at','updated_at'];

  
    public function get_data($email, $password)
	{
      return $this->db->table('users')
      ->where(array('email' => $email, 'password' => $password))
      ->get()->getRowArray();
	}

      public function getalldata(){
            return $this->db->table('users')
            ->select('fullname', 'email','password','created_at','updated_at')
            ->get()->getRowArray();
      }

       
}
?>