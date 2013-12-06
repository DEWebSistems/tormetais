<?php
    class Produtos extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('producao/MProdutos');
            $this->load->model('daos/DAOProdutos');
            
            $this->load->model('producao/MDadosEmpresa');
            $this->load->model('daos/DAODadosEmpresa');
            
            $this->load->model('producao/MCategoriasProdutos');
            $this->load->model('daos/DAOCategoriasProdutos');
            
            $this->load->model('producao/MLinhasProdutos');
            $this->load->model('daos/DAOLinhasProdutos');
            
            $this->load->helper(array('url', 'form'));
        }
        
        public function index()
        {            
            $this->lista(1);
        }
        
        public function lista($numberPage = 1)
        {
            $dadosPost = $this->input->post();
            
            //echo '<pre>';
            //print_r($dadosPost);
            //echo '</pre>';
            if(isset($dadosPost['bsGravar']))
            {
                if($this->gravar($dadosPost) == true)
                {
                    $messages['isSuccess'] = true;
                    $messages['isErrors'] = false;
                    $messages['messagesSuccess'] = 'Registro salvo com sucesso.';
                }
                else
                {
                    $messages['isSuccess'] = false;
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = 'Erro ao salvar o registro.';
                }
            }
            else if(isset($dadosPost['bsExcluir']))
            {
                if($this->DAOProdutos->excluir($dadosPost['bsExcluir']))
                {
                    $messages['isSuccess'] = true;
                    $messages['isErrors'] = false;
                    $messages['messagesSuccess'] = 'Registro salvo com sucesso.';
                }
                else
                {
                    $messages['isSuccess'] = false;
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = 'Erro ao excluir o registro.<br/>Detalhes: ' . $this->DAOProdutos->getMessagesErros();
                }
            }
            else
            {
                $messages['isErrors'] = false;
                $messages['isSuccess'] = false;
            }
            $datasBody = array();
            
            
            $datasBody['messages'] = $messages;
            $returns = $this->DAOProdutos->listPagination($numberPage);            
            $datasBody['produtos'] = $returns->result_array();
            $this->load->library('pagination');
            $config['use_page_numbers'] = TRUE;
            $config['base_url'] = 'produtos/index/';
            $config['total_rows'] = $this->DAOProdutos->getNumberRecords();
            $config['per_page'] = $this->DAOProdutos->getLimitPage();
            $this->pagination->initialize($config);
            $datasBody['paginations'] = $this->pagination->create_links();
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/produtoslist', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function adicionar()
        {
            $datasBody = array();
            $dadosProduto = array();
            $dadosProduto['id'] = '';
            $dadosProduto['nome'] = '';
            $dadosProduto['descricao'] = '';
            $dadosProduto['categoriaprodutoid'] = '';
            $dadosProduto['linhaprodutoid'] = '';
            $datasBody['operation'] = 'i';
            $datasBody['dadosProduto'] = $dadosProduto;
            $datasBody['categoriasProduto'] = $this->DAOCategoriasProdutos->getCategoriasProdutos()->result_array();
            $datasBody['linhasProduto'] = $this->DAOLinhasProdutos->getAll()->result_array();
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);            
            $this->load->view('privado/producao/produtosform', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function alterar($id)
        {
            $datasBody = array();
            $dadosProduto = array();
            $returns = $this->DAOProdutos->getProdutoById($id);
            $datasBody['operation'] = 'u';
            $datasBody['dadosProduto'] = $returns;
            $datasBody['categoriasProduto'] = $this->DAOCategoriasProdutos->getCategoriasProdutos()->result_array();
            $datasBody['linhasProduto'] = $this->DAOLinhasProdutos->getAll()->result_array();
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/produtosform', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function gravar($dadosPost)
        {
            $this->MProdutos->setId($dadosPost['itId']);
            $this->MProdutos->setNome($dadosPost['itNome']);
            $this->MProdutos->setDescricao($dadosPost['taDescricao']);
            $this->MProdutos->setCategoriaProdutoId($dadosPost['seCategoriaProduto']);
            $this->MProdutos->setLinhaProdutoId($dadosPost['seLinhaProduto']);
            if($dadosPost['bsGravar'] == 'i')
            {
                $results = $this->DAOProdutos->insert($this->MProdutos);
            }
            else if($dadosPost['bsGravar'] == 'u')
            {
                $results = $this->DAOProdutos->update($this->MProdutos);
            }
            else
            {
                $results = false;
            }            
            return $results;
        }
        
        private function getCategoriasProdutos()
        {
            $categoriasProdutos = array(
                1 => 'Categoria Um',
                2 => 'Categoria Dois'                
            );
            return $categoriasProdutos;
        }
        
        public function multimidias($produtoId)
        {
            $datasBody['messages']['messagesErrors'] = '';
            $datasBody['messages']['messagesSuccess'] = '';
            $dadosPost = $this->input->post();
            if(isset($dadosPost['bsGravarImagem']))
            {
                $resultsRecording = $this->gravarImagem($produtoId);
                if($resultsRecording['messages'] != '')
                {
                    $datasBody['messages']['messagesErrors'] = $resultsRecording['messages'];
                }
                else if($resultsRecording == true)
                {
                    $datasBody['messages']['messagesSuccess'] = 'A imagem foi salva com sucesso.';
                }
                else
                {
                    $datasBody['messages']['messagesErrors'] = 'Ocorreu um erro não detectado.';
                }
            }
            else if(isset($dadosPost['bsImagemPrincipal']))
            {
                $arquivoMultimidiaId = $dadosPost['ihArquivoMultimidiaId'];
                $resultsSets = $this->setArquivoPrincipal($produtoId, $arquivoMultimidiaId);
                if($resultsSets['messages'] != '')
                {
                    $datasBody['messages']['messagesErrors'] = $resultsSets['messages'];
                }
                else if($resultsSets == true)
                {
                    $datasBody['messages']['messagesSuccess'] = 'A imagem foi setada como principal.';
                }
                else
                {
                    $datasBody['messages']['messagesErrors'] = 'Ocorreu um erro não detectado.';
                }
            }
            else if(isset($dadosPost['bsExcluirImagem']))
            {
                $arquivoMultimidiaId = $dadosPost['ihArquivoMultimidiaId'];
                $resultsDeletes = $this->excluirArquivoMultimidia($produtoId, $arquivoMultimidiaId);
                if($resultsDeletes['messages'] != '')
                {
                    $datasBody['messages']['messagesErrors'] = $resultsDeletes['messages'];
                }
                else if($resultsDeletes == true)
                {
                    $datasBody['messages']['messagesSuccess'] = 'A imagem foi excluída.';
                }
                else
                {
                    $datasBody['messages']['messagesErrors'] = 'Ocorreu um erro não detectado.';
                }
            }
            else if(isset($dadosPost['bsGravarVideo']))
            {
                if((isset($dadosPost['iurlVideo'])) and ($dadosPost['iurlVideo'] != ''))
                {
                    $iurlVideo = $dadosPost['iurlVideo'];
                    //$this->MArquivosMultimidias->setNomeOriginal('');
                    $this->MArquivosMultimidias->setLocalizacao($iurlVideo);
                    //$this->MArquivosMultimidias->setExtensao('');
                    $this->MArquivosMultimidias->setTipoArquivo(1);
                    $arquivoPrincipal = false;
                    $resultsRecording = $this->DAOProdutos->insertAM($produtoId, $this->MArquivosMultimidias, $arquivoPrincipal);
                    if($resultsRecording == false)
                    {
                        $datasBody['messages']['messagesErrors'] = 'Erro ao gravar a imagem no banco de dados.<br/>Detalhes: ' . $this->DAOProdutos->getMessagesErros();
                    }
                    else if($resultsRecording == true)
                    {
                        $datasBody['messages']['messagesSuccess'] = 'A vídeo foi salvo com sucesso.';
                    }
                    else
                    {
                        $datasBody['messages']['messagesErrors'] = 'Ocorreu um erro não detectado.';
                    }
                }
                else
                {
                    $datasBody['messages']['messagesErrors'] = 'O link do vídeo não foi informado, por isso o mesmo não pode ser salvo.';
                }
            }
            else if(isset($dadosPost['bsExcluirVideo']))
            {
                $arquivoMultimidiaId = $dadosPost['bsExcluirVideo'];
                $resultsDeletes = $this->excluirArquivoMultimidia($produtoId, $arquivoMultimidiaId);
                if($resultsDeletes['messages'] != '')
                {
                    $datasBody['messages']['messagesErrors'] = $resultsDeletes['messages'];
                }
                else if($resultsDeletes == true)
                {
                    $datasBody['messages']['messagesSuccess'] = 'O vídeo foi excluído.';
                }
                else
                {
                    $datasBody['messages']['messagesErrors'] = 'Ocorreu um erro não detectado.';
                }
            }
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $returnsProdutos = $this->DAOProdutos->getProdutoById($produtoId);
            $datasBody['dadosProduto'] = $returnsProdutos;
            $returnsImagens = $this->DAOProdutos->getImagens($returnsProdutos['id']);
            $returnsVideos = $this->DAOProdutos->getVideos($returnsProdutos['id']);
            $datasBody['dadosImagens'] = $returnsImagens->result_array();
            $datasBody['dadosVideos'] = $returnsVideos->result_array();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/produtosmultimidias', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        private function gravarImagem($produtoId)
        {
            if($_FILES['ifImage']['name'] == '')
            {
                $errors['messages'] = 'A foto não foi selecionada.';
                return $errors;
            }
            $configsUploads['upload_path'] = "C:/xampp/htdocs/tormetais/assets/imagesproductions/";
            $configsUploads['allowed_types'] = 'gif|jpg|png|jpeg';
            $configsUploads['max_size'] = '1000';
            $configsUploads['max_width'] = '2000';
            $configsUploads['max_height'] = '2000';
            $configsUploads['encrypt_name'] = false;
            $configsUploads['file_name'] = md5(date('YmdHis'));
            $this->load->library('upload', $configsUploads);
            if(!$this->upload->do_upload('ifImage'))
            {
                $errorsUploads = $this->upload->display_errors();
                $errors['messages'] = 'Erro ao fazer o upload da imagem.<br/>Detalhes: ' . $errorsUploads;
                return $errors;
            }
            else
            {
                $returnsImagens = $this->DAOProdutos->getImagens($produtoId);
                $datasUploads = $this->upload->data();
                $this->MArquivosMultimidias->setNomeOriginal($datasUploads['orig_name']);
                $this->MArquivosMultimidias->setLocalizacao('/tormetais/assets/imagesproductions/' . $datasUploads['file_name']);
                $this->MArquivosMultimidias->setExtensao($datasUploads['file_ext']);
                $this->MArquivosMultimidias->setTipoArquivo(0);
                $arquivoPrincipal = false;
                if($returnsImagens->num_rows() == 0)
                {
                    $arquivoPrincipal = true;
                }
                $dadosPost = $this->input->post();
                if(isset($dadosPost['icbImagemPrincipal']))
                {
                    $arquivoPrincipal = true;
                }
                if($this->DAOProdutos->insertAM($produtoId, $this->MArquivosMultimidias, $arquivoPrincipal))
                {
                    return true;
                }
                else
                {
                    $errors['messages'] = 'Erro ao gravar a imagem no banco de dados.<br/>Detalhes: ' . $this->DAOProdutos->getMessagesErros();
                    return $errors;
                }
            }
        }
        
        private function setArquivoPrincipal($produtoId, $arquivoMultimidiaId)
        {
            if($this->DAOProdutos->setArquivoPrincipal($produtoId, $arquivoMultimidiaId))
            {
                return true;
            }
            else
            {
                $errors['messages'] = 'Erro ao setar a imagem como principal.<br/>Detalhes: ' . $this->DAOProdutos->getMessagesErros();
                return $errors;
            }
        }
        
        private function excluirArquivoMultimidia($produtoId, $arquivoMultimidiaId)
        {
            if(!$this->DAOProdutos->deleteArquivoMultimidia($produtoId, $arquivoMultimidiaId))
            {
                $errors['messages'] = 'Erro ao excluir a imagem e/ou vídeo.<br/>Detalhes: ' . $this->DAOProdutos->getMessagesErros();
                return $errors;
            }
            else
            {
                return true;
            }
        }
    }
?>