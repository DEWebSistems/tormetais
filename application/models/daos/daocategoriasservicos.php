<?php
    class DAOCategoriasServicos extends CI_Model
    {
        private $limitPage;
        private $numberRecords;
        
        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->model('producao/MCategoriasServicos');
            $this->setLimitPage(2);
        }
        
        public function getLimitPage() {
            return $this->limitPage;
        }

        public function setLimitPage($limitPage) {
            $this->limitPage = $limitPage;
        }
        
        public function getNumberRecords() {
            $this->numberRecords = $this->db->count_all('categoriasservicos');
            return $this->numberRecords;
        }

        public function setNumberRecords($numberRecords) {
            $this->numberRecords = $numberRecords;
        }
        
        public function listPagination($numberPage = 1)
        {
            $offSet = ($numberPage - 1) * $this->getLimitPage();
            //$offSet = $numberPage;
            $results = $this->db->get('categoriasservicos', $this->getLimitPage(), $offSet);
            return $results;
        }
        
        public function getCategoriasServicos()
        {
            $results = $this->db->get('categoriasservicos');
            return $results;
        }
        
        public function insert($object)
        {
            $this->MCategoriasServicos = $object;
            $this->db->trans_start();
            $this->db->insert('categoriasservicos', $this->MCategoriasServicos);
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
        
        public function update($object)
        {
            $this->MCategoriasServicos = $object;
            $this->db->trans_start();
            $this->db->update('categoriasservicos', $this->MCategoriasServicos, 'id = ' . $this->MCategoriasServicos->getId());
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
        
        public function getCategoriaServicoById($id)
        {
            $results = $this->db->get_where('categoriasservicos', array('id' => $id), 1);            
            if($results->num_rows() > 0)
            {
                return $results->result_array()[0];            
            }
        }     
        
        public function excluir($id)
        {
            $this->db->trans_start();
            $this->db->delete('categoriasservicos', array('id' => $id));
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