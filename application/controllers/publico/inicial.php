<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Inicial extends CI_Controller
    {
        public function index()
        {
            $this->load->view('fragmentos/cabecalho');
            $this->load->view('fragmentos/rodape');
        }
    }
?>