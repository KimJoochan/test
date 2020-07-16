<?php
    class Upload extends CI_Controller{
        public function index(){
            $this->load->view("vw_upload");
        }
        public function upload_file(){
            $config['allowed_types']='jpg|png';
            $config['upload_path']='./static/';
            $config['encrypt_name']=true;
            $this->load->library('upload',$config);
            if($this->upload->do_upload("image")){
                var_dump($this->upload->data());
            }else{
                print_r($this->upload->display_errors());
            }
        }
        public function upload_file_ck(){
            $config['allowed_types']='jpg|png';
            $config['upload_path']='./static/';
            $config['encrypt_name']=true;
            $this->load->library('upload',$config);
            if($this->upload->do_upload("des")){
                var_dump($this->upload->data());
            }else{
                print_r($this->upload->display_errors());
            }
        }
    }
?>