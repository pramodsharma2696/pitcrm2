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
            <h6 class="m-0 font-weight-bold text-primary"> Add Documents</h6>
         </div>
         <div class="card-body">
         <form action="{{ route('immediate-relative.documents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0">
       
              
       <label for="document">Document:</label>
        <input type="file" name="document" id="document" required>
        @error('document')
        <span>{{ $message }}</span>
        @enderror
                  </div>
               </div>

              <div class="text-center">	
                  <button class="btn btn-primary rounded-pill" type="submit">Upload Document</button>
                  <a href="{{route('immediate-relative.documents.show')}}" class="btn btn-primary rounded-pill">Back</a>
               </div>

</form>

         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
@endsection