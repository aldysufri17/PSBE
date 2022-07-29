<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Admin Panel</li>
            <li class="active"><a class="nav-link " href="{{route('dashboard')}}"><i
                        class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-clipboard"></i><span>Masters</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('role.index')}}">Roles</a></li>
                    <li><a class="nav-link" href="{{route('energi.index')}}">Jenis Energi</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-alt"></i><span>Pengguna</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('pengguna.index')}}">Daftar Pengguna</a></li>
                    <li><a class="nav-link" href="{{route('pengguna.create')}}">Tambah Pengguna</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Post Energi</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{route('post.index')}}">Daftar Post Energi</a></li>
                    {{-- <li><a class="nav-link" href="">Penghematan Energi</a></li> --}}
                </ul>
            </li>
        </ul>
    </aside>
</div>
