@php
    use App\Helpers\SiteConfig;
    $config = SiteConfig::get();
    $links = [
        ['label' => 'Home', 'href' => 'home'],
        ['label' => 'Portfolio', 'href' => 'portfolio'],
        ['label' => 'Blogs', 'href' => 'blogs'],
    ];
@endphp
<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 w-full z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ url('/') }}">
                    <img class="h-8 w-auto" src="{{ url($config['icon']) }}" alt="Logo">
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                @foreach ($links as $link)
                    <a href="{{ route($link['href']) }}"
                        class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium {{ request()->routeIs($link['href']) ? 'border-indigo-500 text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            <!-- Mobile Menu Button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                    <span class="sr-only">Open main menu</span>
                    <!-- Heroicon name: menu -->
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="open" class="sm:hidden" x-cloak wire:transition>
        <div class="pt-2 pb-3 space-y-1">
            @foreach ($links as $link)
                <a href="{{ route($link['href']) }}"
                    class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium {{ request()->routeIs($link['href']) ? 'border-indigo-500 text-indigo-700 bg-indigo-50' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</nav>
