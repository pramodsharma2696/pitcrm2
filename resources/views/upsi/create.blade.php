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
            <h6 class="m-0 font-weight-bold text-primary">Sharing UPSI</h6>
         </div>
         <div class="card-body">
         @if ($errors->any())
               <div class="alert alert-danger">
                  <ul>
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif	
            <form  method="POST" action="{{route('upsi.store')}}"  enctype="multipart/form-data">
                @csrf	
               
                <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <label for="myDateInput">Event Name</label>
                  <input type="text" class="form-control " id="exampleFirstName"
                        placeholder="Event Name" name="event_name" required>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="myDateInput">Event Date</label>
                    <input type="date" name="event_date" class="form-control" required>
                  </div>
                  <div class="col-sm-6">
                  <label for="myDateInput">Publishing Date</label>
                    <input type="date" name="publishing_date" class="form-control" >
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <label for="myDateInput">Trading Window Open or Closed</label>
                    <select name="trading_window" class="form-control"  id="trading_window" required>
                        <option value="" disabled selected>Trading Window Open or Closed</option>
                        <option value="open">Open</option>
                       <option value="closed">Closed</option>
                    </select>  
                  </div>
               </div>
               <div id="hideShow" style="display:none">
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="myDateInput">Closure Start date</label>
                    <input type="date" name="closure_start_date" class="form-control">
                  </div>
                  <div class="col-sm-6">
                    <label for="myDateInput">Closure end date</label>
                    <input type="date" name="closure_end_date" class="form-control">
                  </div>
               </div>
   
               </div>
              	
               <hr>
               <div id="table-container">
   <!-- Existing table rows -->
   <div class="table-row">
   <input type="hidden" class="form-control " name="upsid_to_store" >	
             <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <label for="myDateInput" class="form-label  text-dark">Purpose of sharing:</label>
                     <input type="text" class="form-control " id="exampleFirstName"
                        placeholder="Purpose of sharing" name="sharing_purpose[]" required>
                  </div>        
               </div>
               <div class="form-group row">
                 <div class="col-sm-6 mb-3 mb-sm-0">
                   <select name="upsi_sender_name[]" class="form-control sender-select" required>
                     <option value="" disabled selected required>Sender Name</option>
                     @foreach($connedtedData as $data)
                       <option value="{{ $data->id }}">{{ $data->name }} ({{ ucfirst($data->category_type) }})</option>
                     @endforeach
                   </select>
                   <div class="sender-pan-details" id="panDetails_sender_name"></div> <!-- Unique ID for sender PAN details -->
                 </div>
                 <div class="col-sm-6">
                   <select name="recipient_name[]" class="form-control recipient-select" required multiple>
                     <option value="" disabled selected required>Recipient Name</option>
                     @foreach($connedtedData as $data)
                       <option value="{{ $data->id }}">{{ $data->name }}  ({{ucfirst($data->category_type) }})</option>
                     @endforeach
                   </select>
                  <div class="recipient-pan-details" id="panDetails_recipient_name"></div>
                 </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <label for="myDateInput" class="form-label  text-dark">Date of sharing:</label>
                    <input type="date" name="sharing_date[]" class="form-control" required>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <label for="myDateInput" class="form-label  text-dark">Remarks:</label>
                    <textarea rows="2" name="remarks[]" class="form-control" required></textarea>
                  </div>
               </div>

               <div class="form-group row"  >
               <div class="col-sm-6 mb-3 mb-sm-0">
               <label for="myDateInput" class="form-label  text-dark">NDA Signed or Notice of Confidentiality shared:</label>
                    <select name="notice_shared[]" class="form-control notice_shared" required id="notice_shared">
                        <option value="" disabled selected>NDA Signed or Notice of Confidentiality shared</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>  
               </div>
               <div class="col-sm-6">
               <label for="myDateInput">Attach File:</label>
                     <input type="file"  class="form-control attach-file" name="files[]"  id="attach_file">
               </div>
            </div>
<hr>
 
   </div>
</div>

<button id="add-row-btn" class="btn btn-primary">Add More</button>
<button id="cancel-row-btn" class="btn btn-danger" style="display: none;">Cancel</button>
               <div class="text-center">	
                  <button class="btn btn-primary rounded-pill" type="submit">Add</button>
                  @if( Auth::user()->role=='admin')
                  <a href="{{route('upsi.list')}}" class="btn btn-primary rounded-pill">Back</a>
                @else
                <a href="{{route('dashboard')}}" class="btn btn-primary rounded-pill">Back</a>
                @endif
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<style>
    hr {
        border-top: 2px solid black;
    }
</style>

@endsection
