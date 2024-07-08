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
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Update  {{ $datas->isEmpty() ? '' : $datas->first()->upsi_id }}</h6>
                <div class="float-right">
                @if( Auth::user()->role=='admin')
                  <a href="{{route('upsi.list')}}" class="btn btn-primary btn-sm">Back</a>
                @else
                <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm">Back</a>
                @endif
         </div>
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
       <form method="POST" action="{{ route('admin.field-values') }}" enctype="multipart/form-data">
                 @csrf  
                 <input type="hidden" name="upsi_id" value="{{ $datas->isEmpty() ? '' : $datas->first()->upsi_id }}">
                <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <label for="myDateInput">Event Name</label>
                  <input type="text" class="form-control " id="exampleFirstName" 
                        placeholder="Event Name" name="event_name" value="{{ $datas->isEmpty() ? '' : $datas->first()->event_name }}" required>
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="myDateInput">Event Date</label>
                    <input type="date" name="event_date" class="form-control" required  value="{{ $datas->isEmpty() ? '' : $datas->first()->event_date }}">
                  </div>
                  <div class="col-sm-6">
                  <label for="myDateInput">Publishing Date</label>
                    <input type="date" name="publishing_date" class="form-control" value="{{ $datas->isEmpty() ? '' : $datas->first()->publishing_date }}">
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-12 mb-3 mb-sm-0">
                  <label for="myDateInput">Trading Window Open or Closed</label>
                    <select name="trading_window" class="form-control"  id="trading_window" required >
                        <option value="" disabled selected>Trading Window Open or Closed</option>
                        <option value="open"  {{ $datas->isEmpty() ? '' : ($datas->first()->trading_window === 'open' ? 'selected' : '') }}>Open</option>
                       <option value="closed" {{ $datas->isEmpty() ? '' : ($datas->first()->trading_window === 'closed' ? 'selected' : '') }}>Closed</option>
                    </select>  
                  </div>
               </div>

               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="myDateInput">Closure Start date</label>
                    <input type="date" name="closure_start_date"  class="form-control" value="{{ $datas->isEmpty() ? '' : $datas->first()->closure_start_date }}">
                  </div>
                  <div class="col-sm-6">
                    <label for="myDateInput">Closure end date</label>
                    <input type="date" name="closure_end_date" class="form-control" value="{{ $datas->isEmpty() ? '' : $datas->first()->closure_end_date }}">
                  </div>
               </div>

               <div class="form-group row">
               <div class="col-sm-12 mb-3 mb-sm-0">
                 <label for="myDateInput">Remarks</label>
                 <textarea rows="2" name="remarks" class="form-control" required>{{ $datas->isEmpty() ? '' : $datas->first()->remarks }}</textarea>
               </div>
              </div>
              <!-- <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label for="myDateInput">NDA Signed or Notice of Confidentiality shared</label>
                       <select name="notice_shared" class="form-control">
                         <option value="1" @if($datas->isEmpty() ? '' : $datas->first()->notice_of_confidentiality_shared == '1')selected @endif>Yes</option>
                         <option value="0" @if($datas->isEmpty() ? '' : $datas->first()->notice_of_confidentiality_shared == '0')selected @endif>No</option>
                       </select>
                  </div>
                  <div class="col-sm-6">
                  <label for="myDateInput">Attach File:</label>
                     {{ $datas->isEmpty() ? '' : $datas->first()->file_name }}
                    <input type="file" class="form-control attach-file" name="files" id="attach_file">
                  </div>
               </div> -->
      
               <button type="submit" class="btn btn-primary">Update</button>
          </form>
               <hr>
                @foreach($datas as $data)
                <form method="POST" action="{{ route('admin.update-upsi-list', $data->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                       <div class="col-sm-12 mb-3 mb-sm-0">
                         <label for="myDateInput">Purpose of sharing</label>
                         <input type="text" class="form-control" id="exampleFirstName" placeholder="Purpose of sharing" name="sharing_purpose" required value="{{ $data->purpose_of_sharing }}">
                       </div>
                     </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="myDateInput">Sender Name</label>
                            <select name="upsi_sender_name" class="form-control sender-select" required>
                                <option value="" disabled selected>Sender Name</option>
                                @foreach($connectedData as $connectedPerson)
                                <option value="{{ $connectedPerson->id }}" @if($connectedPerson->name == $data->sender_name) selected @endif>
                                    {{ $connectedPerson->name }} (@if($connectedPerson->category_type == 'designated person') Insider @elseif($connectedPerson->category_type == 'connected person') Connected Person @elseif($connectedPerson->category_type == 'immediate relative') Immediate Relative @elseif($connectedPerson->category_type == 'financial relative') Financial Relative @endif)
                                </option>
                                @endforeach
                            </select>
                            <div class="sender-pan-details" id="panDetails_sender_name"></div>
                            <!-- Unique ID for sender PAN details -->
                        </div>
                        <div class="col-sm-6">
                            <label for="myDateInput">Recipient Name</label>
                            <select name="recipient_name" class="form-control recipient-select" required>
                                <option value="" disabled selected>Recipient Name</option>
                                @foreach($connectedData as $connectedPerson)
                                <option value="{{ $connectedPerson->id }}" @if($connectedPerson->name == $data->recipient_name) selected @endif>
                                    {{ $connectedPerson->name }} (@if($connectedPerson->category_type == 'designated person') Insider @elseif($connectedPerson->category_type == 'connected person') Connected Person @elseif($connectedPerson->category_type == 'immediate relative') Immediate Relative @elseif($connectedPerson->category_type == 'financial relative') Financial Relative @endif)
                                </option>
                                @endforeach
                            </select>
                            <div class="recipient-pan-details" id="panDetails_recipient_name"></div>
                        </div>
                    </div>


                      <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                          <label for="myDateInput">Date of sharing</label>
                          <input type="date" name="sharing_date" class="form-control" required value="{{ $data->sharing_date }}">
                        </div>
                        <div class="col-sm-6">
                        <label for="myDateInput">NDA Signed or Notice of Confidentiality shared</label>
                          <select name="notice_shared" class="form-control">
                            <option value="1" @if($data->notice_of_confidentiality_shared == '1')selected @endif>Yes</option>
                            <option value="0" @if($data->notice_of_confidentiality_shared == '0')selected @endif>No</option>
                          </select>
                        </div>
                      </div>

                        <div class="form-group row">
                          <div class="col-sm-12 mb-3 mb-sm-0">
                            <label for="myDateInput">Attach File:</label>
                            {{ $data->file_name }}
                            <input type="file" class="form-control attach-file" name="files" id="attach_file">
                          </div>
                        </div>
                    <div class="text-center">
                        <button class="btn btn-primary rounded-pill" type="submit">Update</button>
                        @if(Auth::user()->role == 'admin')
                        <a href="{{ route('upsi.list') }}" class="btn btn-primary rounded-pill">Back</a>
                        @else
                        <a href="{{ route('dashboard') }}" class="btn btn-primary rounded-pill">Back</a>
                        @endif
                    </div>
                    <br>
                </form>
<hr>

                @endforeach
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