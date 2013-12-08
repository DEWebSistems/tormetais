<?php

    class Noticias extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            
            $this->load->helper('url');
            
            $this->load->model('daos/DAODadosEmpresa');
            $this->load->model('producao/MDadosEmpresa');                                                        

            $this->load->model('daos/DAONoticias');
            $this->load->model('producao/MNoticias');             
        }
        
        public function index()
        {
            
            $this->detalhe();            
        }                
        
        public function detalhe($idNoticia)
        {            
            $dadosEmpresa['dadosEmpresa']       = $this->DAODadosEmpresa->getDadosEmpresa();            
            
            $noticia                            = $this->DAONoticias->getNoticiaById($idNoticia);            
            $imagemPrincipal                    = $this->DAONoticias->getImagemPrincipal($noticia['id']);                
            $noticia['imagemprincipal']         = $imagemPrincipal['localizacao'];
            
            $datasBody['dadosNoticia']          = $noticia;
            $datasBody['videosnoticia']         = $this->DAONoticias->getVideos($idNoticia)->result_array();
            $datasBody['imagensnoticia']        = $this->DAONoticias->getImagens($idNoticia)->result_array();            
            
            $this->load->view('fragmentos/cabecalho',   $dadosEmpresa);
            $this->load->view('publico/noticia',        $datasBody);
            $this->load->view('fragmentos/rodape',      $dadosEmpresa);            
        }                                                    
    }
?>