<div class="footer">
    <div class="row footer-content">
        <div class="col-md-4 col-sm-4">
            <div class="footer-sobre">
                <div class="row">
                    <div class="col-lg-4 col-md-5" >
                        <img src="<?php echo base_url('/assets/images/logovermelha.png'); ?>" alt="<?php echo $dadosEmpresa['nomefantasia'];?>" width="180">                        
                    </div>
                    <div class="col-lg-4 col-md-6 col-md-offset-1 footer-nome-fantasia" >
                        <strong>Metais Reboques</strong>
                    </div>                    
                </div>
                <p>
                    <span><?php echo $dadosEmpresa['descricaoempresa'];?></span>
                </p>
            </div>
        </div>
        <div class="col-md-4 col-md-offset-1 col-sm-4">                
            <h3><i class="glyphicon glyphicon-user"></i> Atendimento</span></h3>
            <div class="footer-atendimento">
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
        <div class="col-md-3 col-sm-4">
            <h3><i class="glyphicon glyphicon-phone-alt"></i> Contato</h3>
            <address>                                                    
                <div class="footer-contato dadosEmpresaContato">                            
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
                        <tr>
                            <td class="contato-coluna-um"><strong>Telefone: </strong></td>
                            <td><span><?php echo $dadosEmpresa['telefoneprincipal'];?></span></td>
                        </tr>
                        <tr>
                            <td class="contato-coluna-um"><strong>E-mail: </strong></td>
                            <td><span><?php echo $dadosEmpresa['emailprincipal'];?></span></td>
                        </tr>

                    </table>          
                </div>                                                                                 
            </address>
        </div>
    </div>           
</div>
<div class="row sub-footer">
    <div class="sub-footer-content">
        <div class="col-md-6" style="padding-top: 14px;">
            <p>©2013. Tor Metais. Todos os direitos reservados.</p>
        </div>
        <div class="col-md-6" style="padding-top: 14px; text-align: right;">
            <a href="http://www.serviti.com.br" target="_blank" title="ServiTI" style="color: #fff;" ><p>ServiTI</p></a>
        </div>
    </div>
</div>


   
</body>
</html>