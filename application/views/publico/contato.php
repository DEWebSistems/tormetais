<script type="text/javascript" src="<?php echo base_url('/assets/plugins/jquerymask/jquerymask1.3.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/contato.js'); ?>"></script>

<div class="row" style="margin-left: 0px; margin-right: 0px;">
    <div class="col-md-12 contato-mapa" id="mapa-localizacao"></div>
</div>

<div class="content">
<div class="row" style="margin-left: 0px; margin-right: 0px;">
    <br>
    <hr>
    <div id="divResultsValidations" class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
        <script>
            $(function(){                
                $(".maskTelefone").mask("(99) 9999-9999");
            });
        </script>

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
    </div>
    <div class="col-md-6 ">
                      
        <form action="<?php echo site_url('publico/contato'); ?>" method="post" class="form-horizontal" role="form">

            <div class="form-group">
                <label for="itNome" class="col-xs-3 control-label">Nome:</label>
                <div class="col-xs-9">
                    <input id="itNome" name="itNome" type="text" maxlength="90" value="" class="form-control"/>
                </div>
            </div>
            <div class="form-group">
                <label for="itTelefone" class="col-xs-3 control-label">Telefone:</label>
                <div class="col-xs-9">
                    <input id="itTelefone" name="itTelefone" type="text" maxlength="20" value="" class="form-control maskTelefone"/>
                </div>
            </div>
            <div class="form-group">
                <label for="itEmailOrigem" class="col-xs-3 control-label">E-mail:</label>
                <div class="col-xs-9">
                    <input id="itEmailOrigem" name="itEmailOrigem" type="email" maxlength="90" value="" class="form-control"/>
                </div>
            </div>
            <div class="form-group">
                <label for="itAssunto" class="col-xs-3 control-label">Assunto:</label>
                <div class="col-xs-9">
                    <input id="itAssunto" name="itAssunto" type="text" maxlength="20" value="" class="form-control"/>
                </div>
            </div>

            <div class="form-group">
                <label for="taMensagem" class="col-xs-3 control-label">Mensagem:</label>
                <div class="col-xs-9">
                    <textarea id="taMensagem" name="taMensagem" maxlength="5000" rows="10" class="form-control" ></textarea>
                </div>
            </div>    

            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button id="bsEnviar" name="bsEnviar" type="submit" class="btn btn-primary btn-block" onclick="return validateBeforeSubmitRecord();">Enviar</button>                    
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-5 col-lg-5 col-lg-offset-1">
        <div class="row">
            <h3>Localização</h3>
            <div class="col-md-12">
                <table>
                    <tr>
                        <td rowspan="3" class="contato-coluna-um"><strong>Endereço: </strong></td>
                        <td><span><?php echo $dadosEmpresa['endereco'];?></span></td>
                    </tr>
                    <tr>                        
                        <td class="contato-coluna-dois"><span><?php echo $dadosEmpresa['bairro'];?></span> - <span><?php echo $dadosEmpresa['numero'];?></span></td>
                    </tr>
                    <tr>
                        <td class="contato-coluna-dois"><span><?php echo $dadosEmpresa['estado'];?></span> - <span><?php echo $dadosEmpresa['cidade'];?></span></td>
                    </tr>
                </table>                
            </div>    
            <div class="col-md-12">
                <hr/>
            </div>
            <h3>Contato</h3>
            <div class="col-md-12 dadosEmpresaContato">
                
                <table>
                    <tr>
                        <td rowspan="2" class="contato-coluna-um"><strong>Telefone:</strong></td>
                        <td class="contato-coluna-dois"><span><?php echo $dadosEmpresa['telefoneprincipal'];?></span></td>
                    </tr>
                    <tr>                        
                        <td class="contato-coluna-dois"><span><?php echo $dadosEmpresa['telefonesecundario'];?></span></td>
                    </tr>                    
                </table>                           
            </div>
            <div class="col-md-12">                
                <table>
                    <tr>
                        <td rowspan="2" class="contato-coluna-um"><strong>E-mail:</strong></td>
                        <td class="contato-coluna-dois"><span><?php echo $dadosEmpresa['emailprincipal'];?></span></td>
                    </tr>
                    <tr>                        
                        <td class="contato-coluna-dois"><span><?php echo $dadosEmpresa['emailsecundario'];?></span></td>
                    </tr>                    
                </table>                        
            </div>
            <div class="col-md-12">
                <hr/>
            </div>
            <h3>Atendimento</h3>                        
            <div class="col-md-12">
                <table>
                    <tr>
                        <td class="contato-coluna-um"><strong>Manhã:</strong></td>
                        <td class="contato-coluna-dois"><span>08:00 as 12:00</span></td>
                    </tr>
                    <tr>
                        <td class="contato-coluna-um"><strong>Tarde:</strong></td>
                        <td class="contato-coluna-dois"><span>13:30 as 18:00</span></td>
                    </tr>
                    <tr>
                        <td class="contato-coluna-um"><strong>Sábado:</strong></td>
                        <td class="contato-coluna-dois"><span>08:00 as 12:00</span></td>
                    </tr>
                </table>                                 
            </div>  
        </div>
    </div>   
</div>
</div>

 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
        var map;
        function initialize() {
            var mapOptions = {
                zoom: 17,
                center: new google.maps.LatLng(-28.736824, -52.836978),
                mapTypeId: google.maps.MapTypeId.SATELLITE,
                scrollwheel: false
            };
            map = new google.maps.Map(document.getElementById('mapa-localizacao'),
                    mapOptions);
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>