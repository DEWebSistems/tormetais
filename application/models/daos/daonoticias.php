<?php
    class DAONoticias extends CI_Model
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
            $this->load->model('producao/MNoticias');
            $this->load->model('producao/MArquivosMultimidias');
            $this->load->model('daos/DAOArquivosMultimidias');
            $this->load->model('producao/MNoticiasAM');
            $this->setLimitPage(20);
        }

        public function getLimitPage() {
            return $this->limitPage;
        }

        public function setLimitPage($limitPage) {
            $this->limitPage = $limitPage;
        }
        
        public function getNumberRecords() {
            $this->numberRecords = $this->db->count_all('noticias');
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
            $results = $this->db->get('noticias', $this->getLimitPage(), $offSet);
            return $results;
        }
        
        public function getNoticias()
        {
            $this->db->order_by("datapublicacao", "desc"); 
            $results = $this->db->get('noticias', 3);
            return $results;
        }                
        
        public function getNoticiaById($id)
        {
            $results = $this->db->get_where('noticias', array('id' => $id), 1);            
            if($results->num_rows() > 0)
            {
                return $results->result_array()[0];            
            }
        }                

        public function insert($object)
        {
            $this->MNoticias = $object;
            $this->db->trans_start();
            $this->db->insert('noticias', $this->MNoticias);            
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
            $this->MNoticias = $object;
            $this->db->trans_start();
            $this->db->update('noticias', $this->MNoticias, 'id = ' . $this->MNoticias->getId());
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
            $this->db->delete('noticias', array('id' => $id));
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
        
        public function insertAM($noticiaId, $objectAM, $arquivoPrincipal)
        {
            //echo $noticiaId;
            $this->db->trans_start();
            if(!$this->DAOArquivosMultimidias->insert($objectAM))
            {
                return false;
            }
            else
            {
                if($arquivoPrincipal == true)
                {
                    if(!$this->unsetArquivosPrincipals($noticiaId))
                    {
                        return false;
                    }
                }
                $this->MNoticiasAM->setNoticiaId($noticiaId);
                $this->MNoticiasAM->setArquivoMultimidiaId($this->DAOArquivosMultimidias->getLastId());
                $this->MNoticiasAM->setArquivoPrincipal($arquivoPrincipal);
                $this->db->insert('noticiasarquivosmultimidias', $this->MNoticiasAM);
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
        
        public function getImagemPrincipal($noticiaId)
        {
            
            $imagens = $this->getImagens($noticiaId)->result_array();
            
            foreach ($imagens as $imagem) {
                
                if($imagem['arquivoprincipal'] == true)
                {   
                    return $imagem;
                }                
            }
            
            return NULL;
        }
        
        public function getImagens($noticiaId)
        {
            $this->db->select('*');
            $this->db->from('noticiasarquivosmultimidias nam');
            $this->db->join('arquivosmultimidias am', 'am.id = nam.arquivomultimidiaid');
            $this->db->where(array('nam.noticiaid' => $noticiaId, 'am.tipoarquivo' => 0));
            $returns = $this->db->get();
            //echo '<pre>';
            //print_r($returns->result_array());
            //echo '</pre>';
            return $returns;
        }
        
        public function getVideos($noticiaId)
        {
            $this->db->select('*');
            $this->db->from('noticiasarquivosmultimidias nam');
            $this->db->join('arquivosmultimidias am', 'am.id = nam.arquivomultimidiaid');
            $this->db->where(array('nam.noticiaid' => $noticiaId, 'am.tipoarquivo' => 1));
            $returns = $this->db->get();
            //echo '<pre>';
            //print_r($returns->result_array());
            //echo '</pre>';
            return $returns;
        }
        
        private function unsetArquivosPrincipals($noticiaId)
        {
            $this->db->where('noticiaid', $noticiaId);
            $this->db->update('noticiasarquivosmultimidias', array('arquivoprincipal' => false));
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
        
        public function setArquivoPrincipal($noticiaId, $arquivoMultimidiaId)
        {
            $this->db->trans_start();
            if(!$this->unsetArquivosPrincipals($noticiaId))
            {
                $this->db->trans_complete();
                return false;
            }
            $this->db->where('noticiaid', $noticiaId);
            $this->db->where('arquivomultimidiaid', $arquivoMultimidiaId);
            $this->db->update('noticiasarquivosmultimidias', array('arquivoprincipal' => true));
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
        
        public function deleteArquivoMultimidia($noticiaId, $arquivoMultimidiaId)
        {
            //falta excluir o arquivo e registro se possível
            $this->db->trans_start();
            $dadosImage = $this->db->get_where('noticiasarquivosmultimidias', array('noticiaid' => $noticiaId, 'arquivomultimidiaid' => $arquivoMultimidiaId, 'arquivoprincipal' => true));
            $this->db->where('noticiaid', $noticiaId);
            $this->db->where('arquivomultimidiaid', $arquivoMultimidiaId);
            $this->db->delete('noticiasarquivosmultimidias');
            if($this->db->affected_rows() > 0)
            {
                if($dadosImage->num_rows() > 0)
                {
                    $dadosImage = $this->getImagens($noticiaId);
                    if($dadosImage->num_rows() > 0)
                    {
                        if(!$this->setArquivoPrincipal($noticiaId, $dadosImage->result_array()[0]['arquivomultimidiaid']))
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