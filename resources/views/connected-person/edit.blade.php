@extends('layout.mainlayout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <!-- DataTales Example -->
   <div class="container mt-5">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Connected People Data</h6>
         </div>
         <div class="card-body">
         <form  method="POST" action="{{route('connected-person.update',$data->id)}}" enctype="multipart/form-data">
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
               <label class="form-label  text-dark" >Select Connection Type:</label>
               <select name="type" class="form-control"  id="type" required>
               <option value="individual" <?php if ($data->type === 'individual') echo 'selected'; ?>>Individual</option>
               <option value="entity" <?php if ($data->type === 'entity') echo 'selected'; ?>>Entity</option>
                       </select>
                       @error('type')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >Name:</label>

                  <input type="text" class="form-control" id="name" 
                      name="name"  value="{{$data->name}}" >
                      @error('name')
                     <span style="color:red">{{$message}}</span>
                     @enderror

               </div>
            </div>

            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Nature of Connection:</label>

                  <!-- <input type="text" class="form-control " 
                     placeholder="Nature of Connection" name="nature_of_connection"  value="{{$data->nature_of_connection}}" > -->
               <select name="nature_of_connection" class="form-control"  id="nature_of_connection" required>
                   <option value="Executive Director"  <?php if ($data->nature_of_connection === 'Executive Director') echo 'selected'; ?>>Executive Director</option>
                   <option value="Non Executive Director" <?php if ($data->nature_of_connection === 'Non Executive Director') echo 'selected'; ?>>Non Executive Director</option>
                   <option value="Key Managerial Personnel" <?php if ($data->nature_of_connection === 'Key Managerial Personnel') echo 'selected'; ?>>Key Managerial Personnel</option>
                   <option value="Designated Employee" <?php if ($data->nature_of_connection === 'Designated Employee') echo 'selected'; ?>>Designated Employee</option>
                   <option value="Holding Company" <?php if ($data->nature_of_connection === 'Holding Company') echo 'selected'; ?>>Holding Company</option>
                   <option value="Subsidiary Company" <?php if ($data->nature_of_connection === 'Subsidiary Company') echo 'selected'; ?>>Subsidiary Company</option>
                   <option value="Associate Company" <?php if ($data->nature_of_connection === 'Associate Company') echo 'selected'; ?>>Associate Company</option>
                   <option value="Group Company" <?php if ($data->nature_of_connection === 'Group Company') echo 'selected'; ?>>Group Company</option>
                   <option value="Director of Group/Holding/Subsidiary/Associate Company" <?php if ($data->nature_of_connection === 'Director of Group/Holding/Subsidiary/Associate Company') echo 'selected'; ?>>Director of Group/Holding/Subsidiary/Associate Company</option>
                   <option value="Designated Employee of Group/Holding/Subsidiary/Associate Company" <?php if ($data->nature_of_connection === 'Designated Employee of Group/Holding/Subsidiary/Associate Company') echo 'selected'; ?>>Designated Employee of Group/Holding/Subsidiary/Associate Company</option>
                   <option value="Intermediary/Director of Intermediary/Employee of Intermediary" <?php if ($data->nature_of_connection === 'Intermediary/Director of Intermediary/Employee of Intermediary') echo 'selected'; ?>>Intermediary/Director of Intermediary/Employee of Intermediary</option>
                   <option value="Investment Co./Trustee Co./AMC/ Its Directors or Employees" <?php if ($data->nature_of_connection === 'Investment Co./Trustee Co./AMC/ Its Directors or Employees') echo 'selected'; ?>>Investment Co./Trustee Co./AMC/ Its Directors or Employees</option>
                   <option value="Official of Stock Exchange" <?php if ($data->nature_of_connection === 'Official of Stock Exchange') echo 'selected'; ?>>Official of Stock Exchange</option>
                   <option value="Member of Board of Trustees/AMC of MF or its Employees" <?php if ($data->nature_of_connection === 'Member of Board of Trustees/AMC of MF or its Employees') echo 'selected'; ?>>Member of Board of Trustees/AMC of MF or its Employees</option>
                   <option value="Member of BOD/ Employee of PFI" <?php if ($data->nature_of_connection === 'Member of BOD/ Employee of PFI') echo 'selected'; ?>>Member of BOD/ Employee of PFI</option>
                   <option value="Official of SRO" <?php if ($data->nature_of_connection === 'Official of SRO') echo 'selected'; ?>>Official of SRO</option>
                   <option value="Banker" <?php if ($data->nature_of_connection === 'Banker') echo 'selected'; ?>>Banker</option>
                   <option value="Body Corporate/AOP/Concern wherein Director/Banker has more than 10% Interest" <?php if ($data->nature_of_connection === 'Body Corporate/AOP/Concern wherein Director/Banker has more than 10% Interest') echo 'selected'; ?>>Body Corporate/AOP/Concern wherein Director/Banker has more than 10% Interest</option>
                </select>
                     @error('nature_of_connection')
                     <span style="color:red">{{$message}}</span>
                     @enderror
          
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >Email:</label>

                  <input type="text" class="form-control" id="email"
                     placeholder="Email " name="email"  value="{{$data->email}}" required>
                     @error('email')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>

            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Mobile:</label>

                  <input type="text" class="form-control" id="mobile"
                     placeholder="Mobile" name="mobile"  value="{{$data->mobile}}" required>
                     @error('mobile')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >No of Share's Held:</label>

                  <input type="text" class="form-control" id="no_of_share_held" required
                     placeholder="No of Share's Held" name="no_of_share_held"  value="{{$data->no_of_share_held}}">
                     @error('no_of_share_held')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>
            <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <select name="pan_option" class="form-control" id="pan_option" required>
                     <option value="Yes" <?php if ($data->pan_option === 'Yes') echo 'selected'; ?>>Yes</option>
                     <option value="No" <?php if ($data->pan_option === 'No') echo 'selected'; ?>>No</option>
                     </select>
                  </div>
                  
               </div>


            <div class="form-group row pan_fields" id="pan_fields">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >PAN:</label>
                  <input type="text" class="form-control "  id="pan_number"
                     placeholder="PAN" name="pan" value="{{$data->pan}}">
                     @error('pan')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
                  <div class="col-sm-6 pan_fields">
                  <!-- <label class="form-label text-dark">PAN Attachment:</label> -->
                   PAN Attachment: {{ basename($data->pan_attachment) }}
                   <input type="file" class="form-control" name="pan_attachment" id="pan_attachment"  placeholder="Select pan_attachment"  value="{{$data->pan_attachment}}">
                   @error('pan_attachment')
                      <span style="color: red">{{ $message }}</span>
                   @enderror
               </div>
               </div>
               <div class="form-group row" id="no_pan_declaration" >
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >No PAN Declaration:</label>
               <input type="text" name="no_pan_declaration_input" class="form-control" value="No PAN Declaration" disabled>
               </div>
               <div class="col-sm-6">
               <!-- <label class="form-label text-dark">Declaration Attachment:</label> -->
               Declaration Attachment: {{ basename($data->declaration_attachment) }}
                     <input type="file" class="form-control" name="declaration_attachment" id="declaration_attachment" value="{{$data->declaration_attachment}}">
                     @error('declaration_attachment')
                        <span style="color: red">{{ $message }}</span>
                     @enderror
               </div>
            </div>

            <div class="form-group row ">
               <div class="col-sm-6  mb-sm-0" >
               <label class="form-label  text-dark" >Demat Account Number:</label>
                  <input type="text" class="form-control " id="demat_account_number" required
                     placeholder="Demat Account Number" name="demat_account_number" value="{{$data->demat_account_number}}">
                     @error('demat_account_number')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>

            <div class="form-group row individual-fields">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Permanent Address:</label>

                  <input type="text" class="form-control " id="permanent_address"
                     placeholder="Required when connection type is Individual" name="permanent_address"  value="{{$data->permanent_address}}">
                     @error('permanent_address')
                     <span style="color:red">{{$message}}</span>
                     @enderror
    
               </div>
               <div class="col-sm-6 individual-fields">
               <label class="form-label  text-dark" >Correspondence Address:</label>
                  <input type="text" class="form-control" id="correspondence_address"
                     placeholder="Required when connection type is Individual" name="correspondence_address"  value="{{$data->correspondence_address}}">
                     @error('correspondence_address')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>

            <div class="form-group row individual-fields">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Designation:</label>
                  <input type="text" class="form-control" id="designation"
                     placeholder="Required when connection type is Individual" name="designation"  value="{{$data->designation}}">
                     @error('designation')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>
      
            <!-- Entity -->
            
            <div class="form-group row entity-fields" >
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Entity Permanent Address:</label>

                  <input type="text" class="form-control " id="entity_permanent_address"
                     placeholder="Required when connection type is Entity" name="entity_permanent_address"  value="{{$data->entity_permanent_address}}">
                     @error('entity_permanent_address')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6 entity-fields" >
               <label class="form-label  text-dark" >Entity Correspondence Address:</label>

                  <input type="text" class="form-control" id="entity_correspondence_address"
                     placeholder="Required when connection type is Entity" name="entity_correspondence_address"  value="{{$data->entity_correspondence_address}}" >
                     @error('entity_correspondence_address')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>

            <div class="form-group row entity-fields">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Type of Entity:</label>
               <input type="text" class="form-control" id="type_of_entity"
                     placeholder="Type of Entity" name="type_of_entity" value="{{$data->type_of_entity}}">
                     @error('type_of_entity')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <!-- <div class="col-sm-6 entity-fields">
               <label class="form-label  text-dark" >Entity Declaration:</label>

                  <input type="text" class="form-control" id="entity_declaration"
                     placeholder="Required when connection type is Entity" name="entity_declaration"  value="{{$data->entity_declaration}}">
                     @error('entity_declaration')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div> -->
               <div class="col-sm-6 pan_fields">
                  <!-- <label class="form-label text-dark">PAN Attachment:</label> -->
                  Entity Declaration Attachment: {{ basename($data->entity_declaration) }}
                   <input type="file" class="form-control" name="entity_declaration" id="entity_declaration"  placeholder="Select entity declaration attachment"  value="{{$data->entity_declaration}}">
                   @error('entity_declaration')
                      <span style="color: red">{{ $message }}</span>
                   @enderror
               </div>
               
            </div>

            <div class="form-group row entity-fields">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Entity Registration Number:</label>

                  <input type="text" class="form-control " id="entity_registration_number"
                     placeholder="Entity Registration Number (if any)" name="entity_registration_number" value="{{$data->entity_registration_number}}">
                     @error('entity_registration_number')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6 entity-fields">
               <label class="form-label  text-dark" >Authorized Personnel Name:</label>

                  <input type="text" class="form-control" id="authorized_personnel_name"
                     placeholder="Required when connection type is Entity" name="authorized_personnel_name"  value="{{$data->authorized_personnel_name}}">
                     @error('authorized_personnel_name')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>

            <div class="form-group row entity-fields">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Authorized Personnel Email:</label>

                  <input type="text" class="form-control " id="authorized_personnel_email"
                     placeholder="Required when connection type is Entity" name="authorized_personnel_email" value="{{$data->authorized_personnel_email}}">
                     @error('authorized_personnel_email')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6 entity-fields">
               <label class="form-label  text-dark" >Authorized Personnel Mobile Number:</label>

                  <input type="text" class="form-control" id="authorized_personnel_mobile_number"
                     placeholder="Required when connection type is Entity" name="authorized_personnel_mobile_number"  value="{{$data->authorized_personnel_mobile_number}}">
                     @error('authorized_personnel_mobile_number')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>
            <div class="form-group row entity-fields">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >No of Entity:</label>
                  <input type="text" class="form-control " id="no_of_entity"
                     placeholder="Required when connection type is Entity" name="no_of_entity" value="{{$data->no_of_entity}}">
                     @error('no_of_entity')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               </div>  

          
               <div class="text-center">	
                <button class="btn btn-primary rounded-pill" type="submit">Update</button>
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