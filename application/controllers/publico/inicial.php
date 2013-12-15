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
            
            $this->load->model('daos/DAONoticias');
            $this->load->model('producao/MNoticias');  
            
            $this->load->model('daos/DAOServicos');
            $this->load->model('producao/MServicos');  
            
            $this->load->model('daos/DAOLinhasProdutos');
            $this->load->model('producao/MLinhasProdutos');
            
            $this->load->model('daos/DAOProdutos');
            $this->load->model('producao/MProdutos');   
            
        }
        
        public function index()
        {
            $dadosEmpresa['dadosEmpresa']       = $this->DAODadosEmpresa->getDadosEmpresa();
            $dadosInicial['linhasProdutos']     = $this->DAOLinhasProdutos->getAll()->result_array();                        
            
            $dadosInicial['anuncios']           = $this->getAnuncios();
            $dadosInicial['noticias']           = $this->getNoticias();
            
            $dadosInicial['dadosEmpresa']       = $dadosEmpresa['dadosEmpresa'];                         
            
            if($this->getServicoPrincipal() != NULL)
            {    
                $dadosInicial['servicoPrincipal']   = $this->getServicoPrincipal();                                    
            }
                     
            $this->load->view('fragmentos/cabecalho', $dadosEmpresa);            
            $this->load->view('publico/inicial', $dadosInicial);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        private function getAnuncios()
        {
            $anuncios = $this->DAOAnuncios->getAnuncios()->result_array();                 
            
            $anunciosComImagem = array();                       
            
            foreach ($anuncios as $anuncio) {
                                                                                
                $imagemPrincipal = $this->DAOAnuncios->getImagemPrincipal($anuncio['id']);
                
                $anuncio['imagemprincipal'] = $imagemPrincipal['localizacao'];
                
                $anunciosComImagem[] = $anuncio;
            }       
            
            return $anunciosComImagem;                        
        }
        
        private function getNoticias()
        {
            $noticias = $this->DAONoticias->getNoticias()->result_array();                 
                        
            $noticiasComImagem = array();                       
            
            foreach ($noticias as $noticia) {
                                                                                
                $imagemPrincipal = $this->DAONoticias->getImagemPrincipal($noticia['id']);                                
                
                if($imagemPrincipal != NULL)
                {
                    $noticia['imagemprincipal'] = $imagemPrincipal['localizacao'];                
                    $noticiasComImagem[] = $noticia;
                }                
            }       
            
            return $noticiasComImagem;                        
        }
        
        private function getServicoPrincipal(){
            
            
            if($this->DAOServicos->getNumberRecords() > 0)
            {
                $servico = $this->DAOServicos->getServicoPrincipal()->result_array()[0];            
                $imagemPrincipal = $this->DAOServicos->getImagemPrincipal($servico['id']);                                     
                $servico['imagemprincipal'] = $imagemPrincipal['localizacao'];
                return $servico;
            } 
            
            return NULL;                                    
        }
        
        private function getProdutoAgricolaPrincipal($idProduto) {
            
            $produto = $this->DAOProdutos->getProdutoById($idProduto);
            
            return $produto;
        }
    }
?>
