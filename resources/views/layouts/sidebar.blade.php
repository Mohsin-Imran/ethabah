< !-- Page Sidebar Start-->
    <div class="page-sidebar ">
        <div class="main-header-left d-lg-block" style="background-color: #214d45;">
            <div class="logo-wrapper">
                <a href="index.html">
                    <img class="img-fluid" style="height: 100px !important; position: relative;right: 0px;" src="{{ asset('logo.png') }}" alt="Personal Portfolio Images">
                </a>
                {{-- <a href="#" class="mt-3" style="font-size: 30px; color: #214d45; text-decoration: none;">
                 شمعات
             </a> --}}
            </div>

        </div>
        <div class="sidebar custom-scrollbar" style="background-color: #214d45;">
            <a href="javascript:void(0)" class="sidebar-back d-lg-none d-block"><i class="fa fa-times" aria-hidden="true"></i></a>
            <div class="sidebar-user">
                @if(auth()->check() && auth()->user()->profile_img)
                <img class="img-fluid" style="height: 50px !important; position: relative;right: 0px;" src="{{ asset('images/' . auth()->user()->profile_img) }}" alt="Personal Portfolio Images">
                @else
                <img class="img-fluid" style="height: 50px !important; position: relative;right: 0px;" src="https://bup.edu.bd/public/upload/user-dummy.jpeg" alt="Personal Portfolio Images">
                @endif
                <div>
                    <h6 class="text-white" style="font-size: 10px;">{{ auth()->user()->name ?? 'N/A' }}</h6>
                    <p style="font-size: 9px;">{{ auth()->user()->email ?? 'N/A' }}</p>
                </div>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a class="sidebar-header" href="{{ route('admin.admin.dashboard') }}" style="{{ request()->routeIs('admin.admin.dashboard') ? 'background-color: white; color: #214d45;' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a class="sidebar-header" href="{{ route('admin.category.index') }}" style="{{ request()->routeIs('admin.category.index') ? 'background-color: white; color: #214d45;' : '' }}">
                        <!-- New SVG (Folder Icon) -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder">
                            <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h5l2 2h9a2 2 0 0 1 2 2z"></path>
                        </svg>
                        <span>Category</span>
                    </a>
                </li>
                <li class="">
                    <a class="sidebar-header" href="{{ route('admin.company.index') }}" style="{{ request()->routeIs('admin.company.index') ? 'background-color: white; color: #214d45;' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M3 21V3h18v18H3zm2-2h14V5H5v14zm2-10h10v6H7V9z"></path>
                        </svg>
                        <span>Companies</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>
                    <ul class="sidebar-submenu" style="display: none;">
                        <li>
                            <a href="{{ route('admin.request.bike.index') }}">
                                <i class="fa fa-circle"></i>
                                <span>Request</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.statistic.index') }}">
                                <i class="fa fa-circle"></i>
                                <span>Statistic</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.company.index') }}">
                                <i class="fa fa-circle"></i>
                                <span>Profiles</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="sidebar-header" href="{{ route('admin.assigned.company.index') }}" style="{{ request()->routeIs('admin.assigned.company.index') ? 'background-color: white; color: #214d45;' : '' }}">
                        <!-- New SVG (Home Icon) -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                            <path d="M3 12l2-2V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v6l2 2 7-7-9-9-9 9 7 7z"></path>
                        </svg>
                        <span>Investor Funds  Companies</span>
                    </a>
                </li>
                <li class="">
                    <a class="sidebar-header" href="{{ route('admin.investor.index') }}" style="{{ request()->routeIs('admin.investor.index') ? 'background-color: white; color: #214d45;' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"></path>
                        </svg>
                        <span>Investors</span>
                        <i class="fa fa-angle-right pull-right"></i>
                    </a>
                    <ul class="sidebar-submenu" style="display: none;">
                        <li>
                            <a href="{{ route('admin.investor.index') }}">
                                <i class="fa fa-circle"></i>
                                <span>Investors</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a class="sidebar-header" href="{{ route('admin.investor.funds.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zM5 19V5h14v14H5zM12 7v6l4 4"></path>
                        </svg>
                        <span>Investors Funds</span>
                    </a>
                </li>

                <li>
                    <a class="sidebar-header" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M12 17.27l6.18 3.73-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73-1.64 7.03z"></path>
                        </svg>
                        <span>Review</span>
                    </a>
                </li>

                <li>
                    <a class="sidebar-header" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M21 11.5C21 6.26 16.74 3 12 3S3 6.26 3 11.5 7.26 20 12 20c2.74 0 5.2-1.06 7-2.83l4 2.83-1.43-4.09A8.46 8.46 0 0 0 21 11.5z"></path>
                        </svg>
                        <span>Tickets</span>
                    </a>
                </li>


                <li>
                    <a class="sidebar-header" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H10a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V10a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                        <span>Setting</span>
                    </a>
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="sidebar-header" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i data-feather="log-out"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
    <!-- Page Sidebar Ends-->
