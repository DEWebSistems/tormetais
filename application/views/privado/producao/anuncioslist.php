<script type="text/javascript" src="/tormetais/assets/js/anunciosprivate.js"></script>
<script type="text/javascript">
    $(function(){
        $('#bsExcluir').hide();
    });
</script>

<h3 class="page-header-form-list">Manutenção de Anúncios</h3>
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
    <form id="formCategoriaAnuncios" action="<?php echo site_url('privado/anuncios'); ?>" method="post">
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
                    if(empty($anuncios))
                    {
                        echo '<tr>';
                        echo '<td colspan="3">';
                        echo 'Não há nenhuma categoria serviço cadastrada.';
                        echo '</td>';
                        echo '</tr>';
                    }
                    foreach($anuncios as $anuncio)
                    {
                        echo '<tr>';
                        echo '<td>' . $anuncio['id'] . '</td>';
                        echo '<td>' . $anuncio['nome'] . '</td>';                        
                        echo '<td>';
                        echo '<div class="btn-group">';
                        echo '<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Opções <span class="caret"></span></button>';
                        echo '<ul class="dropdown-menu" role="menu">';
                        echo '<li><a href=" '. site_url("privado/anuncios/alterar/" . $anuncio['id']) . '">Alterar</a></li>';                                                
                        echo '</ul>';
                        echo '</div>';
                        echo '</td>';
                        echo '</tr>';
                    }
                ?>
            </tbody>
        </table>        
    </form>
</div>