 <!-- Layout container -->
 <div class="layout-page">
     <!-- Navbar -->

     <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
         id="layout-navbar">
         <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
             <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                 <i class="bx bx-menu bx-sm"></i>
             </a>
         </div>

         <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
             <div class="nav-item d-flex align-items-center">
                 Hello {{ Auth::user()->name }}
             </div>


             <ul class="navbar-nav flex-row align-items-center ms-auto">
                

                 <!-- User -->
                 <li>

                  <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                      <i class="bx bx-power-off me-2"></i>
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="GET"
                      style="display: none;">
                      @csrf
                  </form>
              </li>

                 {{-- <li class="nav-item navbar-dropdown dropdown-user dropdown">
                     <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                         data-bs-toggle="dropdown">
                         <div class="avatar avatar-online">
                             <img src="{{ asset('backend/img/avatars/1.png') }}" alt
                                 class="w-px-40 h-auto rounded-circle" />
                         </div>
                     </a>
                     @auth
                     <ul>
                     </ul>
                         <ul class="dropdown-menu dropdown-menu-end">
                             <li>
                                 <a class="dropdown-item" href="#">
                                     <div class="d-flex">
                                         <div class="flex-shrink-0 me-3">
                                             <div class="avatar avatar-online">
                                                 <img src="{{ asset('backend/img/avatars/1.png') }}" alt
                                                     class="w-px-40 h-auto rounded-circle" />
                                                 {{ Auth::user()->name }}<span class="caret"></span>
                                                 <hr>
                                             </div>
                                         </div>
                                     </div>
                                 </a>
                             </li>
                             <li>

                                 <a class="dropdown-item" href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                     <i class="bx bx-power-off me-2"></i>
                                     {{ __('Logout') }}
                                 </a>

                                 <form id="logout-form" action="{{ route('logout') }}" method="GET"
                                     style="display: none;">
                                     @csrf
                                 </form>
                             </li>
                         </ul>
                     @endauth
                 </li> --}}
                 <!--/ User -->
             </ul>
         </div>
     </nav>

     <!-- / Navbar -->
