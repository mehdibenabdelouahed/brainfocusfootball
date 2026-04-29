<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Brain Focus Football')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#f59e0b">
    <link rel="apple-touch-icon" href="/images/logoBFF.png">

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
<body x-data="compareSystem()" @toggle-compare.window="toggle($event.detail)" class="antialiased bg-slate-950 text-white min-h-screen">
    @yield('content')

    @include('partials.compare-bar')

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
                    window.location.href = `/comparateur?ids=${ids}`;
                }
            }
        }
    </script>
</body>
</html>


