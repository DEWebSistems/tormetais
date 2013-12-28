<?php
    class Noticias extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('producao/MNoticias');
            $this->load->model('daos/DAONoticias');
            
            $this->load->model('producao/MDadosEmpresa');
            $this->load->model('daos/DAODadosEmpresa');                        
            
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
                if($this->DAONoticias->excluir($dadosPost['bsExcluir']))
                {
                    $messages['isSuccess'] = true;
                    $messages['isErrors'] = false;
                    $messages['messagesSuccess'] = 'Registro salvo com sucesso.';
                }
                else
                {
                    $messages['isSuccess'] = false;
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = 'Erro ao excluir o registro.<br/>Detalhes: ' . $this->DAONoticias->getMessagesErros();
                }
            }
            else
            {
                $messages['isErrors'] = false;
                $messages['isSuccess'] = false;
            }
            $datasBody = array();
            
            
            $datasBody['messages'] = $messages;
            $returns = $this->DAONoticias->listPagination($numberPage);            
            $datasBody['noticias'] = $returns->result_array();
            $this->load->library('pagination');
            $config['use_page_numbers'] = TRUE;
            $config['base_url'] = 'noticias/index/';
            $config['total_rows'] = $this->DAONoticias->getNumberRecords();
            $config['per_page'] = $this->DAONoticias->getLimitPage();
            $this->pagination->initialize($config);
            $datasBody['paginations'] = $this->pagination->create_links();
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/noticiaslist', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function adicionar()
        {
            $datasBody = array();
            $dadosNoticia = array();
            $dadosNoticia['id'] = '';
            $dadosNoticia['nome'] = '';
            $dadosNoticia['descricao'] = '';                        
            $datasBody['operation'] = 'i';
            $datasBody['dadosNoticia'] = $dadosNoticia;            
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);            
            $this->load->view('privado/producao/noticiasform', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function alterar($id)
        {
            $datasBody = array();
            $dadosNoticia = array();
            $returns = $this->DAONoticias->getNoticiaById($id);
            $datasBody['operation'] = 'u';
            $datasBody['dadosNoticia'] = $returns;            
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/noticiasform', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function gravar($dadosPost)
        {
            $this->MNoticias->setId($dadosPost['itId']);
            $this->MNoticias->setNome($dadosPost['itNome']);
            $this->MNoticias->setDescricao($dadosPost['taDescricao']);     
            $this->MNoticias->setDataPublicacao(date('Y-m-d H:i:s'));
            if($dadosPost['bsGravar'] == 'i')
            {
                $results = $this->DAONoticias->insert($this->MNoticias);
            }
            else if($dadosPost['bsGravar'] == 'u')
            {
                $results = $this->DAONoticias->update($this->MNoticias);
            }
            else
            {
                $results = false;
            }            
            return $results;
        }
               
        public function multimidias($noticiaId)
        {
            $datasBody['messages']['messagesErrors'] = '';
            $datasBody['messages']['messagesSuccess'] = '';
            $dadosPost = $this->input->post();
            if(isset($dadosPost['bsGravarImagem']))
            {
                $resultsRecording = $this->gravarImagem($noticiaId);
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
                $resultsSets = $this->setArquivoPrincipal($noticiaId, $arquivoMultimidiaId);
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
                $resultsDeletes = $this->excluirArquivoMultimidia($noticiaId, $arquivoMultimidiaId);
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
                    $resultsRecording = $this->DAONoticias->insertAM($noticiaId, $this->MArquivosMultimidias, $arquivoPrincipal);
                    if($resultsRecording == false)
                    {
                        $datasBody['messages']['messagesErrors'] = 'Erro ao gravar a imagem no banco de dados.<br/>Detalhes: ' . $this->DAONoticias->getMessagesErros();
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
                $resultsDeletes = $this->excluirArquivoMultimidia($noticiaId, $arquivoMultimidiaId);
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
            $returnsNoticias = $this->DAONoticias->getNoticiaById($noticiaId);
            $datasBody['dadosNoticia'] = $returnsNoticias;
            $returnsImagens = $this->DAONoticias->getImagens($returnsNoticias['id']);
            $returnsVideos = $this->DAONoticias->getVideos($returnsNoticias['id']);
            $datasBody['dadosImagens'] = $returnsImagens->result_array();
            $datasBody['dadosVideos'] = $returnsVideos->result_array();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/noticiasmultimidias', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        private function gravarImagem($noticiaId)
        {
            if($_FILES['ifImage']['name'] == '')
            {
                $errors['messages'] = 'A foto não foi selecionada.';
                return $errors;
            }
            $configsUploads['upload_path'] = "./assets/imagesproductions/";
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
                $returnsImagens = $this->DAONoticias->getImagens($noticiaId);
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
                if($this->DAONoticias->insertAM($noticiaId, $this->MArquivosMultimidias, $arquivoPrincipal))
                {
                    return true;
                }
                else
                {
                    $errors['messages'] = 'Erro ao gravar a imagem no banco de dados.<br/>Detalhes: ' . $this->DAONoticias->getMessagesErros();
                    return $errors;
                }
            }
        }
        
        private function setArquivoPrincipal($noticiaId, $arquivoMultimidiaId)
        {
            if($this->DAONoticias->setArquivoPrincipal($noticiaId, $arquivoMultimidiaId))
            {
                return true;
            }
            else
            {
                $errors['messages'] = 'Erro ao setar a imagem como principal.<br/>Detalhes: ' . $this->DAONoticias->getMessagesErros();
                return $errors;
            }
        }
        
        private function excluirArquivoMultimidia($noticiaId, $arquivoMultimidiaId)
        {
            if(!$this->DAONoticias->deleteArquivoMultimidia($noticiaId, $arquivoMultimidiaId))
            {
                $errors['messages'] = 'Erro ao excluir a imagem e/ou vídeo.<br/>Detalhes: ' . $this->DAONoticias->getMessagesErros();
                return $errors;
            }
            else
            {
                return true;
            }
        }
    }
?>