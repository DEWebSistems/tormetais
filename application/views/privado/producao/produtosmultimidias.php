<script type="text/javascript">
    $(function(){
        $('#divFieldImage').hide();
        $('#divPostImages').hide();
        $('#bbAdicionarImagem').click(function(){
            $('#divFieldImage').show();
            $('#bbAdicionarImagem').hide();
            $('#divPostImages').show();
            $('#ifImage').click();
            }
        );
        $('#bbCancelarImagem').click(function(){
            $('#divFieldImage').hide();
            $('#bbAdicionarImagem').show();
            $('#divPostImages').hide();
        });
    });
</script>
<h3 class="page-header-form-list">Imagens</h3>
<?php echo form_open_multipart('privado/produtos/multimidias', array('class' => 'form-horizontal', 'role' => 'form')); ?>
    <button id="bbAdicionarImagem" name="bbAdicionarImagem" type="button" class="btn btn-primary">Adicionar Imagem</button>
    <div id="divFieldImage" class="form-group">
        <div class="col-xs-10 col-sm-8 col-md-7 col-lg-6">
            <input id="ifImage" name="ifImage" type="file" class="form-control"/>
        </div>
    </div>
    <div id="divPostImages" class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button id="bsGravarImagem" name="bsGravarImagem" type="submit" class="btn btn-primary">Gravar</button>
            <button id="bbCancelarImagem" name="bbCancelarImagem" type="button" class="btn btn-default">Cancelar</button>
        </div>
    </div>
</form>
<h3 class="page-header-form-list">Vídeos</h3>