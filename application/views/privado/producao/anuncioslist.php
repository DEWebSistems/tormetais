<div class="page-header-form-list">
    <strong>Manutenção de Anúncio</strong>
</div>
<script type="text/javascript" src="/tormetais/assets/js/anunciosprivate.js"></script>            
    
    <br/>
    <form action="" method="post">
        <table class="table table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width: 100px;">Código</th>
                    <th>Nome</th>
                    <th style="width: 200px;">
                        Opções
                        <a href="<?php echo site_url('privado/anuncios/adicionar') ?>" class="btn btn-primary">Adicionar</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //echo '<pre>';
                    //print_r($categoriasProdutos);
                    //echo '</pre>';
                    if(empty($anuncios))
                    {
                        echo '<tr>';
                        echo '<td colspan="3">';
                        echo 'Não há nenhum anúncio cadastrado.';
                        echo '</td>';
                        echo '</tr>';
                    }
                    foreach($anuncios as $anuncio)
                    {
                        echo '<tr>';
                        echo '<td>' . $anuncio['id'] . '</td>';
                        echo '<td>' . $anuncio['nome'] . '</td>';
                        echo '<td>';
                        echo '<a href=" '. site_url("privado/anuncios/alterar") . $anuncio['id'] . '" class="btn btn-default btn-sm">Alterar</a>';
                        echo '&nbsp;&nbsp;&nbsp;';
                        echo '<button name="bsExcluir" type="submit" value="' . $anuncio['id'] . '" class="btn btn-default btn-sm" onclick="return confirmaExclusao();">Excluir</button>';
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