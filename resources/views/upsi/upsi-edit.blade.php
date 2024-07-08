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
            <h6 class="m-0 font-weight-bold text-primary">Update UPSI</h6>
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

            <form  method="POST" action="{{route('upsi.update')}}" enctype="multipart/form-data">
                @csrf	
               	<input type="hidden" name="upsi_update_id" value="{{$upsilist->id}}">
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="myDateInput">Sender Name</label>
                  <select name="upsi_sender_name" class="form-control sender-select" required>
                     <option value="" disabled selected>Sender Name</option>
                     @foreach($connedtedData as $data)
                     <option value="{{ $data->id }}" @if($data->name == $upsilist->sender_name) selected @endif>{{ $data->name }}  (@if($data->category_type == 'designated person') Insider @elseif($data->category_type == 'connected person') Connected Person @elseif($data->category_type == 'immediate relative') Immediate Relative @elseif($data->category_type == 'financial relative') Financial Relative @endif)</option>
                     @endforeach
                  </select>
                 <div class="sender-pan-details" id="panDetails_sender_name"></div> <!-- Unique ID for sender PAN details -->
                  </div>
                  <div class="col-sm-6">
                  <label for="myDateInput">Recipient Name</label>
                    <select name="recipient_name" class="form-control recipient-select" required>
                    <option value="" disabled selected>Recipient Name</option>
                     @foreach($connedtedData as $data)
                     <option value="{{ $data->id }}"  @if($data->name == $upsilist->recipient_name) selected @endif>{{ $data->name }} (@if($data->category_type == 'designated person') Insider @elseif($data->category_type == 'connected person') Connected Person @elseif($data->category_type == 'immediate relative') Immediate Relative @elseif($data->category_type == 'financial relative') Financial Relative @endif)</option>
                     @endforeach
                  </select>
                  <div class="recipient-pan-details" id="panDetails_recipient_name"></div>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <label for="myDateInput">Publishing Date</label>
                    <input type="date" name="publishing_date" class="form-control" value="{{$upsilist->publishing_date}}" >
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <label for="myDateInput">Purpose of sharing</label>
                     <input type="text" class="form-control " id="exampleFirstName"
                        placeholder="Purpose of sharing" name="sharing_purpose" required value="{{$upsilist->purpose_of_sharing}}">
                  </div>
                  
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="myDateInput">Date of sharing</label>
                    <input type="date" name="sharing_date" class="form-control" required value="{{$upsilist->sharing_date}}">
                  </div>
                  <div class="col-sm-6">
                    <label for="myDateInput">Event Date</label>
                    <input type="date" name="event_date" class="form-control" required value="{{$upsilist->event_date}}">
                  </div>
               </div>
               <!-- <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <select name="trading_window" class="form-control"  id="trading_window" required>
                        <option value="open" @if($upsilist->trading_window == '1')selected @endif>Open</option>
                       <option value="closed" @if($upsilist->trading_window == '1')selected @endif>Closed</option>
                    </select>  
                  </div>
               </div>
              <div> -->
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="myDateInput">Closure Start date</label>
                    <input type="date" name="closure_start_date" class="form-control" value="{{$upsilist->closure_start_date}}">
                  </div>
                  <div class="col-sm-6">
                    <label for="myDateInput">Closure end date</label>
                    <input type="date" name="closure_end_date" class="form-control" value="{{$upsilist->closure_end_date}}">
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <label for="myDateInput">Remarks</label>
                    <textarea rows="2" name="remarks" class="form-control">{{$upsilist->remarks}}</textarea>
                  </div>
               </div>
               
               <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <label for="myDateInput">NDA Signed or Notice of Confidentiality shared</label>
                    <select name="notice_shared" class="form-control">
                        <option value="1" @if($upsilist->notice_of_confidentiality_shared == '1')selected @endif>Yes</option>
                        <option value="0" @if($upsilist->notice_of_confidentiality_shared == '0')selected @endif>No</option>
                    </select>  
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <label for="myDateInput">Attach File:</label>
                  {{$upsilist->file_name}}
                     <input type="file"  class="form-control attach-file" name="files" id="attach_file" >
                  </div>
               </div>
               </div>
               <div class="text-center">	
                  <button class="btn btn-primary rounded-pill" type="submit">Update</button>
                  @if( Auth::user()->role=='admin')
                  <a href="{{route('upsi.list')}}" class="btn btn-primary rounded-pill">Back</a>
                @else
                <a href="{{route('dashboard')}}" class="btn btn-primary rounded-pill">Back</a>
                @endif
               </div>
               <br>
            </form>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@endsection
