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
   <div class="container mt-5">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Company Data</h6>
         </div>
         <div class="card-body">
            <form  method="POST" action="{{route('master-data.store')}}" >
               @if ($errors->any())
               <div class="alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
               @csrf								
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     <input type="text" class="form-control " 
                        placeholder="Company Name" name="company_name" required>
                  </div>
                  <div class="col-sm-6">
                     <input type="text" class="form-control"
                        placeholder="Registered Office" name="registered_office" required>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     <input type="text" class="form-control" id="exampleFirstName"
                        placeholder="Corporate Office" name="corporate_office" required>
                  </div>
                  <div class="col-sm-6">
                     <input type="text" class="form-control" id="exampleLastName"
                        placeholder="Mobile" name="mobile" required>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     <input type="email" class="form-control " id="exampleFirstName"
                        placeholder="Email" name="email" required>
                  </div>
                  <div class="col-sm-6">
                     <input type="text" class="form-control" id="exampleLastName"
                        placeholder="CIN" name="cin" required>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     <input type="text" class="form-control " 
                        placeholder="ISIN" name="isin" required>
                  </div>
                  <div class="col-sm-6">
                     <input type="text" class="form-control "
                        placeholder="BSE Scrip Code" name="bse_scrip_code" required>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     <input type="text" class="form-control" 
                        placeholder="NSE Scrip Code" name="nse_scrip_code" required>
                  </div>
                  <div class="col-sm-6">
                     <input type="text" class="form-control" 
                        placeholder="Compliance Officer Name" name="compliance_officer_name" required>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     <input type="email" class="form-control" 
                        placeholder="Compliance Officer Email" name="compliance_officer_mail" required>
                  </div>
                  <div class="col-sm-6">
                     <input type="text" class="form-control"
                        placeholder="Compliance Officer Designation" name="compliance_officer_designation" required>
                  </div>
               </div>
               <div class="text-center">	
                  <button class="btn btn-primary rounded-pill" type="submit">Add</button>
                  <a href="{{route('master-data.records')}}" class="btn btn-primary rounded-pill">Back</a>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@endsection