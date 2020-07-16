<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->database(); 
		$this->load->model('Post_model');
		$this->load->helper(array('form', 'url'));
	}
	function __header(){ //헤더의 css,javascript와 네비
        $this->load->view('header');
        $this->load->view('/loginsuc/index');
    }
	public function index() //맨처음 화면
	{
		$this->load->view('welcome_message');
	}
	public function coment($reg){ //댓글페이지
		$level=$this->Post_model->level($reg);
		$this->__header();
		$this->load->view('coment',array('number'=>$reg,'level'=>$level));
	}
	function script($msg){
        echo "<script>alert('$msg');</script>";
    }
	public function comment(){ //댓글 디비 실행
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', '제목', 'required');
		$this->form_validation->set_rules('description', '본문', 'required');
		$title=$this->input->post('title');
		$des=$this->input->post('description');
		$title=$this->test_input($title);
		$des=$this->test_input($des);
		$reg=$this->input->post('keynum');
		try{
			if(strlen($title)==0){
				throw new Exception("title");
			}else if(strlen($des)==0){
				throw new Exception("des");
			}else{
				$topic_id = $this->Post_model->comment_process($title, $des,$this->input->post('level'),$reg);
				$this->__back();
			}
		}catch(Exception $e){
			if($e->getMessage()=="title"){
				$this->script('제목을 작성해주시요');
			}else if($e->getMessage()=="des"){
				$this->script('내용을 작성해주세요.');
			}
			$this->coment($reg);
		}	
	}
	public function show_data($reg){ //글 보기 화면
		$post  =  $this->Post_model->show($reg);
		$this->__header();
		$this->load->view("post_board",array("post"=>$post));
	}
	public function update($id){ //게시글 수정 화면
		$post  =  $this->Post_model->update($id);
		$this->__header();
		$this->load->view("update_form",array('post'=>$post));
	}
	public function delete($id){ //게시글 삭제
		$post  =  $this->Post_model->delete($id);
        echo "1";
	}
	function pathDe($id){ //이미지 삭제
		$post  =  $this->Post_model->pathDe($id);
		$this->__back();
	}
	public function update_process(){ // 게시글 수정 처리 과정
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', '제목', 'required');
		$this->form_validation->set_rules('des', '본문', 'required');
		$this->load->model('Main_model');
		$dataPath="";
		if(!empty($_FILES['userfile'])){
			$dataFile=$this->do_upload();
			$dataFile['upload_data']['file_path'];//파일 절대 경로
			$dataPath=$dataFile['upload_data']['file_name'];;//파일 명
		}
		$this->load->helper("file");
		$topic_id = $this->Main_model->update($this->input->post('title'), $this->input->post('des'),$this->input->post('number'),$dataPath);
		echo $topic_id;
	}
	public function index_list(){ //목록띄우기
		$seg=$request=$this->uri->segment(3); //파라매타가 없을시 세그먼트를 통해서 기본값설정
		if($request==null){
			$request=1;
		}
		if  ($request  ==  1)  {
			$db_req[0]  =  0;
			$db_req[1]  =  $request+4;
		}  else  {
			$num  =  $request  -  1;
			$num  =  $num  *  4;
			$db_req[0]  =  $num;
			$db_req[1]  =  $request+4;
		}
		try{
			if(!empty($this->input->get('search'))){
				$search=$this->input->get('search');
				$category=$this->input->get('category');
				if($category==""){
					throw new Exception("검색카테고리를 선택해주세요");
				}
				else if($category=="nikname"){
					$post_all  =  $this->Post_model->post_nikname_search($search);
				}else if($category=="title"){
					$post_all  =  $this->Post_model->post_title_search($search);
				}
				if($post_all==false){
					throw new Exception("검색없음");
				}
				$post  =  $this->Post_model->post_search_paging($post_all[0]->id_num,$db_req);
			}else{
				$post_all  =  $this->Post_model->post_require_all();
				$post  =  $this->Post_model->post_require_paging($db_req);
			}
			$this->__header();
			$this->load->view('Index_paging',  array('post'=>$post,  'post_all'=>$post_all));
		}catch(Exception $e){
			$this->script($e->getMessage());
			echo "<script>location.href='".base_url()."index/index_list'</script>";
		}
	}
	public function write(){ //작성페이지
		$this->__header();
		$this->load->view("write");
	}
	function test_input($data) {
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	function console($msg){
		echo "<script>alert('$msg');</script>";
	}
	function ajWrite(){
		$dataPath="";
		$this->load->model('Main_model');
		if(!empty($_FILES['userfile'])){
			$dataFile=$this->do_upload();
			$dataFile['upload_data']['file_path'];//파일 절대 경로
			$dataPath=$dataFile['upload_data']['file_name'];;//파일 명
		}
		$title=$this->input->post('title');
		$des=$this->input->post('des');
		$title=$this->test_input($title);
		$des=$this->test_input($des);
		try{
			if(strlen($title)==0){
				throw new Exception("title");
			}else if(strlen($des)==0){
				throw new Exception("des");
			}else{
				$res=$this->Main_model->add($title, $des,$dataPath);
				echo $res;
			}
		}
		catch(Exception $e){
			if($e->getMessage()=="title"){
				$this->console("제목을 채워주세요");
			}else if($e->getMessage()=="des"){
				$this->console("내용을 입력해주세요");
			}
		}
	}
	public function do_upload(){//파일 업로드 함수
		$config = array();
		$config['upload_path'] = './uploads/demo/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['overwrite']     = FALSE;
		$config['max_size'] = 1 * 1024;
		$config['encrypt_name'] = TRUE;

		$files = $_FILES;
		$this->load->library('upload');
		$this->upload->initialize($config);
		$_FILES['userfile']['name'] = $files['userfile']['name'];
		$_FILES['userfile']['type'] = $files['userfile']['type'];
		$_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
		$_FILES['userfile']['error'] = $files['userfile']['error'];
		$_FILES['userfile']['size'] = $files['userfile']['size'];
		if (!$this->upload->do_upload('userfile')) {
		 	$error = array('error' => $this->upload->display_errors());
		} else {
			 $data1 = array('upload_data' => $this->upload->data());
			 $data1['upload_data']['file_path'];//파일 경로
			 $data1['upload_data']['raw_name'];//파일 명
			return $data1;
		}	
	}
	function __back(){
		//반복하는 리다이렉트
        redirect('/Index/index_list/1');
	}
	function search(){//게시판 검색기능
		$request=$this->uri->segment(3); //파라매타가 없을시 세그먼트를 통해서 기본값설정
		if($request==null){
			$request=1;
		}
		if  ($request  ==  1)  {
			$db_req[0]  =  0;
			$db_req[1]  =  $request+4;
		}  else  {
			$num  =  $request  -  1;
			$num  =  $num  *  4;
			$db_req[0]  =  $num;
			$db_req[1]  =  $request+4;
		}
		$search=$this->input->post('search');
		$post_all  =  $this->Post_model->post_require_search($search);
		$post  =  $this->Post_model->post_search_paging($post_all[0]->id_num,$db_req);
		// var_dump($post);
		$this->__header();
		$this->load->view('Index_paging',  array('post'=>$post,  'post_all'=>$post_all));
		// $this->index_list();
	}
}
