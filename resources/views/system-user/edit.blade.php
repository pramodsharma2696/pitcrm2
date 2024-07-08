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
            <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
         </div>
         <div class="card-body">
            <form  method="POST" action="{{route('user.update',$user->id)}}" >
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
                  <label class="form-label  text-dark" >First Name:</label>
                  <input type="text" class="form-control" id="exampleFirstName"
                        name="firstname"  value="{{$user->firstname}}">
                     @error('firstname')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label  text-dark" >Last Name:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="lastname"   value="{{$user->lastname}}">
                     @error('lastname')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label  text-dark" >Email:</label>
                  <input type="email" class="form-control" id="exampleFirstName"
                        name="email"   value="{{$user->email}}">
                     @error('email')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
                  <div class="col-sm-6">
                  <label class="form-label text-dark" >Phone:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                         name="phone"   value="{{$user->phone}}">
                     @error('phone')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                  <label class="form-label text-dark" >Designation:</label>
                  <input type="text" class="form-control" id="exampleLastName"
                       name="designation"  value="{{$user->designation}}">
                     @error('designation')
                     <span style="color:red">{{$message}}</span>
                     @enderror
                  </div>

               </div>

               <div class="text-center">	
                  <button class="btn btn-primary rounded-pill" type="submit">Update</button>
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