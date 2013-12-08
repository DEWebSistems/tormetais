<div class="content">
<div class="main">    
    <div class="row">
        <div class="col-md-3">
            <div class="page-header">
                <h4 class="font-agricola">Categorias</h4>
            </div>
            <div>
            <ul class="nav nav-pills nav-stacked " style="max-width: 300px;">
                <?php
                    foreach ($categoriasServicos as $categoriaServico)
                    {
                        echo '<li><a href=" '. site_url('publico/servicos/filtro/' . $categoriaServico['id']) . '">' . $categoriaServico['nome'] . '</a></li>';                                
                    }                    
                ?>                                                
             </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="page-header">
                <h4 class="font-agricola">Servicos - Linha Agrícola</h4>
            </div>      
            
            <div class="row">                                       
            <?php
            
                if(count($servicos) > 0) {
                    $i = 0;                                
                    foreach ($servicos as $servico)
                    { 
                        if($i == 4) 
                        {
                            echo '</div>';
                            echo '<div class="row">';
                            $i = 0;
                        }
                        $i ++;
                        ?>

                        <div class="col-md-3">	                            
                            <a href="<?php echo site_url('publico/servicos/detalhe/' . $servico['id']); ?>">
                                <img src="<?php echo $servico['imagemprincipal']; ?>" alt="<?php echo $servico['nome']; ?>" height="150" width="200" class="img-rounded">                                                           
                            </a>
                            <div align="center" >
                                <a href="<?php echo site_url('publico/servicos/detalhe/' . $servico['id']); ?>">
                                    <h4 class="font-agricola"><?php echo $servico['nome']; ?></h4>                               
                                </a> 
                            </div>    
                        </div>                                       
            <?php
                    }
                }
            ?>
                   </div>
        </div>
    </div>
</div>
</div>