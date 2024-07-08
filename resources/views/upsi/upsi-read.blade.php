@extends('layout.mainlayout')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
   <div class="container mt-5">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sharing UPSI</h6>
         </div>
         <div class="card-body">	
            <form>	
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="myDateInput">UPSI ID</label>
                  <select name="upsi_id" class="form-control" readonly>
                    <option value="{{ $upsilist->upsi_id }}">{{ $upsilist->upsi_id }}</option>
                  </select>
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="myDateInput">Event Name</label>
                  <input type="text" class="form-control " id="exampleFirstName" name="event_name" value="{{$upsilist->event_name}}" readonly>
                  </div>
               </div>
              					
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="myDateInput">Sender Name</label>
                  <select name="upsi_sender_name" class="form-control sender-select" disabled>
                  @foreach($connedtedData as $data)
                     <option value="{{ $data->id }}" @if($data->name == $upsilist->sender_name) selected @endif>{{ $data->name }}  (@if($data->category_type == 'designated person') Insider @elseif($data->category_type == 'connected person') Connected Person @elseif($data->category_type == 'immediate relative') Immediate Relative @elseif($data->category_type == 'financial relative') Financial Relative @endif)</option>
                     @endforeach
                  </select>
                  <div class="sender-pan-details" id="panDetails_sender_name"></div> <!-- Unique ID for sender PAN details -->

                  </div>
                  <div class="col-sm-6">
                  <label for="myDateInput">Recipient Name</label>
                  <select name="recipient_name" class="form-control recipient-select" disabled>
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
                    <input type="date" name="publishing_date" class="form-control" value="{{$upsilist->publishing_date}}" readonly>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <label for="myDateInput">Purpose of sharing</label>
                     <input type="text" class="form-control " id="exampleFirstName"
                        placeholder="Purpose of sharing" name="sharing_purpose" value="{{$upsilist->purpose_of_sharing}}" readonly>
                  </div>
                  
               </div>

               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="myDateInput">Date of sharing</label>
                    <input type="date" name="sharing_date" class="form-control" value="{{$upsilist->sharing_date}}" readonly>
                  </div>
                  <div class="col-sm-6">
                    <label for="myDateInput">Event Date</label>
                    <input type="date" name="event_date" class="form-control" value="{{$upsilist->event_date}}" readonly>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <label for="myDateInput">Trading Window Open or Closed</label>
                    <select name="trading_window" class="form-control"  id="trading_window2" readonly>
                    @if($upsilist->trading_window == 'open')
                        <option value="open" selected>Open</option>
                     @else
                     <option value="closed" selected>Closed</option>
                     @endif
                        
                       
                    </select>  
                  </div>
               </div>
              <div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="myDateInput">Closure Start date</label>
                    <input type="date" name="closure_start_date" class="form-control" value="{{$upsilist->closure_start_date}}" readonly>
                  </div>
                  <div class="col-sm-6">
                    <label for="myDateInput">Closure end date</label>
                    <input type="date" name="closure_end_date" class="form-control" value="{{$upsilist->closure_end_date}}" readonly>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                    <label for="myDateInput">Remarks</label>
                    <textarea rows="2" name="remarks" class="form-control" readonly>{{$upsilist->remarks}}</textarea>
                  </div>
               </div>
               @if(!is_null($upsilist->file_path))
                  <a href="{{ route('Attachment.documents.download', $upsilist->id) }}" class="btn btn-success btn-sm">Download Attachment </a> {{$upsilist->file_name}}
              @endif
               <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <label for="myDateInput">NDA Signed or Notice of Confidentiality shared</label>
                    <select name="notice_shared" class="form-control" readonly>
                        <option value="1" @if($upsilist->notice_of_confidentiality_shared == '1')selected @endif>Yes</option>
                        <option value="0" @if($upsilist->notice_of_confidentiality_shared == '0')selected @endif>No</option>
                    </select> 
                  </div>
               </div>
               </div>
               <div class="text-center">
               @if( Auth::user()->role=='admin')
                  <a href="{{route('upsi.list')}}" class="btn btn-primary rounded-pill">Back</a>
                @else
                <a href="{{route('dashboard')}}" class="btn btn-primary rounded-pill">Back</a>
                @endif
               </div>
            </form>
            @if($upsilist->status == 1)
            @php 

            $createdAt = $upsilist->created_at;
            $createdAt = Carbon\Carbon::parse($createdAt);

            $created_time = $createdAt->format('H:i:s'); 
            $created_date = $createdAt->toDateString(); 

            $updatedAt = $upsilist->updated_at;
            $updatedAt = Carbon\Carbon::parse($updatedAt);
            
            $update_time = $updatedAt->format('H:i:s'); // Format: 24-hour time (e.g., 14:30:00)
            $update_date = $updatedAt->toDateString(); // Format: YYYY-MM-DD

            @endphp
            <h5><span class="badge bg-success text-white">Approved On:</span></h5>
           <h6>Date: {{$upsilist->approved_date}}</h6>
           <!-- <h5><span class="badge bg-success text-white">Created On:</span></h5>
           <h6>Date: {{$created_date}}</h6>
           <h6>Time: {{$created_time}}</h6>
  -->
           <h5><span class="badge bg-success text-white">Updated On:</span></h5>
           <h6>Date: {{$update_date}}</h6>
           <h6>Time: {{$update_time}}</h6>
           @endif
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@endsection
