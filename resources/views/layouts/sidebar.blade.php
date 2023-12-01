<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : '' }} " aria-current="page" href="/">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('/pendaftaran') ? 'active' : '' }} " href="/pendaftaran">
                    <span data-feather="edit-3"></span>
                    Pendaftaran
                </a>
            </li>
            @cannot('admin')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/irs') ? 'active' : '' }} " href="/irs">
                    <span data-feather="edit-3"></span>
                    IRS
                </a>
            </li>
            @endcannot
            @can('admin')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dosen*') ? 'active' : '' }}" href="/dosen">
                    <span data-feather="users"></span>
                    Dosen
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('mahasiswa*') ? 'active' : '' }}" href="/mahasiswa">
                    <span data-feather="users"></span>
                    Mahasiswa
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('matakuliah*') ? 'active' : '' }}" href="/matakuliah">
                    <span data-feather="file-text"></span>
                    Mata Kuliah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('kelas*') ? 'active' : '' }}" href="/kelas">
                    <span data-feather="file-text"></span>
                    Kelas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/trash">
                    <span data-feather="file-text"></span>
                    Trash
                </a>
            </li>
            @endcan
        </ul>
    </div>
</nav>