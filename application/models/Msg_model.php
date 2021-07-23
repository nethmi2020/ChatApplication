<?php
if(!defined('BASEPATH')) exit ('No access');


class Msg_model extends CI_Model{

    function getMsgDetails(){
        $this->db->select('*');
        $records=$this->db->get('message');
        $data=$records->result_array();

        return $data;
    }

    
    function storeData($data){
        
        $data= $this->db->insert('message',$data);
        return $data;

        // return $data;
    }
}