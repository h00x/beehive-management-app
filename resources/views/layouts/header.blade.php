<nav class="bg-primary-400 text-primary-900 py-6">
    <div class="container mx-auto flex justify-between">
        @auth
            <div>
                <a href="{{ route('dashboard') }}"
                   class="font-bold no-underline text-primary-700 {{ isCurrentRoute('dashboard') ? 'active' : '' }}"
                >Dashboard</a>
                <a href="{{ route('hives.index') }}" class="ml-4 font-bold no-underline text-primary-700 {{ isCurrentRoute('hives.*') ? 'active' : '' }}">Hives</a>
                <a href="{{ route('apiaries.index') }}" class="ml-4 font-bold no-underline text-primary-700 {{ isCurrentRoute('apiaries.*') ? 'active' : '' }}">Apiaries</a>
                <a href="{{ route('harvests.index') }}" class="ml-4 font-bold no-underline text-primary-700 {{ isCurrentRoute('harvests.*') ? 'active' : '' }}">Harvests</a>
                <a href="{{ route('inspections.index') }}" class="ml-4 font-bold no-underline text-primary-700 {{ isCurrentRoute('inspections.*') ? 'active' : '' }}">Inspections</a>
            </div>
        @endauth

        <div class="flex items-center">
            <!-- Authentication Links -->
            @guest
                <a href="{{ route('login') }}" class="mr-4">{{ __('Login') }}</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif
            @else
                <a href="#" role="button" class="mr-4">
                    {{ Auth::user()->name }}
                </a>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @endguest
        </div>
    </div>

    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center">
            <h1 class="font-title text-4xl mr-6">
                @yield('pageTitle', 'Page')
            </h1>
            @yield('subHeaders')
        </div>
        <div>
            button
        </div>
    </div>
</nav>
