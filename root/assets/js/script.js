/**
 * Created by aliozyildirim on 27/05/2018.
 */

$(document).ready(function(){
    $('.form--login').on('submit', function (e) {
       e.preventDefault();
       var serialize = $(this).serializeArray();
       console.log(serialize);
        $.post('/member/login', serialize)
            .done(function(result){
                if(result.success) {
                      window.location = result.redirect;
                }else
                {
                    alert(result.message)
                }
            })
            .fail(function(xhr, status, error) {
            // error handling
                alert(status);
            });
    });

    $("#logout_button").click(function(){
        $.ajax({url: "/member/logout", success: function(result){
            window.location = '/member/';
            if(result.success) {
                alert(result.message);
            }
        }});
    });
});