@auth
@php
    $user = auth()->user();
    $isAdmin = $user && $user->isAdmin();
@endphp

<aside class="sidebar fixed left-0 top-0 h-screen bg-white shadow-xl flex flex-col">

    <!-- LOGO -->
    <div class="logo flex items-center justify-center h-20 border-b">
        <div class="logo-box">
            🏫
        </div>
        <span class="logo-text">E-School</span>
    </div>

    <!-- MENU -->
    <nav class="flex-1 px-3 py-6 space-y-3">

        @if($isAdmin)
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="icon">📊</span>
                <span class="text">Dashboard</span>
            </a>

            <a href="{{ route('admin.aspirasi.index') }}" class="menu-item {{ request()->routeIs('admin.aspirasi.*') ? 'active' : '' }}">
                <span class="icon">📝</span>
                <span class="text">Pengaduan</span>
            </a>

            <a href="{{ route('admin.students.index') }}" class="menu-item {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
                <span class="icon">👥</span>
                <span class="text">Data Siswa</span>
            </a>
        @else
            <a href="{{ route('siswa.dashboard') }}" class="menu-item {{ request()->routeIs('siswa.dashboard') ? 'active' : '' }}">
                <span class="icon">📊</span>
                <span class="text">Dashboard</span>
            </a>

            <a href="{{ route('siswa.aspirasi.index') }}" class="menu-item {{ request()->routeIs('siswa.aspirasi.*') ? 'active' : '' }}">
                <span class="icon">📝</span>
                <span class="text">Pengaduan Saya</span>
            </a>

            <a href="{{ route('siswa.aspirasi.create') }}" class="menu-item {{ request()->routeIs('siswa.aspirasi.create') ? 'active' : '' }}">
                <span class="icon">➕</span>
                <span class="text">Buat Pengaduan</span>
            </a>
        @endif
    </nav>

    <!-- LOGOUT -->
    <div class="p-4 border-t">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="menu-item logout">
                <span class="icon">🚪</span>
                <span class="text">Logout</span>
            </button>
        </form>
    </div>

</aside>

<style>
/* SIDEBAR */
.sidebar{
    width:80px;
    transition:.3s;
    z-index:50;
}
.sidebar:hover{
    width:240px;
}

/* LOGO */
.logo-box{
    width:44px;
    height:44px;
    border-radius:14px;
    background:#e5e7eb;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:1.5rem;
}
.logo-text{
    margin-left:12px;
    font-weight:700;
    font-size:1.1rem;
    opacity:0;
    transition:.3s;
    white-space:nowrap;
}
.sidebar:hover .logo-text{
    opacity:1;
}

/* MENU ITEM */
.menu-item{
    display:flex;
    align-items:center;
    gap:16px;
    padding:14px;
    border-radius:14px;
    color:#374151;
    transition:.2s;
    text-decoration:none;
}
.menu-item:hover{
    background:#f3f4f6;
    transform:translateX(4px);
}
.menu-item .icon{
    font-size:1.6rem;
    min-width:32px;
    text-align:center;
}
.menu-item .text{
    opacity:0;
    transition:.3s;
    white-space:nowrap;
}
.sidebar:hover .menu-item .text{
    opacity:1;
}

/* ACTIVE */
.menu-item.active{
    background:#2563eb;
    color:white;
    box-shadow:0 10px 25px rgba(37,99,235,.35);
}

/* LOGOUT */
.menu-item.logout{
    color:#dc2626;
}
.menu-item.logout:hover{
    background:#fee2e2;
}
</style>
@endauth
