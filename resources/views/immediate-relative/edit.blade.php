@extends('layout.mainlayout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <!-- DataTales Example -->
   <div class="container mt-5">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Immediate Relative Data</h6>
         </div>
         <div class="card-body">
         <form  method="POST" action="{{route('immediate-relative.update',$immediateRelative->id)}}"  enctype="multipart/form-data">
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
               <label class="form-label  text-dark" >Select connected person:</label>
               <select name="connected_person_id" class="form-control" required>
               @if(isset($selectedConnectedPerson))
                  <option value="{{ $selectedConnectedPerson->id }}" selected>{{ $selectedConnectedPerson->name }} ({{ $selectedConnectedPerson->type }})</option>
               @endif
                    <!-- Show all connected persons in the dropdown -->
                    @foreach($allConnectedPersons as $connectedPerson)
                        @if($connectedPerson->category_type === 'connected person')
                            @if(isset($selectedConnectedPerson) && $selectedConnectedPerson->id === $connectedPerson->id)
                                <!-- Skip rendering the selected user in the loop -->
                                @continue
                            @endif
                            <option value="{{ $connectedPerson->id }}">{{ $connectedPerson->name }} ({{ $connectedPerson->type }})</option>
                        @endif
                    @endforeach

                  </select>
          
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >Immediate Relative Name:</label>
                  <input type="text" class="form-control"
                      name="relative_name" value="{{$immediateRelative->relative_name }}" >
                      @error('relative_name')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>

            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >PAN:</label>

                  <input type="text" class="form-control " 
                     placeholder="PAN" name="pan"  value="{{$immediateRelative->pan}}" >
                     @error('pan')
                     <span style="color:red">{{$message}}</span>
                     @enderror
          
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >PAN Attachment:</label>
                  {{ basename($immediateRelative->pan_attachment) }}
                   <input type="file" class="form-control" name="pan_attachment"  placeholder="Select pan_attachment"  value="{{$immediateRelative->pan_attachment}}">
                   @error('pan_attachment')
                      <span style="color: red">{{ $message }}</span>
                   @enderror
               </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Demat Account Number:</label>
                  <input type="text" class="form-control " id="exampleFirstName"
                     placeholder="Demat Account Number" name="demat_account_number"  value="{{$immediateRelative->demat_account_number}}" >
                     @error('demat_account_number')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >Mobile:</label>

                  <input type="text" class="form-control"
                     placeholder="Mobile " name="mobile"  value="{{$immediateRelative->mobile}}" >
                     @error('mobile')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>

            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Address:</label>

                  <input type="text" class="form-control"
                     placeholder="Address" name="address"  value="{{$immediateRelative->address}}" >
                     @error('address')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >No of Share's Held:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                     placeholder="No of Share's Held (if any)" name="shares_held"  value="{{$immediateRelative->shares_held}}" >
                     @error('shares_held')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>
   
            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Nature of Relation:</label>
               <select name="nature_of_relation" class="form-control"   id="natureOfRelationSelect"  required>
                   <option value="Spouse" <?php if ($immediateRelative->nature_of_relation === 'Spouse') echo 'selected'; ?>>Spouse</option>
                   <option value="Father" <?php if ($immediateRelative->nature_of_relation === 'Father') echo 'selected'; ?>>Father</option>
                   <option value="Mother" <?php if ($immediateRelative->nature_of_relation === 'Mother') echo 'selected'; ?>>Mother</option>
                   <option value="Son" <?php if ($immediateRelative->nature_of_relation === 'Son') echo 'selected'; ?>>Son</option>
                   <option value="Daughter" <?php if ($immediateRelative->nature_of_relation === 'Daughter') echo 'selected'; ?>>Daughter</option>
                   <option value="Brother" <?php if ($immediateRelative->nature_of_relation === 'Brother') echo 'selected'; ?>>Brother</option>
                   <option value="Sister" <?php if ($immediateRelative->nature_of_relation === 'Sister') echo 'selected'; ?>>Sister</option>
                   <option value="Sons Wife" <?php if ($immediateRelative->nature_of_relation === 'Sons Wife') echo 'selected'; ?>>Son's Wife</option>
                   <option value="Daughters Husband" <?php if ($immediateRelative->nature_of_relation === 'Daughters Husband') echo 'selected'; ?>>Daughter's Husband</option>
                   <option value="Other" <?php if ($immediateRelative->nature_of_relation === 'Other') echo 'selected'; ?>>Other</option>
                </select>
                @error('nature_of_relation')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6" id="typeOfRelationContainer">
               <label class="form-label  text-dark" >Type of Relation:</label>
                  <input type="text" class="form-control" id="typeOfRelation"
                     placeholder="Type of Relation" name="type_of_relation" value="{{$immediateRelative->type_of_relation}}">
                     @error('type_of_relation')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               </div>          
               <div class="text-center">	
                <button class="btn btn-primary rounded-pill" type="submit">Update</button>
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