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
            <h6 class="m-0 font-weight-bold text-primary">Edit Breach Data</h6>
         </div>
         <div class="card-body">
         <form  method="POST" action="{{route('breach-upsi.update',$breachOfUpsi->id)}}" >

               @csrf								
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >UPSI ID:</label>
                  <input type="text" class="form-control" id="exampleFirstName"
                        name="upsi_id"  value="{{$breachOfUpsi->upsi_id}}" disabled>
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >Insider Name:</label>
                  <!-- <input type="text" class="form-control" id="exampleLastName"
                         name="insider_name"   value="{{$breachOfUpsi->insider_name}}" > -->
                   <select name="insider_name" class="form-control" required>
                     @foreach($insiderPeople as $data)
                     <option value="{{ $data->name }}" @if($data->name == $breachOfUpsi->insider_name) selected @endif>{{ $data->name }}  ({{ $data->category_type }})</option>
                     @endforeach
                  </select>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >Date of Commiting Breach:</label>

                     <input type="date" class="form-control" 
                        placeholder="Date of Commiting Breach" name="date_of_commiting_breach"  value="{{$breachOfUpsi->date_of_commiting_breach}}" required>
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >Action Status:</label>

                  <select name="status" class="form-control" required>
                     <option value="Pending" <?php if ($breachOfUpsi->status === 'Pending') echo 'selected'; ?>>Pending</option>
                      <option value="In Process" <?php if ($breachOfUpsi->status === 'In Process') echo 'selected'; ?>>In Process</option>
                      <option value="Completed" <?php if ($breachOfUpsi->status === 'Completed') echo 'selected'; ?>>Completed</option>
                  </select>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >Effect of Breach:</label>
                  <input type="text" class="form-control" id="exampleFirstName"
                        name="effect_of_breach"  value="{{$breachOfUpsi->effect_of_breach}}"  >
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >Gain or Loss:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="gain_or_loss"   value="{{$breachOfUpsi->gain_or_loss}}" >
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >Action Taken:</label>
                  <input type="text" class="form-control" id="exampleFirstName"
                        name="action_taken"  value="{{$breachOfUpsi->action_taken}}" >
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >Breach Type:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="breach_type"   value="{{$breachOfUpsi->breach_type}}" >
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >Breach Details:</label>
                  <input type="text" class="form-control" id="exampleFirstName"
                        name="breach_details"  value="{{$breachOfUpsi->breach_details}}" >
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >Reporting Date:</label>
                  <input type="date" class="form-control" id="exampleLastName"
                         name="reporting_date"   value="{{$breachOfUpsi->reporting_date}}" > 
                  </div>
               </div>
               @if ($breachOfUpsi->names)
               <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >Other Persons Involved:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="names"   value="{{$breachOfUpsi->names}}" > 
                  </div>
               </div>
               @else
               <div id="names-container">
            <div class="names-row">
            <div class="form-group">
            <label class="form-label  text-dark">Other Persons Involved:</label>
                <input type="text" class="form-control" name="name[]" placeholder="Enter a name">
             <button class="cancel-name-btn" type="button" style="display: none;">Cancel</button>

            </div>
            </div>
        </div>
        <button id="add-row-button" class="btn btn-primary">Add More</button>
        <button id="cancel-row-button" class="btn btn-danger" style="display: none;">Cancel</button>
               @endif
               <div class="text-center">	
                <button class="btn btn-primary rounded-pill" type="submit">Update</button>
                  <a href="{{route('breach-upsi.records')}}" class="btn btn-primary rounded-pill">Back</a>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@endsection