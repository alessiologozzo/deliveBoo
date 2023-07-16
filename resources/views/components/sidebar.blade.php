<aside class="d-flex flex-column">
    <div class="logo-container">
        <img src="{{Vite::asset('resources/img/deliveboo3.png')}}" alt="dc-logo">
    </div>

    <a href="http://localhost:5174/" class="d-flex align-items-center gap-3 sidebar-item px-3">
        <i class="fa-solid fa-house-chimney"></i>
        <span class="d-none d-md-block">Home</span>
    </a>

    <a href="{{ url('/') }}" class="d-flex align-items-center gap-3 sidebar-item px-3">
        <i class="fa-solid fa-chart-line"></i>
        <span class="d-none d-md-block">Dashboard</span>
    </a>

    <a href="{{ url('/orders') }}" class="d-flex align-items-center gap-3 sidebar-item px-3">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="d-none d-md-block">My Orders</span>
    </a>

    <a href="{{ url('/dishes') }}" class="d-flex align-items-center gap-3 sidebar-item px-3">
        <i class="fa-solid fa-burger"></i>
        <span class="d-none d-md-block">My Dishes</span>
    </a>

    <a href="{{ route('images.index') }}" class="d-flex align-items-center gap-3 sidebar-item px-3">
        <i class="fa-solid fa-images"></i>
        <span class="d-none d-md-block">My Images</span>
    </a>



    <div onclick="window.Func.toggleMenu(event)" class="drop-menu-data mb-3">
        <div
            class="d-flex justify-content-between gap-3 sidebar-item px-3 sidebar-item cursor-pointer drop-master-data">
            <div class="d-flex align-items-center gap-3">
                <i class="fa-solid fa-gears"></i>
                <span class="d-none d-md-block">My Profile</span>
            </div>

            <div class="d-flex align-items-center">
                <i class="fa-solid fa-chevron-left drop-size"></i>
            </div>
        </div>

        <div class="drop-menu">
            <a href="{{ url('/users') }}" class="drop-item d-flex align-items-center gap-3 sidebar-item">
                <i class="fa-solid fa-user"></i>
                <span class="d-none d-md-block">User</span>
            </a>

            <a href="{{ url('/restaurants') }}" class="drop-item d-flex align-items-center gap-3 sidebar-item">
                <i class="fa-solid fa-utensils"></i>
                <span class="d-none d-md-block">Restaurant</span>
            </a>
        </div>
    </div>



    <div onclick="window.Func.resizeSidebar();" class="sidebar-resizer">
        <i class="fa-solid fa-chevron-right"></i>
    </div>
</aside>
