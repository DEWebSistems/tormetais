<?php
    class Anuncios extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('producao/MAnuncios');
            $this->load->model('daos/DAOAnuncios');
            $this->load->helper('url');      
            
            $this->load->model('daos/DAODadosEmpresa');
            $this->load->model('producao/MDadosEmpresa');   
        }
        
        public function index()
        {
            $this->lista(1);            
        }
        
        public function lista($numberPage = 1)
        {
            $dadosPost = $this->input->post();            
            
            if(isset($dadosPost['bsGravar']))
            {                
                if($this->gravar($dadosPost) == true)
                {
                    $messages['isSuccess'] = true;
                    $messages['isErrors'] = false;
                    $messages['messagesSuccess'] = 'Registro salvo com sucesso';
                }
                else
                {
                    $messages['isSuccess'] = false;
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = 'Erro ao salvar o registro';
                }
            }            
            else
            {
                $messages['isErrors'] = false;
                $messages['isSuccess'] = false;
            }
            $datasBody = array();
            
            
            $datasBody['messages'] = $messages;
            $returns = $this->DAOAnuncios->listPagination($numberPage);            
            $datasBody['anuncios'] = $returns->result_array();
            $this->load->library('pagination');
            $config['use_page_numbers'] = TRUE;
            $config['base_url'] = 'anuncios/index/';
            $config['total_rows'] = $this->DAOAnuncios->getNumberRecords();
            $config['per_page'] = $this->DAOAnuncios->getLimitPage();
            $this->pagination->initialize($config);
            $datasBody['paginations'] = $this->pagination->create_links();
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/anuncioslist', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function adicionar()
        {
            $datasBody = array();
            $dadosAnuncio = array();
            $dadosAnuncio['id'] = '';
            $dadosAnuncio['nome'] = '';
            $dadosAnuncio['descricao'] = '';            
            $datasBody['operation'] = 'i';
            $datasBody['dadosAnuncio'] = $dadosAnuncio;
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/anunciosform', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function alterar($id)
        {
            $datasBody = array();
            $dadosAnuncio = array();
            $returns = $this->DAOAnuncios->getAnuncio($id);
            $returns = $returns->result_array()[0];
            $datasBody['operation'] = 'u';
            $datasBody['dadosAnuncio'] = $returns;
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/anuncioslist', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function gravar($dadosPost)
        {
            $this->MAnuncios->setId($dadosPost['itId']);
            $this->MAnuncios->setNome($dadosPost['itNome']);
            $this->MAnuncios->setDescricao($dadosPost['taDescricao']);
            if($dadosPost['bsGravar'] == 'i')
            {
                $results = $this->DAOAnuncios->insert($this->MAnuncios);
            }
            else if($dadosPost['bsGravar'] == 'u')
            {
                $results = $this->DAOAnuncios->update($this->MAnuncios);
            }
            else
            {
                $results = false;
            }
            //echo '<pre>';
            //print_r($dadosPost);
            //print_r($results);
            //echo '</pre>';
            return $results;
        }
    }
?>