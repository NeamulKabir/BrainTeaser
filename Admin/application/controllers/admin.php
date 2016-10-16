<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*!

*/

class Admin extends CI_Controller {

	/*!
	Constructor only loads the essential library, model and helper. 
	Also here we initialize the loginInfo by the session data.
	*/
	 public function __construct()
        {
            parent::__construct();
                $this->load->model('admin_model');
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
        load login page of Admin
    */
    public function index()
    {
    	$this->load->view('adminlogin');
    }
    /*!
        load login page of Admin
    */
    public function login()
    {
        $this->load->view('adminlogin');
    }
    /*!
        Verify Login info provided by the admin
    */
    public function loginConfirm()
    {
        $this->userinfo = array($this->input->post());
        if (isset($_SESSION['username']))
        {
            redirect('admin/home');
        }

        else
         {
            $loginInfo = array($this->input->post());
            $num= $this->admin_model->loginvalidation($loginInfo);
                    // //$num = 1;
            echo $num;
            if($num==1)
            {
                $this->session->set_userdata ('username',$loginInfo[0]['username']);

                redirect('admin/home');
            }
         
            else
             {
                echo 'failure<br>';
                redirect('admin/index'); // ridirect to login page


            }
         }

    }
    /*!
        destroy the session & redirect to the admin login page
    */
    public function signout()
    {
           // echo 'LogOut is successful.<br>';
            $this->session->sess_destroy();
            redirect('admin/login');
   }
   /*!
        after logged in show home
    */
    public function home()
    {
        $this->load->view('adminHome');
    }
    /*!
        show the view of adding a ctegory
    */
    public function addCategory()
    {
        $this->load->view('addCategory');
    }
    /*!
        insert new category to the database
    */
    public function add_new_category()
    {
        $cat = array($this->input->post());
        $this->admin_model->addCategory($cat);

        redirect('admin/addCategory');
    }
    /*!
    show the view of adding a section
    */
    public function addSection()
    {
        $categories = $this->problem_model->get_category();
        $data['cat']  =$categories;

        $this->load->view('addSection', $data);
    }
    /*!
        insert a section under a provided category
    */
    public function add_new_section()
    {
        $input = array($this->input->post());
        $this->admin_model->addSection($input);

        redirect('admin/addSection');
    }
    /*!
    show the view of adding an admin
    */
    public function addAdmin()
    {
        $this->load->view('addAdmin');
    }
    /*!
        add new admin to the database
    */
    public function add_new_admin()
    {
        $in = array($this->input->post());
        $this->admin_model->addAdmin($in);

        redirect('admin/addAdmin');
    }
    /*!
        did not used
    */
    public function addProblem()
    {
        $cat = $this->problem_model->get_category();
    
        foreach ($cat as $value) {
            $it = 0;
            $sec_c = $this->problem_model->get_a_section($value['category_id']);
            $sections[$value['category_id']] = $sec_c;
        }
        $data['cat'] = $cat;
        $data['sections'] = $sections;
        

        $this->load->view('addProblem',$data);
    }
    /*!
        not used
    */
    public function add_new_problem()
    {
        $prob = array($this->input->post());
        
        $u = $this->admin_model->get_profile($this->loginInfo);
        $prob[0]['admin_id'] = $u[0]['admin_id'];
        //print_r($prob);
        $num = $this->problem_model->insert_problem($prob);
        //$data['problem_succ'] = 1;
        //$this->load->view('home');
        redirect('admin/home');
    }

}
