<aside class="d-flex flex-column">
    <div class="logo-container">
        <img src="{{ Vite::asset('resources/img/logo.svg') }}" alt="logo">
    </div>

    <a href="#" class="d-flex align-items-center gap-3 sidebar-item px-3">
        <i class="fa-solid fa-house-chimney"></i>
        <span class="d-none d-md-block">Home</span>
    </a>

    <a href="#" class="d-flex align-items-center gap-3 sidebar-item px-3">
        <i class="fa-solid fa-chart-line"></i>
        <span class="d-none d-md-block">Dashboard</span>
    </a>

    <a href="#" class="d-flex align-items-center gap-3 sidebar-item px-3">
        <i class="fa-solid fa-burger"></i>
        <span class="d-none d-md-block">My Foods</span>
    </a>

    <a href="#" class="d-flex align-items-center gap-3 sidebar-item px-3">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="d-none d-md-block">My Orders</span>
    </a>

    <a href="#" class="d-flex align-items-center gap-3 sidebar-item px-3">
        <i class="fa-solid fa-images"></i>
        <span class="d-none d-md-block">My Images</span>
    </a>

    

    <div onclick="window.Func.toggleMenu(event)" class="drop-menu-data mb-3">
        <div class="d-flex justify-content-between gap-3 sidebar-item px-3 sidebar-item cursor-pointer drop-master-data">
            <div class="d-flex align-items-center gap-3">
                <i class="fa-solid fa-utensils"></i>
                <span class="d-none d-md-block">My Restaurant</span>
            </div>
    
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-chevron-left drop-size"></i>
            </div>
        </div>

        <div class="drop-menu">
            <a href="#" class="drop-item d-flex align-items-center gap-3 sidebar-item">
                <i class="fa-solid fa-user"></i>
                <span class="d-none d-md-block">Profile</span>
            </a>

            <a href="#" class="drop-item d-flex align-items-center gap-3 sidebar-item">
                <i class="fa-regular fa-circle"></i>
                <span class="d-none d-md-block">Restaurant</span>
            </a>
        </div>
    </div>



    <div onclick="window.Func.resizeSidebar();" class="sidebar-resizer">
        <i class="fa-solid fa-chevron-right"></i>
    </div>
</aside>