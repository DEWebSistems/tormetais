<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Tor Metais</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Everaldo Boccoli" >
        <meta name="author" content="Daniel Rockenbach Loro" >

        <!-- Styles -->
        
        <link href="<?php echo base_url('/assets/bootstrap/3.0.0/css/bootstrap.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('/assets/css/layout.css');?>" rel="stylesheet">
        
        <link rel="stylesheet" href="<?php echo base_url('/assets/bootstrap-image-gallery-3.1.0/css/blueimp-gallery.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('/assets/bootstrap-image-gallery-3.1.0/css/netdna.bootstrapcdn.min.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('/assets/bootstrap-image-gallery-3.1.0/css/bootstrap-image-gallery.min.css');?>">

        <!-- Java Script -->
        <script type="text/javascript" src="<?php echo base_url('/assets/jquery/jquery203/jquery-2.0.3.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('/assets/bootstrap/3.0.0/js/bootstrap.js');?>"></script>        
        <script type="text/javascript" src="<?php echo base_url('/assets/bootstrap/3.0.0/js/transition.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('/assets/bootstrap/3.0.0/js/carousel.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('/assets/js/genericsfunctions.js');?>"></script>
        <script type="text/javascript" src="<?php echo base_url('/assets/ckeditor/ckeditor.js');?>"></script>                       

    </head>

    <body>
            <!-- <CABECALHO> -->
            <div class="top-line"></div>
            <div class="header">
            <div class="container">               
                <div class="row">                        
                    <div class="col-md-6">      
                        <div class="row">      
                            <!-- HEADER LOGO -->
                            <div class="col-md-6 site-header-logo">
                                <img src="<?php echo base_url('/assets/images/logoamarela.png');?>" alt="<?php echo $dadosEmpresa['nomefantasia'];?>">
                            </div>                        
                            <!-- / HEADER LOGO -->

                            <!-- HEADER DESCRICAO SITE-->
                            <div class="col-md-6 site-header-desc" >
                                <strong>Metais</strong>
                            </div>
                            <!-- / HEADER DESCRICAO SITE --> 
                        </div>                                                                                                                                                                                             
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-10 col-md-offset-2">

                                <!-- HEADER CONTATO -->
                                <div class="site-header-contato row">                                    
                                    <div class="col-md-6">
                                        <span class="header-contato-fone">Telefone: </span>
                                        <strong><?php echo $dadosEmpresa['telefoneprincipal'];?></strong>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="header-contato-email">E-mail: </span>
                                        <strong><?php echo $dadosEmpresa['emailprincipal'];?></strong>                                
                                    </div>
                                </div>
                                <!-- / HEADER CONTATO -->

                                <!-- HEADER MENU -->
                                <div class="site-header-menu">
                                    <ul class="nav nav-justified menu-superior">
                                        <li class="active" ><a class="link-menu-superior" href="<?php echo site_url('privado/dadosempresa'); ?>">Empresa</a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle link-menu-superior" data-toggle="dropdown">Cadastros <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a class="link-menu-superior" href="<?php echo site_url('privado/anuncios/lista'); ?>">Anúncios</a></li>
                                                <li><a class="link-menu-superior" href="<?php echo site_url('privado/categoriasprodutos/lista'); ?>">Categoria dos Produtos</a></li>
                                                <li><a class="link-menu-superior" href="<?php echo site_url('privado/categoriasservicos/lista'); ?>">Categoria dos Serviços</a></li>                                                
                                                <li><a class="link-menu-superior" href="<?php echo site_url('privado/noticias/lista'); ?>">Notícias</a></li>   
                                                <li><a class="link-menu-superior" href="<?php echo site_url('privado/produtos/lista'); ?>">Produtos</a></li>
                                                <li><a class="link-menu-superior" href="<?php echo site_url('privado/servicos/lista'); ?>">Serviços</a></li>             
                                            </ul>
                                        </li>                                                                                                        
                                    </ul>	
                                </div>                                
                                <!-- / HEADER CONTATO -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>               
            </div>
 

        