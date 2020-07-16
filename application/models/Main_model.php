<?php
class Main_model extends CI_Model{
    function __construct()
    {       
        parent::__construct();
    }
    function gets(){
        return $this->db->query("SELECT * FROM posts")->result();
    }
    function add($title, $description,$filepath){
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('posts',array(
            'title'=>$title,
            'des'=>$description,
            'path'=>$filepath,
            'id_num'=>$_SESSION['id']
        ));        
        $thisId= $this->db->insert_id();
        $sql="update posts set keynum=? where number=?";
        $result=$this->db->query($sql,array($thisId,$thisId));
        return $thisId;
    }
    function update($title, $description,$number,$path){
        // if(!empty($path)){
            
        // }else{
        //     $oriPath=$this->db->query("select path from posts where number=$number")->result_array();
        //     $path=$oriPath[0]['path'];
        // }
         $this->db->set('created', 'NOW()', false);
         $this->db->where('number', $number);
         $this->db->update('posts', array(
             'title'=>$title,
             'des'=>$description,
             'path'=>$path
         ));
         $this->db->affected_rows();
        return $number;
    }
}
?>