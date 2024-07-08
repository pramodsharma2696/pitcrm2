<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <body>
  <section class="vh-100" style="background-color: #2779e2";>
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
          <div class="text-center mb-4">
          <img src="{{ asset('images/logo.png') }}" alt="Logo" width="250">
              </div>
            <h5 class="mb-4 pb-2 pb-md-0 mb-md-5">Verify OTP</h5>
            <form method="POST" action="{{ route('otp.verify') }}">
                @csrf
                @if(session('message'))
                 <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                 </div>
                 @endif
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="otp" required autofocus  placeholder="Enter OTP">
                                    @error('otp')
                                     <span style="color:red">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="d-grid">
                <button class="btn btn-primary btn-block text-uppercase fw-bold" type="submit">Verify OTP</button>
              </div>
 
        
    
                        </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  </body>
</html>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>