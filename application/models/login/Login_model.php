<?php
class Login_model extends CI_Model{
    function __construct()
    {        
        parent::__construct();
    }
    function add($obj){
        $this->db->set('created', 'NOW()', false);
        $sql="insert into user (email,password,name,nikname,oripwd) values(?,?,?,?,?)";
        $this->db->query($sql,array($obj['email'],$obj['password'],$obj['name'],$obj['nikname'],$obj['oripwd']));
    }
    function script($msg){
        echo "<script>console.log('".$msg."')</script>";
    }
    function login($obj){
         $sql="select * from user where email='".$obj['email']."'";
         $res=$this->db->query($sql)->result_array();
         if(count($res)==1){ //디비에서 받아온 배열의 개수가 1이면 성공 없으면 실패
             return ($res[0]);
         }else{
             return false;
         } 
    }
    //개인정보 확인
    function get(){
        $id=$_SESSION['id'];
        $sql="select * from user where id=?";
        $res=$this->db->query($sql,array($id))->result_array();
        return $res; 
    }
    function change($obj){
        $id=$_SESSION['id'];
        $sql="update user set name=?,nikname=?,email=? where id=?";
        $res=$this->db->query($sql,array($obj['name'],$obj['nikname'],$obj['email'],$id));
        $sql="select * from user where id=?";
        $res=$this->db->query($sql,array($id))->result_array();
        return $res; 
    }
    function admin_select(){//관리자 사용자 조회 페이지
        $sql="select * from user where grad != 'admin'";
        $res=$this->db->query($sql)->result_array();
        return $res;
    }
    function admin_board(){//관리자 사용자 조회 페이지
        $sql="select posts.title,posts.created,posts.number,user.nikname from posts inner join user on posts.id_num =user.id order by nikname asc, created desc; ";
        $res=$this->db->query($sql)->result_array();
        return $res;
    }
}