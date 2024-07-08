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
         <h6 class="m-0 font-weight-bold text-primary">Immediate Relative Documents</h6>
         <a href="{{route('immediate-relative.documents.add')}}" class="btn btn-success btn-sm ">Add Documents</a>
      </div>
      <div class="card-body">
         <div class="table-responsive">
         <table class="table table-bordered" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>Sr. No.</th>
                     <th>Created By</th>
                     <th>File Name</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody>
               @foreach ($documents as $document)
                  <td> {{ $documents->firstItem()+$loop->index }} </td>
                  <td>{{ $document->user->firstname.' '. $document->user->lastname}}</td>
                  <td>{{ $document->name }}</td>
                <td>
                    <a href="{{ route('immediate-relative.documents.download', $document->id) }}" class="btn btn-success btn-sm">Download</a>
                    @if( Auth::user()->role=='admin')
                    <a href="{{ route('immediate-relative.documents.delete', $document->id) }}" class="btn btn-danger btn-sm">Delete</a>
                    @endif
                </td>
                  </tr>
                  @endforeach
               </tbody>
               
            </table>
            {{ $documents->links() }}
                <div class="text-center">	
                  <a href="{{route('immediate-relative.records')}}" class="btn btn-primary rounded-pill">Back</a>
               </div>
         </div>
      </div>
   </div>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

    
@endsection
