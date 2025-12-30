    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    
    
    <script type="text/javascript" src="../assets/table/jquery-3.7.0.js"></script>
    <script type="text/javascript" src="../assets/table/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="../assets/table/dataTables.fixedHeader.min.js"></script>
    <script type="text/javascript" src="../assets/table/dataTables.responsive.min.js"></script>
    <script type="text/javascript" src="../assets/table/responsive.bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/table/table.js"></script>
   
    
    
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <script src="../assets/vendor/libs/quill/katex.js"></script>
    <script src="../assets/vendor/libs/quill/quill.js"></script>
    <script src="../assets/vendor/libs/select2/select2.js"></script>
    <script src="../assets/vendor/libs/dropzone/dropzone.js"></script>
    <script src="../assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="../assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="../assets/vendor/libs/tagify/tagify.js"></script>
    <script src="../assets/js/app-ecommerce-product-add.js"></script>
    <script src="../assets/vendor/libs/moment/moment.js"></script>
    <script src="../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/app-ecommerce-referral.js"></script>
    <script src="../assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
    <script src="../assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="../assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>
    <script src="../assets/js/modal-edit-user.js"></script>
    <script src="../assets/js/app-user-view.js"></script>
    <script src="../assets/js/modal-edit-user.js"></script>
    <script src="../assets/js/modal-enable-otp.js"></script>
    <script src="../assets/js/app-user-view.js"></script>
    <script src="../assets/js/app-user-view-security.js"></script>
    <script src="../assets/js/pages-auth.js"></script>
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="../assets/vendor/libs/clipboard/clipboard.js"></script>
    <script src="../assets/vendor/libs/moment/moment.js"></script>
    <script src="../assets/vendor/libs/idletimer/idletimer.js"></script>
    <script src="../assets/vendor/libs/numeral/numeral.js"></script>
    <script src="../assets/vendor/libs/toastr/toastr.js"></script>
    <script src="../assets/js/extended-ui-misc-clipboardjs.js"></script>
    <script src="../assets/js/extended-ui-misc-idle-timer.js"></script>
    <script src="../assets/js/extended-ui-misc-numeraljs.js"></script>
    <script src="../assets/vendor/libs/moment/moment.js"></script>
    <script src="../assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <script src="../assets/js/form-layouts.js"></script>
    <script src="../assets/vendor/libs/autosize/autosize.js"></script>
    <script src="../assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js"></script>
    <script src="../assets/vendor/libs/jquery-repeater/jquery-repeater.js"></script>
    <script src="../assets/js/forms-extras.js"></script>
    <script src="../assets/vendor/libs/tagify/tagify.js"></script>
    <script src="../assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
    <script src="../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../assets/vendor/libs/bloodhound/bloodhound.js"></script>
    <script src="../assets/js/forms-selects.js"></script>
    <script src="../assets/js/forms-tagify.js"></script>
    <script src="../assets/js/forms-typeahead.js"></script>
    <script src="../assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="../assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="../assets/js/pages-account-settings-account.js"></script>
    <script src="../assets/vendor/libs/cleavejs/cleave-phone.js"></script>
    <script src="../assets/js/pages-account-settings-security.js"></script>
    <script src="../assets/js/modal-enable-otp.js"></script>
    <script src="../assets/js/pages-profile.js"></script>
    <script src="../assets/js/tables-datatables-extensions.js"></script>
    <script src="../assets/vendor/libs/swiper/swiper.js"></script>
    <script src="../assets/js/ui-carousel.js"></script>
    <script src="../assets/js/ui-popover.js"></script>
    <script>
			function getToken(){
    const chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'

    let tokenLength = 6;
    let token =  "";

    for (let i=0; i<tokenLength; i++){
        let randomNumber = Math.floor(Math.random() * chars.length);
        token += chars.substring(randomNumber,randomNumber+1);
    }
    document.getElementById('token').value = 'BT4_'+token;
}
const chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'

    let tokenLength = 6;
    let token =  "";

    for (let i=0; i<tokenLength; i++){
        let randomNumber = Math.floor(Math.random() * chars.length);
        token += chars.substring(randomNumber,randomNumber+1);
    }
    document.getElementById('token').value = 'BT4_'+token;
		</script>
		
		<script>
		(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
   
    
})(jQuery);


		</script>