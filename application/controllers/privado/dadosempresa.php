<?php
    class DadosEmpresa extends CI_Controller
    {
        public function index()
        {
            $button = $this->input->post('bsGravar');
            if($button == 'gravar')
            {
                $dadosPost = $this->input->post();
                echo '<pre>';
                print_r($dadosPost);
                echo '</pre>';
                $this->load->model('producao/MDadosEmpresa');
                $this->MDadosEmpresa->setNomeFantasia($dadosPost['itNomeFantasia']);
                $this->MDadosEmpresa->setRazaoSocial($dadosPost['itRazaoSocial']);
                $this->MDadosEmpresa->setEstado($dadosPost['itEstado']);
                $this->MDadosEmpresa->setCidade($dadosPost['itCidade']);
                $this->MDadosEmpresa->setBairro($dadosPost['itBairro']);
                $this->MDadosEmpresa->setEndereco($dadosPost['itEndereco']);
                $this->MDadosEmpresa->setNumero($dadosPost['itNumero']);
                $this->MDadosEmpresa->setTelefonePrincipal($dadosPost['itFonePrincipal']);
                $this->MDadosEmpresa->setEmailSecundario($dadosPost['itEMailSecundario']);
                $this->MDadosEmpresa->gravar();
            }
            $this->load->view('fragmentos/cabecalho');
            $this->load->view('privado/producao/dadosempresa');
            $this->load->view('fragmentos/rodape');
        }
    }
?>