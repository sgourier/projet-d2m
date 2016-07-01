/**
 * Created by Sylvain Gourier on 30/06/2016.
 */

$(document).ready(function ()
{
    $('#selectDomain').on('change',function ()
    {
        $('#formFilterPract').attr('action',$('#formFilterPract').attr('action') + "/" + $(this).val());
        $('#formFilterPract').submit();
    })
});

