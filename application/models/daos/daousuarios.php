<?php

    class DAOUsuarios extends CI_Model
    {
        private $numbersErrors;
        private $rowsAffecteds;
        private $messagesErros;
        
        function __construct()
        {
            parent::__construct();
            $this->load->database();
        }
        
        public function getNumbersErrors() {
            return $this->numbersErrors;
        }

        public function setNumbersErrors($numbersErrors) {
            $this->numbersErrors = $numbersErrors;
        }

        public function getRowsAffecteds() {
            return $this->rowsAffecteds;
        }

        public function setRowsAffecteds($rowsAffecteds) {
            $this->rowsAffecteds = $rowsAffecteds;
        }

        public function getMessagesErros() {
            return $this->messagesErros;
        }

        public function setMessagesErros($messagesErros) {
            $this->messagesErros = $messagesErros;
        }
        
        public function getUsuariosById($id)
        {
            $results = $this->db->get_where('usuarios', array('id' => $id));
            $this->numbersErrors = $this->db->_error_number();
            $this->rowsAffecteds = $this->db->affected_rows();
            $this->messagesErros = $this->db->_error_message();
            return $results;
        }
        
        public function getUsuariosByLogin($login)
        {
            $results = $this->db->get_where('usuarios', array('login' => $login));
            $this->numbersErrors = $this->db->_error_number();
            $this->rowsAffecteds = $this->db->affected_rows();
            $this->messagesErros = $this->db->_error_message();
            return $results;
        }
        
        public function alterarDados($object)
        {
            $this->db->trans_start();
            $this->db->update('usuarios', array('nome' => $object->getNome(), 'email' => $object->getEMail(), 'login' => $object->getLogin()), 'id = ' . $object->getId());
            $this->rowsAffecteds = $this->db->affected_rows();
            $this->numbersErrors = $this->db->_error_number();
            $this->messagesErros = $this->db->_error_message();
            $this->db->trans_complete();
            if($this->numbersErrors == 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        public function alterarSenhas($object)
        {
            $this->db->trans_start();
            $this->db->update('usuarios', array('senha' => $object->getSenha()), 'id = ' . $object->getId());
            $this->rowsAffecteds = $this->db->affected_rows();
            $this->numbersErrors = $this->db->_error_number();
            $this->messagesErros = $this->db->_error_message();
            $this->db->trans_complete();
            if($this->numbersErrors == 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
    }
?>