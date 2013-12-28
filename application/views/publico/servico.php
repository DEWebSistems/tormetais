<div class="content">

<div class="main">
    <div class="row">
        <div class="col-md-2">
            <div class="page-header">
                <h4 class="font-">Categorias</h4>
            </div>
            <ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
                <?php                    
                    foreach ($categoriasServicos as $categoriaServico)
                    {
                        echo '<li><a href=" '. site_url('publico/servicos/filtro/' . $categoriaServico['id']) . '">'. $categoriaServico['nome'].'</a></li>';                                
                    }
                ?>
             </ul>
        </div>
        <div class="col-md-10">
            <div class="page-header">
                
                <h4 class="font-"><?php echo $dadosServico['nome'];?></h4>
            </div>
            <div class="row">
                <div class="col-md-6">  
                    <img src="<?php echo $dadosServico['imagemprincipal'];?>" alt="<?php echo $dadosServico['nome'];?>" height="336" width="500" class="media-object img-rounded">
                       
                    <br/>
                    <p><a class="btn btn-success" href="<?php echo site_url('publico/servicos/lista/'); ?>">Serviços</a></p>
                </div>
                <div class="col-md-6" style="font-size: 14px;">
                    <p><?php echo $dadosServico['descricao'];?></p>                    
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="page-header">
                        <h4 class="font-agricola">Imagens</h4>
                    </div>
                    <div id="links">            
                        <?php                                                                 
                            foreach ($imagensservico as $imagemservico)
                            {
                        ?>                                                                        
                                <a href="<?php echo $imagemservico['localizacao']; ?>" title="<?php echo $dadosServico['nome'];?>" data-gallery>
                                    <img src="<?php echo $imagemservico['localizacao']; ?>" alt="<?php echo $dadosServico['nome'];?>" height="100" width="100" class="img-rounded">
                                </a>                                                                              
                        <?php
                            }
                        ?>
                    </div>      
                </div>
                
                <div class="col-md-6">
                    <?php 
                        if(count($videosservico) > 0)
                        {
                    ?>

                    <div class="page-header">
                        <h4 class="font-agricola">Vídeos</h4>
                    </div>

                    <div class="row">
                        <?php                                                                 
                            foreach ($videosservico as $videoservico)
                            {
                                ?>  
                        <div class="col-md-12" align="center">
                            <iframe width="450" height="300" src="<?php echo $videoservico['localizacao']; ?>" frameborder="0" allowfullscreen></iframe>                                                
                        </div>
                        <?php
                            }
                        ?>
                    </div>                                    
                    <?php 
                        }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Anterior
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Próximo
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script src="<?php echo base_url('/assets/bootstrap-image-gallery-3.1.0/js/jquery.blueimp-gallery.min.js'); ?>"></script>
<script src="<?php echo base_url('/assets/bootstrap-image-gallery-3.1.0/js/bootstrap-image-gallery.min.js'); ?>"></script>