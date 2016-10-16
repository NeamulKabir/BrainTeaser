<?php
class brain_model extends CI_Model {
       /*!
       constructor to load database
        */
		  public function __construct()
        {
                $this->load->database();
        }
       
        //! getuser Function :
       /*!
              gets data of the all users from User table in database
        */
       public function getuser()
       {
       		$query = $this->db->get('user');
       		return $query->result_array();

       } 

     
       //! loginvalidation Function :
       //! @param $test contains the login info that has been submitted.
       /*!

          Matches username & password provided by a user to log him in. First the involved user info need to be fetched. Then 
          it was checked against the submitted info. 
        */
       public function loginvalidation($test)
       {
       		//echo $test[0]['username'];
       		$info = array('user_name'=>$test[0]['username'],'password'=>$test[0]['password']);
       		$this->db->select('*');
       		$this->db->where ($info);
       		$num = $this->db->get('user');
       		//print_r($num);
       		//echo $num->num_rows();
       		return $num->num_rows();

       }


       //! signupValidation Function :
       //! @param $test contains the signup info that has been submitted.
       /*!
              Here it was made sure whether the user name that has been provided is already in use.
        */
       public function signupValidation($test)
       {

       		$info = array('user_name'=>$test[0]['user_name']);
       		$this->db->select('*');
       		$this->db->where ($info);
       		$num = $this->db->get('user');
       		//print_r($num);
       		//echo $num->num_rows();
       		return $num->num_rows();

       }

       //! insert_new Function :
       //! @param $test2 contains all the info needed to create an entry in user table.
       /*!
              Adds a new user after sign up. Also invoke the function to make entry in point table.
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



       //! insert_point_entry Function :
       //! @param $id contains the user id for whome point_table entry is to be created
       /*!
              Adds an entry in point table for a user for each category.
        */
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
       //! @param $test contains user_info
       /*!
              Gets all info of a user
        */
       public function get_profile($test)
       {
       		 // $query = $this->db->get_where('USER',array('user_name' => $test1[0]['display_name']));
       		$username = $test['username'];
       		$info  = array('user_name' => $username );
       		$query = $this->db->get_where('user',$info);
       		return $query->result_array();

       }


       //! editPassword Function :
       //! @param $info contains the user info
       /*!
              Changes password and updates in the database
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
       //! @param $id contains user id of a user
       /*!
              returns user name of a user by user id
        */
       public function get_username($id)
       {
              $query = "Select fullname from User where user_id=?";
              $name = $this->db->query($query, $id)->row_array();
              return $name['fullname'];

       }

}