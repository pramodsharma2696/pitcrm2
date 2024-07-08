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
      <h6 class="m-0 font-weight-bold text-primary">Add Financial Relative</h6>
   </div>
   <div class="card-body">
      <form  method="POST" action="{{route('financial-relative.store')}}"  enctype="multipart/form-data">
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
            <div class="form-group row mt-4">
               <div class="col-sm-6 mb-3 mb-sm-0">
                  <select name="connected_person_id" class="form-control" required >
                     <option value="" disabled selected required >Select connected person</option>
                     @foreach($connectedPeople as $connectedPerson)
                     <option value="{{ $connectedPerson->id }}">{{ $connectedPerson->name }} ({{ $connectedPerson->type }})</option>
                     @endforeach
                  </select>
               </div>
               <div class="col-sm-6">
               <input type="text" class="form-control " 
                     placeholder="Financial Relative Name" name="financial_relative_name" value="{{old('financial_relative_name')}}" required>
                     @error('financial_relative_name')
                     <span style="color:red">{{$message}}</span>
                     @enderror
            </div>
            </div>
            <div class="form-group row">
               <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="text" class="form-control " id="exampleFirstName"
                     placeholder="Nature of Relation" name="nature_of_relation" value="{{old('nature_of_relation')}}" required>
                     @error('nature_of_relation')
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
                     placeholder="PAN " name="pan" value="{{old('pan')}}" required>
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
               <input type="text" class="form-control" id="exampleLastName"
                     placeholder="Address" name="address" value="{{old('address')}}" required>
                     @error('address')
                     <span style="color:red">{{$message}}</span>
                     @enderror
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
               <input type="text" class="form-control" id="exampleLastName"
                     placeholder="Shares Held (if any)" name="shares_held" value="{{old('shares_held')}}">
                     @error('shares_held')
                     <span style="color:red">{{$message}}</span>
                     @enderror
               </div>
               <div class="col-sm-6">
               </div>
            </div>
               <div class="text-center col">	
                  <button class="btn btn-primary rounded-pill" type="submit">Add</button>
 
                 <a href="{{route('financial-relative.records')}}" class="btn btn-primary rounded-pill">Back</a>
      
      </form>
      </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@endsection