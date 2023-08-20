<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            LaraBook
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <x-nav-link :url="route('profile.create')" :active="request()->routeIs('profile.create')">Profile</x-nav-link>
            {{-- Right side of the navbar :  --}}
            <div style="position:absolute;display: flex;align-items: center;right: 10px;">
                {{-- Search bar :  --}}
                <livewire:autocomplete-search />
                {{-- Notification box:  --}}
                <x-notification-box />
                <!-- Authentication Links -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <x-nav-link :url="route('login')" :active="request()->routeIs('login')">Login</x-nav-link>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <x-nav-link :url="route('register')" :active="request()->routeIs('register')">Register</x-nav-link>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
</nav>
