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
         <h6 class="m-0 font-weight-bold text-primary">List of Insider's</h6>
         <div class="float-right">
           <a href="{{route('insider-detail.add')}}" class="btn btn-success btn-sm">Add Insider</a>
           <a href="{{ route('insider-documents.show')}}" class="btn btn-info btn-sm">Documents</a>
         </div>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>Sr. No.</th>
                     <th>Name</th>
                     <th>IUID</th>
                     <th>Category </th>
                     <th>PAN </th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($insider as $data)
                  <td> {{ $insider->firstItem()+$loop->index }} </td>
       
                  <td>{{$data->name}}</td>
                  <td>{{$data->iuid}}</td>
                  <td>{{ucfirst($data->category_type) }}</td>
                  @if($data->pan_option=='Yes')
                  <td>{{$data->pan}}</td>
                  @else
                  <td>Declaration Attached</td>
                  @endif
                  <td>
                 
                   @if($data->category_type=='connected person')
                   <a href="{{ route('insider-detail.show',$data->id) }}" class="btn btn-warning btn-sm">View</a>
                   <a href="{{ route('connected-person.edit',$data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                   <a href="{{ route('connected-person.delete',$data->id) }}" class="btn btn-danger btn-sm">Delete</a>
                   <!-- <a href="{{ route('connected-person.revokeInsider',$data->id) }}" class="btn btn-danger btn-sm">Revoke Insider</a> -->
                   @elseif($data->category_type=='designated person')
                   <a href="{{ route('insider-detail.show',$data->id) }}" class="btn btn-warning btn-sm">View</a>
                   <a href="{{ route('insider-detail.edit',$data->id) }}" class="btn btn-primary btn-sm">Edit</a>
                   <a href="{{ route('connected-person.delete',$data->id) }}" class="btn btn-danger btn-sm">Delete</a>
                   <!-- <a href="{{ route('insider-detail.delete',$data->id) }}" class="btn btn-danger btn-sm">Delete</a> -->
                   @elseif($data->category_type=='immediate relative')
                   <a href="{{ route('immediate-relative.show',$data->immediate_relative_id) }}" class="btn btn-warning btn-sm">View</a>
                   <a href="{{ route('immediate-relative.edit',$data->immediate_relative_id) }}" class="btn btn-primary btn-sm">Edit</a>
                   <a href="{{ route('immediate-relative.delete',$data->immediate_relative_id) }}" class="btn btn-danger btn-sm">Delete</a>

                   @else
                   <a href="{{ route('financial-relative.show',$data->financial_relative_id) }}" class="btn btn-warning btn-sm">View</a>
                   <a href="{{ route('financial-relative.edit',$data->financial_relative_id) }}" class="btn btn-primary btn-sm">Edit</a>
                   <a href="{{ route('financial-relative.delete',$data->financial_relative_id) }}" class="btn btn-danger btn-sm">Delete</a>

                   @endif
                  </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            {{ $insider->links() }}
  
         </div>
      </div>
   </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->


@endsection