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
         <h6 class="m-0 font-weight-bold text-primary">UPSI LIST</h6>
         <div class="float-right">
         <a href="{{ route('upsi.create') }}" class="btn btn-success btn-sm">Add</a>
        <a href="{{ route('upsi.documents.show') }}" class="btn btn-info btn-sm">Documents</a>
         </div>
      </div>
      <div class="card-body">
         <div class="table-responsive  text-nowrap">
            <table class="table table-bordered" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>IUID </th>
                     <th>Event Name</th>
                     <th>Event date</th>
                     <th>Publish date</th>
                     <th>Created By</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($upsilist as $data)
     
        
                  <td> {{ $upsilist->firstItem()+$loop->index }} </td>
                  <td><a href="{{ route('upsi.open-upsi-list',$data->upsi_id)}}">{{$data->upsi_id}} </a></td>      
                  <td>{{$data->event_name}}</td>
                  <td>{{$data->event_date}}</td>        
                  <td>{{$data->publishing_date}}</td>
                  <td>
                     @if($data->status == 0)
                     {{ $data->createdByUser->firstname }}  {{ $data->createdByUser->lastname }}
                   @else
                      {{ $data->approved_by }}
                   @endif

                  </td>
                  <td>

                  <a href="{{ route('admin.upsi.read',$data->id)}}" class="btn btn-warning btn-sm">View</a>
                   <a href="{{ route('admin.upsi.edit.list',$data->upsi_id)}}" class="btn btn-primary btn-sm">Edit</a>
                   @if($data->status == 0)
                    <a href="{{ route('upsi.approve',$data->id)}}" class="btn btn-info btn-sm">Approve</a>
                   @else
                    <a href="#" class="btn btn-success btn-sm disabled" tabindex="-1" aria-disabled="true">Approved</a>
                   @endif
                   @if($data->status == 0)
                   <a href="{{ route('admin.upsi.delete',$data->id)}}" class="btn btn-danger btn-sm">Delete</a>
                   @endif
                  </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            {{ $upsilist->links() }}
       
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