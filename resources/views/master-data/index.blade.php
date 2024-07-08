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
         <h6 class="m-0 font-weight-bold text-primary">Master Data</h6>

         @if (auth()->user()->companyData()->count() > 0)
    <!-- User has already created a record, hide the asa76543dd button -->
    <a href="{{route('company.documents.show')}}" class="btn btn-info btn-sm mbtn">Documents</a>

          @else
    <!-- User has not created a record, show the add button -->
    <a href="{{route('master-data.add')}}" class="btn btn-success btn-user mbtn">Add New</a>
          @endif

      </div>
      <div class="card-body">
    
  <form >
               @csrf			
               @foreach($companyData as $data)					
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >Company Name:</label>
                  <input type="text" class="form-control" id="exampleFirstName"
                        name="company_name"  value="{{$data->company_name}}" disabled>
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >Registered Office:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="registered_office"   value="{{$data->registered_office}}" disabled>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >Corporate Office:</label>
                  <input type="text" class="form-control" id="exampleFirstName"
                        name="corporate_office"  value="{{$data->corporate_office}}"  disabled>
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >Mobile:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="mobile"   value="{{$data->mobile}}" disabled>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >Email:</label>
                  <input type="email" class="form-control" id="exampleFirstName"
                        name="email"  value="{{$data->email}}" disabled>
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >CIN:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="cin"   value="{{$data->cin}}" disabled>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >ISIN:</label>
                  <input type="text" class="form-control" id="exampleFirstName"
                        name="isin"  value="{{$data->isin}}" disabled>
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >BSE Scrip Code:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="bse_scrip_code"   value="{{$data->bse_scrip_code}}" disabled> 
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >NSE Scrip Code:</label>
                  <input type="text" class="form-control" id="exampleFirstName"
                        name="nse_scrip_code"  value="{{$data->nse_scrip_code}}" disabled>
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >Compliance Officer Name:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="compliance_officer_name"   value="{{$data->compliance_officer_name}}" disabled>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >Compliance Officer Mail:</label>
                  <input type="text" class="form-control" id="exampleFirstName"
                        name="compliance_officer_mail"  value="{{$data->compliance_officer_mail}}" disabled>
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >Compliance Officer Designation:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="compliance_officer_designation"   value="{{$data->compliance_officer_designation}}" disabled>
                  </div>
               </div>
               @if(auth()->user()->role=='admin')
               <div class="text-center">	
                  <a href="{{route('master-data.edit',$data->id)}}" class="btn btn-primary rounded-pill">Edit</a>
               </div>
               @endif
            </form>
      </div>
      @endforeach

   </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

 
@endsection