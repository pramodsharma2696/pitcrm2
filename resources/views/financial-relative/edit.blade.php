@extends('layout.mainlayout')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <!-- DataTales Example -->
   <div class="container mt-5">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Financial Relative Data</h6>
         </div>
         <div class="card-body">
         <form  method="POST" action="{{route('financial-relative.update',$data->id)}}"  enctype="multipart/form-data">
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
               <label class="form-label  text-dark" >Financial Relative Name:</label>

                  <input type="text" class="form-control"
                      name="financial_relative_name"  value="{{$data->financial_relative_name}}">
                      @error('financial_relative_name')
                     <span style="color:red">{{$message}}</span>
                     @enderror

               </div>
            </div>

            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Nature of Relation:</label>
               <input type="text" class="form-control " 
                      name="nature_of_relation" value="{{$data->nature_of_relation}}">
                      @error('nature_of_relation')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >Mobile:</label>

                  <input type="text" class="form-control"
                     placeholder="mobile " name="mobile"  value="{{$data->mobile}}" >
                     @error('mobile')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >PAN:</label>

                  <input type="text" class="form-control " 
                     placeholder="Nature of Connection" name="pan"  value="{{$data->pan}}" >
                     @error('pan')
                     <span style="color:red">{{$message}}</span>
                     @enderror
          
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >PAN Attachment:</label>
                  {{ basename($data->pan_attachment) }}
                   <input type="file" class="form-control" name="pan_attachment"  placeholder="Select pan_attachment"  value="{{$data->pan_attachment}}">
                   @error('pan_attachment')
                      <span style="color: red">{{ $message }}</span>
                   @enderror
               </div>
            </div>

            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >Address:</label>

                  <input type="text" class="form-control"
                     placeholder="address" name="address"  value="{{$data->address}}">
                     @error('address')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6">
               <label class="form-label  text-dark" >Demat Account Number:</label>
                  <input type="text" class="form-control " id="exampleFirstName"
                     placeholder="demat_account_number" name="demat_account_number"  value="{{$data->demat_account_number}}" >
                     @error('demat_account_number')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>
   
            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label class="form-label  text-dark" >No of Share's Held:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                     placeholder="No of Share's Held" name="shares_held"  value="{{$data->shares_held}}" >
                     @error('shares_held')
                     <span style="color:red">{{$message}}</span>
                     @enderror                  
               </div>
               <div class="col-sm-6">
     
               </div>
               </div>
             
               <div class="text-center">	
                <button class="btn btn-primary rounded-pill" type="submit">Update</button>
                  <a href="{{route('financial-relative.records')}}" class="btn btn-primary rounded-pill">Back</a>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script>
$(document).ready(function() {
   // Hide entity fields when page is loaded
   $('.entity-fields').hide();
   $('#type').change(function() {  
          if($(this).val() == 'individual') {
            $('.entity-fields').hide();
            $('.individual-fields').show();
            $('#input-field').val('Individual'); 
        } else {
            $('.entity-fields').show();
            $('.individual-fields').hide();
            $('#input-field').val(''); 
        }
    });
});


</script>
@endsection