@extends('layouts.bootstrap')
  <body>
  <section class="h-100 h-custom" style="background-color: #8fc4b7;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-8 col-xl-6">
        <div class="card rounded-3">
 
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Register</h3>
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

            <form class="px-md-2" method="POST" action="{{ route('register') }}">
                   @csrf
        <!-- FirstName -->
              <div class="form-outline mb-4">
               <input type="text" id="form3Example1cg" name="firstname" value="{{old('firstname')}}"  required placeholder="Enter First Name" class="form-control form-control-lg" />
                 <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
              </div>
        <!-- LastName -->
              <div class="form-outline mb-4">
               <input type="text" id="form3Example1cg" name="lastname" value="{{old('lastname')}}"  required placeholder="Enter Last Name" class="form-control form-control-lg" />
                 <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
              </div>
        <!-- Email -->
              <div class="form-outline mb-4">
                  <input type="email" id="form3Example3cg" name="email" value="{{old('email')}}" required placeholder="Enter Email Address" class="form-control form-control-lg" />
                  <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
        <!-- Phone -->
              <div class="form-outline mb-4">
                  <input type="text" id="form3Example1cg"  name="phone" value="{{old('phone')}}" required placeholder="Enter Phone Number" class="form-control form-control-lg" />
                   <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                </div>
        <!-- Designation -->
              <div class="form-outline mb-4">
               <input type="text" id="form3Example1cg" name="designation" value="{{old('designation')}}"  required placeholder="Enter Your Designation" class="form-control form-control-lg" />
                 <x-input-error :messages="$errors->get('designation')" class="mt-2" />
              </div>
        <!-- Password -->
              <div class="form-outline mb-4">
                  <input type="password" name="password" placeholder="Password" value="{{old('password')}}" required class="form-control form-control-lg" />
                   <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
        <!-- ConfirmPassword -->
                <div class="form-outline mb-4">
                  <input type="password" name="password_confirmation" placeholder="Confirm Password" value="{{old('password_confirmation')}}"required class="form-control form-control-lg" />
                  <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

              <button type="submit" class="btn btn-success btn-lg mb-1">Submit</button>
              <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="{{ route('login') }}"
                    class="fw-bold text-body"><u>Login here</u></a></p>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  </body>
</html>