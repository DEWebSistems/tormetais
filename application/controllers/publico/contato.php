<?php

    class Contato extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }
        
        public function index()
        {
            
            $dadosPost = $this->input->post();
            $messages = array();
            $messages['isErrors'] = false;
            $messages['messagesErrors'] = '';
            $messages['isSuccess'] = false;
            $messages['messagesSuccess'] = '';
            if(isset($dadosPost['bsEnviar']))
            {
                $returns = $this->enviar($dadosPost);
                
                if($returns == false)
                {
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = 'Ocoreu um erro ao enviar a mensagem de contato.';

                }
                else
                {
                    $messages['isSuccess'] = true;
                    $messages['messagesSuccess'] = 'A mensagem de contato foi enviada com sucesso.';
                }
            }
            
            $datasBody = array();
            $datasBody['messages'] = $messages;
            $this->load->model('daos/DAODadosEmpresa');
            $this->load->model('producao/MDadosEmpresa');
            $datasBody['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalho');
            $this->load->view('publico/contato', $datasBody);
            $this->load->view('fragmentos/rodape');
        }
        
        public function enviar($dadosPost)
        {          
            $this->load->model('producao/MMensagemContato');            
            $this->MMensagemContato->setNome($dadosPost['itNome']);
            $this->MMensagemContato->setTelefone($dadosPost['itTelefone']);
            $this->MMensagemContato->setFromEmail($dadosPost['itEmailOrigem']);
            $this->MMensagemContato->setToEmail('teste@tormetais.com.br');
            $this->MMensagemContato->setAssunto($dadosPost['itAssunto']);
            $this->MMensagemContato->setMensagem($dadosPost['taMensagem']);
            $this->MMensagemContato->setIpOrigem('ip');
            $this->MMensagemContato->setMacAddressOrigem('itMacAddressOrigem');
            $this->MMensagemContato->setDataHoraMensagem(date(0));
           
            $this->load->model('daos/DAOMensagemContato');
            $this->DAOMensagemContato->inserir($this->MMensagemContato);
          
            $this->sendMail($dadosPost);
        }
        
        function sendMail($dadosPost)
        {
            $para       = $dadosPost['itEmailDestino'];                        
            $assunto    = $dadosPost['itAssunto'];
            $mensagem   = $dadosPost['taMensagem'];
            
            $headers    = "Content-Type::text/html; charset=UTF-8\n";
            
            mail($para, $assunto, $mensagem, $headers);                        
        }
    }
?>