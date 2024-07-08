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
            <h6 class="m-0 font-weight-bold text-primary">Add Insider</h6>
         </div>
         <div class="card-body">
                <form method="POST" action="{{ route('store') }}">
           @csrf
       
           <div id="names-container">
               <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" name="names[]" class="form-control" required>
               </div>
           </div>
       
           <button type="button" id="add-name" class="btn btn-primary">Add More</button>
           <button type="submit" class="btn btn-success">Submit</button>
       </form>       
         </div>
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->



@endsection
