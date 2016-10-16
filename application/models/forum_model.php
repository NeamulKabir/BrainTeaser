<?php
class forum_model extends CI_Model {
    //! __construct Function :
    /*!
       constructor to load database
    */
	  public function __construct()
    {
        $this->load->database();
    }

    //! insert_post Function :
    //! @param $info : an array with all information to insert a forum post
    /*!
       inserts a new post into the database (forum table)
    */
    public function insert_post($info)
    {
    	

    	$query = "Select user_id From user Where user_name = ?";
    	$uid = $this->db->query ($query,$info['username'])->result_array();
    	$id = $uid[0]['user_id'];
    	$f_id = '';
    	$f_post = $info['forum_post'];
    	$f_vote = 0;
    	

    	$data = array(
    				'forum_id' => $f_id,
    				'post'=> $f_post,
    				'user_id'=> $id,
    				'vote' => $f_vote


    		);
    	//print_r($data);
    	$this->db->insert('forum',$data);

    	
    }

    //! getLatest Function :
    /*!
       returns the latest 5 posts from database to show to the user
    */
    public function getLatest()
    {
    	$query = " SELECT * FROM forum order by forum_id DESC limit 5 " ;
    	$res = $this->db->query($query)->result_array();
        for($i=0;$i<sizeof($res);$i++)
        {
            $res[$i]['poster'] = $this->getPosterName($res[$i]['user_id']);
        }
    	return $res;
    }

    public function getPosterName($id)
    {
        $query = "Select fullname from user where user_id=?";
        $out=$this->db->query($query, $id)->row_array();
        return $out['fullname'];
    }

    //! insert_comment Function :
    //! @param $info : an array with all infos to insert a comment into the database
    /*!
       inserts a comment to a post into the database (comment table)
    */
    public function insert_comment($info)
    {
    	$query = "Select user_id From user Where user_name = ?";
    	$uid = $this->db->query ($query,$info['username'])->result_array();
    	$id = $uid[0]['user_id'];
    	$c_id = '';
    	$f_id = $info['f_id'];
    	$comment = $info['comment'];

    	$data = array(
    				'comment_id'=> $c_id,
    				'forum_id' => $f_id,
    				'user_id' => $id,
    				'comment' => $comment

    		);
    	$this->db->insert('comment',$data);
    }


    //! show_comments Function :
    /*!
       loads all comments by forum post from database
    */
    public function show_comments()
    {
        $query = "Select forum_id from Forum";
        $posts = $this->db->query($query)->result_array();
        foreach ($posts as $p) {
            $query = "Select * from comment where forum_id=?";
            $res = $this->db->query($query, $p['forum_id'])->result_array();
            for ($i=0; $i<sizeof($res);$i++)
            {
                $res[$i]['name'] = $this->brain_model->get_username($res[$i]['user_id']);
            }
            $comms[$p['forum_id']] = $res;
        }
        
        return $comms;
    }


    //! vote_post_entry Function :
    //! @param $param : an array with two data post_id & user_id 
    /*!
       keeps track of voting a post. Checks if a user is voting twice or not.
    */
    public function vote_post_entry($param)
    {
        $query = "Select * from posts where post_id=? and user_id=?";
        $re = $this->db->query($query, $param)->row_array();
        if($re)
        {
            //echo "You have already voted";
        }
        else
        {
            $query = "Insert into posts values('', ?, ?)";
            $this->db->query($query, $param);
            $this->forum_model->update_post_vote($param['post_id']);
            //echo "vote succeefull!!!!!";
        }
    }


    //! update_post_vote Function :
    //! @param $post_id : forum post id
    /*!
       updates the vote count of a post in Forum table
    */
    public function update_post_vote($post_id)
    {
        $query = "Update forum Set vote=vote+1 where forum_id=?";
        $this->db->query($query, $post_id);
    }


    //! delete_post_entry Function :
    //! @param $param : an array with post_id & forum_id 
    /*!
       processes a delete request. If the user posted it, the post is deleted otherwise return
    */

    public function delete_post_entry($param)
    {
        $query = "Select user_id from forum where forum_id=?";
        $u =  $this->db->query($query, $param['post_id'])->row_array();
        if($u['user_id'] == $param['user_id'])
        {
            $query = "Delete from Forum where forum_id=?";
            $this->db->query($query, $param['post_id']);
            return 1;
            
             echo "<script type='text/javascript'>alert('Deleted successfully!')</script>";
        }
        else
        {
             echo "<script type='text/javascript'>alert('Failed!!! You can not delete the post.')</script>";
             return 0;
        }
    }

}