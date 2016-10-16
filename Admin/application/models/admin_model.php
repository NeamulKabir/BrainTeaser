<?php
class admin_model extends CI_Model {
       /*!
       constructor to load database
        */
		  public function __construct()
        {
                $this->load->database();
        }
        //! getuser Function :
       /*!
              gets all user data from database
        */
       public function getuser()
       {
       		$query = $this->db->get('user');
       		return $query->result_array();

       } 
       //! loginvalidation Function :
       /*!
       matches username & password provided by a user to log him in
        */
       public function loginvalidation($test)
       {
       		//echo $test[0]['username'];
       		$info = array('user_name'=>$test[0]['username'],'password'=>$test[0]['password']);
       		$query = "Select * from admin where username=? and password=?";
          $num = $this->db->query($query, $info)->row_array();
          if($num)
       		 return 1;
          else
            return 0;

       }
       //! insert_new Function :
       /*!
              adds a new user after sign up
        */
       public function insert_new($test2)
       {

       		$fullName= $test2[0]['firstname']." ".$test2[0]['lastname'];
       		$user_name = $test2[0]['user_name'];
       		$email = $test2[0]['email'];
       		$age = $test2[0]['age'];
       		$password = $test2[0]['passwd'];

       		$info= array (
       				'user_name' => $user_name,
       				'fullName' => $fullName,
       				'password' => $password,
       				'email' => $email,
       				'age' => $age

       			);

       		$this->db->insert('user',$info);
          $query = "Select user_id from user where user_name = ?";
          $id = $this->db->query($query, $user_name)->row_array();
          $this->insert_point_entry($id['user_id']);
       }

       public function insert_point_entry($id)
       {
          $query = "Select * from category";
          $cat = $this->db->query($query, $id)->result_array();
          foreach ($cat as $c) {
            $query = "Insert into points values('',0,?,?)";
            $p['user_id'] = $id;
            $p['category_id'] = $c['category_id'];
            $this->db->query($query, $p);
          }
       }
       //! get_profile Function :
       /*!
              gets all profile info of a user
        */
       public function get_profile($test)
       {
       		 // $query = $this->db->get_where('USER',array('user_name' => $test1[0]['display_name']));
       		$username = $test['username'];
       		$info  = array('username' => $username );
       		$query = $this->db->get_where('admin',$info);
       		return $query->result_array();

       }
       //! editPassword Function :
       /*!
              changes password and stores in the database
        */
       public function editPassword($info)
       {
       		//print_r($info);
       		$data = array (
       				'password' => $info['pass']
       			);
       		$this->db->where('user_name',$info['username']);
       		$this->db->update('user',$data);


       }
       //! get_username Function :
       /*!
              returns user name of a user by user id
        */
       public function get_username($id)
       {
              $query = "Select fullname from User where user_id=?";
              $name = $this->db->query($query, $id)->row_array();
              return $name['fullname'];

       }

       public function addCategory($cat)
       {
          $query = "Insert into category values('', ?)";
          $this->db->query($query, $cat[0]['category']);
       }

       public function addSection($input)
       {
          $query = "Select category_id from category where category_name=?";
          $cat = $this->db->query($query, $input[0]['category'])->row_array();

          $query = "Insert into section values('', ?, ?)";
          $param['section_name'] = $input[0]['section'];
          $param['cat_id'] = $cat['category_id'];
          $this->db->query($query, $param);
       }

       public function addAdmin($in)
       {
          $query = "Insert into admin values('', ?, ?)";
          $para['username'] = $in[0]['username'];
          $para['password'] = $in[0]['password'];
          $this->db->query($query, $para);
       }

}