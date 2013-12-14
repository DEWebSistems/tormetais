<?php
    class Inicio extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->helper(array('url'));
            $this->load->model('producao/MDadosEmpresa');
            $this->load->model('daos/DAODadosEmpresa');
            $this->load->model('seguranca/MUsuarios');
            $this->MUsuarios->validateUser();
        }
        
        public function index()
        {
            $datasBody = array();
            $datasCR['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $datasBody['dadosUsuario'] = $this->MUsuarios->getUserSession()->result_array()[0];
            $this->load->view('fragmentos/cabecalhoprivado', $datasCR);
            $this->load->view('privado/producao/inicio', $datasBody);
            $this->load->view('fragmentos/rodape', $datasCR);
        }
    }
?>