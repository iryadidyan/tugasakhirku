<?php

class AutoController extends CI_controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Nasabah');
        if($this->session->userdata('status') == ''){
            redirect('/');
        }
    } 

    function get_autocomplete(){
        $keyword = $_GET['term'];
        $result = $this->Nasabah->search_nasabah($keyword);
        if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'id' => $row->no_rekening,
                    'value' => $row->nama,
                );
                echo json_encode($arr_result);
        }
    }

    public function tes(){
        echo "tes";
    }

}

?>