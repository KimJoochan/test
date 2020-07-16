<?php
class Post_model extends CI_Model{
    public function post_require_paging($db_req){
      $sql = "SELECT * FROM posts ORDER BY keynum DESC Limit  ?,?";
      return  $this->db->query($sql,array($db_req[0], $db_req[1]))->result();
    }
    public function post_require_all(){
        return  $this->db->query("SELECT  *  FROM posts ORDER BY created DESC, keynum desc, level asc")->result();
    }
    public function post_search_paging($sea,$db_req){
        $sql = "SELECT * FROM posts where id_num=? ORDER BY keynum DESC Limit  ?,?";
        return  $this->db->query($sql,array($sea,$db_req[0], $db_req[1]))->result();
      }
    function post_nikname_search($search){
        $res=$this->db->query("select id from user where nikname like '%$search%'")->result_array();
        if(empty($res[0]['id'])){
            return false;
        }
        $sql="SELECT * FROM posts where id_num=? ORDER BY created DESC, keynum desc, level asc";
        return  $this->db->query($sql,array($res[0]['id']))->result();
    }
    function post_title_search($search){
        $sql="select * from posts where title like '%$search%'";
        return  $this->db->query($sql)->result();
    }
    
    public function show($reg){
        $sql ="SELECT  hit  FROM posts where number= ?";
        $hit=$this->db->query($sql,array($reg))->result_array();
        $hit= $hit[0]['hit']+1;
        $sql="UPDATE posts SET hit = ? where number=?";
        $this->db->query($sql,array($hit,$reg));
        $sql="select posts.title, posts.des,posts.number, posts.created,posts.path, user.nikname  FROM posts  inner join user on posts.id_num=user.id where posts.number=$reg";   
        return $this->db->query($sql,$reg)->result_array();
    }
    public function update($reg){
        return $this->db->query("SELECT  *  FROM `posts` where number='$reg'")->result_array();
    }
    public function delete($reg){
        return $this->db->query("delete FROM `posts` where number='$reg'");
    }
    public function pathDe($reg){
        return $this->db->query("update posts set path='' where number='$reg'");
    }
    public function level($reg){
        return $this->db->query("select level from posts where number='$reg'")->result_array();
    }
    public function comment_process($title,$des,$level,$keynum){
        $sql="insert into posts (title,des,created,level,keynum,id_num) values(?,?,NOW(),?,?,?)";
        return $this->db->query($sql,array($title,$des,$level,$keynum, $_SESSION['id']));
    }
}
?>