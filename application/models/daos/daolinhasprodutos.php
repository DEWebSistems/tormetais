<?php
    class DAOLinhasProdutos extends CI_Model
    {
        private $limitPage;
        private $numberRecords;
        private $numbersErrors;
        private $rowsAffecteds;
        private $messagesErros;
        
        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->setLimitPage(20);
        }

        public function getLimitPage() {
            return $this->limitPage;
        }

        public function setLimitPage($limitPage) {
            $this->limitPage = $limitPage;
        }
        
        public function getNumberRecords() {
            $this->numberRecords = $this->db->count_all('linhasprodutos');
            return $this->numberRecords;
        }

        public function setNumberRecords($numberRecords) {
            $this->numberRecords = $numberRecords;
        }
        
        public function getNumbersErrors() {
            return $this->numbersErrors;
        }
        
        public function getRowsAffecteds() {
            return $this->rowsAffecteds;
        }

        public function getMessagesErros() {
            return $this->messagesErros;
        }
        
        public function getAll()
        {
            $results = $this->db->get('linhasprodutos');
            return $results;
        }
        
        public function getById($id)
        {
            $results = $this->db->get_where('linhasprodutos', array('id' => $id));
            return $results;
        }
        
        public function alterar($object)
        {
            $this->MLinhasProdutos = $object;
            $this->db->trans_start();
            $this->db->update('linhasprodutos', $this->MLinhasProdutos, 'id = ' . $this->MLinhasProdutos->getId());
            $this->numbersErrors = $this->db->_error_number();
            $this->messagesErros = $this->db->_error_message();
            $this->rowsAffecteds = $this->db->affected_rows();
            $this->db->trans_complete();
            if($this->numbersErrors == 0)
            {
                return true;
            }
            else
            {
                return $this->messagesErros;
            }
        }
    }
?>