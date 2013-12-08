<?php
    class Servicos extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->model('producao/MServicos');
            $this->load->model('daos/DAOServicos');
            
            $this->load->model('producao/MDadosEmpresa');
            $this->load->model('daos/DAODadosEmpresa');
            
            $this->load->model('producao/MCategoriasServicos');
            $this->load->model('daos/DAOCategoriasServicos');
                        
            $this->load->helper(array('url', 'form'));
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
                $servicoReturn = $this->DAOServicos->getServicoById($dadosPost['itId']);                                
                
                echo $servicoReturn['principal'];
                if(($servicoReturn['principal'] == TRUE) and (isset($dadosPost['icbServicoPrincipal']) == false))
                {
                    
                    echo 'aki';
                    $messages['isSuccess'] = false;
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = 'Erro ao salvar.<br/>Detalhes: Deve existir pelo menos um serviço principal.';
                }                      
                else if($this->gravar($dadosPost) == true)
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
                $servicoReturn = $this->DAOServicos->getServicoById($dadosPost['bsExcluir'])->result_array();
                
                if($servicoReturn['principal'])
                {
                    $messages['isSuccess'] = false;
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = 'Erro ao excluir o registro.<br/>Detalhes: Este é o serviço principal.';
                }                                 
                else if($this->DAOServicos->excluir($dadosPost['bsExcluir']))
                {
                    $messages['isSuccess'] = true;
                    $messages['isErrors'] = false;
                    $messages['messagesSuccess'] = 'Registro Excluído com sucesso.';
                }
                else
                {
                    $messages['isSuccess'] = false;
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = 'Erro ao excluir o registro.<br/>Detalhes: ' . $this->DAOServicos->getMessagesErros();
                }
            }
            else
            {
                $messages['isErrors'] = false;
                $messages['isSuccess'] = false;
            }
            $datasBody = array();
            
            
            $datasBody['messages'] = $messages;
            $returns = $this->DAOServicos->listPagination($numberPage);            
            $datasBody['servicos'] = $returns->result_array();
            $this->load->library('pagination');
            $config['use_page_numbers'] = TRUE;
            $config['base_url'] = 'servicos/index/';
            $config['total_rows'] = $this->DAOServicos->getNumberRecords();
            $config['per_page'] = $this->DAOServicos->getLimitPage();
            $this->pagination->initialize($config);
            $datasBody['paginations'] = $this->pagination->create_links();
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/servicoslist', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function adicionar()
        {
            $datasBody = array();
            $dadosServico = array();
            $dadosServico['id'] = '';
            $dadosServico['nome'] = '';
            $dadosServico['descricao'] = '';
            $dadosServico['categoriaservicoid'] = '';   
            $dadosServico['principal'] = false;   
            $datasBody['operation'] = 'i';
            $datasBody['dadosServico'] = $dadosServico;
            $datasBody['categoriasServico'] = $this->DAOCategoriasServicos->getCategoriasServicos()->result_array();            
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);            
            $this->load->view('privado/producao/servicosform', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function alterar($id)
        {
            $datasBody = array();
            $dadosServico = array();
            $returns = $this->DAOServicos->getServicoById($id);
            $datasBody['operation'] = 'u';
            $datasBody['dadosServico'] = $returns;
            $datasBody['categoriasServico'] = $this->DAOCategoriasServicos->getCategoriasServicos()->result_array();            
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/servicosform', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function gravar($dadosPost)
        {
            
            
            $this->MServicos->setId($dadosPost['itId']);
            $this->MServicos->setNome($dadosPost['itNome']);
            $this->MServicos->setDescricao($dadosPost['taDescricao']);
            $this->MServicos->setCategoriaServicoId($dadosPost['seCategoriaServico']);
            
            if(isset($dadosPost['icbServicoPrincipal']))
            {
                $this->MServicos->setPrincipal(true);
            } 
            else {
                $this->MServicos->setPrincipal(false);
            }                                                                               
            
            if($dadosPost['bsGravar'] == 'i')
            {
                $results = $this->DAOServicos->insert($this->MServicos);
            }
            else if($dadosPost['bsGravar'] == 'u')
            {
                $results = $this->DAOServicos->update($this->MServicos);
            }
            else
            {
                $results = false;
            }            
            return $results;
        }               
        
        public function multimidias($servicoId)
        {
            $datasBody['messages']['messagesErrors'] = '';
            $datasBody['messages']['messagesSuccess'] = '';
            $dadosPost = $this->input->post();
            if(isset($dadosPost['bsGravarImagem']))
            {
                $resultsRecording = $this->gravarImagem($servicoId);
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
                $resultsSets = $this->setArquivoPrincipal($servicoId, $arquivoMultimidiaId);
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
                $resultsDeletes = $this->excluirArquivoMultimidia($servicoId, $arquivoMultimidiaId);
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
                    $resultsRecording = $this->DAOServicos->insertAM($servicoId, $this->MArquivosMultimidias, $arquivoPrincipal);
                    if($resultsRecording == false)
                    {
                        $datasBody['messages']['messagesErrors'] = 'Erro ao gravar a imagem no banco de dados.<br/>Detalhes: ' . $this->DAOServicos->getMessagesErros();
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
                $resultsDeletes = $this->excluirArquivoMultimidia($servicoId, $arquivoMultimidiaId);
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
            $returnsServicos = $this->DAOServicos->getServicoById($servicoId);
            $datasBody['dadosServico'] = $returnsServicos;
            $returnsImagens = $this->DAOServicos->getImagens($returnsServicos['id']);
            $returnsVideos = $this->DAOServicos->getVideos($returnsServicos['id']);
            $datasBody['dadosImagens'] = $returnsImagens->result_array();
            $datasBody['dadosVideos'] = $returnsVideos->result_array();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/producao/servicosmultimidias', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        private function gravarImagem($servicoId)
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
                $returnsImagens = $this->DAOServicos->getImagens($servicoId);
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
                if($this->DAOServicos->insertAM($servicoId, $this->MArquivosMultimidias, $arquivoPrincipal))
                {
                    return true;
                }
                else
                {
                    $errors['messages'] = 'Erro ao gravar a imagem no banco de dados.<br/>Detalhes: ' . $this->DAOServicos->getMessagesErros();
                    return $errors;
                }
            }
        }
        
        private function setArquivoPrincipal($servicoId, $arquivoMultimidiaId)
        {
            if($this->DAOServicos->setArquivoPrincipal($servicoId, $arquivoMultimidiaId))
            {
                return true;
            }
            else
            {
                $errors['messages'] = 'Erro ao setar a imagem como principal.<br/>Detalhes: ' . $this->DAOServicos->getMessagesErros();
                return $errors;
            }
        }
        
        private function excluirArquivoMultimidia($servicoId, $arquivoMultimidiaId)
        {
            if(!$this->DAOServicos->deleteArquivoMultimidia($servicoId, $arquivoMultimidiaId))
            {
                $errors['messages'] = 'Erro ao excluir a imagem e/ou vídeo.<br/>Detalhes: ' . $this->DAOServicos->getMessagesErros();
                return $errors;
            }
            else
            {
                return true;
            }
        }
    }
?>