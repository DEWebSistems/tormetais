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
                        <div class="row header-content">                        
                            <div class="col-lg-7 col-md-5 col-sm-8">      
                                <div class="row">      
                                    <!-- HEADER LOGO -->
                                    <div class="col-lg-3 col-md-6 col-sm-5" style="padding-left: 0px; padding-right: 0px;">
                                        <div class="site-header-logo">
                                            <a href="<?php echo site_url('publico/inicial'); ?> ">
                                                <img src="<?php echo base_url('/assets/images/logoamarela.png');?>" alt="Tor Metais" width="220">
                                            </a>
                                        </div>
                                    </div>                        
                                    <!-- / HEADER LOGO -->
                                    <!-- HEADER DESCRICAO SITE-->
                                    <div class="col-lg-8 col-md-5 col-md-offset-1 col-sm-5 site-header-desc" >
                                        <strong>Metais Agrícola</strong>
                                    </div>
                                    <!-- / HEADER DESCRICAO SITE --> 
                                </div>                                                                                                                                                                                             
                            </div>
                            <div class="col-lg-5 col-md-7 col-sm-4 site-header-direita">
                                <div class="row">
                                    <div class="col-lg-offset-7 col-lg-5 col-md-offset-6 col-md-6 col-sm-6 site-header-direita">
                                        <div class="site-header-contato">                                    
                                            <strong>Telefone: </strong>
                                            <span><?php echo $dadosEmpresa['telefoneprincipal']; ?></span>                                                                        
                                        </div>
                                    </div>
                                </div>
                                       
                                <div class="col-lg-12 col-md-12 col-sm-12 site-header-menu">
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
                                        <li><a class="link-menu-superior" href="<?php echo site_url('publico/contato'); ?>">Contato</a></li>
                                    </ul>	
                                </div>                                
                                        <!-- / HEADER CONTATO -->                                                                                           
                            </div>
                        </div>  
            </div>
        </div>

        