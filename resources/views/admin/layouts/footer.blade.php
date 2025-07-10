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


        $('#mda').select2({
            dropdownParent: $('#offcanvasRight')
        });


        $('#subscriptionDetails').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var planDetails = button.data('plandetails') // Extract info from data-* attributes
            var planFee = button.data('planfee') // Extract info from data-* attributes
            var renewalDate = button.data('renewaldate') // Extract info from data-* attributes
            var planId = button.data('planid') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var modal = $(this)
            document.getElementById("planDetails").innerHTML = planDetails;
            document.getElementById("planFee").innerHTML = planFee;
            document.getElementById("renewalDate").innerHTML = renewalDate;
            modal.find('.modal-body #planId').val(planId);
        })




        $('#userrole').select2({
            dropdownParent: $('#offcanvasRight')
        });

        $('#bank').select2({
            dropdownParent: $('#withdrawalModal')
        });

        $('#bank2').select2({
            dropdownParent: $('#bonusWithdrawalModal')
        });

        $('#editRole').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var role = button.data('role') // Extract info from data-* attributes

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            // modal.find('.modal-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #role').val(role)
        })






        // In your Javascript (external .js resource or <script> tag)


        $(document).ready(function() {
            $('#plans').select2();
        });

        $(document).ready(function() {
            $('#category').select2();
        });

        $(document).ready(function() {
            $('#paymentSchedule').select2();
        });

        $(document).ready(function() {
            $('#workMode').select2();
        });

        $(document).ready(function() {
            $('#jobStatus').select2();
        });

        $(document).ready(function() {
            $('#bannertype').select2();
        });

        $(document).ready(function() {
            $('#discat').select2();
        });
    </script>
