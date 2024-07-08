
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('pitcrm/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('pitcrm/css/sb-admin-2.min.css') }}" rel="stylesheet">
	<link href="{{ asset('pitcrm/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
	<style type="text/css">
	.reportbtn{
	    float: right;
		width: 100%;
	}
	.reportbtn a{
	    float: right;
	}
    p.leading-5{
        margin-top: 10px !important;
    }
	/* tr:nth-child(even) {
  background-color: #f2f2f2;
}
	  */
	</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body id="page-top">
   <!-- Page Wrapper -->
   <div id="wrapper">
   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      @if( Auth::user()->role=='admin')
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admindashboard')}}">
      @else
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dashboard')}}">
      @endif
         <!-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
            </div> -->
         <div class="sidebar-brand-text mx-3">
            <!-- {{config('app.name')}} <sup>2</sup> -->
          <img src="{{ asset('images/Whitelogo.png') }}" alt="Logo" width="150">

         </div>
      </a>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
      <!-- Divider -->
      <hr class="sidebar-divider">
      <!-- Heading -->
      <!--  <div class="sidebar-heading">
         Interface
         </div> -->
      <!-- Nav Item - Pages Collapse Menu -->
      @if( Auth::user()->role=='admin')
      <li class="nav-item">
         <a class="nav-link collapsed" href="{{route('admindashboard')}}"
            aria-expanded="true" aria-controls="collapseTwo">
         <i class="fas fa-fw fa-user"></i>
         <span>Company Users</span>
         </a>
      </li>
      <li class="nav-item">
         <a class="nav-link collapsed" href="{{route('master-data.records')}}"
            aria-expanded="true" aria-controls="collapseTwo">
         <i class="fas fa-fw fa-building"></i>
         <span>Master Data of Company</span>
         </a>
      </li>

      <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
         <i class="fas fa-fw fa-user"></i>
         <span>Connected Person</span>
         </a>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
               <h6 class="collapse-header">PIT:</h6>
               <a class="collapse-item"  href="{{route('connected-person.records')}}">List of Connected Person</a>
               <a class="collapse-item"  href="{{route('immediate-relative.records')}}">List of Immediate Relatives</a>
               <a class="collapse-item"  href="{{route('financial-relative.records')}}">List of Financial Relatives</a>
               <!-- <a class="collapse-item" href="cards.html">Menu Name</a> -->
            </div>
         </div>
      </li>
      <li class="nav-item">
         <a class="nav-link collapsed" href="{{route('insider-detail.records')}}"
            aria-expanded="true" aria-controls="collapseTwo">
         <i class="fas fa-fw fa-user"></i>
         <span>Insider</span>
         </a>
      </li>
      <li class="nav-item">
         <a class="nav-link collapsed" href="{{route('breach-upsi.records')}}"
            aria-expanded="true" aria-controls="collapseTwo">
         <i class="fas fa-fw fa-user"></i>
         <span>Breach-UPSI</span>
         </a>
      </li>
      <li class="nav-item">
         <a class="nav-link collapsed {{ request()->routeIs('upsi.list') ? 'active-link' : '' }}" href="{{route('upsi.list')}}"
            aria-expanded="true" aria-controls="collapseTwo">
         <i class="fa fa-share"></i>
         <span>UPSI</span>
         </a>
      </li>
      <li class="nav-item">
         <a class="nav-link collapsed {{ request()->routeIs('reports.page') ? 'active-link' : '' }}" href="{{route('reports.page')}}"
            aria-expanded="true" aria-controls="collapseTwo">
         <i class="fa fa-file"></i>
         <span>Reports</span>
         </a>
      </li>
      @else
      <li class="nav-item">
         <a class="nav-link collapsed {{ request()->routeIs('dashboard') ? 'active-link' : '' }}" href="{{route('dashboard')}}"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-dashboard" style="font-size:18px"></i>
         <span>Dashboard</span>
         </a>
      </li> 
      <li class="nav-item">
         <a class="nav-link collapsed {{ request()->routeIs('upsi.create') ? 'active-link' : '' }}" href="{{route('upsi.create')}}"
            aria-expanded="true" aria-controls="collapseTwo">
         <i class="fa fa-share"></i>
         <span>UPSI</span>
         </a>
      </li>
      @endif



      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
      <!-- Sidebar Message -->
      <!-- <div class="sidebar-card d-none d-lg-flex">
         <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
         <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
         <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
         </div> -->
   </ul>
   <!-- End of Sidebar -->
   <!-- Content Wrapper -->
   <div id="content-wrapper" class="d-flex flex-column">
   <!-- Main Content -->
   <div id="content">
   <!-- Topbar -->
   <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
   <!-- Sidebar Toggle (Topbar) -->
   <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
   <i class="fa fa-bars"></i>
   </button>
   <!-- Topbar Search -->
<form
   class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
   <div class="input-group">
      <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
         aria-label="Search" aria-describedby="basic-addon2">
      <div class="input-group-append">
         <button class="btn btn-primary" type="button">
         <i class="fas fa-search fa-sm"></i>
         </button>
      </div>
   </div>
</form>
<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">
   <!-- Nav Item - Search Dropdown (Visible Only XS) -->
   <li class="nav-item dropdown no-arrow d-sm-none">
      <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-search fa-fw"></i>
      </a>
      <!-- Dropdown - Messages -->
      <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
         aria-labelledby="searchDropdown">
         <form class="form-inline mr-auto w-100 navbar-search">
            <div class="input-group">
               <input type="text" class="form-control bg-light border-0 small"
                  placeholder="Search for..." aria-label="Search"
                  aria-describedby="basic-addon2">
               <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                  </button>
               </div>
            </div>
         </form>
      </div>
   </li>
   <div class="topbar-divider d-none d-sm-block"></div>
   <!-- Nav Item - User Information -->
   <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->firstname}} {{ Auth::user()->lastname}}</span>
      <img class="img-profile rounded-circle"
         src="{{ asset('pitcrm/img/undraw_profile.svg') }}">
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
         aria-labelledby="userDropdown">
         <!-- <a class="dropdown-item" href="{{route('profile.edit')}}">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Profile
            </a> -->
         <!-- <a class="dropdown-item" href="#">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Settings
            </a> -->
         <div class="dropdown-divider"></div>
         @if( Auth::user()->role=='admin')
               <a class="dropdown-item" href="{{ route('admindashboard') }}" >
                @else
                <a class="dropdown-item" href="{{route('dashboard')}}" >
                @endif
  
            
         <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
         Dashboard
         </a>

      </div>
   </li>
</ul>
</nav>
<!-- End of Topbar -->


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
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Update Profile</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">{{ __('Profile Information') }}</h2>
            <p class="card-text">{{ __("Update your account's profile information and email address.") }}</p>
        </div>
        <div class="card-body">
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>
            <form method="post" action="{{ route('profile.update') }}" class="mt-6">
                @csrf
                @method('patch')
                @if (session('status') === 'profile-updated')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="firstname" class="form-label">{{ __('First Name') }}</label>
                    <input id="firstname" name="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" value="{{ old('firstname', $user->firstname) }}" required autofocus autocomplete="firstname" />
                    @error('firstname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="lastname" class="form-label">{{ __('Last Name') }}</label>
                    <input id="lastname" name="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" value="{{ old('lastname', $user->lastname) }}" required autofocus autocomplete="lastname" />
                    @error('lastname')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="email" />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2">
                            <p class="text-sm text-danger">
                                {{ __('Your email address is unverified.') }}
                                <button form="send-verification" class="btn btn-link text-decoration-none">{{ __('Click here to re-send the verification email.') }}</button>
                            </p>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-success">{{ __('A new verification link has been sent to your email address.') }}</p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </div>

            </form>
            

    <div class="card">
        <div class="card-header">
            <h2 class="card-title">{{ __('Update Password') }}</h2>
            <p class="card-text">{{ __("Ensure your account is using a long, random password to stay secure.") }}</p>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('password.update') }}" class="mt-6">
                @csrf
                @method('put')
                @if (session('status') === 'password-updated')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                   
                    <div>
                    <input id="current_password" name="current_password" type="password" class="form-control" required />
                  <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
        <label for="password" class="form-label">{{ __('New Password') }}</label>
        <input id="password" name="password" type="password" class="form-control" required />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>

        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required/>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>
        <button class="btn btn-primary mt-3">{{ __('Save') }}</button>

    </div>
</div>
</div>
</div>
</div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->





<!-- Footer -->
<footer class="sticky-footer bg-white">
   <div class="container my-auto">
      <div class="copyright text-center my-auto">
         <span>Copyright &copy;  2023 Mindpool Technologies Limited, All Rights Reserved</span>
      </div>
   </div>
</footer>
<!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('pitcrm/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('pitcrm/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('pitcrm/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('pitcrm/js/sb-admin-2.min.js')}}"></script>
<!-- Page level plugins -->
<script src="{{ asset('pitcrm/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('pitcrm/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('pitcrm/js/demo/datatables-demo.js')}}"></script>


