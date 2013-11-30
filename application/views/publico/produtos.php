<div class="main">    
    <div class="row">
        <div class="col-md-3">
            <div class="page-header">
                <h4>Categorias</h4>
            </div>
            <div>
            <ul class="nav nav-pills nav-stacked " style="max-width: 300px;">
                <?php
                    foreach ($categoriasProdutos as $categoriaProduto)
                    {
                        echo '<li><a href=" '. site_url('publico/produtos/filtro/' . $categoriaProduto['id']) . '">' . $categoriaProduto['nome'] . '</a></li>';                                
                    }                    
                ?>                                                
             </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="page-header">
                <h4>Lista de Produtos</h4>
            </div>      
            
            <div class="row">                                       
            <?php
            
                if(count($produtos) > 0) {
                    $i = 0;                                
                    foreach ($produtos as $produto)
                    { 
                        if($i == 3) 
                        {
                            echo '</div>';
                            echo '<div class="row">';
                            $i = 0;
                        }
                        $i ++;
                        ?>

                        <div class="col-md-4">	
                            <div class="thumbnail">
                                <img src="/tormetais/assets/images/carreto abastecedor 13tn.png" alt="..." height="200" width="300">                                                           
                                <div class="caption">
                                    <h3><?php echo $produto['nome']; ?></h3>
                                    <p><?php echo $produto['descricao']; ?></p>
                                    <div align="center">
                                        <p><a class="btn btn-primary" href="<?php echo site_url('publico/produtos/detalhe/' . $produto['id']); ?>">Detalhes</a></p>
                                    </div>
                                </div>
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