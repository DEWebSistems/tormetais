function validateBeforeSubmitRecord()
{
    var isErrors;
    var messagesHTML;
    isErrors = false;
    messagesHTML = '';
    messagesHTML += '<div class="alert alert-warning">';
    messagesHTML += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
    messagesHTML += '<h4>Foram encontradas as seguintes inconsistências:</h4>';
    if(allTrim($('#itNomeFantasia').val()) === '')
    {
        if(isErrors === false)
        {
            $('#itNomeFantasia').focus();
        }
        isErrors = true;
        messagesHTML += '<br/>O campo "Nome Fantasia" é de preenchimento obrigatório.';
    }
    if(allTrim($('#itRazaoSocial').val()) === '')
    {
        if(isErrors === false)
        {
            $('#itRazaoSocial').focus();
        }
        isErrors = true;
        messagesHTML += '<br/>O campo "Razão Social" é de preenchimento obrigatório.';
    }
    
    if(allTrim($('#seEstado').val()) === '')
    {
        if(isErrors === false)
        {
            $('#seEstado').focus();
        }
        isErrors = true;
        messagesHTML += '<br/>O campo "Estado" é de seleção obrigatória.';
    }
    if(allTrim($('#itCidade').val()) === '')
    {
        if(isErrors === false)
        {
            $('#itCidade').focus();
        }
        isErrors = true;
        messagesHTML += '<br/>O campo "Cidade" é de preenchimento obrigatório.';
    }
    if(allTrim($('#itBairro').val()) === '')
    {
        if(isErrors === false)
        {
            $('#itBairro').focus();
        }
        isErrors = true;
        messagesHTML += '<br/>O campo "Bairro" é de preenchimento obrigatório.';
    }
    if(allTrim($('#itEndereco').val()) === '')
    {
        if(isErrors === false)
        {
            $('#itEndereco').focus();
        }
        isErrors = true;
        messagesHTML += '<br/>O campo "Endereço" é de preenchimento obrigatório.';
    }
    if(allTrim($('#itNumero').val()) === '')
    {
        if(isErrors === false)
        {
            $('#itNumero').focus();
        }
        isErrors = true;
        messagesHTML += '<br/>O campo "Número" é de preenchimento obrigatório.';
    }
    if(allTrim($('#itTelefonePrincipal').val()) === '')
    {
        if(isErrors === false)
        {
            $('#itTelefonePrincipal').focus();
        }
        isErrors = true;
        messagesHTML += '<br/>O campo "Telefone Principal" é de preenchimento obrigatório.';
    }
    if(allTrim($('#iemEMailSecundario').val()) === '')
    {
        if(isErrors === false)
        {
            $('#iemEMailSecundario').focus();
        }
        isErrors = true;
        messagesHTML += '<br/>O campo "E-Mail Secundario" é de preenchimento obrigatório.';
    }
    
    messagesHTML += '</div>';
    if(isErrors === true)
    {
        $('#divResultsValidations').html(messagesHTML);
        window.scrollTo(0, 0);
        return false;
    }
    else if(isErrors === false)
    {
        $('#divResultsValidations').html('');
        window.scrollTo(0, 0);
        return true;
    }
}