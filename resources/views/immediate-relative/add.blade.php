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
         <h6 class="m-0 font-weight-bold text-primary">Add Immediate Relative</h6>
      </div>
      <div class="card-body">
         <form  method="POST" action="{{route('immediate-relative.store')}}" enctype="multipart/form-data">
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
            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
                  <select name="connected_person_id" class="form-control" required>
                     <option value="" disabled selected required>Select connected person</option>
                     @foreach($connectedPeople as $connectedPerson)
                     <option value="{{ $connectedPerson->id }}">{{ $connectedPerson->name }} ({{ $connectedPerson->type }})</option>
                     @endforeach
                  </select>
               </div>
               <div class="col-sm-6">
               <input type="text" class="form-control " 
                     placeholder="Demat Account Number" name="demat_account_number" value="{{old('demat_account_number')}}" required>
                     @error('demat_account_number')
                     <span style="color:red">{{$message}}</span>
                     @enderror
            </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="text" class="form-control " 
                     placeholder="Relative Name" name="relative_name" value="{{old('relative_name')}}" required>
                     @error('relative_name')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6">
               <input type="text" class="form-control" id="exampleFirstName"
                     placeholder="Mobile" name="mobile" value="{{old('mobile')}}" required>
                     @error('mobile')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <input type="text" class="form-control"
                     placeholder="PAN" name="pan" value="{{old('pan')}}" required>
                     @error('pan')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6">
               <input type="file"  class="form-control" name="pan_attachment"  placeholder="Select pan_attachment" required>
                     @error('pan_attachment')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
               <select name="nature_of_relation" class="form-control" id="natureOfRelationSelect" required>
                        <option value="" disabled selected >Nature of Relation</option>
                        <option value="Spouse" {{ old('nature_of_relation') === 'Spouse' ? 'selected' : '' }}>Spouse</option>
                        <option value="Father" {{ old('nature_of_relation') === 'Father' ? 'selected' : '' }}>Father</option>
                        <option value="Mother" {{ old('nature_of_relation') === 'Mother' ? 'selected' : '' }}>Mother</option>
                        <option value="Son" {{ old('nature_of_relation') === 'Son' ? 'selected' : '' }}>Son</option>
                        <option value="Daughter" {{ old('nature_of_relation') === 'Daughter' ? 'selected' : '' }}>Daughter</option>
                        <option value="Brother" {{ old('nature_of_relation') === 'Brother' ? 'selected' : '' }}>Brother</option>
                        <option value="Sister" {{ old('nature_of_relation') === 'Sister' ? 'selected' : '' }}>Sister</option>
                        <option value="Sons Wife" {{ old('nature_of_relation') === 'Sons Wife' ? 'selected' : '' }}>Son's Wife</option>
                        <option value="Daughters Husband" {{ old('nature_of_relation') === 'Daughters Husband' ? 'selected' : '' }}>Daughter's Husband</option>
                        <option value="Other" {{ old('nature_of_relation') === 'Other' ? 'selected' : '' }}>Other</option>
                       </select>
                       @error('nature_of_relation')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6">
                  <input type="text" class="form-control" id="exampleLastName"
                     placeholder="Address" name="address" value="{{old('address')}}" required>
                     @error('address')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>
            <div class="form-group row" >
               <div class="col-sm-6 mb-3 mb-sm-0">
               <input type="text" class="form-control" value="{{old('shares_held')}}"
                     placeholder="Shares Held (if any)" name="shares_held">
                     @error('shares_held')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6" id="typeOfRelationContainer">
               <input type="text" class="form-control" value="{{old('type_of_relation')}}" id="typeOfRelation"
                     placeholder="Type of Relation" name="type_of_relation">
                     @error('type_of_relation')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
            </div>

               <div class="text-center col">	
                  <button class="btn btn-primary rounded-pill" type="submit">Add</button>

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