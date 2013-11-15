<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <title>Tor Metais</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Everaldo Boccoli" >
        <meta name="author" content="Daniel Rockenbach Loro" >

        <!-- Styles -->        
        <!--<link href="/tormetais/assets/bootstrap/3.0.0/css/bootstrap.css" rel="stylesheet">-->
        <link href="/tormetais/assets/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="/tormetais/assets/css/layout.css" rel="stylesheet">

        <!-- Java Script -->
        <script type="text/javascript" src="/tormetais/assets/jquery/jquery203/jquery-2.0.3.js"></script>
        <script type="text/javascript" src="/tormetais/assets/bootstrap/3.0.0/js/bootstrap.js"></script>        
        <script type="text/javascript" src="/tormetais/assets/bootstrap/3.0.0/js/transition.js"></script>
        <script type="text/javascript" src="/tormetais/assets/bootstrap/3.0.0/js/carousel.js"></script>
        <script type="text/javascript" src="/tormetais/assets/js/genericsfunctions.js"></script>
        <script type="text/javascript" src="/tormetais/assets/ckeditor/ckeditor.js"></script>

    </head>

    <body>
            <!-- <CABECALHO> -->
            <div class="top-line"></div>
            <div class="container">               
                <div class="row header-content">                        
                    <div class="col-md-6">      
                        <div class="row">      
                            <!-- HEADER LOGO -->
                            <div class="col-md-6 site-header-logo">
                                <img src="/tormetais/assets/images/logo.png" alt="">
                            </div>                        
                            <!-- / HEADER LOGO -->

                            <!-- HEADER DESCRICAO SITE-->
                            <div class="col-md-6 site-header-desc">
                                <strong><?php echo $dadosEmpresa['nomefantasia'];?></strong>
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
                                        <li><a href="dadosempresa">Empresa</a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cadastros <b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#">Anúncios</a></li>
                                                <li><a href="#">Categoria dos Produtos</a></li>
                                                <li><a href="#">Categoria dos Serviços</a></li>                                                
                                                <li><a href="#">Notícias</a></li>   
                                                <li><a href="produtoform">Produtos</a></li>
                                                <li><a href="#">Serviços</a></li>             
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
 

        