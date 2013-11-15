function allTrim(valueString)
{
    valueString = valueString.replace( /\s/g, '' );
    return valueString;
}

function confirmaExclusao()
{
    if(confirm('Você deseja excluir este registro?'))
    {
        return true;
    }
    else
    {
        return false;
    }
}