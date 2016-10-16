<?php
class problem_model extends CI_Model {

    /*!
      constructor to load database.
    */
	  public function __construct()
    {
        $this->load->database();
    }
    //! getuser Function :
    /*!
      gets all the user data
    */

    public function getuser()
    {
    	$query = $this->db->get('user');
       	return $query->result_array();

    } 
    //! insert_problem Function :
    //! @param $prob : an array with all information of a problem to be inserted
     /*!
        inserts a new problem into the database
    */

    public function insert_problem($prob)
    {
      $id ="";
      $statement = $prob[0]['description'];
      $vote_count = 0;
      $reported_info = " ";
      $sec_id = $prob[0]['opt_sec'];
      $title = $prob[0]['title'];
      $answer = $prob[0]['answer'];
      $uid = $prob[0]['admin_id'];
      $point = $prob[0]['point'];
      $info= array (
              'problem_id' => $id,
              'statement' => $statement,
              'vote_count' => $vote_count,
              'reported_info' => $reported_info,
              'sec_id' => $sec_id,
              'title' => $title,
              'answer' => $answer,
              'problem_setter' => $uid ,
              'point' => $point
            );

          $this->db->insert('problem',$info);
    }
    //! get_category Function :
     /*!
      loads all the category from database
    */
    public function get_category()
    {
      $query = 'Select * From Category';
      $result = $this->db->query($query)->result_array();
      return $result;
    }
    //! get_a_category name Function :
    //! @param $cid : category_id
     /*!
      returns a category name of the given category id
    */
    public function get_a_category_name($cid)
    {
      $query = "Select category_name from Category where category_id = ?";
      $result = $this->db->query($query, $cid)->row_array();
      return $result['category_name'];
    }
    //! get_category_by_section Function : 
    //! @param $sid : section_id
     /*!
      returns the category name of the given section id
    */
    public function get_category_by_section($sid)
    {
      $query = "Select category_name from Category where category_id = (Select cat_id from Section where section_id = ?)";
      $result =  $this->db->query($query, $sid)->row_array();
      return $result['category_name'];
    }
    //! get_sections Function :
     /*!
      loads all sections from database
    */
    public function get_sections()
    {
      $query = 'Select * From Section';
      $result = $this->db->query($query)->result_array();
      return $result;
    }
    //! get_a_section Function :
    //! @param $cat : category_id
     /*!
      returns all sections of a provided category id
    */

    public function get_a_section($cat)
    {
      $query = 'Select section_name, section_id From Section Where cat_id = ?';
      $result = $this->db->query($query,$cat)->result_array();
      return $result;
    }
    //! getlast Function :
    //! @param $user : an array with two param user_id & problem_id
     /*!
      returns last added problem with problem setter name and topic tags
    */
    public function getLast($user)
    {
      $query = "select * from problem order by problem_id DESC limit 1";
      $res=$this->db->query($query)->result_array();
      $q['user_id'] = $user;
      $q['problem_id'] = $res[0]['problem_id'];
      $res[0]['solved'] = $this->is_solved($q);
     // print_r($res);
      return $res;
    }
    //! topProblems Function :
    //! @param $uid : user_id
     /*!
      returns top 5 problems based on likes by the user
    */
    public function topProblems($uid)
    {
      $q['user_id'] = $uid;
      $query = "select * from problem order by vote_count DESC limit 5";
      $res=$this->db->query($query)->result_array();
      for($i=0; $i<sizeof($res); $i++) {
        $setter = $this->get_problem_setter($res[$i]['problem_id']);
        $tag = $this->get_topic_tag($res[$i]['problem_id']);
        $res[$i]['setter'] = $setter;
        $res[$i]['cat'] = $tag['cat'];
        $res[$i]['sec'] = $tag['sec'];

        $q['problem_id'] = $res[$i]['problem_id']; //to check if it is solved
        $res[$i]['solved'] = $this->is_solved($q);
      }
      return $res;
    }
    //! is_solved Function :
    //! @param $info : an array with two param user_id & problem_id
     /*!
      checks if a problem is solved by the current user
    */
    ///check if a problem is solved by a specific user
    public function is_solved($info) /// info = user_id + problem_id
    {
      $query = "Select * from solvedproblems where user_id=? and problem_id=?"; ///check if the problem is solved by this user
      $pq = $this->db->query($query, $info)->row_array();
      //print_r($pq);
      //echo "here";
      if($pq)
      {
        return 1;
      }
      else
        return 0;
    }
    //! validate Function :
    //! @param $info : an array with two param user_id & problem_id
     /*!
      checks the answer of a problem provided by the user with the true value
    */
    public function validate($info)
    {
          $query = array('problem_id'=>$info['problem_id'], 'answer' =>$info['result']);
          $this->db->select('*');
          $this->db->where ($query);
          $num = $this->db->get('problem');
          return $num->num_rows();
    }
     //! solved_a_problem Function :
    //! @param $info : an array with two param user_id & problem_id
     /*!
      stores the information when a user solves a problem
    */
    public function solved_a_problem($info)
    {
      $query = "Insert into solvedproblems values('', ?, ?)";
      $q['user_id'] = $info['user_id'];
      $q['problem_id'] = $info['problem_id'];
      $q_res = $this->db->query($query, $q);

      $this->point_calc($info);


    }

    public function point_calc($info)
    {
      $query = "Select cat_id from section where section_id = (Select sec_id from problem where problem_id = ?)";
      $result = $this->db->query($query,$info['problem_id'])->row_array();

      $query = "Select point from problem where problem_id = ?";
      $point = $this->db->query($query, $info['problem_id'])->row_array();

      $para['point'] = $point['point'];
      $para['user_id'] = $info['user_id'];
      $para['category_id'] = $result['cat_id'];
      
      $query = "Update points set point=point+? where user_id=? and category_id=?";
        
      $this->db->query($query, $para);
    }
    ///problems with topic tag
    public function getProb($inf)
    {

      $info = array ('sec_id'=> $inf['sec_id']);
      $this->db->select('*');
      $this->db->where($info);
      $num = $this->db->get('problem')->result_array();
      for($i=0; $i<sizeof($num); $i++) {
        $param['user_id'] = $inf['user_id'];
        $param['problem_id'] = $num[$i]['problem_id']; ///parameter to check if the problem is solved
        $setter = $this->get_problem_setter($num[$i]['problem_id']);
        $tag = $this->get_topic_tag($num[$i]['problem_id']);
        $num[$i]['setter'] = $setter;
        $num[$i]['cat'] = $tag['cat'];
        $num[$i]['sec'] = $tag['sec'];
        $num[$i]['solved'] = $this->is_solved($param);

      }
      return $num; 

    }

    public function get_section_name($id)
    {
      $query="Select section_name from section where section_id=?";
      $name = $this->db->query($query,$id)->row_array();
      return $name;
    }
    ///maintain one like for each user
    public function add_a_like($like)
    {
      $query = "Select * From Likes where problem_id=? and liker_id=?";
      $liker['problem_id'] = $like['problem'];
      $liker['liker_id'] = $like['user'];
      $r = $this->db->query($query, $liker)->row_array();
      print_r($r);
      if($r)
        echo "You have already liked it once!!!";
      
      else
      {
        $this->update_vote_count($like['problem']);
        $query = "Insert Into Likes values('', ?, ?)";
        $this->db->query($query, $liker);
        echo " updated count";
      }
        
    }

    public function update_vote_count($id)
    {
      $query = "Update Problem Set vote_count=vote_count+1 where problem_id=?";
      $this->db->query($query, $id); 
      echo "vote count done";
    }
    //.get the problem setter name(id)
    public function get_problem_setter($pid)
    {
      $query = "Select problem_setter from problem where problem_id=?";
      $uid = $this->db->query($query, $pid)->row_array();
      $query = "Select fullname from User where user_id=?";
      $problem_setter = $this->db->query($query,  $uid['problem_setter'])->row_array();
      return $problem_setter['fullname'];
    }
    ///get topic tags for a problem
    public function get_topic_tag($pid)
    {
      $query = "Select sec_id from problem where problem_id=?";
      $sid = $this->db->query($query, $pid)->row_array();
      $query = "Select section_name, cat_id from section where section_id=?";
      $section = $this->db->query($query, $sid['sec_id'])->row_array();
      $query = "Select category_name from category where category_id=?";
      $category = $this->db->query($query, $section['cat_id'])->row_array();
      $topic['cat'] = $category['category_name'];
      $topic['sec'] = $section['section_name'];
      return $topic;

    }

    public function get_solution_methods($pid)
    {
      $query = "Select * from solutionmethod where problem_id=?";
      $out = $this->db->query($query, $pid)->result_array();
      //print_r($out);
      for ($i=0; $i<sizeof($out); $i++) {
        
        $query = "Select title from problem where problem_id = ?";
        $prid = $this->db->query($query, $out[$i]['problem_id'])->row_array();
        $out[$i]['title'] = $prid['title'];
        $query = "Select fullname from user where user_id=?";
        $solver = $this->db->query($query, $out[$i]['user_id'])->row_array();
        $out[$i]['solver'] = $solver['fullname'];
        //print_r($k);
      }
      //print_r($out);
      return $out;
    }

  public function loadStatistics($id)
  {
    $query = " Select * from points where user_id=?";
    $out = $this->db->query($query, $id)->result_array();

    for($i=0;$i<sizeof($out);$i++)
    {
      $query = "Select category_name from category where category_id=?";
      $cname = $this->db->query($query, $out[$i]['category_id'])->row_array();
      $out[$i]['cat_name'] = $cname['category_name'];
      $out[$i]['level'] = $this->checkLevel($out[$i]['point']);
    }
    return $out;
  }

  public function checkLevel($point)
  {
    if($point<=1000)
        return "BEGINNER";
    else if($point <=2500)
      return "INTERMEDIATE";
    else
      return "EXPERT";
  }

}