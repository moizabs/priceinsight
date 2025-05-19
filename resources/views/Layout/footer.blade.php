
<!-- Jquery JS-->
<script src="vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="vendor/bootstrap-4.1/popper.min.js"></script>
<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="vendor/slick/slick.min.js"></script>
<script src="vendor/wow/wow.min.js"></script>
<script src="vendor/animsition/animsition.min.js"></script>
<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<script src="vendor/circle-progress/circle-progress.min.js"></script>
<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<!-- Main JS-->
<script src="js/main.js"></script>
<script src="js/custom.js"></script>

<script type="text/javascript">
     var onloadCallback = function() {
       grecaptcha.render('feedback-recaptcha', {
         'sitekey' : '6LcmYJwkAAAAAM_tgGsRCuaGxVV0NY495sEuUnn0'
       });
     };
     $("button[name='submit']").click(function(e){
        var response = grecaptcha.getResponse();
        $("#feedback-recaptcha").parent('.col-sm-12').siblings('.text-danger').remove();
        if(response.length == 0) 
        { 
            e.preventDefault();
            $("#feedback-recaptcha").parent('.col-sm-12').after('<div class="text-danger col-sm-12 p-0 mb-2">Please check recaptcha, if you are not a robot!</div>');
        }
     })

</script>