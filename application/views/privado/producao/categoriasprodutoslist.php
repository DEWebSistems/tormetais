<script type="text/javascript" src="/tormetais/assets/js/categoriasprodutosprivate.js"></script>
<script type="text/javascript">
    $(function(){
        $('#bsExcluir').hide();
    });
</script>

<h3 class="page-header-form-list">Manutenção de Categorias de Serviços</h3>
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
    <a href="<?php echo site_url('privado/categoriasprodutos/adicionar'); ?>" class="btn btn-primary" style="float: right; margin-bottom: 10px;">Adicionar</a>
    <form id="formCategoriaProdutos" action="<?php echo site_url('privado/categoriasprodutos'); ?>" method="post">
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
                    if(empty($categoriasprodutos))
                    {
                        echo '<tr>';
                        echo '<td colspan="3">';
                        echo 'Não há nenhuma categoria serviço cadastrada.';
                        echo '</td>';
                        echo '</tr>';
                    }
                    foreach($categoriasprodutos as $categoriasproduto)
                    {
                        echo '<tr>';
                        echo '<td>' . $categoriasproduto['id'] . '</td>';
                        echo '<td>' . $categoriasproduto['nome'] . '</td>';                        
                        echo '<td>';
                        echo '<div class="btn-group">';
                        echo '<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">Opções <span class="caret"></span></button>';
                        echo '<ul class="dropdown-menu" role="menu">';
                        echo '<li><a href=" '. site_url("privado/categoriasprodutos/alterar/" . $categoriasproduto['id']) . '">Alterar</a></li>';                        
                        echo '<li><a href="javascript:void(0)" onclick="aExcluirOnClick(' . $categoriasproduto['id'] . ');">Excluir</a></li>';                        
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
</div>