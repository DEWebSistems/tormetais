<?php

    class Anuncios extends CI_Controller
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
            
            $this->detalhe();            
        }                
        
        public function detalhe($idAnuncio)
        {            
            $dadosEmpresa['dadosEmpresa']       = $this->DAODadosEmpresa->getDadosEmpresa();            
            
            $anuncio                            = $this->DAOAnuncios->getAnuncioById($idAnuncio);            
            $imagemPrincipal                    = $this->DAOAnuncios->getImagemPrincipal($anuncio['id']);                
            $anuncio['imagemprincipal']         = $imagemPrincipal['localizacao'];
            
            $datasBody['dadosAnuncio']          = $anuncio;
            $datasBody['videosanuncio']         = $this->DAOAnuncios->getVideos($idAnuncio)->result_array();
            $datasBody['imagensanuncio']        = $this->DAOAnuncios->getImagens($idAnuncio)->result_array();            
            
            $this->load->view('fragmentos/cabecalho',   $dadosEmpresa);
            $this->load->view('publico/anuncio',        $datasBody);
            $this->load->view('fragmentos/rodape',      $dadosEmpresa);            
        }                                                    
    }
?>