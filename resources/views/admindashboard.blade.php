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
   <div class="card shadow mb-4">
   <div class="card-header py-3 d-flex justify-content-between align-items-center">
         <h6 class="m-0 font-weight-bold text-primary">Company Users</h6>
         <a href="{{route('system-user.page')}}" class="btn btn-success btn-user mbtn">Add User</a>
      </div>
      <div class="card-body">
         <div class="table-responsive  text-nowrap">
            <table class="table table-bordered" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>Sr. No.</th>
                     <th>User Name</th>
                     <th>Email</th>
                     <th>Phone</th>
                     <th>Designation</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($users as $user)
                  <td> {{ $users->firstItem()+$loop->index }} </td>
                  <td>{{$user->firstname}} {{$user->lastname}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->phone}}</td>
                  <td>{{$user->designation}}</td>
                  <td>
                   <a href="{{ route('user.edit',$user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                   <a href="{{ route('user.delete',$user->id) }}" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            {{ $users->links() }}
         </div>
      </div>
   </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px;
            font-size: 14px;
        }
    </style>
    
@endsection