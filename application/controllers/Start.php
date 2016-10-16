<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*!

*/

class Start extends CI_Controller {

	public $userinfo; /*!< holds the user info of current user    */
	public $loginInfo; /*!<  holds the loginfo of the user   */
	public $user;     /*!<  contains user_id   */
	/*!
	Constructor only loads the essential library, model and helper. 
	Also here we initialize the loginInfo by the session data.
	*/
	 public function __construct()
        {
                parent::__construct();
                $this->load->model('brain_model');
                $this->load->helper('form');
                $this->load->library('session');
                $this->load->helper('url');
                $this->load->helper('html');
                $this->load->library('form_validation');
              	$this->load->model('problem_model');
              	$this->load->model('forum_model');
              	$this->loginInfo = $this->session->all_userdata();
              	
        }
    /*!
		This is the first called function. 
		By default it is called by the controller funtion when it loads.
		Here the 1st page of our website is set to be loaded.
	*/

	public function index()
	{
		$this->load->view('teaser');
	}

	//! Sign up function : 
	/*!
		It loads the view page signup with a parameter. parameter is passed in a indexed array. In the loaded page the 
		index only used as the variable.*/
		/*!fail = 0   	; when user name already exists*/
		/*!fail = 1 	; when success its by default*/
		/*!fail = 2	; when password doesnt match confirming password*/



	public function signup()
	{
		$data['fail'] = 1;
		$this->load->view('signup',$data);
	}

	//! Login Function :
	/*!
		It loads the login page only.

	*/

	public function login()
	{
		$this->load->view('login');
	}

	//! login confirm Function:
	/*!
		It is called from the login page when a user submits his/her login info.
		Here the login info is checked. 
		1. if already a session is running on this username.
		2. then info is checked against the database data. if ok we set the session data.
		3. else we redirect the user to login page. 
	*/

	public function login_confirm()
	{
		$this->userinfo = array($this->input->post());
     	//print_r($this->userinfo);

     	if (isset($_SESSION['username']))
            {
                //die("logOut first");
                redirect('start/home');
            }

     	 else
     	 {
     	 	$loginInfo = array($this->input->post());
         	$num= $this->brain_model->loginvalidation($loginInfo);
                    // //$num = 1;
            echo $num;
            if($num==1)
            {
         		$this->session->set_userdata ('username',$loginInfo[0]['username']);

                redirect('start/home');
            }
         
            else
             {
                echo "<script type='text/javascript'>alert('Login failed!!! Try again')</script>";	
                redirect('start/login'); // ridirect to login page


            }
     	 }

	}

	//! Logout Function :
	/*!
		It destroys the running session . Redirect the user to 1st page. 
		sess_destroy is a buit in process in codeigniter framework.
	*/


	public function logout()
	{
			echo 'LogOut is successful.<br>';
           $this->session->sess_destroy();
         	redirect('start/index');
	}

	//! Signup Confirm Function :

	/*!
	This function handles the new user information and registration. It validates the userinfo. It also prompts the user
	whether he/she needs to change some of his/her info. 
	1. first checking the info already exists or not
	2. then password matching

	
	*/


	public function signup_confirm()
	{
		$this->userinfo = array($this->input->post());
		$test = $this->userinfo;
		$num = $this->brain_model->signupValidation($this->userinfo);
         
		if ($test[0]['passwd'] != $test[0]['conPasswd'])
		{
			$data['fail'] = 2;
			$this->load->view('signup',$data);
		}


         
        elseif($num==0)
            {
                $this->brain_model->insert_new($this->userinfo);
                $this->session->set_userdata ('username',$this->userinfo[0]['user_name']);

               redirect('start/home');
            }
 
            else
            {
                // ridirect to register page
               $data['fail'] = 0;
                
              $this->load->view('signup',$data);
            }  
           
       // print_r($this->userinfo);
       
        //$info= $this->brain_model->getuser();

        //print_r($info);
		//$this->load->view ('home') ;
		//redirect('start/home');
	}
	
	//! Home Function: 
	/*!
		This function handles the loading of home page. Along with it loads necessary data from the database to the home page.
		1. get the user id
		2. get the categories
		3. get the last added problem
		4. get the top rated problems*/
		/*! Then it loads all the data in a array. It then passed in the home page to show.*/

	public function home()
	{

		$this->userinfo = $this->brain_model->get_profile($this->loginInfo);
		//print_r($this->userinfo);
        $this->user = $this->userinfo[0]['user_id']; ///get user id to check solved problem

        $categories = $this->problem_model->get_category(); ///get all categories to show in home

		$new = $this->problem_model->getLast($this->user); ///get last added problem
		$top= $this->problem_model->topProblems($this->user);
		//$num= $new->num_rows();
		if($new)
		{
			$data['title'] = $new[0]['title'];
			$data['statement']= $new[0]['statement'];
			$data['p_id']= $new[0]['problem_id'];
			$data['problem_setter'] = $this->problem_model->get_problem_setter($new[0]['problem_id']);
			$data['vote_count'] = $new[0]['vote_count'];
			$topics = $this->problem_model->get_topic_tag($new[0]['problem_id']);
			$data['category'] = $topics['cat'];
			$data['section'] = $topics['sec'];
			$data['solved'] = $new[0]['solved'];
			$data['categories'] = $categories;
			$data['point'] = $new[0]['point'];
		}
		else 
			$data['statement']= "No problem is there.";

		$data['top'] = $top;
		$this->load->view('home',$data);
	}


	//! profile Function :
	/*!
		This function retrieve the user info from the database and load it to profile page.

	*/



	public function profile()
	{
		$categories = $this->problem_model->get_category();
		$data['categories'] = $categories;

		$this->loginInfo = $this->session->all_userdata();
		$data['profile']= $this->brain_model->get_profile($this->loginInfo);
		$this->load->view('profile',$data);
	}

	//! Edit password loading Function (settings) :
	/*!
		This function only loads the edit page with necessary info that is retrieved from the database.
	*/

	public function settings()
	{
		$categories = $this->problem_model->get_category();
		$data['categories'] = $categories;

		$data['done'] = 0;
		$this->load->view('settings',$data);
	}

	//! edit password handling (ePass) :
	/*!
		It ckecks the userinfo and changes the password as requested
		1. checks the old password and submitted old password if same
		2. if it checks out then the password is updated.
	*/

	public function ePass()
	{
		$this->loginInfo = $this->session->all_userdata();
		$pass = array($this->input->post());
		$old = $this->brain_model->get_profile($this->loginInfo);
		if ($old[0]['password'] == $pass[0]['old'])
		{
			$info  = array(
				'username' => $old[0]['user_name'],
				'fullName' => $old[0]['fullName'],
				'email'=> $old[0]['email'],
				'age' => $old[0]['age'],
				'pass' => $pass[0]['new']


			 );
			$this->brain_model->editPassword($info);
			$data['done'] = 1;
			echo "<script type='text/javascript'>alert('Password changed successfully!')</script>";	
			$this->load->view('settings',$data);
		}
		else
			echo "<script type='text/javascript'>alert('Old Password doesn't match!')</script>";	

	}
	//! Topic Load Function :
	//! @param $cid category id 
	/*!
		
		Loads the page of algebra. 
	*/


	public function algebra($cid)
	{
		//echo ".....................................................................";
		//echo $cid;
		$sections = $this->problem_model->get_a_section($cid);
		$data['sections'] = $sections;
		$categories = $this->problem_model->get_category();
		$data['categories'] = $categories;
		$data['cat_name'] = $this->problem_model->get_a_category_name($cid);
		$this->load->view('algebra',$data);
	}

	//! sub topic loader (func) :
	//! @param $id section id 
	/*!
		
		Loads the sub topic page of algebra. 
		1. get user id to check solved problem
		2./get all problems of this section of this user
		3. get all the categories
		4. loads the page with all those data.
	*/

	public function func($id)
	{

		$this->userinfo = $this->brain_model->get_profile($this->loginInfo);
        $this->user = $this->userinfo[0]['user_id']; 
        $inf['user_id'] = $this->user;
        $inf['sec_id'] = $id;

		$res = $this->problem_model->getProb($inf); 
		//print_r($res);
		$categories = $this->problem_model->get_category();
		$data['categories'] = $categories;
		$data['cat_name'] = $this->problem_model->get_category_by_section($id);
		//echo $data['cat_name'];
		$data['problems'] = $res;
		$data['name'] = $this->problem_model->get_section_name($id);

		$this->load->view('function',$data);
	}

	/*!

	*/

	public function statistic()
	{
		$this->userinfo = $this->brain_model->get_profile($this->loginInfo);
        $this->user = $this->userinfo[0]['user_id']; 
        $stat = $this->problem_model->loadStatistics($this->user);

        $data['stat'] = $stat;
		$categories = $this->problem_model->get_category();
		$data['categories'] = $categories;

		$this->load->view('statistic', $data);
	}
	

	//! addProblem Function :
	/*!
		This function loads the page that adds a problem. it takes the categories and corresponding sections in a array 
		and passes it in the loading page. 
	*/

	
	public function addProblem()
	{
		$cat = $this->problem_model->get_category();
		//print_r($cat);
		//$sec = $this->problem_model->get_sections();
		foreach ($cat as $value) {
			$it = 0;
			$sec_c = $this->problem_model->get_a_section($value['category_id']);
			$sections[$value['category_id']] = $sec_c;
			/*foreach ($sec_c as $key) {
				$sections[$value['category_id']][$it] = $key['section_name'];
				$it++;
			}*/
		}
		$data['cat'] = $cat;
		$data['sections'] = $sections;
		

		$this->load->view('addProblem',$data);
	}

	//! add_new_problem Function :
	/*!
		function takes a problem , category and answer as input. Then it inserts it to its corresponding category under specified sub topic
		along with the problem setter id.
	*/

	public function add_new_problem()
	{
		$prob = array($this->input->post());
		print_r($prob);
		$u = $this->brain_model->get_profile($this->loginInfo);
		$prob[0]['user_id'] = $u[0]['user_id'];
		//print_r($prob);
		$num = $this->problem_model->insert_problem($prob);
		//$data['problem_succ'] = 1;
		//$this->load->view('home');
		echo "<script type='text/javascript'>alert('Congrats! The problem is successful added!')</script>";	
		redirect('start/home');
	}

	//! submit_result Function :
	//!@param $id problem id which is being solved
	/*!
		
		It checks if the solution is correct . If correct then it also 
		adds the user info in a table so he/she cant solve the same problem twice.
	*/


	public function submit_result($id)
	{
			$result = $this->input->post();
			$result['problem_id']= $id;
			$u= $this->brain_model->get_profile($this->loginInfo);  ///get user data
			$result['user_id'] = $u[0]['user_id'];

			$res=$this->problem_model->validate($result);
			if ($res == 1){
				echo "<script type='text/javascript'>alert('Congrats!! You've solved it.)</script>";
				$this->problem_model->solved_a_problem($result);
				redirect('start/home');
				//echo "successful\n";
			}
			else
			{
				echo "<script type='text/javascript'>alert('wrong answer!')</script>";	
				redirect('start/home');
			}
			 
	}
	public function submit_result1($id)
	{
			$result = $this->input->post();
			$result['problem_id']= $id;
			$sid = $this->problem_model->get_Section($id);
			$u= $this->brain_model->get_profile($this->loginInfo);  ///get user data
			$result['user_id'] = $u[0]['user_id'];

			$res=$this->problem_model->validate($result);
			if ($res == 1){
				echo "<script type='text/javascript'>alert('Congrats!! You've solved it.)</script>";
				$this->problem_model->solved_a_problem($result);
				redirect('start/func/'.$sid);
				//echo "successful\n";
			}
			else
			{
				echo "<script type='text/javascript'>alert('wrong answer!')</script>";	
				redirect('start/func/'.$sid);
			}
			 
	}
	//! Vote Function (for a problem) :
	//! @param $id problem id which has been voted
	/*!
		
		It handles the voting of a problem its updates the votecount as well as it takes the user info
		so that he/she cant vote twice for the same problem.
	*/


	public function vote_problem($id)
	{
		$u = $this->brain_model->get_profile($this->loginInfo);
		$like['user'] = $u[0]['user_id'];
		$like['problem'] = $id;
		$this->problem_model->add_a_like($like);
		redirect('start/home');
	}

	//! Solution_method ( submitting ):
	//! @param $id problem id whose solution method is being inserted 
	/*!
		
		It takes solution method as input along with the user info.
		It then inserts it in the database.
	*/

	public function solution_method($id)
	{
		$u = $this->brain_model->get_profile($this->loginInfo);
		$result = $this->input->post();
		
		$infos['problem_id'] = $id;
		$infos['solution'] = $result['solutionMethod'];
		$infos['user_id'] = $u[0]['user_id'];
		$query = "Insert into solutionmethod values('', ?, ?, ?)";
		$this->db->query($query, $infos);
		$this->show_solution_method($id);
	}

	//! show_solution_method :
	/*!
		This function retrieve the soltion method and show them in the respective page.
	*/

	public function show_solution_method($p_id)
	{
		
		$categories = $this->problem_model->get_category();
		$data['categories'] = $categories;
		$solves = $this->problem_model->get_solution_methods($p_id);
		if(count($solves)>0)
		{
			$data['solves'] = $solves;
			$query = "Select title from Problem where problem_id = ?";
			$t = $this->db->query($query, $p_id)->row_array();
			$data['title'] = $t['title'];

			$u = $this->brain_model->get_profile($this->loginInfo);
			$param['user_id'] = $u[0]['user_id'];
			$param['pr_id'] = $p_id;
			$this->problem_model->deduct_points($param);
			//print_r($solves);
			$this->load->view('solutionMethod', $data);
		}
		else
			redirect('start/home');
	}

	public function show_solution_method1($p_id)
	{
		
		$categories = $this->problem_model->get_category();
		$data['categories'] = $categories;
		$solves = $this->problem_model->get_solution_methods($p_id);
		if(count($solves)>0)
		{
			$data['solves'] = $solves;
			$query = "Select title from Problem where problem_id = ?";
			$t = $this->db->query($query, $p_id)->row_array();
			$data['title'] = $t['title'];

			$u = $this->brain_model->get_profile($this->loginInfo);
			$param['user_id'] = $u[0]['user_id'];
			$param['pr_id'] = $p_id;
			$this->problem_model->deduct_points($param);
			//print_r($solves);
			$this->load->view('solutionMethod', $data);
		}
		else
		{
			$sid = $this->problem_model->get_Section($p_id);
			redirect('start/func/'.$sid);
		}
	}



	//! Forum function :

	/*!
		This function first retrieves the latest 5 forum post and their corresponding comments list. and then it loads the forum page.
	*/

	public function forum()
	{
		
		$categories = $this->problem_model->get_category();
		$data['categories'] = $categories;
		$post = $this->forum_model->getLatest();
		$data['f_post'] = $post;
		$data['comments'] = $this->forum_model->show_comments();
		$this->load->view('forum',$data);
	}

	//! forum_post Function :
	/*!
		This function handles adding a new post. It takes the post along with the user info then inserts it in database.
	*/

	public function forum_post()
	{
		$post = $this->input->post();
		$userinfo = $this->session->all_userdata();
		$post ['username'] = $userinfo['username'];
		$this->forum_model->insert_post($post);
		redirect('start/forum');
	}

	//! comment Function :
	//! @param $f_id forum post id
	/*!
		this functions takes a comment of a specific forum post and insert it in database along with involved user's data.
	*/

	public function comment($f_id)
	{
		$comment = $this->input->post();
		$comment['f_id']= $f_id;
		$userinfo = $this->session->all_userdata();
		$comment ['username'] = $userinfo['username'];
		$this->forum_model->insert_comment($comment);
		redirect('start/forum');
	}

	//! vote_post Function :
	//! @param $post_id forum post id
	/*!
		this functions takes a comment of a specific forum post and insert it in database along with involved user's data.
	*/
	public function vote_post($post_id)
	{
		$this->userinfo = $this->brain_model->get_profile($this->loginInfo);
        $this->user = $this->userinfo[0]['user_id'];
    	$param['post_id'] = $post_id;
    	$param['user_id'] = $this->user;
		$this->forum_model->vote_post_entry($param);
		redirect('start/forum');
	}

	//! delete_post Function :
	//! @param $post_id forum post id
	/*!
		this functions takes a comment of a specific forum post and insert it in database along with involved user's data.
	*/
	public function delete_post($post_id)
	{
		$this->userinfo = $this->brain_model->get_profile($this->loginInfo);
        $this->user = $this->userinfo[0]['user_id'];
    	$param['post_id'] = $post_id;
    	$param['user_id'] = $this->user;
		$num=$this->forum_model->delete_post_entry($param);
		if($num == 0)
			echo "<script type='text/javascript'>alert('You can not delete this post.')</script>";
		else
			echo "<script type='text/javascript'>alert('Post successfully deleted.')</script>";
		redirect('start/forum');	
	} 
	//! about Function :
	//!
	/*!
		this functions shows a view with the infos of programmers and supervisor behind this project.
	*/

	public function about()
	{
		$this->load->view('about');
	}

	public function search()
	{
		$this->userinfo = array($this->input->post());

	}
}
