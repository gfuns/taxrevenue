 <script type="text/javascript">
     $(document).ready(function() {
         // Hide the account name text field by default
         $('#tpName').hide();
         // AJAX request on account number change
         $('#btin').on('input', function() {
             var btin = $(this).val();

             // Check if the length of the input is between 1 and 10 digits
             if (btin.length == 10) {

                 $('#validationprogress').show();
                 $('#validationerror').hide();
                 // Make AJAX call to validate account number
                 $.ajax({
                     url: '{{ route('mda.validateBtin') }}',
                     type: 'POST',
                     data: {
                         btin: btin,
                         _token: '{{ csrf_token() }}'
                     },

                     success: function(response) {

                         // Update account name field with the returned value
                         $('#taxpayer').val(response.taxpayer).prop('readonly', true);
                         // Show the account name text field
                         $('#tpName').show();
                         // Enable the submit button
                         $('#submitbutton').prop('disabled', false);
                         $('#validationprogress').hide();
                         $("#dob").removeAttr("required");
                         $("#occupation").removeAttr("required");
                         $("#biz").removeAttr("required");
                         $("#bizad").removeAttr("required");

                     },
                     error: function(xhr, status, error) {

                         $('#validationprogress').hide();
                         $('#validationerror').show();
                         // Handle errors if needed
                     }
                 });
             }

             $('#validationprogress').hide();
             $('#validationerror').hide();

         });
     });

     $(document).ready(function() {
         // Hide the account name text field by default
         $('#tpName2').hide();
         // AJAX request on account number change
         $('#btin2').on('input', function() {
             var btin2 = $(this).val();

             // Check if the length of the input is between 1 and 10 digits
             if (btin2.length == 10) {

                 $('#validationprogress2').show();
                 $('#validationerror2').hide();
                 // Make AJAX call to validate account number
                 $.ajax({
                     url: '{{ route('mda.validateBtin') }}',
                     type: 'POST',
                     data: {
                         btin: btin2,
                         _token: '{{ csrf_token() }}'
                     },

                     success: function(response) {

                         // Update account name field with the returned value
                         $('#taxpayer2').val(response.taxpayer).prop('readonly', true);
                         // Show the account name text field
                         $('#tpName2').show();
                         // Enable the submit button
                         $('#submitbutton2').prop('disabled', false);
                         $('#validationprogress2').hide();
                         $("#dob2").removeAttr("required");
                         $("#occupation2").removeAttr("required");
                         $("#biz2").removeAttr("required");
                         $("#bizad2").removeAttr("required");

                     },
                     error: function(xhr, status, error) {

                         $('#validationprogress2').hide();
                         $('#validationerror2').show();
                         // Handle errors if needed
                     }
                 });
             }

             $('#validationprogress2').hide();
             $('#validationerror2').hide();

         });
     });
 </script>
