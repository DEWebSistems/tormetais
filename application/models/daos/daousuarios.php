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
    }
?>