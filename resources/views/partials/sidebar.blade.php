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
               <h6 class="collapse-header">SDD:</h6>
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