<script type="text/javascript" src="/tormetais/assets/js/produtosprivate.js"></script>
<div class="col-lg-12" style="padding-top: 10px;">
    <?php
        if($messages['isErrors'] == true)
        {
            echo '<div class="alert alert-danger alertcol-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">';
            echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            echo '<h4>Erro</h4>';
            echo $messages['messagesErrors'];
            echo '</div>';
        }
        if($messages['isSuccess'] == true)
        {
            echo '<div class="alert alert-success alertcol-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">';
            echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
            echo '<h4>' . $messages['messagesSuccess'] . '</h4>';
            echo '</div>';
        }
    ?>
    <br/>
    <div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom: 15px;">
            <h3>Categorias de Produtos</h3>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
            <a href="<?php echo site_url('privado/categoriasprodutos/adicionar') ?>" class="btn btn-primary">Adicionar</a>
        </div>
    </div>
    <br/>
    <form action="" method="post">
        <table class="table table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width: 100px;">Código</th>
                    <th>Nome</th>
                    <th style="width: 200px;">Opções</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //echo '<pre>';
                    //print_r($categoriasProdutos);
                    //echo '</pre>';
                    if(empty($categoriasProdutos))
                    {
                        echo '<tr>';
                        echo '<td colspan="3">';
                        echo 'Não há nenhuma categoria de produto cadastrada.';
                        echo '</td>';
                        echo '</tr>';
                    }
                    foreach($categoriasProdutos as $categoriaProduto)
                    {
                        echo '<tr>';
                        echo '<td>' . $categoriaProduto['id'] . '</td>';
                        echo '<td>' . $categoriaProduto['nome'] . '</td>';
                        echo '<td>';
                        echo '<a href=" '. site_url("privado/categoriasprodutos/alterar/". $categoriaProduto['id'])  . '" class="btn btn-default btn-sm">Alterar</a>';
                        echo '&nbsp;&nbsp;&nbsp;';
                        echo '<button name="bsExcluir" type="submit" value="' . $categoriaProduto['id'] . '" class="btn btn-default btn-sm" onclick="return confirmaExclusao();">Excluir</button>';
                        echo '</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
    </form>
<div>
    Exibindo 10 de 10 registros.
</div>
<?php
    echo $paginations;
?>
<ul class="pagination">
    <li><a><<</a></li>
    <li><a><</a></li>
    <li><a>1</a></li>
    <li><a>></a></li>
    <li><a>>></a></li>
</ul>
</div>