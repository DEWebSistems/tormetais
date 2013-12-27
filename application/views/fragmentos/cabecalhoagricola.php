<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Tor Metais</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Everaldo Boccoli" >
        <meta name="author" content="Daniel Rockenbach Loro" >
        
        <link rel="shortcut icon" href="<?php echo base_url('/assets/images/favicon.ico');?>" />
        
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
        <div class="content">
            
            <!-- <CABECALHO> -->
            <div class="top-line"></div>
                <div class="header">
                    <div class="container">               
                        <div class="row header-content">                        
                            <div class="col-md-6">      
                                <div class="row">      
                                    <!-- HEADER LOGO -->
                                    <div class="col-md-6" style="padding-left: 0px; padding-right: 0px;">
                                        <div class="site-header-logo">
                                            <img src="<?php echo base_url('/assets/images/logoamarela.png'); ?>" alt="Tor Metais" style="width: 100%;">
                                        </div>
                                    </div>                        
                                    <!-- / HEADER LOGO -->

                                    <!-- HEADER DESCRICAO SITE-->
                                    <div class="col-md-6 site-header-desc-agricola" >
                                        <strong>Metais Agrícola</strong>
                                        <p><strong style="font-style:italic; font-size: 20px;">A Solução no Campo</strong></p>
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
                                                <strong class="header-contato-fone">Telefone: </strong>
                                                <span>(54) 3383-2222</span>
                                            </div>
                                            <div class="col-md-6">
                                                <strong class="header-contato-email">E-mail: </strong>
                                                <span><a style="color: black;" href="mailto:<?php echo $dadosEmpresa['emailprincipal']; ?>"><?php echo $dadosEmpresa['emailprincipal']; ?></a></span>                                    
                                            </div>
                                        </div>
                                        <!-- / HEADER CONTATO -->

                                        <!-- HEADER MENU -->
                                        <div class="site-header-menu">
                                            <ul class="nav nav-justified menu-superior">
                                                <li><a class="active link-menu-superior" href="<?php echo site_url('publico/inicial'); ?> ">Inicial</a></li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle link-menu-superior" data-toggle="dropdown">Produtos <b class="caret"></b></a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="link-menu-superior" href="<?php echo site_url('publico/produtosagricola/lista'); ?> ">Agricolas</a></li>
                                                        <li><a class="link-menu-superior" href="<?php echo site_url('publico/produtosreboque/lista'); ?> ">Reboques</a></li>                                                
                                                    </ul>
                                                </li>
                                                <li><a class="link-menu-superior" href="<?php echo site_url('publico/servicos/lista'); ?>">Serviços</a></li>
                                                <li><a class="link-menu-superior" href="#">Sobre</a></li>
                                                <li><a class="link-menu-superior" href="<?php echo site_url('publico/contato'); ?>">Contato</a></li>
                                            </ul>	
                                        </div>                                
                                        <!-- / HEADER CONTATO -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  

            </div>
        </div>

        