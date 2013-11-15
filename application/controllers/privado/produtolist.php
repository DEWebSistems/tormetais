<?php

use MProduto;

class Produto extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
            $dadosPost = $this->input->post();
            if(isset($dadosPost['bsGravar']))
            {
                //echo '<pre>';
                //print_r($dadosPost);
                //echo '</pre>';
                $this->gravar($dadosPost);
            }
            $datasBody['categoriasProduto'] = $this->getCategoriasProduto();
            $this->load->model('daos/DAOProduto');
            $this->load->model('producao/MProduto');
            $datasBody['produto'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalho');
            $this->load->view('privado/producao/dadosempresa', $datasBody);
            $this->load->view('fragmentos/rodape');
        }
        
        private function gravar($dadosPost)
        {
            $this->load->model('producao/MProduto');                        
            $this->MProduto->setId($dadosPost['itId']);
            $this->MProduto->setNome($dadosPost['itNome']);
            $this->MProduto->setDescricao($dadosPost['itDescricao']);            
            $this->MProduto->setCategoriaProdutoId($dadosPost['seCategoriaProduto']);            
            $this->load->model('daos/DAOProduto');
            if($this->MProduto->getId() == null)
            {
                $this->DAOProduto->inserir($this->MProduto);
            }
            else
            {
                $this->DAOProduto->alterar($this->MProduto);
            }
        }
        
        private function alterar($idProduto)
        {
            $datasBody['categoriasProduto'] = $this->getCategoriasProdutos();
            $this->load->model('daos/DAOProduto');
            $this->load->model('producao/MProduto');
            $datasBody['produto'] = $this->DAOProduto->getProdutoById($idProduto);
            $this->load->view('fragmentos/cabecalho');
            $this->load->view('privado/producao/produtoform', $datasBody);
            $this->load->view('fragmentos/rodape');
            
        }                
        
        private function excluir($idProduto)
        {       
            $this->DAOProduto->excluir($idProduto);     
            $this->listar();
        }
        
        private function listar()
        {            
            $this->load->model('daos/DAOProduto');
            $this->load->model('producao/MProduto');
            $datasBody['produtos'] = $this->DAOProduto->getProdutos();
            $this->load->view('fragmentos/cabecalho');
            $this->load->view('privado/producao/produtolista', $datasBody);
            $this->load->view('fragmentos/rodape');
        }
        
        private function incluir()
        {           
            
            $datasBody['categoriasProduto'] = $this->getCategoriasProdutos();
            $this->load->model('daos/DAOProduto');
            $this->load->model('producao/MProduto');
            $datasBody['produto'] = new MProduto();
            $this->load->view('fragmentos/cabecalho');
            $this->load->view('privado/producao/produtoform', $datasBody);
            $this->load->view('fragmentos/rodape');
            
            $this->load->view('fragmentos/cabecalho');
            $this->load->view('privado/producao/produto-form');
            $this->load->view('fragmentos/rodape');
        }

        private function getCategoriasProdutos()
        {
            $categoriasProdutos = array(
                1 => 'Categoria Um',
                2 => 'Categoria Dois'                
            );
            return $categoriasProdutos;
        }
    }
?>