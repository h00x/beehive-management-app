<nav class="bg-primary-400 text-primary-900 py-6">
    <div class="container mx-auto flex justify-between">
        @auth
            <div>
                <a href="{{ route('dashboard') }}"
                   class="font-bold no-underline text-primary-700 hover:text-primary-800 {{ isCurrentRoute('dashboard') ? 'active' : '' }}"
                >Dashboard</a>
                <a href="{{ route('hives.index') }}" class="ml-4 font-bold no-underline text-primary-700 hover:text-primary-800 {{ isCurrentRoute('hives.*') ? 'active' : '' }}">Hives</a>
                <a href="{{ route('apiaries.index') }}" class="ml-4 font-bold no-underline text-primary-700 hover:text-primary-800 {{ isCurrentRoute('apiaries.*') ? 'active' : '' }}">Apiaries</a>
                <a href="{{ route('harvests.index') }}" class="ml-4 font-bold no-underline text-primary-700 hover:text-primary-800 {{ isCurrentRoute('harvests.*') ? 'active' : '' }}">Harvests</a>
                <a href="{{ route('inspections.index') }}" class="ml-4 font-bold no-underline text-primary-700 hover:text-primary-800 {{ isCurrentRoute('inspections.*') ? 'active' : '' }}">Inspections</a>
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
                <dropdown>
                    <template v-slot:trigger>
                        <button
                            class="flex items-center text-default no-underline text-sm"
                            v-pre
                        >
                            <div class="flex items-center justify-center rounded-full mr-3 bg-primary-700 w-8 h-8 text-primary-900 text-center font-bold">{{ substr(auth()->user()->name, 0, 1) }}</div>
                            {{ auth()->user()->name }}<i class="fas fa-caret-down ml-1"></i>
                        </button>
                    </template>
                    <div class="hover:bg-secondary-100 -mx-2 px-2 border-b border-secondary-100">
                        <a href="/profile" role="button" class="inline-block p-2"><i class="fas fa-user text-sm mr-2"></i>Profile</a>
                    </div>
                    <div class="hover:bg-secondary-100 -mx-2 px-2">
                        <a href="{{ route('logout') }}"
                           class="inline-block p-2"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt text-sm mr-2"></i>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </dropdown>
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
