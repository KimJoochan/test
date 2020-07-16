<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class register extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->database(); 
        $this->load->helper(array('form', 'url'));
        $this->load->model('login/Login_model');
    }
    function __header(){ //헤더의 css,javascript와 네비
        $this->load->view('header');
        $this->load->view('/loginsuc/index');
    }
    function index(){
        $this->__header();
        $this->load->view('login/login');
    }
     function join(){ //회원가입 화면
        $this->__header();
        $this->load->view('login/register');
    }
    function script($msg){
        echo "<script>alert('$msg')</script>";
        // foreach($msg as $value => $item){
        //     echo "<script>console.log('$value'+' $item')</script>";
        // }
    }
    function register(){ //회원가입 등록하기
        $this->load->library('form_validation');
        if(!function_exists('password_hash')){
             $this->load->helper('password');
        }
        $crepwd=$this->input->post('password');
        $repwd=$this->input->post('re_password');
        $name=$this->test_input($this->input->post('name'));
        $nikname=$this->test_input($this->input->post('nickname'));
        $email=$this->test_input($this->input->post('email'));
        $pwd=$this->input->post("password");
        $num = preg_match('/[0-9]/u', $crepwd);
        $eng = preg_match('/[a-z]/u', $crepwd);
        $spe = preg_match("/[\!\@\#\$\%\^\&\*]/u",$crepwd);
        try{
            if($name==""){
                throw new Exception("name");
            }else if($nikname==""){
                throw new Exception("nickname");
            }else if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)==false){
                throw new Exception("email");
            }else if($crepwd != $repwd){
                echo "$crepwd"."$repwd";
                throw new Exception("pwd");
            }else if(preg_match("/\s/u", $pwd) == true)
            {
                throw new Exception("pwdSpace");//공백사용
            }
            if( $num == 0 || $eng == 0 || $spe == 0)//영문,숫자,특수문자 혼합
            {
                throw new Exception("pwdMerge");
            }
            else {
                $hash=hash("sha256", $crepwd);
                $this->Login_model->add(array(
                    'name'=>$name,
                    'nikname'=>$nikname,
                    'email'=>$email,
                    'password'=>$hash,
                    'oripwd'=>$crepwd
                ));
                echo "회원가입완료";
                //redirect('/index.php/Register/login_view');
            }
        }catch(Exception $e){
            $err=$e->getMessage();
            if($err=="name"){
                $error="이름을 채워주세요";
                $name="";
            }else if($err=="nickname"){
                $error="닉네임을 채워주세요";
                $nikname="";
            }else if($err=="email"){
                $error="이메일 형식에 맞지 않습니다.";
                $email="";
            }else if($err=="pwdLen"){
                $error="비밀번호는 영문, 숫자, 특수문자를 혼합하여 최소 10자리 ~ 최대 30자리 이내로 입력해주세요";
            }else if($err=="pwdSpace"){
                $error="비밀번호는 공백없이 입력";
            }else if($err=="pwdMerge"){
                $error="비밀번호는 영문,숫자,특수문자 혼합사용";
            }else if($err=="pwd"){
                $error="비밀번호가 일치 하지 않습니다.";
            }
            echo $error;
            //redirect('/index.php/Register/login_view');//페이지 다시초기화
        }
        
    }
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function login(){ //로그인 처리함수
        try{
            $hash="";
            if(!$this->input->post('email')){
                throw new Exception("Email1");
            }else if(!$this->input->post('pwd')){
                throw new Exception("pwd1");
            }else{
                $hash=hash("sha256", $this->input->post('pwd'));
                $dbpw=$this->Login_model->login(array(
                    'email'=>$this->input->post('email')
                ));
                if(empty($dbpw['password'])){//리턴값이 안날라올시
                    echo '이메일과 패스워드가 일치하지않습니다.';
                    // $this->script('이메일과 패스워드가 일치하지않습니다.');
                    // $this->login_view();
                }else{
                   
                    if($dbpw['password']==$hash){ //이메일과 비밀번호가 일치할시     
                        foreach($dbpw as $value => $item){
                            $_SESSION[$value] = $item;
                        }
                        $_SESSION["login"] = "true";
                        echo $_SESSION['login'];
                        //redirect('index/index_list'); //리다이렉트로 다른 컨트롤로 연결하기
                    }
                }
            }
        }catch(Exception $e){
            if($e->getMessage() =="Email1"){
               echo "이메일을 입력해주세요";
                // $this->script('이메일을 입력해주세요');
                //$this->load->view('login/login');
            }else if($e->getMessage()=="pwd1"){
                echo "패스워드를 입력해주세요";
                // $this->script('패스워드를 입력해주세요');
                // $this->load->view('login/login',array("email"=>$this->input->post('email')));
            }
        }        
    }
    function myinfo(){
        if(!isset($_SESSION['id'])){
            redirect("index/index_list");
        }else{
            $info=$this->Login_model->get();
            $this->__header();
            $this->load->view('login/myinfo',array('data'=>$info));
       }
    }
    function myinfoshow(){ //정보수정창
        if(!isset($_SESSION['id'])){
            redirect("index/index_list");
        }else{
            $info=$this->Login_model->get();
            $this->__header();
            $this->load->view('login/myinfoChange',array('data'=>$info));
       }
    }
    function sesion($info){
        foreach($info as $value => $item){
            $_SESSION[$value] = $item;
        }
    }
    function myinfoChangeProcess(){ //개인정보 수정하기
        if(!isset($_SESSION['id'])){
            redirect("index/index_list");
        }else{
            $name=$this->input->post("name");
            $nikname=$this->input->post("nikname");
            $email=$this->input->post("email");
            //받아오는 쪽
            $name=$this->test_input($name);
            $email=$this->test_input($email);
            $nikname=$this->test_input($nikname);
            //유효성겁사
            try{
                if(strlen($name)==0){
                    throw new Exception("name");
                }else if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)==false){
                    throw new Exception("email");
                }else if(strlen($nikname)==0){
                    throw new Exception("nikname");
                }else{
                    $info=$this->Login_model->change(array(
                        'name'=>$name,
                        'nikname'=>$nikname,
                        'email'=>$email
                    ));
                    foreach($info[0] as $value => $item){
                        $_SESSION[$value] = $item;
                    }
                    echo $_SESSION['id'];
                    // $this->load->view('/loginsuc/index');
                    // $this->load->view('login/myinfoChange',array('data'=>$info));
                }
            }catch(Exception $e){
                echo $e->getMessage().'<br>';
                echo $e->getLine();
            }
       }
    }
    function admin(){
        //관리자 페이지
        try{
           if($_SESSION['grad']!="admin"){
                throw new Exception("Error Processing Request");
            }else{
                $info=$this->Login_model->admin_select();
                $board=$this->Login_model->admin_board();
                $this->load->view('/loginsuc/index');
                $this->load->view('admin/admin',array('info'=>$info,'board'=>$board));
            }
        }catch(Exception $e){
            $this->script("접속방식이 틀렸습니다.");
            echo "<script>location.href='".base_url()."index/index_list';</script>";
        }
    }
    function loginout(){
        session_destroy();
        echo "<script>history.back(1);</script>";
    }
}

?>