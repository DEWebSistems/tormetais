<div class="page-header-form-list">
    <strong>Manutenção de Produtos</strong>
</div>
<script type="text/javascript" src="/tormetais/assets/js/produtosprivate.js"></script>            
    
    <br/>
    <form action="" method="post">
        <table class="table table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width: 100px;">Código</th>
                    <th>Nome</th>
                    <th style="width: 300px;">
                        Opções
                        <a href="<?php echo site_url('privado/produtos/adicionar') ?>" class="btn btn-primary">Adicionar</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //echo '<pre>';
                    //print_r($categoriasProdutos);
                    //echo '</pre>';
                    if(empty($produtos))
                    {
                        echo '<tr>';
                        echo '<td colspan="3">';
                        echo 'Não há nenhum produto cadastrado.';
                        echo '</td>';
                        echo '</tr>';
                    }
                    foreach($produtos as $produto)
                    {
                        echo '<tr>';
                        echo '<td>' . $produto['id'] . '</td>';
                        echo '<td>' . $produto['nome'] . '</td>';
                        echo '<td>';
                        echo '<a href=" '. site_url("privado/produtos/alterar/" . $produto['id']) . '" class="btn btn-default btn-sm">Alterar</a>';
                        echo '&nbsp;&nbsp;&nbsp;';
                        echo '<button name="bsExcluir" type="submit" value="' . $produto['id'] . '" class="btn btn-default btn-sm" onclick="return confirmaExclusao();">Excluir</button>';
                        echo '&nbsp;&nbsp;&nbsp;';
                        echo '<a href=" '. site_url("privado/produtos/multimidias/" . $produto['id']) . '" class="btn btn-default btn-sm">Fotos</a>';
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