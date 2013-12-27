<?php
    class usuarios extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->load->helper(array('url'));
            $this->load->model('producao/MDadosEmpresa');
            $this->load->model('daos/DAODadosEmpresa');
            $this->load->model('seguranca/MUsuarios');
            $this->load->model('daos/DAOUsuarios');
            $this->MUsuarios->validateUser();
        }
        
        public function index()
        {
            $messages = array();
            $messages['isErrors'] = false;
            $messages['isSuccess'] = false;
            $dadosPost = $this->input->post();
            if(isset($dadosPost['bsGravarMeusDados']))
            {
                $results = $this->gravarMeusDados($dadosPost);
                if($results['typesErrors'] == 'validations')
                {
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = $results['messages'];
                    $this->alterarMeusDados($messages);
                }
                else if($results['typesErrors'] == 'persistences')
                {
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = $results['messages'];
                    $this->meusDados($messages);
                }
                else if($results == true)
                {
                    $messages['isSuccess'] = true;
                    $messages['messagesSuccess'] = 'Os dados foram salvos com sucesso.';
                    $this->meusDados($messages);
                }
            }
            else if(isset($dadosPost['bsGravarMinhasSenhas']))
            {
                $results = $this->gravarMinhasSenhas($dadosPost);
                if($results['typesErrors'] == 'validations')
                {
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = $results['messages'];
                    $this->alterarMinhasSenhas($messages);
                }
                else if($results['typesErrors'] == 'persistences')
                {
                    $messages['isErrors'] = true;
                    $messages['messagesErrors'] = $results['messages'];
                    $this->meusDados($messages);
                }
                else if($results == true)
                {
                    $messages['isSuccess'] = true;
                    $messages['messagesSuccess'] = 'Os dados foram salvos com sucesso.';
                    $this->meusDados($messages);
                }
            }
            else
            {
                $this->meusDados(null);
            }
        }
        
        public function meusDados($messages = null)
        {
            if($messages == null)
            {
                $messages['isErrors'] = false;
                $messages['isSuccess'] = false;
            }
            $datasBody = array();
            $datasBody['messages'] = $messages;
            $dadosUsuario = $this->MUsuarios->getUserSession();
            $datasBody['dadosUsuario'] = $dadosUsuario->result_array()[0];
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/seguranca/usuariosmeusdados', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function alterarMeusDados($messages = null)
        {
            $dadosUsuario = $this->MUsuarios->getUserSession();
            $dadosUsuario = $dadosUsuario->result_array()[0];
            if($messages == null)
            {
                $messages['isErrors'] = false;
            }
            else
            {
                $dadosPost = $this->input->post();
                $dadosUsuario['id'] = $dadosUsuario['id'];
                $dadosUsuario['nome'] = $dadosPost['itNome'];
                $dadosUsuario['email'] = $dadosPost['itEMail'];
                $dadosUsuario['login'] = $dadosPost['itLogin'];
            }
            $datasBody = array();
            $datasBody['messages'] = $messages;
            $datasBody['dadosUsuario'] = $dadosUsuario;
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/seguranca/usuariosformdados', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        public function alterarMinhasSenhas($messages = null)
        {
            if($messages == null)
            {
                $messages['isErrors'] = false;
            }
            $datasBody = array();
            $datasBody['messages'] = $messages;
            $dadosUsuario = $this->MUsuarios->getUserSession();
            $datasBody['dadosUsuario'] = $dadosUsuario->result_array()[0];
            $dadosEmpresa['dadosEmpresa'] = $this->DAODadosEmpresa->getDadosEmpresa();
            $this->load->view('fragmentos/cabecalhoprivado', $dadosEmpresa);
            $this->load->view('privado/seguranca/usuariosformsenhas', $datasBody);
            $this->load->view('fragmentos/rodape', $dadosEmpresa);
        }
        
        private function gravarMeusDados($dadosPost)
        {
            $returns['messages'] = '';
            if((!isset($dadosPost['itNome'])) or (empty($dadosPost['itNome'])) or ($dadosPost['itNome'] == null) or ($dadosPost['itNome'] == ''))
            {
                $returns['messages'] .= 'O campo "Nome" é de preenchimento obrigatório.<br/>';
            }
            if((!isset($dadosPost['itEMail'])) or (empty($dadosPost['itEMail'])) or ($dadosPost['itEMail'] == null) or ($dadosPost['itEMail'] == ''))
            {
                $returns['messages'] .= 'O campo "E-Mail" é de preenchimento obrigatório.<br/>';
            }
            if((!isset($dadosPost['itLogin'])) or (empty($dadosPost['itLogin'])) or ($dadosPost['itLogin'] == null) or ($dadosPost['itLogin'] == ''))
            {
                $returns['messages'] .= 'O campo "Login" é de preenchimento obrigatório.<br/>';
            }
            if($returns['messages'] != '')
            {
                $returns['typesErrors'] = 'validations';
                return $returns;
            }
            $dadosUsuario = $this->MUsuarios->getUserSession();
            $dadosUsuario = $dadosUsuario->result_array()[0];
            $this->MUsuarios->setId($dadosUsuario['id']);
            $this->MUsuarios->setNome($dadosPost['itNome']);
            $this->MUsuarios->setEMail($dadosPost['itEMail']);
            $this->MUsuarios->setLogin($dadosPost['itLogin']);
            if($this->DAOUsuarios->alterarDados($this->MUsuarios))
            {
                return true;
            }
            else
            {
                $returns['messages'] = 'Ocorreu um erro ao salvar os dados.<br/>Detalhes: ' + $this->DAOUsuarios->getMessagesErros();
                $returns['typesErrors'] = 'persistences';
                return $returns;
            }
        }
        
        private function gravarMinhasSenhas($dadosPost)
        {
            $returns['messages'] = '';
            if((!isset($dadosPost['ipwSenhaAtual'])) or (empty($dadosPost['ipwSenhaAtual'])) or ($dadosPost['ipwSenhaAtual'] == null) or ($dadosPost['ipwSenhaAtual'] == ''))
            {
                $returns['messages'] .= 'O campo "Senha Atual" é de preenchimento obrigatório.<br/>';
            }
            if((!isset($dadosPost['ipwNovaSenha'])) or (empty($dadosPost['ipwNovaSenha'])) or ($dadosPost['ipwNovaSenha'] == null) or ($dadosPost['ipwNovaSenha'] == ''))
            {
                $returns['messages'] .= 'O campo "Nova Senha" é de preenchimento obrigatório.<br/>';
            }
            if((!isset($dadosPost['ipwRepitaNovaSenha'])) or (empty($dadosPost['ipwRepitaNovaSenha'])) or ($dadosPost['ipwRepitaNovaSenha'] == null) or ($dadosPost['ipwRepitaNovaSenha'] == ''))
            {
                $returns['messages'] .= 'O campo "Repita A Nova Senha" é de preenchimento obrigatório.<br/>';
            }
            if($returns['messages'] != '')
            {
                $returns['typesErrors'] = 'validations';
                return $returns;
            }
            $dadosUsuario = $this->MUsuarios->getUserSession();
            $dadosUsuario = $dadosUsuario->result_array()[0];
            $decodedPassword = $this->MUsuarios->decodePassword($dadosUsuario['senha']);
            if($decodedPassword != $dadosPost['ipwSenhaAtual'])
            {
                $returns['messages'] .= 'A senha atual informada não está correta, por favor, informe-a novamente.<br/>';
            }
            else if($dadosPost['ipwNovaSenha'] != $dadosPost['ipwRepitaNovaSenha'])
            {
                $returns['messages'] .= 'A nova senha informada não está igual a repetição da nova senha informada.<br/>';
            }
            if($returns['messages'] != '')
            {
                $returns['typesErrors'] = 'validations';
                return $returns;
            }
            $this->MUsuarios->setId($dadosUsuario['id']);
            $this->MUsuarios->setSenha($dadosPost['ipwNovaSenha']);
            $passwordEncoded = $this->MUsuarios->encodePassword();
            $this->MUsuarios->setSenha($passwordEncoded);
            if($this->DAOUsuarios->alterarSenhas($this->MUsuarios))
            {
                return true;
            }
            else
            {
                $returns['messages'] = 'Ocorreu um erro ao salvar a sua nova senha.<br/>Detalhes: ' + $this->DAOUsuarios->getMessagesErros();
                $returns['typesErrors'] = 'persistences';
                return $returns;
            }
        }
    }
?>