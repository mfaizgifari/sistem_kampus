<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow" style="height:60px">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/">Sistem Informasi Kampus</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            @auth
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn nav-link px-3 d-inline">Logout</button>
            </form>
            @else
            <div>
                <a href="/login" class="nav-link px-3 d-inline">Login</a>
                <a href="/register" class="nav-link px-3 d-inline">Sign-up</a>
            </div>
            @endauth
        </div>
    </div>
</header>