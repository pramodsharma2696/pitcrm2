<!-- Footer -->
<footer class="sticky-footer bg-white">
   <div class="container my-auto">
      <div class="copyright text-center my-auto">
         <span>Copyright &copy;  2023 Mindpool Technologies Limited, All Rights Reserved</span>
      </div>
   </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
         <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="{{ route('logout') }}">
               @csrf
               <a class="btn btn-primary" onclick="event.preventDefault();this.closest('form').submit();">Logout</a>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('pitcrm/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('pitcrm/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('pitcrm/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('pitcrm/js/sb-admin-2.min.js')}}"></script>
<!-- Page level plugins -->
<script src="{{ asset('pitcrm/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('pitcrm/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('pitcrm/js/demo/datatables-demo.js')}}"></script>


<!-- jQuery script for connected-person.blade.php file form -->

<script>

$(document).ready(function() {
  // Cache selectors for improved performance
  var $entityFields = $('.entity-fields');
  var $individualFields = $('.individual-fields');
  var $type = $('#type');
  var $inputField = $('#input-field');

  // Show/hide fields based on initial select box value
  if ($type.val() === 'individual') {
    $entityFields.hide();
    $individualFields.show();
  } else if ($type.val() === 'entity'){
    $entityFields.show();
    $individualFields.hide();
    $inputField.val('');
  }

  // Handle select box change event
  $type.change(function() {
    if ($(this).val() === 'individual') {
      $entityFields.hide();
      $individualFields.show();
      $('#permanent_address').prop('required', true);
      $('#correspondence_address').prop('required', true);
      $('#designation').prop('required', true);
      $('#entity_permanent_address').prop('required', false);
      $('#no_of_entity').prop('required', false);
      $('#entity_correspondence_address').prop('required', false);
      $('#entity_declaration').prop('required', false);
      $('#authorized_personnel_name').prop('required', false);
      $('#authorized_personnel_email').prop('required', false);
      $('#authorized_personnel_mobile_number').prop('required', false);
      $('#type_of_entity').prop('required', false);
      $inputField.val('Individual');
    } else if ($(this).val() === 'entity') {
      $entityFields.show();
      $individualFields.hide();
      $('#entity_permanent_address').prop('required', true);
      $('#no_of_entity').prop('required', true);
      $('#entity_correspondence_address').prop('required', true);
      $('#entity_declaration').prop('required', true);
      $('#authorized_personnel_name').prop('required', true);
      $('#authorized_personnel_email').prop('required', true);
      $('#authorized_personnel_mobile_number').prop('required', true);
      $('#type_of_entity').prop('required', true);
      $('#permanent_address').prop('required', false);
      $('#correspondence_address').prop('required', false);
      $('#designation').prop('required', false);
      $inputField.val('');
    }
  });
});
$(document).ready(function() {
  var $connectedFields = $('.connected-fields');
  var $connectedType = $('#connectedtype');
  var $connectedField = $('#connected-field');
  var $immediateField = $('#immediate-field');
  var $financialField = $('#financial-field');

  // Hide connected fields when page is loaded
  $connectedFields.hide();
  $immediateField.hide();
  $financialField.hide();

  // Handle select box change event
  $connectedType.change(function() {
    if ($(this).val() === 'connected person') {
      $('.all').hide();
      $connectedFields.show();
      $immediateField.hide();
      $financialField.hide();
      $('#connected-field').prop('required', true);
      $('#immediate-field').prop('required', false);
      $('#financial-field').prop('required', false);

      $connectedField.val(''); // Empty the value of the connected field
      $('#name').prop('required', false);
      $('#email').prop('required', false);
      $('#type').prop('required', false);
      $('#nature_of_connection').prop('required', false);
      $('#mobile').prop('required', false);
      $('#no_of_share_held').prop('required', false);
      $('#demat_account_number').prop('required', false);
      $('#pan_option').prop('required', false);
      $('#demat_account_number').prop('required', false);
    } 
    else if ($(this).val() === 'immediate relative') {
      $('.all').hide();
      $immediateField.show();
      $connectedFields.hide();
      $financialField.hide();

      $('#immediate-field').prop('required', true);
      $('#connected-field').prop('required', false);
      $('#financial-field').prop('required', false);
      $immediateField.val(''); // Empty the value of the connected field
      $('#name').prop('required', false);
      $('#email').prop('required', false);
      $('#type').prop('required', false);
      $('#nature_of_connection').prop('required', false);
      $('#mobile').prop('required', false);
      $('#no_of_share_held').prop('required', false);
      $('#demat_account_number').prop('required', false);
      $('#pan_option').prop('required', false);
      $('#demat_account_number').prop('required', false);
    } 
    else if ($(this).val() === 'financial relative') {
      $('.all').hide();
      $financialField.show();
      $connectedFields.hide();
      $immediateField.hide();

      $('#financial-field').prop('required', true);
      $('#immediate-field').prop('required', false);
      $('#connected-field').prop('required', false);
    
      $financialField.val(''); // Empty the value of the connected field
      $('#name').prop('required', false);
      $('#email').prop('required', false);
      $('#type').prop('required', false);
      $('#nature_of_connection').prop('required', false);
      $('#mobile').prop('required', false);
      $('#no_of_share_held').prop('required', false);
      $('#demat_account_number').prop('required', false);
      $('#pan_option').prop('required', false);
      $('#demat_account_number').prop('required', false);
    } 
    else if ($(this).val() === 'designated person'){
      $('.all').show();
      $connectedFields.hide();
      $immediateField.hide();
      $financialField.hide();
      $('#connected-field').prop('required', false);
      $('#immediate-field').prop('required', false);
      $('#financial-field').prop('required', false);
      $('#name').prop('required', true);
      $('#email').prop('required', true);
      $('#type').prop('required', true);
      $('#nature_of_connection').prop('required', true);
      $('#mobile').prop('required', true);
      $('#no_of_share_held').prop('required', true);
      $('#demat_account_number').prop('required', true);
      $('#pan_option').prop('required', true);
      $('#demat_account_number').prop('required', true);
   
    }
  });
});

</script>
<script>
$(document).ready(function() {
  $("#trading_window").on('change', function() {
    if ($("#trading_window").val() == 'closed') {
      $("#hideShow").show();
      // $('input[name="closure_start_date"]').prop('required', true);
      // $('input[name="closure_end_date"]').prop('required', true);
    }else{
      $("#hideShow").hide();
      // $('input[name="closure_start_date"]').prop('required', false);
      // $('input[name="closure_end_date"]').prop('required', false);
    }
  });

  
$("#trading_window2").on('load', function() {
   console.log($("#trading_window2").val());
    if ($("#trading_window2").val() == 'closed') {
      $("#hideShow2").show();
    }else{
      $("#hideShow2").hide();
    }
  });

});

</script>

<script>

$(document).ready(function() {
  const $panOption = $('#pan_option');
  const $panFields = $('#pan_fields');
  const $noPanDeclaration = $('#no_pan_declaration');
  const $panNumberInput = $('#pan_number');
  const $panAttachmentInput = $('#pan_attachment');
  const $declarationAttachmentInput = $('#declaration_attachment');
  

 
  // Show/hide fields based on initial select box value
  if ($panOption.val() === 'Yes') {
    $panFields.show();
    $noPanDeclaration.hide();
  
 
  } else if ($panOption.val() === 'No') {
    $panFields.hide();
    $noPanDeclaration.show();
  

  }

  // Handle PAN option change event
  $panOption.change(function() {
    if ($(this).val() === 'Yes') {
      $panFields.show();
      $noPanDeclaration.hide();
      $panNumberInput.prop('required', true);
      $declarationAttachmentInput.val('');
    } else {
      $panFields.hide();
      $noPanDeclaration.show();
      $panNumberInput.prop('required', false);
      $panNumberInput.val('');
      $panAttachmentInput.val('');
    }
  });
});
</script>


<script>
$(document).ready(function() {
  const $typeOfRelationContainer = $('#typeOfRelationContainer');
  const $typeOfRelationInput = $('#typeOfRelation');

  $(document).on('change', '#natureOfRelationSelect', function() {
    const selectedValue = $(this).val();
    
    if (selectedValue === 'Other') {
      $typeOfRelationContainer.show();
    } else {
      $typeOfRelationContainer.hide();
      $typeOfRelationInput.val('');
    }
  });

  // Reset the value when the page loads
  $('#natureOfRelationSelect').trigger('change');
});
</script>

<script>
  $(document).ready(function () {
    // Function to reset the input values in a cloned row
    function resetClonedRow(clonedRow) {
      clonedRow.find('input').val('');
    }

    // Handle click event on "Add More" button
    $('#add-row-button').click(function(e) {
      e.preventDefault();

      // Clone the last row of the table
      var clonedRow = $('#names-container .names-row:last').clone();

      // Reset the input values in the cloned row
      resetClonedRow(clonedRow);

      // Append the cloned row to the table
      $('#names-container').append(clonedRow);
      $('#cancel-row-button').show();
    });

    $('#cancel-row-button').click(function(e) {
      e.preventDefault();

      // Remove the last row of the table
      $('#names-container .names-row:last').remove();

      // Hide the cancel button if there are no more rows
      if ($('#names-container .names-row').length === 1) {
        $('#cancel-row-button').hide();
      }
    });

    // Reset the input values in the initial row
    resetClonedRow($('#names-container .names-row'));
  });
</script>



<script>
 $(document).ready(function() {
  // Get the CSRF token value
  var csrfToken = $('meta[name="csrf-token"]').attr('content');

  
  // Function to reset the input values and PAN details in a cloned row
  function resetClonedRow(clonedRow) {
    clonedRow.find('input, select').val('');
    clonedRow.find('.sender-pan-details').empty();
    clonedRow.find('.recipient-pan-details').empty();
  }

  // Add event listener to the sender select element
  $(document).on('change', '.sender-select', function() {
    var selectedId = $(this).val();
    var panDetailsElement = $(this).closest('.form-group').find('.sender-pan-details');

    if (selectedId) {
      // Send an AJAX request to fetch the PAN details for the sender
      $.ajax({
        url: '{{ route('getPanDetails') }}', // Use the Laravel route() helper to generate the URL
        type: 'POST',
        data: { id: selectedId },
        headers: {
          'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
        },
        success: function(response) {
          var panDetails = response.pan;
          // Update the sender PAN details
          panDetailsElement.text('PAN: ' + panDetails);
        },

        error: function(xhr, status, error) {
          // Handle the error scenario
        }
      });
    } else {
      // Clear the sender PAN details if no option is selected
      panDetailsElement.empty();
    }
  });

/*
  // Add event listener to the recipient select element
  $(document).on('change', '.recipient-select', function() {
    var selectedId = $(this).val();
    var panDetailsElement = $(this).closest('.form-group').find('.recipient-pan-details');

    if (selectedId) {
      // Send an AJAX request to fetch the PAN details for the recipient
      $.ajax({
        url: '{{ route('getPanDetails') }}', // Use the Laravel route() helper to generate the URL
        type: 'POST',
        data: { id: selectedId },
        headers: {
          'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
        },
        success: function(response) {
          var panDetails = response.pan;
          // Update the recipient PAN details
          panDetailsElement.text('PAN: ' + panDetails);
        },
        error: function(xhr, status, error) {
          // Handle the error scenario
        }
      });
    } else {
      // Clear the recipient PAN details if no option is selected
      panDetailsElement.empty();
    }
  });
*/
$(document).on('change', '.recipient-select', function() {
        var selectedIds = $(this).val();

        if (selectedIds) {
            $.ajax({
                url: '{{ route('getPanDetails') }}',
                type: 'POST',
                data: { id: selectedIds },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    var panDetails = response.pan;

                    // Loop through each recipient select element
                    $('.recipient-select').each(function() {
                        var recipientId = $(this).val();
                        var panDetailsElement = $(this).closest('.form-group').find('.recipient-pan-details');

                        if (panDetails[recipientId]) {
                            var panDetailText = 'PAN: ' + panDetails[recipientId];
                            panDetailsElement.text(panDetailText);
                        } else {
                            panDetailsElement.empty(); // Clear PAN details if not found
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error if needed
                }
            });
        } else {
            // Clear all recipient PAN details if no option is selected
            $('.recipient-pan-details').empty();
        }
    });



  // Handle click event on "Add More" button
  $('#add-row-btn').click(function(e) {
    e.preventDefault();

    // Clone the last row of the table
    var clonedRow = $('#table-container .table-row:last').clone();

    // Reset the input values and PAN details in the cloned row
    resetClonedRow(clonedRow);

    // Append the cloned row to the table
    $('#table-container').append(clonedRow);
    $('#cancel-row-btn').show();
  });
  $('#cancel-row-btn').click(function(e) {
      e.preventDefault();

      // Remove the last row of the table
      $('#table-container .table-row:last').remove();

      // Hide the cancel button if there are no more rows
      if ($('#table-container .table-row').length === 1) {
         $('#cancel-row-btn').hide();
      }
   });

  // Reset the input values and PAN details in the initial row
  resetClonedRow($('#table-container .table-row'));

  // Trigger change event on sender and recipient select elements
  $('.sender-select, .recipient-select').trigger('change');
});

</script>

