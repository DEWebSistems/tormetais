<?php
    class DAOMensagemContato extends CI_Model
    {
        function __construct()
        {
            parent::__construct();
            $this->load->database();
            $this->load->model('producao/MMensagemContato');
        }                
        
        public function inserir($mMensagemContato)
        {
            $this->MMensagemContato= $mMensagemContato;
//            $dados = array(
//                
//                'nome' => $this->MMensagemContato->getNome(),
//                'telefone' => $this->MMensagemContato->getTelefone(),
//                'fromemail' => $this->MMensagemContato->getFromEmail(),
//                'toemail' => $this->MMensagemContato->getToEmail(),
//                'assunto' => $this->MMensagemContato->getAssunto(),
//                'mensagem' => $this->MMensagemContato->getMensagem(),
//                'iporigem' => $this->MMensagemContato->getIpOrigem(),
//                'macaddressorigem' => $this->MMensagemContato->getMacAddressOrigem(),
//                'datahoramensagem' => $this->MMensagemContato->getDataHoraMensagem(),                
//            );
            $this->db->trans_start();
            $this->db->insert('mensagenscontatos', $this->MMensagemContato);
            $this->db->trans_complete();
        }    
    }
?>