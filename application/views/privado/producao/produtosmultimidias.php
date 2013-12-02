<link rel="stylesheet" href="/tormetais/assets/jquery/jqueryui1103/themes/base/jquery-ui.css"/>
<script type="text/javascript" src="/tormetais/assets/jquery/jqueryui1103/ui/jquery-ui.js"></script>
<script type="text/javascript">
    $(function(){
        $('#divFieldImage').hide();
        $('#divMainImage').hide();
        $('#divPostImages').hide();
        $('#bbAdicionarImagem').click(function(){
            $('#divFieldImage').show();
            $('#divMainImage').show();
            $('#bbAdicionarImagem').hide();
            $('#divPostImages').show();
            $('#ifImage').click();
            }
        );
        $('#bbCancelarImagem').click(function(){
            $('#divFieldImage').hide();
            $('#divMainImage').hide();
            $('#bbAdicionarImagem').show();
            $('#divPostImages').hide();
        });
        $('#modalsImages').dialog({
            modal: true,
            autoOpen: false,
            width: 400,
            height: 400
        });
        $('#bbFecharImagem').click(function(){
            $('#modalsImages').dialog('close');
        });
    });
    function imagesProdutosOnClick(elementImage, arquivoMultimidiaId)
    {
        $('#modalsImages').dialog('open');
        $('#modalImage').attr('src', $(elementImage).attr('src'));
        $('#ihArquivoMultimidiaId').val(arquivoMultimidiaId);
        $('#bbFecharImagem').focus();
    }
</script>
<?php
    if($messages['messagesErrors'] != '')
    {
        echo '<div class="alert alert-danger alertcol-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo '<h4>Erro</h4>';
        echo $messages['messagesErrors'];
        echo '</div>';
    }
    if($messages['messagesSuccess'] != '')
    {
        echo '<div class="alert alert-success alertcol-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo '<h4>' . $messages['messagesSuccess'] . '</h4>';
        echo '</div>';
    }
?>
<h3 class="page-header-form-list">Dados do Produto</h3>
<div style="margin-left: 10px; margin-right: 10px;">
    <table>
        <tbody>
            <tr>
                <th>Nome do Produto:</th>
                <td><?php echo $dadosProduto['nome']; ?></td>
            </tr>
        </tbody>
    </table>
</div>
<h3 class="page-header-form-list">Imagens</h3>
<div style="margin-left: 10px; margin-right: 10px;">
    <?php echo form_open_multipart('privado/produtos/multimidias/' . $dadosProduto['id'], array('class' => 'form-horizontal', 'role' => 'form')); ?>
        <input id="ihProdutoId" name="ihProdutoId" type="hidden" value="<?php echo $dadosProduto['id']; ?>"/>
        <button id="bbAdicionarImagem" name="bbAdicionarImagem" type="button" class="btn btn-primary">Adicionar Imagem</button>
        <div id="divFieldImage" class="form-group">
            <div class="col-xs-10 col-sm-8 col-md-7 col-lg-6">
                <input id="ifImage" name="ifImage" type="file" class="form-control"/>
            </div>
        </div>
        <div id="divMainImage" class="checkbox" style="margin-left: 20px; margin-bottom: 20px;">
                <input id="icbImagemPrincipal" name="icbImagemPrincipal" type="checkbox"/>
            <label for="icbImagemPrincipal">Imagem Principal</label>
        </div>
        <div id="divPostImages" class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button id="bsGravarImagem" name="bsGravarImagem" type="submit" class="btn btn-primary">Gravar</button>
                <button id="bbCancelarImagem" name="bbCancelarImagem" type="button" class="btn btn-default">Cancelar</button>
            </div>
        </div>
    </form>
    <br/>
    <?php
        if(empty($dadosImagens))
        {
    ?>
    <div>
        Nenhuma imagem deste produto foi cadastrada
    </div>
    <?php
        }
        else
        {
            foreach($dadosImagens as $dadosImagem)
            {
                echo '<img src="' . $dadosImagem['localizacao'] . '" style="width: 100px; height: 100px; margin-right: 10px; margin-bottom: 10px;" class="img-rounded" onclick="imagesProdutosOnClick(this, ' . $dadosImagem['arquivomultimidiaid'] .  ');"/>';
            }
        }
    ?>
</div>
<h3 class="page-header-form-list">Vídeos</h3>
<div style="margin-left: 10px; margin-right: 10px;">
</div>
<br/>
<div style="margin-left: 10px; margin-right: 10px;">
    <a href="<?php echo site_url('privado/produtos'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Voltar</a>
</div>
<br/>
<div id="modalsImages" title="Imagem">
    <img id="modalImage" src="" style="width: 350px; height: 300px; margin-bottom: 10px;"/>
    <form action="<?php echo site_url('privado/produtos/multimidias/' . $dadosProduto['id']); ?>" method="post">
        <input id="ihArquivoMultimidiaId" name="ihArquivoMultimidiaId" type="hidden" value=""/>
        <button id="bsImagemPrincipal" name="bsImagemPrincipal" type="submit" class="btn btn-default btn-xs">Principal</button>
        <button id="bsExcluirImagem" name="bsExcluirImagem" type="submit" class="btn btn-default btn-xs" onclick="return confirm('Você realmente deseja excluir esta imagem?');">Excluir</button>
        <button id="bbFecharImagem" name="bbFecharImagem" type="button" class="btn btn-default btn-xs" onclick="">Fechar</button>
    </form>
</div>