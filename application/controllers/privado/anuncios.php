<?php
    class Anuncios extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('producao/MAnuncios');
            $this->load->model('daos/DAOAnuncios');
            
            $this->load->model('daos/DAODadosEmpresa');
            $this->load->model('producao/MDadosEmpresa');                        
            
            $this->load->helper(array('url', 'form'));
            
            $this->load->model('seguranca/MUsuarios');
            $this->MUsuarios->validateUser();
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
            $dadosAnuncio['categoriaanuncioid'] = '';
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
            $returns = $this->DAOAnuncios->getAnuncioById($id);
            $datasBody['operation'] = 'u';
            $datasBody['dadosAnuncio'] = $returns;            
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/anunciosform', $datasBody);
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
            return $results;
        }
        
        private function getCategoriasAnuncios()
        {
            $categoriasAnuncios = array(
                1 => 'Categoria Um',
                2 => 'Categoria Dois'                
            );
            return $categoriasAnuncios;
        }
        
        public function multimidias($anuncioId)
        {
            $datasBody['messages']['messagesErrors'] = '';
            $datasBody['messages']['messagesSuccess'] = '';
            $dadosPost = $this->input->post();
            if(isset($dadosPost['bsGravarImagem']))
            {
                $resultsRecording = $this->gravarImagem($anuncioId);
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
                $resultsSets = $this->setArquivoPrincipal($anuncioId, $arquivoMultimidiaId);
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
                $resultsDeletes = $this->excluirArquivoMultimidia($anuncioId, $arquivoMultimidiaId);
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
                    $resultsRecording = $this->DAOAnuncios->insertAM($anuncioId, $this->MArquivosMultimidias, $arquivoPrincipal);
                    if($resultsRecording == false)
                    {
                        $datasBody['messages']['messagesErrors'] = 'Erro ao gravar a imagem no banco de dados.<br/>Detalhes: ' . $this->DAOAnuncios->getMessagesErros();
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
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $returnsAnuncios = $this->DAOAnuncios->getAnuncioById($anuncioId);
            $datasBody['dadosAnuncio'] = $returnsAnuncios;
            $returnsImagens = $this->DAOAnuncios->getImagens($returnsAnuncios['id']);
            $returnsVideos = $this->DAOAnuncios->getVideos($returnsAnuncios['id']);
            $datasBody['dadosImagens'] = $returnsImagens->result_array();
            $datasBody['dadosVideos'] = $returnsVideos->result_array();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/anunciosmultimidias', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        private function gravarImagem($anuncioId)
        {
            if($_FILES['ifImage']['name'] == '')
            {
                $errors['messages'] = 'A foto não foi selecionada.';
                return $errors;
            }
            $configsUploads['upload_path'] = "./assets/imagesproductions/";
            $configsUploads['allowed_types'] = 'gif|jpg|png|jpeg';
            $configsUploads['max_size'] = '2000';
            $configsUploads['max_width'] = '5000';
            $configsUploads['max_height'] = '5000';
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
                $returnsImagens = $this->DAOAnuncios->getImagens($anuncioId);
                $datasUploads = $this->upload->data();
                $this->MArquivosMultimidias->setNomeOriginal($datasUploads['orig_name']);
                $this->MArquivosMultimidias->setLocalizacao(PATHIMAGESPRODUCTIONS . $datasUploads['file_name']);
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
                if($this->DAOAnuncios->insertAM($anuncioId, $this->MArquivosMultimidias, $arquivoPrincipal))
                {
                    return true;
                }
                else
                {
                    $errors['messages'] = 'Erro ao gravar a imagem no banco de dados.<br/>Detalhes: ' . $this->DAOAnuncios->getMessagesErros();
                    return $errors;
                }
            }
        }
        
        private function setArquivoPrincipal($anuncioId, $arquivoMultimidiaId)
        {
            if($this->DAOAnuncios->setArquivoPrincipal($anuncioId, $arquivoMultimidiaId))
            {
                return true;
            }
            else
            {
                $errors['messages'] = 'Erro ao setar a imagem como principal.<br/>Detalhes: ' . $this->DAOAnuncios->getMessagesErros();
                return $errors;
            }
        }
        
        private function excluirArquivoMultimidia($anuncioId, $arquivoMultimidiaId)
        {
            if(!$this->DAOAnuncios->deleteArquivoMultimidia($anuncioId, $arquivoMultimidiaId))
            {
                $errors['messages'] = 'Erro ao excluir a imagem.<br/>Detalhes: ' . $this->DAOAnuncios->getMessagesErros();
                return $errors;
            }
            else
            {
                return true;
            }
        }
    }
?>