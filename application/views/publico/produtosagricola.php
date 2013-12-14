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
                    foreach ($categoriasProdutos as $categoriaProduto)
                    {
                        echo '<li><a href=" '. site_url('publico/produtosagricola/filtro/' . $categoriaProduto['id']) . '">' . $categoriaProduto['nome'] . '</a></li>';                                
                    }                    
                ?>                                                
             </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="page-header">
                <h4 class="font-agricola"><?php echo $linhaAgricola['nome']; ?></h4>
            </div>      
            
            <div class="row">                                       
            <?php
            
                if(count($produtos) > 0) {
                    $i = 0;                                
                    foreach ($produtos as $produto)
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
                            <a href="<?php echo site_url('publico/produtosagricola/detalhe/' . $produto['id']); ?>">
                                <img src="<?php echo $produto['imagemprincipal']; ?>" alt="<?php echo $produto['nome']; ?>" height="150" width="200" class="img-rounded">                                                           
                            </a>
                            <div align="center" >
                                <a href="<?php echo site_url('publico/produtosagricola/detalhe/' . $produto['id']); ?>">
                                    <h4 class="font-agricola"><?php echo $produto['nome']; ?></h4>                               
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