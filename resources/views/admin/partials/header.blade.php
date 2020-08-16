 <!-- Header -->
 <header class="main-header " id="header">
    <nav class="navbar navbar-static-top navbar-expand-lg">
      <!-- Sidebar toggle button -->
      <button id="sidebar-toggler" class="sidebar-toggle">
        <span class="sr-only">Toggle navigation</span>
      </button>
      <!-- search form -->
      <div class="search-form d-none d-lg-inline-block">
      </div>

      <div class="navbar-right ">
        <ul class="nav navbar-nav">
          <li class="dropdown notifications-menu">
            <button class="dropdown-toggle" data-toggle="dropdown">
              <i class="mdi mdi-bell-outline"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <li class="dropdown-header">You have 5 notifications</li>
              <li>
                <a href="#">
                  <i class="mdi mdi-account-plus"></i> New user registered
                  <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="mdi mdi-account-remove"></i> User deleted
                  <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 07 AM</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="mdi mdi-chart-areaspline"></i> Sales report is ready
                  <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 12 PM</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="mdi mdi-account-supervisor"></i> New client
                  <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="mdi mdi-server-network-off"></i> Server overloaded
                  <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> 05 AM</span>
                </a>
              </li>
              <li class="dropdown-footer">
                <a class="text-center" href="#"> View All </a>
              </li>
            </ul>
          </li>
          <!-- User Account -->
          <li class="dropdown user-menu">
            <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                @if (Auth::user()->profile_photo == '')
                <img src="{{url('storage/foto_user/kosong.png')}}" class="user-image"/>
                @else
                <img src="{{url(Auth::user()->profile_photo)}}" alt="profile toko" class="user-image">
                @endif
              <span class="d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-right">
              <!-- User image -->
              <li class="dropdown-header">
                @if (Auth::user()->profile_photo == '')
                <img src="{{url('storage/foto_user/kosong.png')}}" class="img-circle"/>
                @else
                <img src="{{url(Auth::user()->profile_photo)}}" alt="profile toko" class="img-circle">
                @endif
                <div class="d-inline-block">
                    {{ Auth::user()->name }} <small class="pt-1">{{ Auth::user()->email }}</small>
                </div>
              </li>
              @if (Auth::user()->role_id == '1')
              @elseif (Auth::user()->store_id == '')
              <li>
                <a href="{{ route('stores.create') }}">
                  <i class="mdi mdi-store"></i> Buat Toko
                </a>
              </li>
              @else
              <li>
                <a href="{{ route('stores.show', Auth::user()->store_id) }}">
                  <i class="mdi mdi-store"></i> Lihat Toko
                </a>
              </li>
              <li>
                <a href="{{ route('products.create') }}">
                  <i class="mdi mdi-clipboard"></i> Tambah Produk
                </a>
              </li>
              @endif
              <li>
                <a href="{{ route('users.show', Auth::user()->id) }}"> <i class="mdi mdi-account"></i> Profile </a>
              </li>
              <li class="right-sidebar-in">
                <a href="{{ route('home') }}"> <i class="mdi mdi-shopping"></i> Ke halaman belanja </a>
              </li>

              <li class="dropdown-footer">
                    <a  href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                    >
                        <i class="mdi mdi-logout"></i> Log Out
                    </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>


  </header>
