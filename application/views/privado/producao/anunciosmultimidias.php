<link rel="stylesheet" href="<?php echo base_url('/assets/jquery/jqueryui1103/themes/base/jquery-ui.css'); ?>"/>
<script type="text/javascript" src="<?php echo base_url('/assets/jquery/jqueryui1103/ui/jquery-ui.js'); ?>"></script>
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
        $('#divFieldVideo').hide();
        $('#divPostVideo').hide();
        $('#bbAdicionarVideo').click(function(){
            $('#divFieldVideo').show();
            $('#bbAdicionarVideo').hide();
            $('#divPostVideo').show();
            $('#iurlVideo').click();
            }
        );
        $('#bbCancelarVideo').click(function(){
            $('#divFieldVideo').hide();
            $('#bbAdicionarVideo').show();
            $('#divPostVideo').hide();
        });
    });
    function imagesAnunciosOnClick(elementImage, arquivoMultimidiaId, imagemPrincipal)
    {
        $('#modalsImages').dialog('open');
        $('#modalImage').attr('src', $(elementImage).attr('src'));
        $('#ihArquivoMultimidiaId').val(arquivoMultimidiaId);
        if(imagemPrincipal === true)
        {
            $('#bsImagemPrincipal').attr('disabled', true);
        }
        else
        {
            $('#bsImagemPrincipal').removeAttr('disabled');
        }
        $('#bbFecharImagem').focus();
    }
</script>
<style type="text/css">
    .mainImage
    {
        border: #00f 1px solid;
    }
</style>
<?php
    if($messages['messagesErrors'] != '')
    {        
        echo '<br/>';
        echo '<div class="alert alert-danger alert col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo '<h4>Erro</h4>';
        echo $messages['messagesErrors'];
        echo '</div>';
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';        
        echo '<br/>';       
        echo '<br/>';
    }
    if($messages['messagesSuccess'] != '')
    {       
        echo '<br/>';
        echo '<div class="alert alert-success alert col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo '<h4>' . $messages['messagesSuccess'] . '</h4>';
        echo '</div>';
        echo '<br/>';
        echo '<br/>';        
        echo '<br/>';       
        echo '<br/>';  
    }
?>
<h3 class="page-header-form-list">Dados do Anúncio</h3>
<div style="margin-left: 10px; margin-right: 10px;">
    <table>
        <tbody>
            <tr>
                <th>Nome do Anúncio:</th>
                <td><?php echo $dadosAnuncio['nome']; ?></td>
            </tr>
        </tbody>
    </table>
</div>
<h3 class="page-header-form-list">Imagens</h3>
<div style="margin-left: 10px; margin-right: 10px;">
    <?php echo form_open_multipart('privado/anuncios/multimidias/' . $dadosAnuncio['id'], array('class' => 'form-horizontal', 'role' => 'form')); ?>
        <input id="ihAnuncioId" name="ihAnuncioId" type="hidden" value="<?php echo $dadosAnuncio['id']; ?>"/>
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
        Nenhuma imagem deste anúncio foi cadastrada
    </div>
    <?php
        }
        else
        {
            foreach($dadosImagens as $dadosImagem)
            {
                echo '<img src="' . base_url($dadosImagem['localizacao']) . '" style="width: 100px; height: 100px; margin-right: 10px; margin-bottom: 10px;" ';
                if($dadosImagem['arquivoprincipal'] == true)
                {
                    echo 'class="img-rounded mainImage" onclick="imagesAnunciosOnClick(this, ' . $dadosImagem['arquivomultimidiaid'] .  ', true);"/>';
                }
                else
                {
                    echo 'class="img-rounded" onclick="imagesAnunciosOnClick(this, ' . $dadosImagem['arquivomultimidiaid'] .  ', false);"/>';
                }
            }
        }
    ?>
</div>
<h3 class="page-header-form-list">Vídeos</h3>
<div style="margin-left: 10px; margin-right: 10px;">
    <form action="<?php echo site_url('privado/anuncios/multimidias/' . $dadosAnuncio['id']); ?>" method="post" role="form" class="form-horizontal">
        <button id="bbAdicionarVideo" name="bbAdicionarVideo" type="button" class="btn btn-primary">Adicionar Vídeo</button>
        <div id="divFieldVideo" class="form-group">
            <label for="iurlVideo" class="col-xs-2 col-sm-2 col-md-1 col-lg-1 control-label">Link do Vídeo:</label>
            <div class="col-xs-10 col-sm-8 col-md-7 col-lg-6">
                <input id="iurlVideo" name="iurlVideo" type="text" class="form-control"/>
            </div>
        </div>
        <div id="divPostVideo" class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button id="bsGravarVideo" name="bsGravarVideo" type="submit" class="btn btn-primary">Gravar</button>
                <button id="bbCancelarVideo" name="bbCancelarVideo" type="button" class="btn btn-default">Cancelar</button>
            </div>
        </div>
    </form>
    <br/>
    <?php
        if(empty($dadosVideos))
        {
    ?>
    <div>
        Nenhum vídeo deste anúncio foi cadastrado
    </div>
    <?php
        }
        else
        {
            foreach($dadosVideos as $dadosVideo)
            {
                //style="margin-right: 10px; margin-bottom: 10px;"
                //echo '<div>';
                echo '<iframe width="250" height="200" src="' . $dadosVideo['localizacao'] . '" frameborder="0" allowfullscreen style="margin-right: 10px; margin-bottom: 10px;"></iframe>';
                //echo '</div>';
            }
        }
    ?>
</div>
<br/>
<div style="margin-left: 10px; margin-right: 10px;">
    <a href="<?php echo site_url('privado/anuncios'); ?>" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Voltar</a>
</div>
<br/>
<div id="modalsImages" title="Imagem">
    <img id="modalImage" src="" style="width: 350px; height: 300px; margin-bottom: 10px;"/>
    <form action="<?php echo site_url('privado/anuncios/multimidias/' . $dadosAnuncio['id']); ?>" method="post">
        <input id="ihArquivoMultimidiaId" name="ihArquivoMultimidiaId" type="hidden" value=""/>
        <button id="bsImagemPrincipal" name="bsImagemPrincipal" type="submit" class="btn btn-default btn-xs">Principal</button>
        <button id="bsExcluirImagem" name="bsExcluirImagem" type="submit" class="btn btn-default btn-xs" onclick="return confirm('Você realmente deseja excluir esta imagem?');">Excluir</button>
        <button id="bbFecharImagem" name="bbFecharImagem" type="button" class="btn btn-default btn-xs" onclick="">Fechar</button>
    </form>
</div>