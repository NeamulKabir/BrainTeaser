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
        Inserts a new problem into the database
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
      $uid = $prob[0]['user_id'];
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
      Retrieve and returns all the category from database
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
      Retrieve and returns a category name of the given category id from database.
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
      Retrieve and returns the category name of the given section id fronm database
    */
    public function get_category_by_section($sid)
    {
      $query = "Select category_name from Category where category_id = (Select cat_id from Section where section_id = ?)";
      $result =  $this->db->query($query, $sid)->row_array();
      return $result['category_name'];
    }
   

    //! get_sections Function :
     /*!
      Retrieves and returns all sections from database
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
      Retrieve and returns all sections of a provided category id from database.
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
      Retrieve last added problem with problem setter name and topic tags. After that another call to is_solved is made to know whether it was already
      solved by the user. Returns the problem with solved info.
      Return :
      1. problem description
      2. solving info.
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
      Retrieve top 5 problems based on likes by the user from database. Then each problem is taged with solving info of the user. 
      the return it.
      Return : 
      1.problem info
      2. problem setter name
      3. category name
      4. section name
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
      Returns : boolean value 1 for solved
      * 0 for unsolved
    */
   
    public function is_solved($info) 
    {
      $query = "Select * from solvedproblems where user_id=? and problem_id=?"; 
      $pq = $this->db->query($query, $info)->row_array();
      
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
      Retrieve the rows with problem id and answer from the database. and returns it.
      Return : 
      number of rows.
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


    //! Point Calculation Function :
    //! @param $info: contains all info of a problem that has been solved.
    /*!
        First gets the category of that problem. Then with that info gets the allocated point of that problem type . The 
        update the points inthe point table of a user for that category.
    */

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

    //! getprob Function :
    //! @param $inf: contains sec_id and User id
    /*!
        Retrieve all the problems under that section.
        Return:
        1. problem description
        2. setter name
        3. section name
        4. category name
        5. solving info
    */

   
    public function getProb($inf)
    {

      $info = array ('sec_id'=> $inf['sec_id']);
      $this->db->select('*');
      $this->db->where($info);
      $num = $this->db->get('problem')->result_array();
      for($i=0; $i<sizeof($num); $i++) {
        $param['user_id'] = $inf['user_id'];
        $param['problem_id'] = $num[$i]['problem_id']; 
        $setter = $this->get_problem_setter($num[$i]['problem_id']);
        $tag = $this->get_topic_tag($num[$i]['problem_id']);
        $num[$i]['setter'] = $setter;
        $num[$i]['cat'] = $tag['cat'];
        $num[$i]['sec'] = $tag['sec'];
        $num[$i]['solved'] = $this->is_solved($param);

      }
      return $num; 

    }
    //! get_section_name Function :
    //! @param $id: section id
    /*!
        Returns: 
        section name.
    */

    public function get_section_name($id)
    {
      $query="Select section_name from section where section_id=?";
      $name = $this->db->query($query,$id)->row_array();
      return $name;
    }

    //! add_a_like Function: 
    //! @param $like: contain problem id and liker id
    /*!
        update liker table if user has not already vote it once. if not invoke update vote count function. 
    */
    ///maintain one like for each user
    public function add_a_like($like)
    {
      $query = "Select * From Likes where problem_id=? and liker_id=?";
      $liker['problem_id'] = $like['problem'];
      $liker['liker_id'] = $like['user'];
      $r = $this->db->query($query, $liker)->row_array();
      if($r)
          echo "<script type='text/javascript'>alert('You have already liked it once!!')</script>";
      
      else
      {
        $this->update_vote_count($like['problem']);
        $query = "Insert Into Likes values('', ?, ?)";
        $this->db->query($query, $liker);
       echo "<script type='text/javascript'>alert('Thanks for voting!!')</script>";
      }
        
    }
    public function get_Section($id)
    {
      $query="Select sec_id from problem where problem_id = ?";
      $out = $this->db->query($query, $id)->row_array();
      return $out['sec_id'];
    }

    //! update_vote_count Function :
    //! @param $id: problem_id
    //! update the vote count increased by 1.

    public function update_vote_count($id)
    {
      $query = "Update Problem Set vote_count=vote_count+1 where problem_id=?";
      $this->db->query($query, $id); 
      
    }

    //! get_problem_setter Function :
    //! @param $pid: problem_id
    //! Retrieve the problem Setter name from database
    /*!
      Return:
      Problem Setter name.
    */
  
    public function get_problem_setter($pid)
    {
      $query = "Select problem_setter from problem where problem_id=?";
      $uid = $this->db->query($query, $pid)->row_array();
      $query = "Select fullname from User where user_id=?";
      $problem_setter = $this->db->query($query,  $uid['problem_setter'])->row_array();
      return $problem_setter['fullname'];
    }

    //! get_topic_tag Function :
    //!@param $pid: problem_id
    /*!
        Retrieve the category name and section name of a problem.
        Return :
        1. category name
        2. Section name
    */
   
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


    //! get_solution_method Function :
    //! @param $pid: problem_id
    /*!
        retrieve the solution method from databse with title and solver name
        Return :
        1. solution methods
        2. problem title
        3. solver name
    */
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
        
      }
   
      return $out;
    }



    //! loadstatistics Function:
    //! @param $id: user_id
    /*!
        Retrieve the points and levels of a user per category.
        Return :
        1. points
        2. levels
        3. category name
    */

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


  //! checkLevels Function:
  //! @param $points: points value
  /*!
      based on pints we assign a level
      Levels:
      1.BEGINNER
      2.INTERMEDIATE
      3.EXPERT
  */
  public function checkLevel($point)
  {
    if($point<=1000)
        return "BEGINNER";
    else if($point <=2500)
      return "INTERMEDIATE";
    else
      return "EXPERT";
  }

  public function deduct_points($param)
  {
    $query = "Select * from solvedproblems where user_id=? and problem_id=?";
    $out = $this->db->query($query, $param)->row_array();
    if($out)
      echo "everything fine";
    else
    {
      $query = "Insert Into solvedproblems values('', ?, ?)";
      $this->db->query($query, $param);
    }
  }

}