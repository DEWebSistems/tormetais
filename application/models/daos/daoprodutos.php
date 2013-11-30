<?php
    class DAOProdutos extends CI_Model
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
            $this->load->model('producao/MProdutos');
            $this->load->model('producao/MArquivosMultimidias');
            $this->load->model('daos/DAOArquivosMultimidias');
            $this->load->model('producao/MProdutosAM');
            $this->setLimitPage(20);
        }

        public function getLimitPage() {
            return $this->limitPage;
        }

        public function setLimitPage($limitPage) {
            $this->limitPage = $limitPage;
        }
        
        public function getNumberRecords() {
            $this->numberRecords = $this->db->count_all('produtos');
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
        
        public function listPagination($numberPage = 1)
        {
            $offSet = ($numberPage - 1) * $this->getLimitPage();
            //$offSet = $numberPage;
            $results = $this->db->get('produtos', $this->getLimitPage(), $offSet);
            return $results;
        }
        
        public function getProdutos()
        {
            $results = $this->db->get('produtos');
            return $results;
        }
        
        public function getProdutosByCategoriaProdutoId($categoriaProdutoId)
        {
            $results = $this->db->get_where('produtos', array('categoriaprodutoid' => $categoriaProdutoId));            
            if($results->num_rows() > 0)
            {
                return $results->result_array();            
            }
        }
        
        public function getProdutoById($id)
        {
            $results = $this->db->get_where('produtos', array('id' => $id), 1);            
            if($results->num_rows() > 0)
            {
                return $results->result_array()[0];            
            }
        }                

        public function insert($object)
        {
            $this->MProdutos = $object;
            $this->db->trans_start();
            $this->db->insert('produtos', $this->MProdutos);            
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
            $this->MProdutos = $object;
            $this->db->trans_start();
            $this->db->update('produtos', $this->MProdutos, 'id = ' . $this->MProdutos->getId());
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
        
        public function excluir($id)
        {
            $this->db->trans_start();
            $this->db->delete('produtos', array('id' => $id));
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
        
        public function insertAM($produtoId, $objectAM, $arquivoPrincipal)
        {
            //echo $produtoId;
            $this->db->trans_start();
            if(!$this->DAOArquivosMultimidias->insert($objectAM))
            {
                return false;
            }
            else
            {
                $this->MProdutosAM->setProdutoId($produtoId);
                echo $this->DAOArquivosMultimidias->getLastId();
                $this->MProdutosAM->setArquivoMultimidiaId($this->DAOArquivosMultimidias->getLastId());
                $this->MProdutosAM->setArquivoPrincipal($arquivoPrincipal);
                $this->db->insert('produtosarquivosmultimidias', $this->MProdutosAM);
            }
            $this->numbersErrors = $this->db->_error_number();
            $this->rowsAffecteds = $this->db->affected_rows();
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
        
        public function getImagens($produtoId)
        {
            $this->db->select('*');
            $this->db->from('produtosarquivosmultimidias pam');
            $this->db->join('arquivosmultimidias am', 'am.id = pam.arquivomultimidiaid');
            $this->db->where(array('pam.produtoid' => $produtoId, 'am.tipoarquivo' => false));
            $returns = $this->db->get();
            //echo '<pre>';
            //print_r($returns->result_array());
            //echo '</pre>';
            return $returns;
        }
    }
?>