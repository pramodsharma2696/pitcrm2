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
            <h6 class="m-0 font-weight-bold text-primary">Add Connected Person</h6>
         </div>
         <div class="card-body">
            <form  method="POST" action="{{route('connected-person.store')}}"  enctype="multipart/form-data">
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

               <div class="form-group row ">
               <div class="col-sm-6 mb-3 mb-sm-0">
                  <select name="type" class="form-control"  id="type" required>
                  <option value="" disabled selected >Type</option>
                        <option value="individual"  {{ old('type') === 'individual' ? 'selected' : '' }}>Individual</option>
                        <option value="entity"   {{ old('type') === 'entity' ? 'selected' : '' }}>Entity</option>
                       </select>
               </div>
               <div class="col-sm-6">
                  <input type="text" class="form-control"
                     placeholder="Name " name="name" value="{{old('name')}}" id="name" required>
                     @error('name')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>

            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
                  <!-- <input type="text" class="form-control " 
                     placeholder="Nature of Connection" name="nature_of_connection" value="{{old('nature_of_connection')}}"> -->
                     <select name="nature_of_connection" class="form-control"  id="nature_of_connection" required>
                  <option value="" disabled selected >Nature of Connection</option>
                        <option value="Executive Director"  {{ old('nature_of_connection') === 'Executive Director' ? 'selected' : '' }}>Executive Director</option>
                        <option value="Non Executive Director"  {{ old('nature_of_connection') === 'Non Executive Director' ? 'selected' : '' }}>Non Executive Director</option>
                        <option value="Key Managerial Personnel"  {{ old('nature_of_connection') === 'Key Managerial Personnel' ? 'selected' : '' }}>Key Managerial Personnel</option>
                        <option value="Designated Employee"  {{ old('nature_of_connection') === 'Designated Employee' ? 'selected' : '' }}>Designated Employee</option>
                        <option value="Holding Company"  {{ old('nature_of_connection') === 'Holding Company' ? 'selected' : '' }}>Holding Company</option>
                        <option value="Subsidiary Company"  {{ old('nature_of_connection') === 'Subsidiary Company' ? 'selected' : '' }}>Subsidiary Company</option>
                        <option value="Associate Company"  {{ old('nature_of_connection') === 'Associate Company' ? 'selected' : '' }}>Associate Company</option>
                        <option value="Group Company" {{ old('nature_of_connection') === 'Group Company' ? 'selected' : '' }}>Group Company</option>
                        <option value="Director of Group/Holding/Subsidiary/Associate Company" {{ old('nature_of_connection') === 'Director of Group/Holding/Subsidiary/Associate Company' ? 'selected' : '' }}>Director of Group/Holding/Subsidiary/Associate Company</option>
                        <option value="Designated Employee of Group/Holding/Subsidiary/Associate Company" {{ old('nature_of_connection') === 'Designated Employee of Group/Holding/Subsidiary/Associate Company' ? 'selected' : '' }}>Designated Employee of Group/Holding/Subsidiary/Associate Company</option>
                        <option value="Intermediary/Director of Intermediary/Employee of Intermediary" {{ old('nature_of_connection') === 'Intermediary/Director of Intermediary/Employee of Intermediary' ? 'selected' : '' }}>Intermediary/Director of Intermediary/Employee of Intermediary</option>
                        <option value="Investment Co./Trustee Co./AMC/ Its Directors or Employees" {{ old('nature_of_connection') === 'Investment Co./Trustee Co./AMC/ Its Directors or Employees' ? 'selected' : '' }}>Investment Co./Trustee Co./AMC/ Its Directors or Employees</option>
                        <option value="Official of Stock Exchange" {{ old('nature_of_connection') === 'Official of Stock Exchange' ? 'selected' : '' }}>Official of Stock Exchange</option>
                        <option value="Member of Board of Trustees/AMC of MF or its Employees" {{ old('nature_of_connection') === 'Member of Board of Trustees/AMC of MF or its Employees' ? 'selected' : '' }}>Member of Board of Trustees/AMC of MF or its Employees</option>
                        <option value="Member of BOD/ Employee of PFI" {{ old('nature_of_connection') === 'Member of BOD/ Employee of PFI' ? 'selected' : '' }}>Member of BOD/ Employee of PFI</option>
                        <option value="Official of SRO" {{ old('nature_of_connection') === 'Official of SRO' ? 'selected' : '' }}>Official of SRO</option>
                        <option value="Banker" {{ old('nature_of_connection') === 'Banker' ? 'selected' : '' }}>Banker</option>
                        <option value="Body Corporate/AOP/Concern wherein Director/Banker has more than 10% Interest" {{ old('nature_of_connection') === 'Body Corporate/AOP/Concern wherein Director/Banker has more than 10% Interest' ? 'selected' : '' }}>Body Corporate/AOP/Concern wherein Director/Banker has more than 10% Interest</option>
                       </select>
                     @error('nature_of_connection')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6">
                  <input type="text" class="form-control"
                     placeholder="Email " name="email"  id="email" value="{{old('email')}}" required>
                     @error('email')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>

            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="text" class="form-control"
                     placeholder="Mobile" name="mobile" id="mobile" value="{{old('mobile')}}" required>
                     @error('mobile')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6">
                  <input type="text" class="form-control" id="no_of_share_held"
                     placeholder="No of Share's Held" name="no_of_share_held" value="{{old('no_of_share_held')}}" required>
                     @error('no_of_share_held')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>


            <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <select name="pan_option" class="form-control" id="pan_option" required>
                     <option value="" disabled selected >PAN Options</option>
                     <option value="Yes"  {{ old('pan_option') === 'Yes' ? 'selected' : '' }}>Yes</option>
                     <option value="No"  {{ old('pan_option') === 'No' ? 'selected' : '' }}>No</option>
                     </select>
                  </div>
                  
               </div>
            <div class="form-group row" id="pan_fields" >
               <div class="col-sm-6 mb-3 mb-sm-0">
               <input type="text" class="form-control" id="pan_number"
                     placeholder="PAN" name="pan" value="{{old('pan')}}">
                     @error('pan')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6">
                     <input type="file"  class="form-control" name="pan_attachment" id="pan_attachment" placeholder="Select pan_attachment">
                     @error('pan_attachment')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>
            <div class="form-group row" id="no_pan_declaration" >
               <div class="col-sm-6 mb-3 mb-sm-0">
               <input type="text" name="no_pan_declaration_input" class="form-control" value="No PAN Declaration" disabled>
               </div>
               <div class="col-sm-6">
               <input type="file" class="form-control" name="declaration_attachment" id="declaration_attachment">
               @error('declaration_attachment')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>
            <div class="form-group row individual-fields">
               <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="text" class="form-control "
                     placeholder="Permanent Address" name="permanent_address" id="permanent_address" value="{{old('permanent_address')}}">
                     @error('permanent_address')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6 individual-fields">
                  <input type="text" class="form-control" 
                     placeholder="Correspondence Address" name="correspondence_address" id="correspondence_address" value="{{old('correspondence_address')}}">
                     @error('correspondence_address')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>

            <div class="form-group row ">
               <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="text" class="form-control "
                     placeholder="Demat Account Number" name="demat_account_number" id="demat_account_number" value="{{old('demat_account_number')}}" required>
                     @error('demat_account_number')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6 individual-fields" >
                  <input type="text" class="form-control"
                     placeholder="Designation" name="designation"  id="designation" value="{{old('designation')}}">
                     @error('designation')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>

            <!-- Entity -->
            <div class="form-group row entity-fields">
               <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="text" class="form-control " 
                     placeholder="Entity Permanent Address" name="entity_permanent_address" id="entity_permanent_address" value="{{old('entity_permanent_address')}}">
                     @error('entity_permanent_address')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6 entity-fields" >
                  <input type="text" class="form-control" 
                     placeholder="Entity Correspondence Address" name="entity_correspondence_address" id="entity_correspondence_address" value="{{old('entity_correspondence_address')}}">
                     @error('entity_correspondence_address')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>

            <div class="form-group row entity-fields">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <input type="text" class="form-control"id="type_of_entity"
                     placeholder="Type of Entity" name="type_of_entity" value="{{old('type_of_entity')}}">
                     @error('type_of_entity')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6 entity-fields">
                  <input type="text" class="form-control" id="entity_declaration"
                     placeholder="Entity Declaration" name="entity_declaration" value="{{old('entity_declaration')}}">
                     @error('entity_declaration')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>

            <div class="form-group row entity-fields">
               <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="text" class="form-control " id="entity_registration_number"
                     placeholder="Entity Registration Number (if any)" name="entity_registration_number" value="{{old('entity_registration_number')}}">
                     @error('entity_registration_number')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6 entity-fields">
                  <input type="text" class="form-control" id="authorized_personnel_name"
                     placeholder="Authorized Personnel Name" name="authorized_personnel_name" value="{{old('authorized_personnel_name')}}">
                     @error('authorized_personnel_name')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>

            <div class="form-group row entity-fields" id="entity-fields">
               <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="email" class="form-control " id="authorized_personnel_email"
                     placeholder="Authorized Personnel Email" name="authorized_personnel_email" value="{{old('authorized_personnel_email')}}">
                     @error('authorized_personnel_email')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6 entity-fields">
                  <input type="text" class="form-control" id="authorized_personnel_mobile_number"
                     placeholder="Authorized Personnel Mobile Number" name="authorized_personnel_mobile_number" value="{{old('authorized_personnel_mobile_number')}}">
                     @error('authorized_personnel_mobile_number')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>
            <div class="form-group row entity-fields" id="entity-fields">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <input type="text" class="form-control " id="no_of_entity"
                     placeholder="No of Entity" name="no_of_entity" value="{{old('no_of_entity')}}">
                     @error('no_of_entity')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               </div>
    
               <div class="text-center col">	
                  <button class="btn btn-primary rounded-pill" type="submit">Add</button>
                 <a href="{{route('connected-person.records')}}" class="btn btn-primary rounded-pill">Back</a>
    
               </div>
                  
            </form>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->



@endsection


