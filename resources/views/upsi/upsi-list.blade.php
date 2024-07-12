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
         <h6 class="m-0 font-weight-bold text-primary">{{$upsiId}} - {{$upsi->event_name}}</h6>
         <div class="float-right">
           <a href="{{ route('upsi.add',$upsiId)}}" class="btn btn-primary btn-sm">Add</a>
                @if( Auth::user()->role=='admin')
                  <a href="{{route('upsi.list')}}" class="btn btn-primary btn-sm">Back</a>
                @else
                <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm">Back</a>
                @endif
         </div>
      </div>
      <div class="card-body">
         <div class="table-responsive  text-nowrap">
            <table class="table table-bordered" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <!-- <th>IUID </th> -->
                     <th>Sender</th>
                     <th>Recipient</th>
                     <th>Created At</th>
                     <th>Created By</th>
                     <th>Status</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody>
               <tr>
                  @foreach($upsilist as $data)
                  <!-- <td>{{$data->upsi_id}}</td> -->
                  <td>{{$data->sender_name}}</td>
                  <td>{{ is_array(json_decode($data->recipient_name, true)) ? implode(', ', json_decode($data->recipient_name, true)) : $data->recipient_name }}</td>
                  <td>
                  @if($data->status == 0)
                    {{ $data->created_at->format('Y-m-d') }}
                  @else
                  <span class="badge bg-success text-white">{{$data->approved_date}}</span>
                  @endif
                 </td>         
                 <td>   
                  @if($data->status == 0)
                  {{ $data->createdByUser->firstname }}  {{ $data->createdByUser->lastname }}
                  @else
                 {{ $data->approved_by }}
                  @endif
               </td>

                  <td>
                  @if($data->status == 0)
                  <span class="badge bg-secondary text-white">draft</span>
                  @else
                  <span class="badge bg-success text-white">approved</span>
                  @endif
                 </td>
                  <td>

                  <a href="{{ route('upsi.read',$data->id)}}" class="btn btn-warning btn-sm">View</a>
                  @if( Auth::user()->role=='admin')
                  @if($data->status == 0)
                    <a href="{{ route('upsi.approve',$data->id)}}" class="btn btn-info btn-sm">Approve</a>
                   @endif
                   @endif
         
                   <a href="{{ route('upsi.edit',$data->id)}}" class="btn btn-primary btn-sm">Edit</a>
                   <a href="{{ route('upsi.delete',$data->id)}}" class="btn btn-danger btn-sm">Delete</a>
                
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

 
@endsection