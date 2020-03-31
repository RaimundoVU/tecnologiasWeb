<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/* load the MX_Router class */
require APPPATH . "third_party/MX/Controller.php";
/**
 * Description of my_controller
 *
 * @author Administrator
 */
class MY_Controller extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('evaluation/evaluationModel');
        if (version_compare(CI_VERSION, '2.1.0', '<')) {
            $this->load->library('security');
        }
    }

    protected function render_page($view, $data = []) {
        $data2['evaluationsAgo'] = $this->evaluationModel->getEvaluationsAgo($this->session->userdata('email'),date('Y-m-d',strtotime('-7 days')));
		$data2['evaluationsAway'] = $this->evaluationModel->getEvaluationsAway($this->session->userdata('email'),date('Y-m-d',strtotime('+7 days')));
        $this->load->view('header', $data2);
        $this->load->view($view, $data);
        $this->load->view('footer', $data);
    }
}
/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */