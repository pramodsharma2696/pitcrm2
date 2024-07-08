@extends('layout.mainlayout') @section('content')
<!-- Begin Page Content -->
<div class="container-fluid"> @if(session('success')) <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> @endif @if(session('error')) <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> @endif
    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="container mt-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Breach Data</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('breach-upsi.store')}}"> @if ($errors->any()) <div class="alert alert-danger">
                        <ul> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul>
                    </div> @endif @csrf <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label class="form-label  text-dark">Select UPSI ID:</label>
                            <select name="upsi_id" class="form-control" required>
                                <option value="" disabled selected required>Select UPSI ID</option> @foreach($upsiData as $data) <option value="{{ $data->upsi_id }}">{{ $data->upsi_id }} </option> @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                       <label class="form-label text-dark">Select Insider person:</label>
                       <select name="insider_name" class="form-control" required>
                           <option value="" disabled selected required>Select Insider person</option>
                           @foreach($insiderPeople as $insiderPerson)
                               <option value="{{ $insiderPerson->name }}">{{ $insiderPerson->name }} ({{ $insiderPerson->category_type }})</option>
                           @endforeach
 
                       </select>
                   </div>
                   </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label class="form-label  text-dark">Date of Commiting Breach:</label>
                            <input type="date" class="form-control" placeholder="Date of Commiting Breach" name="date_of_commiting_breach" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label  text-dark">Action Status:</label>
                            <select name="status" class="form-control" required>
                                <option value="" disabled selected required>Select Status</option>
                                <option value="Pending" {{ old('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="In Process" {{ old('status') === 'In Process' ? 'selected' : '' }}>In Process</option>
                                <option value="Completed" {{ old('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label class="form-label  text-dark">Effect of Breach:</label>
                            <input type="text" class="form-control" id="exampleFirstName" placeholder="Effect of Breach" name="effect_of_breach" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label  text-dark">Gain or Loss:</label>
                            <input type="text" class="form-control" id="exampleLastName" placeholder="Gain or Loss" name="gain_or_loss" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label class="form-label  text-dark">Action Taken:</label>
                            <input type="text" class="form-control " id="exampleFirstName" placeholder="Action Taken" name="action_taken" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label  text-dark">Breach Type:</label>
                            <input type="text" class="form-control" id="exampleLastName" placeholder="Breach Type" name="breach_type" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label class="form-label  text-dark">Breach Details:</label>
                            <input type="text" class="form-control " placeholder="Breach Details" name="breach_details" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label  text-dark">Reporting Date:</label>
                            <input type="date" class="form-control " placeholder="Reporting Date" name="reporting_date" required>
                        </div>
                    </div>
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
                    <div class="text-center">
                        <button class="btn btn-primary rounded-pill" type="submit">Add</button>
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