@extends('layout.mainlayout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
   @if(session('success'))
   <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
   </div>
   @endif
   @if(session('error'))
   <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
   </div>
   @endif
   <!-- Page Heading -->
   <!-- DataTales Example -->
   <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
         <h6 class="m-0 font-weight-bold text-primary">Download Reports</h6>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0" style="width: 62rem;">
               <thead>
                  <tr>
                     <th>Reports</th>
                     <th>Date Range</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td> Report of Connected Persons </td>
                     <td>
                        <div class="form-group row">
                           <label for="start_date_connected-person" class="col-sm-2 col-form-label">Start Date</label>
                           <div class="col-sm-4">
                              <input type="date" class="form-control" id="start_date_connected-person" name="start_date_cp" required>
                           </div>
                           <label for="end_date_connected-person" class="col-sm-2 col-form-label">End Date</label>
                           <div class="col-sm-4">
                              <input type="date" class="form-control" id="end_date_connected-person" name="end_date_cp" required>
                           </div>
                        </div>
                     </td>
                     <td>
                        <button type="button" class="btn btn-success btn-sm download-report" data-report="connected-person" data-format="excel">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel
                        </button>
                        <button type="button" class="btn btn-danger btn-sm download-report" data-report="connected-person" data-format="pdf">
                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF
                        </button>
                     </td>
                  </tr>
                  <tr>
                     <td> Report of Insiders </td>
                     <td>
                        <div class="form-group row">
                           <label for="start_date_insider" class="col-sm-2 col-form-label">Start Date</label>
                           <div class="col-sm-4">
                              <input type="date" class="form-control" id="start_date_insider" name="start_date_in" required>
                           </div>
                           <label for="end_date_insider" class="col-sm-2 col-form-label">End Date</label>
                           <div class="col-sm-4">
                              <input type="date" class="form-control" id="end_date_insider" name="end_date_in" required>
                           </div>
                        </div>
                     </td>
                     <td>
                        <button type="button" class="btn btn-success btn-sm download-report" data-report="insider" data-format="excel">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel
                        </button>
                        <button type="button" class="btn btn-danger btn-sm download-report" data-report="insider" data-format="pdf">
                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF
                        </button>
                     </td>
                  </tr>
                  <tr>
                     <td> Report of UPSI </td>
                     <td>
                        <div class="form-group row">
                           <label for="start_date_UPSI" class="col-sm-2 col-form-label">Start Date</label>
                           <div class="col-sm-4">
                              <input type="date" class="form-control" id="start_date_UPSI" name="start_date_upsi" required>
                           </div>
                           <label for="end_date_UPSI" class="col-sm-2 col-form-label">End Date</label>
                           <div class="col-sm-4">
                              <input type="date" class="form-control" id="end_date_UPSI" name="end_date_upsi" required>
                           </div>
                        </div>
                     </td>
                     <td>
                        <button type="button" class="btn btn-success btn-sm download-report" data-report="UPSI" data-format="excel">
                            <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel
                        </button>
                        <button type="button" class="btn btn-danger btn-sm download-report" data-report="UPSI" data-format="pdf">
                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF
                        </button>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<script>
   document.querySelectorAll('.download-report').forEach(button => {
       button.addEventListener('click', function() {
           const reportType = this.getAttribute('data-report');
           const format = this.getAttribute('data-format');
           const startDate = document.getElementById(`start_date_${reportType}`).value;
           const endDate = document.getElementById(`end_date_${reportType}`).value;
           
           if (startDate && endDate) {
               let url = '';
               switch (reportType) {
                   case 'connected-person':
                       url = format === 'excel' ? '{{ route("reports.connected-person.excel") }}' : '{{ route("reports.connected-person.pdf") }}';
                       break;
                   case 'insider':
                       url = format === 'excel' ? '{{ route("reports.insider.excel") }}' : '{{ route("reports.insider.pdf") }}';
                       break;
                   case 'UPSI':
                       url = format === 'excel' ? '{{ route("reports.UPSI.excel") }}' : '{{ route("reports.UPSI.pdf") }}';
                       break;
               }
               window.location.href = `${url}?start_date=${startDate}&end_date=${endDate}`;
           } else {
               alert('Please select both start and end dates.');
           }
       });
   });
</script>

@endsection
