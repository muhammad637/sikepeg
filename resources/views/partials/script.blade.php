 <!-- Bootstrap core JavaScript-->
 <script src="{{asset('tampilan-sikepeg/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

 <!-- Core plugin JavaScript-->
 {{-- <script src="{{asset('tampilan-sikepeg/vendor/jquery-easing/jquery.easing.min.js')}}"></script> --}}

 <!-- Custom scripts for all pages-->
 <script src="{{asset('tampilan-sikepeg/js/sb-admin-2.min.js')}}"></script>

 <!-- Page level plugins -->
 {{-- <script src="{{asset('tampilan-sikepeg/vendor/chart.js/Chart.min.js')}}"></script> --}}

 <!-- Page level custom scripts -->
 {{-- <script src="{{asset('tampilan-sikepeg/js/demo/chart-area-demo.js')}}"></script>
 <script src="{{asset('tampilan-sikepeg/js/demo/chart-pie-demo.js')}}"></script> --}}

 

 <!-- Page level custom scripts -->
 {{-- <script src="{{asset('tampilan-sikepeg/js/demo/datatables-demo.js')}}"></script> --}}
 {{-- <script type="text/javascript" src="https://code.highchartscom/highcharts.js"></script> --}}

 {{-- <script type="text/javascript" src="https://code.highcharts.com/highcharts.js"></script>
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script type="text/javascript" src="https://code.highcharts.com/modules/exporting.js"></script> --}}
 
<script>
    $(document).ready(function () {
        $('#showPasswordBtn').click(function () {
            var passwordField = $('#password');
            var passwordFieldType = passwordField.attr('type');

            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $(this).html('<i class="fas fa-eye"></i>');
            } else {
                passwordField.attr('type', 'password');
                $(this).html('<i class="fas fa-eye-slash"></i>');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#showPasswordBtn2').click(function () {
            var passwordField = $('#newpassword');
            var passwordFieldType = passwordField.attr('type');

            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $(this).html('<i class="fas fa-eye"></i>');
            } else {
                passwordField.attr('type', 'password');
                $(this).html('<i class="fas fa-eye-slash"></i>');
            }
        });
    });
</script>