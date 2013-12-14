<?php

    class Servicos extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            
            $this->load->helper('url');
            
            $this->load->model('daos/DAODadosEmpresa');
            $this->load->model('producao/MDadosEmpresa');                        
            
            $this->load->model('daos/DAOCategoriasServicos');
            $this->load->model('producao/MCategoriasServicos');              

            $this->load->model('daos/DAOServicos');
            $this->load->model('producao/MServicos');             
        }
        
        public function index()
        {
            $dadosPost = $this->input->post();
            if(isset($dadosPost['bsVoltar']))
            {
                $this->lista();                      
            } else if(isset($dadosPost['bsDetalhes']))
            {
                $this->detalhe($dadosPost['bsDetalhes']);
            } else {
                $this->lista();
            }
        }
        
        public function lista()
        {          
            $dadosEmpresa['dadosEmpresa']       = $this->DAODadosEmpresa->getDadosEmpresa();
            $datasBody['categoriasServicos']    = $this->DAOCategoriasServicos->getCategoriasServicos()->result_array();                      
            $servicos                           = $this->DAOServicos->getServicos()->result_array();                        
            
            $servicosComImagem = array();                       
            
            foreach ($servicos as $servico) {
                                                                                
                $imagemPrincipal = $this->DAOServicos->getImagemPrincipal($servico['id']);
                
                $servico['imagemprincipal'] = $imagemPrincipal['localizacao'];
                
                $servicosComImagem[] = $servico;
            }            
            
            $datasBody['servicos']              = $servicosComImagem;
                        
            $this->load->view('fragmentos/cabecalho',   $dadosEmpresa);
            $this->load->view('publico/servicos',       $datasBody);
            $this->load->view('fragmentos/rodape',      $dadosEmpresa);
        }
        
        public function detalhe($idServico)
        {            
            $dadosEmpresa['dadosEmpresa']       = $this->DAODadosEmpresa->getDadosEmpresa();
            $datasBody['categoriasServicos']    = $this->DAOCategoriasServicos->getCategoriasServicos()->result_array();
            
            $servico                            = $this->DAOServicos->getServicoById($idServico);            
            $imagemPrincipal                    = $this->DAOServicos->getImagemPrincipal($servico['id']);                
            $servico['imagemprincipal']         = $imagemPrincipal['localizacao'];
            
            $datasBody['dadosServico']          = $servico;
            $datasBody['videosservico']         = $this->DAOServicos->getVideos($idServico)->result_array();
            $datasBody['imagensservico']        = $this->DAOServicos->getImagens($idServico)->result_array();            
            
            $this->load->view('fragmentos/cabecalho',   $dadosEmpresa);
            $this->load->view('publico/servico',        $datasBody);
            $this->load->view('fragmentos/rodape',      $dadosEmpresa);            
        }
                  
        public function filtro($idCategoriaServico) {
            
            $dadosEmpresa['dadosEmpresa']       = $this->DAODadosEmpresa->getDadosEmpresa();
            $datasBody['categoriasServicos']    = $this->DAOCategoriasServicos->getCategoriasServicos()->result_array();                       
            $servicos                           = $this->DAOServicos->getServicosByCategoriaServicoId($idCategoriaServico);                   
            
            $servicosComImagem = array();                       
            
            foreach ($servicos as $servico) {
                                                                                
                $imagemPrincipal = $this->DAOServicos->getImagemPrincipal($servico['id']);
                
                $servico['imagemprincipal'] = $imagemPrincipal['localizacao'];
                
                $servicosComImagem[] = $servico;
            }            
            
            $datasBody['servicos']              = $servicosComImagem;
            
            $this->load->view('fragmentos/cabecalho',   $dadosEmpresa);
            $this->load->view('publico/servicos',       $datasBody);
            $this->load->view('fragmentos/rodape',      $dadosEmpresa);
        }                               
    }
?>