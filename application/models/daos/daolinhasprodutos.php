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
        
        public function getLinhaProdutoById($id)
        {
            $results = $this->db->get_where('linhasprodutos', array('id' => $id), 1);            
            if($results->num_rows() > 0)
            {
                return $results->result_array()[0];            
            }
        }     
    }
?>