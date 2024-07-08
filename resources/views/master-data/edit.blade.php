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
            <h6 class="m-0 font-weight-bold text-primary">Edit Master Data</h6>
         </div>
         <div class="card-body">
            <form  method="POST" action="{{route('master-data.update',$data->id)}}" >
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
                  <label class="form-label  text-dark" >Company Name:</label>
                  <input type="text" class="form-control" id="exampleFirstName"
                        name="company_name"  value="{{$data->company_name}}">
                     @error('company_name')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >Registered Office:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="registered_office"   value="{{$data->registered_office}}">
                     @error('registered_office')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >Corporate Office:</label>
                  <input type="text" class="form-control" id="exampleFirstName"
                        name="corporate_office"  value="{{$data->corporate_office}}">
                     @error('corporate_office')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >Mobile:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="mobile"   value="{{$data->mobile}}">
                     @error('mobile')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >Email:</label>
                  <input type="email" class="form-control" id="exampleFirstName"
                        name="email"  value="{{$data->email}}">
                     @error('email')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >CIN:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="cin"   value="{{$data->cin}}">
                     @error('cin')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >ISIN:</label>
                  <input type="text" class="form-control" id="exampleFirstName"
                        name="isin"  value="{{$data->isin}}">
                     @error('isin')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >BSE Scrip Code:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="bse_scrip_code"   value="{{$data->bse_scrip_code}}">
                     @error('bse_scrip_code')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >NSE Scrip Code:</label>
                  <input type="text" class="form-control" id="exampleFirstName"
                        name="nse_scrip_code"  value="{{$data->nse_scrip_code}}">
                     @error('nse_scrip_code')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >Compliance Officer Name:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="compliance_officer_name"   value="{{$data->compliance_officer_name}}">
                     @error('compliance_officer_name')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >Compliance Officer Mail:</label>
                  <input type="text" class="form-control" id="exampleFirstName"
                        name="compliance_officer_mail"  value="{{$data->compliance_officer_mail}}">
                     @error('compliance_officer_mail')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >Compliance Officer Designation:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="compliance_officer_designation"   value="{{$data->compliance_officer_designation}}">
                     @error('compliance_officer_designation')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
               </div>
              
               <div class="text-center">	
                  <button class="btn btn-primary rounded-pill" type="submit">Update</button>
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