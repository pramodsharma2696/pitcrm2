@extends('layout.mainlayout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <!-- DataTales Example -->
   <div class="container mt-5">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Immediate Relative Data</h6>
         </div>
         <div class="card-body">
            <form   >
               @csrf								
               <div class="form-group row ">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Connected Person:</label>
               <input type="text" class="form-control " id="exampleFirstName"
                     placeholder="demat_account_number" name="demat_account_number"  value="{{ $immediateRelative->connectedPerson->name }}" disabled>
          
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >Immediate Relative Name:</label>

                  <input type="text" class="form-control"
                      name="relative_name"  value="{{$immediateRelative->relative_name}}" disabled>

               </div>
            </div>

            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >PAN:</label>

                  <input type="text" class="form-control " 
                     placeholder="Nature of Connection" name="pan"  value="{{$immediateRelative->pan}}" disabled>
          
               </div>
               <div class="col-sm-6">
               @if(!is_null($immediateRelative->pan_attachment))
               <label class="form-label  text-dark" >  PAN Attachment:</label>
                      {{ basename($immediateRelative->pan_attachment) }}
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
                     placeholder="address" name="address"  value="{{$immediateRelative->address}}" disabled>
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >Mobile:</label>
                   <input type="text" class="form-control"
                      placeholder="mobile " name="mobile"  value="{{$immediateRelative->mobile}}" disabled>
                   </div>
               </div>
  
   
            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Demat Account Number:</label>
                  <input type="text" class="form-control " id="exampleFirstName"
                     placeholder="demat_account_number" name="demat_account_number"  value="{{$immediateRelative->demat_account_number}}" disabled>
               </div>
               <div class="col-sm-6">
             @if($immediateRelative->nature_of_relation=='Other')
               <label class="form-label  text-dark" >Nature of Relation</label>
               <input type="text" class="form-control " id="exampleFirstName"
                    value="{{ $immediateRelative->type_of_relation }} ({{ $immediateRelative->nature_of_relation }})" disabled>
               </div>
               </div>
               @else
               <label class="form-label  text-dark" >Nature of Relation</label>
               <input type="text" class="form-control " id="exampleFirstName"
                    value="{{ $immediateRelative->nature_of_relation }}" disabled>
               </div>
               </div>
               @endif
               <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >No of Share's Held:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                     placeholder="No of Share's Held (if any)" name="shares_held"  value="{{$immediateRelative->shares_held}}" disabled>
               </div>
               <div class="col-sm-6">
                   </div>
               </div>

               <div class="text-center">	
                  <a href="{{route('immediate-relative.records')}}" class="btn btn-primary rounded-pill">Back</a>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@endsection