<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Brain Focus Football')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#f59e0b">
    <link rel="apple-touch-icon" href="/images/logoBFF.png">

    {{-- Google Fonts — Wix-inspired Poppins typography --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Alpine.js for interactive components --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js');
            });
        }
    </script>

    {{-- Alpine.js x-cloak support --}}
    <style>
        [x-cloak] { display: none !important; }
    </style>
    @stack('styles')
</head>
<body x-data="compareSystem()" @toggle-compare.window="toggle($event.detail)" class="antialiased min-h-screen" style="background-color: var(--bff-bg-dark); color: var(--bff-text-primary);">
    {{-- Notifications flash globales --}}
    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-[-1rem]"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-[-1rem]"
             class="fixed top-4 left-1/2 -translate-x-1/2 z-[999] max-w-lg w-full px-4">
            <div class="bg-red-500/10 border border-red-500/40 backdrop-blur-lg rounded-xl p-4 flex items-start gap-3 shadow-2xl">
                <svg class="w-5 h-5 text-red-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                <p class="text-sm text-red-300 flex-1">{{ session('error') }}</p>
                <button @click="show = false" class="text-red-400 hover:text-red-300 transition">
                     <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    @endif
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-[-1rem]"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-[-1rem]"
             class="fixed top-4 left-1/2 -translate-x-1/2 z-[999] max-w-lg w-full px-4">
            <div class="bg-emerald-500/10 border border-emerald-500/40 backdrop-blur-lg rounded-xl p-4 flex items-start gap-3 shadow-2xl">
                <svg class="w-5 h-5 text-emerald-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <p class="text-sm text-emerald-300 flex-1">{{ session('success') }}</p>
                <button @click="show = false" class="text-emerald-400 hover:text-emerald-300 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    @endif

    @yield('content')

    @include('partials.compare-bar')

    @include('partials.footer')

    @stack('scripts')

    <script>
        function compareSystem() {
            return {
                players: JSON.parse(localStorage.getItem('bff_compare') || '[]'),
                
                toggle(player) {
                    const index = this.players.findIndex(p => p.id === player.id);
                    if (index > -1) {
                        this.players.splice(index, 1);
                    } else if (this.players.length < 3) {
                        this.players.push(player);
                    }
                    this.save();
                },

                remove(id) {
                    this.players = this.players.filter(p => p.id !== id);
                    this.save();
                },

                isInCompare(id) {
                    return this.players.some(p => p.id === id);
                },

                clear() {
                    this.players = [];
                    this.save();
                },

                save() {
                    localStorage.setItem('bff_compare', JSON.stringify(this.players));
                },

                compareNow() {
                    const ids = this.players.map(p => p.id).join(',');
                    window.location.href = `/${document.documentElement.lang}/compare?ids=${ids}`;
                }
            }
        }
    </script>
</body>
</html>
