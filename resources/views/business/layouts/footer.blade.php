    <!-- Libs JS -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('assets/js/theme.min.js') }}"></script>

    <script src="{{ asset('assets/libs/jsvectormap/dist/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jsvectormap/dist/maps/world.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    @include('business.layouts.chart')
    <script src="{{ asset('assets/libs/flatpickr/dist/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/libs/quill/dist/quill.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/editor.js') }}"></script>
    <script src="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/libs/popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/libs/tippy.js/dist/tippy-bundle.umd.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/tooltip.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/yaireo/tagify/dist/tagify.min.js') }}"></script>
    <script src="{{ asset('assets/libs/imask/dist/imask.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/inputmask.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/validation.js') }}"></script>


    @include('sweetalert::alert')

    {{-- @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"]) --}}


    <script src="{{ asset('assets/js/vendors/sweetalert2.all.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#status').select2();
        });

        $(document).ready(function() {
            $('#period').select2();
        });


        $('#mda').select2({
            dropdownParent: $('#offcanvasRight')
        });

        $(document).ready(function() {
            $('#auttrigger1').select2();
        });

        $(document).ready(function() {
            $('#certificateValidity').select2();
        });

        $(document).ready(function() {
            $('#auttrigger2').select2();
        });

        $(document).ready(function() {
            $('#auttrigger3').select2();
        });

        $(document).ready(function() {
            $('#upgrading').select2();
        });

        $("#auttrigger1").change(function() {
            var configType = $(this).val();
            if (configType == "Yes") {
                 $("#autopt1").css("display", "block");
                 $("#certificateValidity").attr("required", true);
                 $("#invalidityReason").attr("required", true);
                 $("#certNo").attr("required", true);
                 $("#when").attr("required", true);
                 $("#where").attr("required", true);
                 $("#class").attr("required", true);
                 $("#whatworks").attr("required", true);
            } else {
                $("#autopt1").css("display", "none");
                $("#certificateValidity").removeAttr("required");
                $("#invalidityReason").removeAttr("required");
                $("#certNo").removeAttr("required");
                $("#when").removeAttr("required");
                $("#where").removeAttr("required");
                $("#class").removeAttr("required");
                $("#whatworks").removeAttr("required");
            }
        });

        $("#auttrigger2").change(function() {
            var configType = $(this).val();
            if (configType == "Yes") {
                 $("#autopt2").css("display", "block");
                 $("#experienceDet").attr("required", true);
            } else {
                $("#autopt2").css("display", "none");
                $("#experienceDet").removeAttr("required");
            }
        });

        $("#auttrigger3").change(function() {
            var configType = $(this).val();
            if (configType == "Yes") {
                 $("#autopt3").css("display", "block");
                 $("#bankName").attr("required", true);
                 $("#bankBranch").attr("required", true);
                 $("#accNo").attr("required", true);
                 $("#postCode").attr("required", true);
            } else {
                $("#autopt3").css("display", "none");
                $("#bankName").removeAttr("required");
                $("#bankBranch").removeAttr("required");
                $("#accNo").removeAttr("required");
                $("#postCode").removeAttr("required");
            }
        });
    </script>
