@extends('layout.mainlayout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <!-- DataTales Example -->
   <div class="container mt-5">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Financial Relative Data</h6>
         </div>
         <div class="card-body">
            <form   >
               @csrf								
               <div class="form-group row ">
               <div class="col-sm-6 mb-3 mb-sm-0">
              <label class="form-label  text-dark" >Connected Person:</label>
               <input type="text" class="form-control " id="exampleFirstName"
                     placeholder="demat_account_number" name="demat_account_number"  value="{{ $financialRelative->connectedPerson->name }}" disabled>
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >Financial Relative Name:</label>

                  <input type="text" class="form-control"
                      name="name"  value="{{$financialRelative->financial_relative_name}}" disabled>

               </div>
            </div>

            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Nature of Relation:</label>
               <input type="text" class="form-control " 
                      value="{{$financialRelative->nature_of_relation}}" disabled>
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >Mobile:</label>

                  <input type="text" class="form-control"
                     placeholder="mobile " name="mobile"  value="{{$financialRelative->mobile}}" disabled>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >PAN:</label>

                  <input type="text" class="form-control " 
                     placeholder="Nature of Connection" name="pan"  value="{{$financialRelative->pan}}" disabled>
                  
               </div>
               <div class="col-sm-6">
               @if(!is_null($financialRelative->pan_attachment))
               <label class="form-label  text-dark" >  PAN Attachment:</label>
                      {{ basename($financialRelative->pan_attachment) }}
                   <a href="{{ $panAttachmentDownloadLink }}" download class="btn btn-primary ">Download PAN Attachment</a>
                   @error('pan_attachment')
                      <span style="color: red">{{ $message }}</span>
                   @enderror
                   @endif
               </div>
            </div>

            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Address:</label>

                  <input type="text" class="form-control"
                     placeholder="address" name="address"  value="{{$financialRelative->address}}" disabled>
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >Demat Account Number:</label>
                  <input type="text" class="form-control " id="exampleFirstName"
                     placeholder="demat_account_number" name="demat_account_number"  value="{{$financialRelative->demat_account_number}}" disabled>
               </div>
            </div>
   
            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >No of Share's Held:</label>
                   <input type="text" class="form-control" id="exampleLastName"
                      placeholder="No of Share's Held (if any)" name="shares_held"  value="{{$financialRelative->shares_held}}" disabled>                   

               </div>
               <div class="col-sm-6">

               </div>
               </div>
             
               <div class="text-center">	
                  <a href="{{route('financial-relative.records')}}" class="btn btn-primary rounded-pill">Back</a>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@endsection