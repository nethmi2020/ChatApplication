<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MSG extends CI_Controller {

	
	public function index()
	{
		$this->load->view('welcome_message');
	}

    public function store()
	{
        // echo 'hi';
		// print_r($_POST);
        // die();

        $name=$_POST['name'];
        $msg=$_POST['msg'];

      

        $sql="INSERT INTO `message`( `sender_name`, `sender_message`) VALUES (' $name','$msg') ";
        $query= $this->db->query($sql);


        if($query){
            // $this->session->set_flashdata('inserted','yes');
            redirect('msg');
        }
        

        // $data['name']=$name;
        // $data['msg']=$msg;
        // $this->load->model('Msg_model');
        // $data=$this->Msg_model->storeData($data);

        // echo json_encode($data);
      
        
	}



    public function process(){

        $this->load->model('Msg_model');
        $data=$this->Msg_model->getMsgDetails();

    // print_r($data);

    echo json_encode($data);
       
    }
}
