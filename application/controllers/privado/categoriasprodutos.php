<?php
    class CategoriasProdutos extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('daos/DAODadosEmpresa');
            $this->load->model('producao/MDadosEmpresa');
            $this->load->model('producao/MCategoriasProdutos');
            $this->load->model('daos/DAOCategoriasProdutos');
            $this->load->helper('url');
            //$this->load->helper('url');
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
            else if(isset($dadosPost['bsExcluir']))
            {
                if($this->DAOCategoriasProdutos->excluir($dadosPost['bsExcluir']) == true)
                {
                    $messages['isSuccess'] = true;
                    $messages['isErrors'] = false;
                    $messages['messagesSuccess'] = 'Registro excluído';
                }
                else
                {
                    $messages['isSuccess'] = false;
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = 'Erro ao excluir o registro';
                }
            }
            else
            {
                $messages['isErrors'] = false;
                $messages['isSuccess'] = false;
            }
            $datasBody = array();
            $datasBody['messages'] = $messages;
            $returns = $this->DAOCategoriasProdutos->listPagination($numberPage);
            //echo '<pre>';
            //print_r($returns->result_array());
            //echo '</pre>';
            $datasBody['categoriasProdutos'] = $returns->result_array();
            $this->load->library('pagination');
            $config['use_page_numbers'] = TRUE;
            $config['base_url'] = site_url('privado/categoriasprodutos/lista');
            $config['total_rows'] = $this->DAOCategoriasProdutos->getNumberRecords();
            $config['per_page'] = $this->DAOCategoriasProdutos->getLimitPage();
            $this->pagination->initialize($config);
            $datasBody['paginations'] = $this->pagination->create_links();
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/categoriasprodutoslist', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function adicionar()
        {
            $datasBody = array();
            $dadosCP = array();
            $dadosCP['id'] = '';
            $dadosCP['nome'] = '';
            $datasBody['operation'] = 'i';
            $datasBody['dadosCP'] = $dadosCP;
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/categoriasprodutosform', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function alterar($id)
        {
            $datasBody = array();
            $dadosCP = array();
            $returns = $this->DAOCategoriasProdutos->getCategoriaProduto($id);
            $returns = $returns->result_array()[0];
            $datasBody['operation'] = 'u';
            $datasBody['dadosCP'] = $returns;
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/categoriasprodutosform', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function gravar($dadosPost)
        {
            $this->MCategoriasProdutos->setId($dadosPost['itId']);
            $this->MCategoriasProdutos->setNome($dadosPost['itNome']);
            if($dadosPost['bsGravar'] == 'i')
            {
                $results = $this->DAOCategoriasProdutos->insert($this->MCategoriasProdutos);
            }
            else if($dadosPost['bsGravar'] == 'u')
            {
                $results = $this->DAOCategoriasProdutos->update($this->MCategoriasProdutos);
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