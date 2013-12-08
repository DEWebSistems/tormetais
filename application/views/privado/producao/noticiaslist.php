<script type="text/javascript" src="/tormetais/assets/js/noticiasprivate.js"></script>
<script type="text/javascript">
    $(function(){
        $('#bsExcluir').hide();
    });
</script>
<h3 class="page-header-form-list">Manutenção de Notícias</h3>
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
<div style="margin-left: 20px; margin-right: 20px;">
    <a href="<?php echo site_url('privado/noticias/adicionar'); ?>" class="btn btn-primary" style="float: right; margin-bottom: 10px;">Adicionar</a>
    <form id="formNoticias" action="<?php echo site_url('privado/noticias'); ?>" method="post">
        <table class="table table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width: 100px;">Código</th>
                    <th>Nome</th>                    
                    <th style="width: 150px;">
                        Opções
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php                   
                    if(empty($noticias))
                    {
                        echo '<tr>';
                        echo '<td colspan="3">';
                        echo 'Não há nenhuma notícia cadastrada.';
                        echo '</td>';
                        echo '</tr>';
                    }
                    foreach($noticias as $noticia)
                    {
                        echo '<tr>';
                        echo '<td>' . $noticia['id'] . '</td>';
                        echo '<td>' . $noticia['nome'] . '</td>';                        
                        echo '<td>';
                        echo '<div class="btn-group">';
                        echo '<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Opções <span class="caret"></span></button>';
                        echo '<ul class="dropdown-menu" role="menu">';
                        echo '<li><a href=" '. site_url("privado/noticias/alterar/" . $noticia['id']) . '">Alterar</a></li>';
                        //echo '<li><button id="bsExcluir" name="bsExcluir" type="submit" value="' . $noticia['id'] . '" class="btn btn-default btn-sm" onclick="return confirmaExclusao();">Excluir</button></li>';
                        echo '<li><a href="javascript:void(0)" onclick="aExcluirOnClick(' . $noticia['id'] . ');">Excluir</a></li>';
                        echo '<li><a href=" '. site_url("privado/noticias/multimidias/" . $noticia['id']) . '">Fotos</a></li>';
                        echo '</ul>';
                        echo '</div>';
                        echo '</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>
        <button id="bsExcluir" name="bsExcluir" type="submit" value="">Excluir</button>
    </form>
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