<header class="d-flex justify-content-end align-items-center">
    <div onclick="window.Func.showMenu(event)" class="al-menu-data position-relative cursor-pointer">
        <i>{{ Str::limit(Auth::user()->first_name . " " . Auth::user()->last_name, 50, "...") }}</i>
        <i class="fa-solid fa-chevron-down"></i>

        <div class="al-menu">
            <a href="{{route('orders.index')}}" class="al-menu-item">
                My Orders
            </a>

            <a href="{{route('dishes.index')}}" class="al-menu-item">
                My Dishes
            </a>

            <a href="#" class="al-menu-item">
                My Images
            </a>

            <div class="al-menu-item item-expandable">
                My Profile
                
                <div class="item-collapse">

                    <a href="{{route('users.index')}}" class="al-menu-item">
                        User
                    </a>

                    <a href="{{route('restaurants.index')}}" class="al-menu-item">
                        Restaurant
                    </a>
                </div>
            </div>
            <div onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="al-menu-item">
                Logout
            </div>
    </div>


    {{-- IN ATTESA DI DECIDERE IL CONTENUTO DELLA TOPBAR --}}
    {{-- <div onclick="window.Func.showMenu(event)" class="d-md-none al-menu-data position-relative cursor-pointer">
        <i class="fa-solid fa-bars"></i>

        <div class="al-menu">
            <a href="#" class="al-menu-item">
                DA DECIDERE...
            </a>

            <div onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="al-menu-item">
                Logout
            </div>
        </div>
    </div> --}}


    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</header>