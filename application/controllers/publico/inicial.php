<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Inicial extends CI_Controller
    {
        
        function __construct()
        {
            parent::__construct();     
            
            $this->load->helper('url');            
            
            $this->load->model('daos/DAODadosEmpresa');
            $this->load->model('producao/MDadosEmpresa');  
            
            $this->load->model('daos/DAOAnuncios');
            $this->load->model('producao/MAnuncios');  
            
        }
        
        public function index()
        {
            $dadosEmpresa['dadosEmpresa']       = $this->DAODadosEmpresa->getDadosEmpresa();
//            $dadosInicial['anuncios']           = $this->DAOAnuncios->getAnuncios()->result_array();
//            $dadosInicial['dadosEmpresa']       = $dadosEmpresa;
            
//            echo '<pre>';
//            print_r($dadosInicial);
//            echo '</pre>';
            $this->load->view('fragmentos/cabecalho');            
            $this->load->view('publico/inicial', $dadosEmpresa);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
    }
?>