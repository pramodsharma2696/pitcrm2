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
            <table class="table table-bordered" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>Reports</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <td> Report of Connected Persons </td>
                  <td>
                     <a href="{{ route('reports.connected-person.excel') }}" class="btn btn-success btn-sm">
                         <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel
                     </a>
                     <a href="{{ route('reports.connected-person.pdf') }}" class="btn btn-danger btn-sm">
                         <i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF       </a>
                 </td>
               </tbody>
               <tbody>
                  <td> Report of Insiders </td>
                  <td>
                     <a href="{{ route('reports.insider.excel') }}" class="btn btn-success btn-sm">
                         <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel
                     </a>
                     <a href="{{ route('reports.insider.pdf') }}" class="btn btn-danger btn-sm">
                         <i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF
                     </a>
                 </td>
               </tbody>
               <tbody>
                  <td> Report of UPSI </td>
                  <td>
                     <a href="{{ route('reports.UPSI.excel') }}" class="btn btn-success btn-sm">
                         <i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel
                     </a>
                     <a href="{{route('reports.UPSI.pdf')}}" class="btn btn-danger btn-sm">
                         <i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF
                     </a>
                 </td>
               </tbody>
            </table>

         </div>
      </div>
   </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

    
@endsection