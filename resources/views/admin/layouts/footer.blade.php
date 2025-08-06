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

        $('#lga').select2({
            dropdownParent: $('#offcanvasRight')
        });

        $('#mda').select2({
            dropdownParent: $('#offcanvasRight')
        });

        $('#userrole').select2({
            dropdownParent: $('#offcanvasRight')
        });

        $('#operation').select2({
            dropdownParent: $('#offcanvasRight')
        });

        $("#configType").select2({
            dropdownParent: $("#addRevenueItem"),
        });


         $("#configType").change(function() {
            var configType = $(this).val();
            if (configType == "fixed") {
                $("#camo").css("display", "block");
                $("#camount").attr("required", true);
                $("#cper").css("display", "none");
                $("#cpercentage").removeAttr("required");
            } else if (configType == "percentage") {
                $("#cper").css("display", "block");
                $("#cpercentage").attr("required", true);
                $("#camo").css("display", "none");
                $("#camount").removeAttr("required");
            } else {
                $("#camo").css("display", "none");
                $("#cper").css("display", "none");
                $("#camount").removeAttr("required");
                $("#cpercentage").removeAttr("required");
            }
        });

        $("#uconfigType").change(function() {
            var configType = $(this).val();
            if (configType == "fixed") {
                $("#uamo").css("display", "block");
                $("#uamount").attr("required", true);
                $("#uper").css("display", "none");
                $("#upercentage").removeAttr("required");
            } else if (configType == "percentage") {
                $("#uper").css("display", "block");
                $("#upercentage").attr("required", true);
                $("#uamo").css("display", "none");
                $("#uamount").removeAttr("required");
            } else {
                $("#uamo").css("display", "none");
                $("#uper").css("display", "none");
                $("#uamount").removeAttr("required");
                $("#upercentage").removeAttr("required");
            }
        });


        $('#editRevenueItem').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var revenue = button.data('revenue') // Extract info from data-* attributes
            var revcode = button.data('revcode') // Extract info from data-* attributes
            var amount = button.data('amount') // Extract info from data-* attributes
            var config = button.data('config') // Extract info from data-* attributes
            var percentage = button.data('percentage') // Extract info from data-* attributes

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            // modal.find('.modal-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #revenue').val(revenue)
            offcanvas.find('.offcanvas-body #revcode').val(revcode)
            offcanvas.find('.offcanvas-body #uamount').val(amount)
            offcanvas.find('.offcanvas-body #upercentage').val(percentage)
            $("#uconfigType").select2({
                    dropdownParent: $("#editRevenueItem"),
                }).val(config)
                .trigger("change");
        })


        $("#feeconfig").change(function() {
            var configType = $(this).val();
            if (configType == "percentage") {
                document.getElementById("feelab1").innerHTML = "Percentage Value to be Charged As Technology Fee";
                document.getElementById("feelab2").innerHTML = "Percentage Value to be Charged As Technology Fee";
            } else if (configType == "fixed") {
                document.getElementById("feelab1").innerHTML = "Amount to be Charged As Technology Fee";
                document.getElementById("feelab2").innerHTML = "Amount to be Charged As Technology Fee";
            } else {
                document.getElementById("feelab1").innerHTML = "Technology Fee";
                document.getElementById("feelab2").innerHTML = "Technology Fee";
            }
        });

        $('#editUserRole').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var role = button.data('userole') // Extract info from data-* attributes

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            // modal.find('.modal-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #userole').val(role)
        })

        $('#editTaxOffice').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var office = button.data('office') // Extract info from data-* attributes
            var address = button.data('address') // Extract info from data-* attributes
            var lga = button.data('lga') // Extract info from data-* attributes

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            // modal.find('.modal-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #office').val(office)
            offcanvas.find('.offcanvas-body #address').val(address)
            $('#editLga').select2({
                dropdownParent: $('#editTaxOffice'),
            }).val(lga).trigger('change');
        })

        $('#editMDA').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var mda = button.data('mda') // Extract info from data-* attributes
            var mdacode = button.data('mdacode') // Extract info from data-* attributes

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            // modal.find('.modal-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #editMda').val(mda)
            offcanvas.find('.offcanvas-body #mdacode').val(mdacode)
        })

        $('#editDocument').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var document = button.data('document') // Extract info from data-* attributes
            var operation = button.data('operation') // Extract info from data-* attributes

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            // modal.find('.modal-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #document').val(document)
            $('#uoperation').select2({
                dropdownParent: $('#editDocument'),
            }).val(operation).trigger('change');
        })


        $('#editAdmin').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var othernames = button.data('othernames') // Extract info from data-* attributes
            var lastname = button.data('lastname') // Extract info from data-* attributes
            var email = button.data('email') // Extract info from data-* attributes
            var phone = button.data('phone') // Extract info from data-* attributes
            var role = button.data('role') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            // modal.find('.modal-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #othernames').val(othernames)
            offcanvas.find('.offcanvas-body #lastname').val(lastname)
            offcanvas.find('.offcanvas-body #email').val(email)
            offcanvas.find('.offcanvas-body #phone').val(phone)
            $('#role').select2({
                dropdownParent: $('#editAdmin'),
            }).val(role).trigger('change');
        })


        function disableLink(anchor) {
            const btn = anchor.querySelector('button');
            if (btn) {
                btn.disabled = true; // visually & functionally disabled
                btn.innerText = 'Submitting request, please wait…';
            }
            return true;
        }
    </script>
