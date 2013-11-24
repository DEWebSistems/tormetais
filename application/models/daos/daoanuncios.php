<?php
    class DAOAnuncios extends CI_Model
    {
        private $limitPage;
        private $numberRecords;
        
        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->model('producao/MAnuncios');
            $this->setLimitPage(20);
        }
        
        public function getLimitPage() {
            return $this->limitPage;
        }

        public function setLimitPage($limitPage) {
            $this->limitPage = $limitPage;
        }
        
        public function getNumberRecords() {
            $this->numberRecords = $this->db->count_all('anuncios');
            return $this->numberRecords;
        }

        public function setNumberRecords($numberRecords) {
            $this->numberRecords = $numberRecords;
        }
        
        public function listPagination($numberPage = 1)
        {
            $offSet = ($numberPage - 1) * $this->getLimitPage();
            //$offSet = $numberPage;
            $results = $this->db->get('anuncios', $this->getLimitPage(), $offSet);
            return $results;
        }
        
        public function getAnuncios()
        {
            $results = $this->db->get('anuncios');
            return $results;
        }
        
        public function insert($object)
        {
            $this->MAnuncios = $object;
            $this->db->trans_start();
            $this->db->insert('anuncios', $this->MAnuncios);            
            $numbersErrors = $this->db->_error_number();            
            $this->db->trans_complete();
            if($numbersErrors == 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        public function update($object)
        {
            $this->MAnuncios = $object;
            $this->db->trans_start();
            $this->db->update('anuncios', $this->MAnuncios, 'id = ' . $this->MAnuncios->getId());
            $numbersErrors = $this->db->_error_number();
            //echo $this->db->affected_rows();
            //echo $this->db->_error_number();
            //echo $this->db->_error_message();
            $this->db->trans_complete();
            if($numbersErrors == 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        
        public function getAnuncio($id)
        {
            $results = $this->db->get_where('anuncios', array('id' => $id), 1);
            return $results;
        }
        
        public function excluir($id)
        {
            $this->db->trans_start();
            $this->db->delete('anuncios', array('id' => $id));
            $numberLinesAffecteds = $this->db->affected_rows();
            $this->db->trans_complete();
            if($numberLinesAffecteds == 1)
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