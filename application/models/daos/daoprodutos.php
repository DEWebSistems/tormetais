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
            $this->numbersErrors = $this->db->_error_number();
            $this->rowsAffecteds = $this->db->affected_rows();
            $this->messagesErros = $this->db->_error_message();
            $this->db->trans_complete();
            if($this->rowsAffecteds == 1)
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
                if($arquivoPrincipal == true)
                {
                    if(!$this->unsetArquivosPrincipals($produtoId))
                    {
                        return false;
                    }
                }
                $this->MProdutosAM->setProdutoId($produtoId);
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
            $this->db->where(array('pam.produtoid' => $produtoId, 'am.tipoarquivo' => 0));
            $returns = $this->db->get();
            //echo '<pre>';
            //print_r($returns->result_array());
            //echo '</pre>';
            return $returns;
        }
        
        public function getVideos($produtoId)
        {
            $this->db->select('*');
            $this->db->from('produtosarquivosmultimidias pam');
            $this->db->join('arquivosmultimidias am', 'am.id = pam.arquivomultimidiaid');
            $this->db->where(array('pam.produtoid' => $produtoId, 'am.tipoarquivo' => 1));
            $returns = $this->db->get();
            //echo '<pre>';
            //print_r($returns->result_array());
            //echo '</pre>';
            return $returns;
        }
        
        private function unsetArquivosPrincipals($produtoId)
        {
            $this->db->where('produtoid', $produtoId);
            $this->db->update('produtosarquivosmultimidias', array('arquivoprincipal' => false));
            if($this->db->_error_number() == 0)
            {
                return true;
            }
            else
            {
                $this->numbersErrors = $this->db->_error_number();
                $this->rowsAffecteds = $this->db->affected_rows();
                $this->messagesErros = $this->db->_error_message();
                return false;
            }
        }
        
        public function setArquivoPrincipal($produtoId, $arquivoMultimidiaId)
        {
            $this->db->trans_start();
            if(!$this->unsetArquivosPrincipals($produtoId))
            {
                $this->db->trans_complete();
                return false;
            }
            $this->db->where('produtoid', $produtoId);
            $this->db->where('arquivomultimidiaid', $arquivoMultimidiaId);
            $this->db->update('produtosarquivosmultimidias', array('arquivoprincipal' => true));
            if($this->db->affected_rows() > 0)
            {
                $this->db->trans_complete();
                return true;
            }
            else
            {
                $this->numbersErrors = $this->db->_error_number();
                $this->rowsAffecteds = $this->db->affected_rows();
                $this->messagesErros = $this->db->_error_message();
                $this->db->trans_complete();
                return false;
            }
        }
        
        public function deleteArquivoMultimidia($produtoId, $arquivoMultimidiaId)
        {
            //falta excluir o arquivo e registro se possível
            $this->db->trans_start();
            $dadosImage = $this->db->get_where('produtosarquivosmultimidias', array('produtoid' => $produtoId, 'arquivomultimidiaid' => $arquivoMultimidiaId, 'arquivoprincipal' => true));
            $this->db->where('produtoid', $produtoId);
            $this->db->where('arquivomultimidiaid', $arquivoMultimidiaId);
            $this->db->delete('produtosarquivosmultimidias');
            if($this->db->affected_rows() > 0)
            {
                if($dadosImage->num_rows() > 0)
                {
                    $dadosImage = $this->getImagens($produtoId);
                    if($dadosImage->num_rows() > 0)
                    {
                        if(!$this->setArquivoPrincipal($produtoId, $dadosImage->result_array()[0]['arquivomultimidiaid']))
                        {
                            $this->db->trans_complete();
                            return false;
                        }
                    }
                }
                $this->DAOArquivosMultimidias->delete($arquivoMultimidiaId);
                $this->db->trans_commit();
                $this->db->trans_complete();
                return true;
            }
            else
            {
                $this->numbersErrors = $this->db->_error_number();
                $this->rowsAffecteds = $this->db->affected_rows();
                $this->messagesErros = $this->db->_error_message();
                $this->db->trans_complete();
                return false;
            }
        }
    }
?>