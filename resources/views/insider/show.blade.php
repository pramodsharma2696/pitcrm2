@extends('layout.mainlayout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <!-- DataTales Example -->
   <div class="container mt-5">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Insider Person Data</h6>
         </div>
         <div class="card-body">
            <form   >
               @csrf								
               <div class="form-group row ">
               <div class="col-sm-6 mb-3 mb-sm-0">
                      <label class="form-label  text-dark" >Insider Type:</label>
               <input type="text" class="form-control " id="exampleFirstName"
                     placeholder="Category Type" name="category_type"  value="{{$insider->category_type}}" disabled>
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >Connected Person Type:</label>
               <input type="text" class="form-control " 
                      value="{{$insider->type}}" disabled>
               </div>
            </div>

            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
                     <label class="form-label  text-dark" >Name:</label>
                    <input type="text" class="form-control"
                    name="name"  value="{{$insider->name}}" disabled>
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >Email:</label>

                  <input type="text" class="form-control"
                     placeholder="Email " name="email"  value="{{$insider->email}}" disabled>
               </div>
            </div>

            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Mobile:</label>

                  <input type="text" class="form-control"
                     placeholder="Mobile" name="mobile"  value="{{$insider->mobile}}" disabled>
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >No of Share's Held:</label>

                  <input type="text" class="form-control" id="exampleLastName"
                     placeholder="No of Share's Held" name="no_of_share_held"  value="{{$insider->no_of_share_held}}" disabled>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Nature of Connection:</label>

                  <input type="text" class="form-control " 
                     placeholder="Nature of Connection" name="nature_of_connection"  value="{{$insider->nature_of_connection}}" disabled>
               </div>
          <div class="col-sm-6" >
               <label class="form-label  text-dark" >Demat Account Number:</label>
               <input type="text" class="form-control " id="exampleFirstName"
               placeholder="Demat Account Number" name="demat_account_number" value="{{$insider->demat_account_number}}" disabled>
               </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >PAN Option:</label>

                  <select name="pan_option" class="form-control" id="pan_option" disabled>
                     <option value="Yes" <?php if ($insider->pan_option === 'Yes') echo 'selected'; ?>>Yes</option>
                     <option value="No" <?php if ($insider->pan_option === 'No') echo 'selected'; ?>>No</option>
                     </select>
                  </div>
                  
               </div>
               <div class="form-group row pan_fields" id="pan_fields">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >PAN:</label>
                  <input type="text" class="form-control "  id="pan_number"
                     placeholder="PAN" name="pan" value="{{$insider->pan}}" disabled>
                     @error('pan')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
                  <div class="col-sm-6 pan_fields">
                   PAN Attachment: {{ basename($insider->pan_attachment) }}
                   <a href="{{ $panAttachmentDownloadLink }}" download class="btn btn-primary ">Download PAN Attachment</a>
                   @error('pan_attachment')
                      <span style="color: red">{{ $message }}</span>
                   @enderror
               </div>
               </div>
               <div class="form-group row" id="no_pan_declaration" >
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >No PAN Declaration:</label>
               <input type="text" name="no_pan_declaration_input" class="form-control" value="Declaration Attached" disabled>
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" > Declaration Attachment: {{ basename($insider->declaration_attachment) }}</label>
               <a href="{{ $declarationAttachmentDownloadLink }}" download class="btn btn-primary ">Download Declaration Attachment</a>
               </div>
            </div>
       
            @if($insider->type=="individual")
            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Designation:</label>
               <input type="text" class="form-control" id="exampleLastName"
                    placeholder="Designation" name="designation"  value="{{$insider->designation}}" disabled>
               </div>
               <div class="col-sm-6">
         
               </div>
            </div>

            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Permanent Address:</label>

                  <input type="text" class="form-control " id="exampleFirstName"
                     placeholder="Permanent Address" name="permanent_address"  value="{{$insider->permanent_address}}" disabled>
    
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >Correspondence Address:</label>

                  <input type="text" class="form-control" id="exampleLastName"
                     placeholder="Correspondence Address" name="correspondence_address"  value="{{$insider->correspondence_address}}" disabled>
               </div>
            </div>


       @elseif($insider->type=="entity")
            <!-- Entity -->
            <div class="form-group row ">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Entity Permanent Address:</label>

                  <input type="text" class="form-control " id="exampleFirstName"
                     placeholder="Entity Permanent Address" name="entity_permanent_address"  value="{{$insider->entity_permanent_address}}" disabled>
               </div>
               <div class="col-sm-6 " >
               <label class="form-label  text-dark" >Entity Correspondence Address:</label>

                  <input type="text" class="form-control" id="exampleLastName"
                     placeholder="Entity Correspondence Address" name="entity_correspondence_address"  value="{{$insider->entity_correspondence_address}}" disabled>
               </div>
            </div>

            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Type of Entity:</label>
                  <input type="text" class="form-control " id="exampleFirstName"
                     placeholder="Type of Entity" name="type_of_entity" value="{{$insider->type_of_entity}}" disabled>
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >Entity Declaration:</label>

                  <input type="text" class="form-control" id="exampleLastName"
                     placeholder="Entity Declaration" name="entity_declaration"  value="{{$insider->entity_declaration}}" disabled>
               </div>
            </div>

            <div class="form-group row ">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Entity Registration Number:</label>

                  <input type="text" class="form-control " id="exampleFirstName"
                     placeholder="Entity Registration Number" name="entity_registration_number" value="{{$insider->entity_registration_number}}" disabled>
               </div>
               <div class="col-sm-6 ">
               <label class="form-label  text-dark" >Authorized Personnel Name:</label>

                  <input type="text" class="form-control" id="exampleLastName"
                     placeholder="Authorized Personnel Name" name="authorized_personnel_name"  value="{{$insider->authorized_personnel_name}}" disabled>
               </div>
            </div>

            <div class="form-group row ">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Authorized Personnel Email:</label>

                  <input type="text" class="form-control " id="exampleFirstName"
                     placeholder="Authorized Personnel Email" name="authorized_personnel_email" value="{{$insider->authorized_personnel_email}}" disabled>
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >Authorized Personnel Mobile Number:</label>

                  <input type="text" class="form-control" id="exampleLastName"
                     placeholder="Authorized Personnel Mobile Number" name="authorized_personnel_mobile_number"  value="{{$insider->authorized_personnel_mobile_number}}" disabled>
               </div>
            </div>
 

            <div class="form-group row ">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >No of Entity:</label>
                  <input type="text" class="form-control " id="exampleFirstName"
                     placeholder="No of Entity" name="no_of_entity" value="{{$insider->no_of_entity}}" disabled>   
               </div>
               <div class="col-sm-6">

               </div>
            </div>
 
@endif            
            
               <div class="text-center">	
                  <a href="{{route('insider-detail.records')}}" class="btn btn-primary rounded-pill">Back</a>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>

<!-- End of Main Content -->
@endsection