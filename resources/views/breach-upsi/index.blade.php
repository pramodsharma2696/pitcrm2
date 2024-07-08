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
         <h6 class="m-0 font-weight-bold text-primary">Breach UPSI Data</h6>

         <div class="float-right">
         <a href="{{route('breach-upsi.add')}}" class="btn btn-success btn-sm">Add New</a>
           <a href="{{ route('breach-upsi.documents.show')}}" class="btn btn-info btn-sm">Documents</a>
         </div>



      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
               <thead>
                  <tr>
             
                     <th>Sr. No.</th>
                     <th>Insider Name </th>
                     <th>Date of Breach</th>
                     <th>Status of Action</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($breachOfUpsi as $data)
                  <td> {{ $breachOfUpsi->firstItem()+$loop->index }} </td>
                  <td>{{$data->insider_name}}</td>
                  <td>{{$data->date_of_commiting_breach}}</td>
                  <td>{{$data->status}}</td>
                  <td>

                   <a href="{{ route('breach-upsi.show',$data->id) }}" class="btn btn-warning btn-sm">View</a>
                   <a href="{{ route('breach-upsi.edit',$data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                   <a href="{{ route('breach-upsi.delete',$data->id) }}" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            {{ $breachOfUpsi->links() }}
       
         </div>
      </div>
   </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

 
@endsection