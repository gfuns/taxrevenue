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
    <script src="{{ asset('assets/js/vendors/chart.js') }}"></script>
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


    @include('sweetalert::alert')


    <script src="{{ asset('assets/js/vendors/sweetalert2.all.min.js') }}"></script>

    <script type="text/javascript">
        $('#updateMilestone').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var milestone = button.data('milestone') // Extract info from data-* attributes
            var milestonefee = button.data('milestonefee') // Extract info from data-* attributes
            var deadline = button.data('deadline') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #milestone').val(milestone)
            offcanvas.find('.offcanvas-body #milestonefee').val(milestonefee)
            offcanvas.find('.offcanvas-body #deadline').val(deadline)
        })

        $('#editCategory').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var categoryname = button.data('categoryname') // Extract info from data-* attributes
            var icon = button.data('icon') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #categoryname').val(categoryname)
            document.getElementById("icon").src = icon;
        })


        $('#editProvider').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var biller = button.data('biller') // Extract info from data-* attributes
            var fee = button.data('fee') // Extract info from data-* attributes
            var icon = button.data('icon') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #biller').val(biller)
            offcanvas.find('.offcanvas-body #fee').val(fee)
            document.getElementById("icon").src = icon;
        })

        $('#editPlan').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var planname = button.data('planname') // Extract info from data-* attributes
            var amount = button.data('amount') // Extract info from data-* attributes
            var duration = button.data('duration') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #planname').val(planname)
            offcanvas.find('.offcanvas-body #amount').val(amount)
            offcanvas.find('.offcanvas-body #duration').val(duration)
        })

        $('#editTutorial').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var videotitle = button.data('videotitle') // Extract info from data-* attributes
            var videodesc = button.data('videodesc') // Extract info from data-* attributes
            var videourl = button.data('videourl') // Extract info from data-* attributes
            var thumbnail = button.data('thumbnail') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #videotitle').val(videotitle)
            offcanvas.find('.offcanvas-body #videodesc').val(videodesc)
            offcanvas.find('.offcanvas-body #videourl').val(videourl)
            document.getElementById("thumbnail").src = thumbnail;
        })

        $('#editProduct').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var productname = button.data('productname') // Extract info from data-* attributes
            var originalprice = button.data('originalprice') // Extract info from data-* attributes
            var discountedprice = button.data('discountedprice') // Extract info from data-* attributes
            var currency = button.data('currency') // Extract info from data-* attributes
            var affiliatelink = button.data('affiliatelink') // Extract info from data-* attributes
            var thumbnail = button.data('thumbnail') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #productname').val(productname)
            offcanvas.find('.offcanvas-body #originalprice').val(originalprice)
            offcanvas.find('.offcanvas-body #discountedprice').val(discountedprice)
            offcanvas.find('.offcanvas-body #affiliatelink').val(affiliatelink)
            document.getElementById("thumbnail").src = thumbnail;
            $('#currency').select2({
                dropdownParent: $('#editProduct'),
            }).val(currency).trigger('change');
        })

        $('#editDataProvider').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var biller = button.data('biller') // Extract info from data-* attributes
            var serviceid = button.data('serviceid') // Extract info from data-* attributes
            var fee = button.data('fee') // Extract info from data-* attributes
            var icon = button.data('icon') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #biller').val(biller)
            offcanvas.find('.offcanvas-body #serviceid').val(serviceid)
            offcanvas.find('.offcanvas-body #fee').val(fee)
            document.getElementById("icon").src = icon;
        })

        $('#editPowerProvider').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var biller = button.data('biller') // Extract info from data-* attributes
            var acronym = button.data('acronym') // Extract info from data-* attributes
            var serviceid = button.data('serviceid') // Extract info from data-* attributes
            var fee = button.data('fee') // Extract info from data-* attributes
            var icon = button.data('icon') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #biller').val(biller)
            offcanvas.find('.offcanvas-body #acronym').val(acronym)
            offcanvas.find('.offcanvas-body #serviceid').val(serviceid)
            offcanvas.find('.offcanvas-body #fee').val(fee)
            document.getElementById("icon").src = icon;
        })

        $('#viewAdmin').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var firstname = button.data('firstname') // Extract info from data-* attributes
            var lastname = button.data('lastname') // Extract info from data-* attributes
            var email = button.data('email') // Extract info from data-* attributes
            var role = button.data('role') // Extract info from data-* attributes
            var photo = button.data('photo') // Extract info from data-* attributes
            var datejoined = button.data('datejoined') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var modal = $(this)
            document.getElementById("vfirstname").innerHTML = firstname;
            document.getElementById("vlastname").innerHTML = lastname;
            document.getElementById("vrole").innerHTML = role;
            document.getElementById("vemail").innerHTML = email;
            document.getElementById("vregdate").innerHTML = datejoined;
            document.getElementById("vphoto").src = photo;
        })


        $('#editAdmin').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var firstname = button.data('firstname') // Extract info from data-* attributes
            var lastname = button.data('lastname') // Extract info from data-* attributes
            var email = button.data('email') // Extract info from data-* attributes
            var role = button.data('role') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            // modal.find('.modal-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #firstname').val(firstname)
            offcanvas.find('.offcanvas-body #lastname').val(lastname)
            offcanvas.find('.offcanvas-body #email').val(email)
            $('#role').select2({
                dropdownParent: $('#editAdmin'),
            }).val(role).trigger('change');
        })


        $('#coursecatsel').select2({
            dropdownParent: $('#offcanvasRight')
        });

        $('#userrole').select2({
            dropdownParent: $('#offcanvasRight')
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







        $('#editInstructor').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var firstname = button.data('firstname') // Extract info from data-* attributes
            var lastname = button.data('lastname') // Extract info from data-* attributes
            var email = button.data('email') // Extract info from data-* attributes
            var discipline = button.data('discipline') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            // modal.find('.modal-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #firstname').val(firstname)
            offcanvas.find('.offcanvas-body #lastname').val(lastname)
            offcanvas.find('.offcanvas-body #email').val(email)
            offcanvas.find('.offcanvas-body #discipline').val(discipline)
        })


        $('#editStudent').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var firstname = button.data('firstname') // Extract info from data-* attributes
            var lastname = button.data('lastname') // Extract info from data-* attributes
            var email = button.data('email') // Extract info from data-* attributes
            var experiencelevel = button.data('experiencelevel') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.


            var offcanvas = $(this)
            // modal.find('.modal-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #firstname').val(firstname)
            offcanvas.find('.offcanvas-body #lastname').val(lastname)
            offcanvas.find('.offcanvas-body #email').val(email)
            $('#parent').select2({
                dropdownParent: $('#editStudent'),
            }).val(experiencelevel).trigger('change');

        })





        $('#editCourseCategory').on('show.bs.offcanvas', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var myid = button.data('myid') // Extract info from data-* attributes
            var catname = button.data('catname') // Extract info from data-* attributes
            var slug = button.data('slug') // Extract info from data-* attributes
            var parentcat = button.data('parentcat') // Extract info from data-* attributes
            var pbstatus = button.data('pbstatus') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var offcanvas = $(this)
            offcanvas.find('.offcanvas-body #myid').val(myid)
            offcanvas.find('.offcanvas-body #name').val(catname)
            offcanvas.find('.offcanvas-body #slug').val(slug)
            document.getElementById("status").checked = pbstatus;

            $('#parent').select2({
                dropdownParent: $('#editCourseCategory'),
            }).val(parentcat).trigger('change');
        })


        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('#country').select2();
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
    </script>
