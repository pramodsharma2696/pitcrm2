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
         <h6 class="m-0 font-weight-bold text-primary">List of Financial Relatives</h6>
         <div class="float-right">
           <a href="{{route('financial-relative.add')}}" class="btn btn-success btn-sm">Add Financial Relatives </a>
           <a href="{{ route('financial-relative.documents.show')}}" class="btn btn-info btn-sm">Documents</a>
         </div>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>Sr. No.</th>
                     <th>Relative Name</th>
                     <th>IUID </th>
                     <th>PAN </th>
                     <th>Name of Connected Person</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($financialRelative as $data)
                  <td> {{ $financialRelative->firstItem()+$loop->index }} </td>
                  <td>{{$data->financial_relative_name}}</td>
                  <td>{{$data->iuid}}</td>
                  <td>{{$data->pan}}</td>
                  <td>{{$data->connectedPerson->name}}</td>
                  <td>

                   <a href="{{ route('financial-relative.show',$data->id) }}" class="btn btn-warning btn-sm">View</a>
                   <a href="{{ route('financial-relative.edit',$data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                   <a href="{{ route('financial-relative.delete',$data->id) }}" class="btn btn-danger btn-sm">Delete</a>
                  </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            {{ $financialRelative->links() }}
         </div>
      </div>
   </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->


@endsection