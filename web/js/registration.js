/**
 * Created by Sylvain Gourier on 07/06/2016.
 */

$(document).on('ready',function ()
{
    $('#userRegister').on('click',function ()
    {
        $('#registerChoose').hide();
        $('#registrationForms').show();
        $('#fos_user_registration_form_roles').val(0);
    });
    $('#practRegister').on('click',function ()
    {
        $('#registerChoose').hide();
        $('#registrationForms').show();
        $('#fos_user_registration_form_roles').val(1);
    });
});
