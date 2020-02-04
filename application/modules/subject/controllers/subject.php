<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
        $this->load->library('session');
       
    }
    
    public function index()
	{
		$this->load->view('subject_list');
		//$this->render_page('subject_list');
	}
	
	
}

?>
