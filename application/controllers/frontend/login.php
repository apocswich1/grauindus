<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->layout->setLayout('login');
        
    }
    
	public function index()
	{

    $this->layout->view('index');
        
	}
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */