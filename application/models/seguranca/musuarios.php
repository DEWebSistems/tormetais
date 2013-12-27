<?php
    class MUsuarios extends CI_Model
    {
        public $id;
        public $nome;
        public $eMail;
        public $login;
        public $senha;
        private $encryptionKey = "MySuperSecretKeys";
        
        function __construct()
        {
            parent::__construct();
            $this->load->library('session');
            $this->load->library('encrypt');
            $this->load->model('daos/DAOUsuarios');
        }
        
        public function getId() {
            return $this->id;
        }
        
        public function setId($id) {
            $this->id = $id;
        }
        
        public function getNome() {
            return $this->nome;
        }
        
        public function setNome($nome) {
            $this->nome = $nome;
        }
        
        public function getEMail() {
            return $this->eMail;
        }
        
        public function setEMail($eMail) {
            $this->eMail = $eMail;
        }
        
        public function getLogin() {
            return $this->login;
        }

        public function setLogin($login) {
            $this->login = $login;
        }

        public function getSenha() {
            return $this->senha;
        }

        public function setSenha($senha) {
            $this->senha = $senha;
        }
        
        public function validateLogin()
        {
            $returns['isErrors'] = false;
            $returns['messagesErrors'] = '';
            $results = $this->DAOUsuarios->getUsuariosByLogin($this->login);
            if($results->num_rows() == 0)
            {
                $returns['isErrors'] = true;
                $returns['messagesErrors'] = 'Nenhum usuário cadastrado com estas informações.';
            }
            else if($results->num_rows() > 0)
            {
                foreach($results->result_array() as $rowsUsuarios)
                {
                    $password = $this->decodePassword($rowsUsuarios['senha']);
                    if(($rowsUsuarios['login'] == $this->login) and ($password == $this->senha))
                    {
                        $this->session->set_userdata('loginUserId', $rowsUsuarios['id']);
                        $returns['isErrors'] = false;
                        $returns['messagesErrors'] = '';
                        return $returns;
                    }
                }
                $returns['isErrors'] = true;
                $returns['messagesErrors'] = 'O usuário e/ou a senha informado(s) está(ão) incorreto(s).';
            }
            else
            {
                $returns['isErrors'] = false;
                $returns['messagesErrors'] = 'Ocorreu um erro inesperado ao validar o usuário.';
            }
            return $returns;
        }
        
        public function encodePassword()
        {
            $encode = $this->encrypt->encode($this->senha, $this->encryptionKey);
            return $encode;
        }
        
        public function decodePassword($encryptPassword)
        {
            $decode = $this->encrypt->decode($encryptPassword, $this->encryptionKey);
            return $decode;
        }
        
        public function validateUser()
        {
            $loginUserId = $this->session->userdata('loginUserId');
            if($loginUserId != false)
            {
                $results = $this->DAOUsuarios->getUsuariosById($loginUserId);
                if($results->num_rows() > 0)
                {
                    foreach($results->result_array() as $usersRows)
                    {
                        if($loginUserId == $usersRows['id'])
                        {
                            return true;
                        }
                    }
                }
            }
            redirect(site_url('privado/login'));
            exit();
        }
        
        public function getUserSession()
        {
            $loginUserId = $this->session->userdata('loginUserId');
            if($loginUserId != false)
            {
                $results = $this->DAOUsuarios->getUsuariosById($loginUserId);
                if($results->num_rows() == 0)
                {
                    $results = null;
                }
                else if($results->num_rows() > 0)
                {
                }
                else
                {
                    $results = null;
                }
            }
            else
            {
                $results = null;
            }
            return $results;
        }
        
        public function unsetUserSession()
        {
            $this->session->unset_userdata('loginUserId');
            redirect(site_url('privado/login'));
            exit();
        }
    }
?>