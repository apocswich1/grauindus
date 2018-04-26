<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {


    private $session_id;
    public function __construct()
    {
        parent::__construct();
      
      
    }
    
    public function index()
    {
        $this->views->load('cabcera');
        $this->views->load('menuLogo');
        $this->views->load('contenido');
        $this->views->load('piePagina');
    }
}
