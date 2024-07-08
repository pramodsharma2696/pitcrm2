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
            <h6 class="m-0 font-weight-bold text-primary">Add User</h6>
         </div>
         <div class="card-body">
            <form  method="POST" action="{{route('system-user.store')}}" >
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
                  <input type="text" class="form-control" id="exampleFirstName"
                        placeholder="First Name" name="firstname" value="{{old('firstname')}}" >
                     @error('firstname')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                  <input type="text" class="form-control" id="exampleLastName"
                        placeholder="Last Name" name="lastname"  value="{{old('lastname')}}">
                     @error('lastname')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="email" class="form-control" id="exampleFirstName"
                        placeholder="Email" name="email"  value="{{old('email')}}">
                     @error('email')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                  <input type="text" class="form-control" id="exampleLastName"
                        placeholder="Phone" name="phone"  value="{{old('phone')}}">
                     @error('phone')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="text" class="form-control" id="exampleLastName"
                        placeholder="Designation" name="designation"  value="{{old('designation')}}">
                     @error('designation')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" class="form-control "
                        placeholder="Password" name="password"  >
                     @error('password')
                     <span style="color:red">{{$message}}</span>
                     @enderror

                  </div>
                  <div class="col-sm-6">
                  <input type="password" class="form-control"
                        placeholder="Confirm Password" name="password_confirmation" >
                     @error('password_confirmation')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
               </div>
               <div class="text-center">	
                  <button class="btn btn-primary rounded-pill" type="submit">Add</button>
                  <a href="{{route('admindashboard')}}" class="btn btn-primary rounded-pill">Back</a>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@endsection