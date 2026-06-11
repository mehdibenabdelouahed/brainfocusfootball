{{-- ═══════════════════════════════════════════════════════ --}}
{{-- FOOTER — Wix style (Global partial)                  --}}
{{-- ═══════════════════════════════════════════════════════ --}}
<footer class="bff-footer pt-16 pb-8 text-[#b2c0d9]" style="background-color: var(--bff-bg-dark); border-top: 1px solid var(--bff-border);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="grid md:grid-cols-4 gap-10 lg:gap-16 mb-12">
            {{-- Column 1 --}}
            <div class="md:col-span-1">
                <a href="{{ route('home') }}" class="inline-block mb-4">
                    <span class="text-2xl font-black italic tracking-tighter uppercase leading-none" style="font-family: 'Poppins', sans-serif;">
                        <span class="text-[#ffdc21]">BRAIN</span><span class="text-white">FOCUS</span>
                    </span>
                </a>
                <p class="text-[#7388a6] text-xs leading-relaxed mb-6 font-light" style="font-family: 'Poppins', sans-serif;">
                    {{ __('nav.footer_desc') }}
                </p>
                {{-- Social links --}}
                <div class="flex items-center gap-4">
                    <a href="#" class="w-9 h-9 rounded-full border border-white/5 flex items-center justify-center text-white/40 hover:text-[#ffdc21] hover:border-[#ffdc21] transition-all bg-[#121b2d]">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="#" class="w-9 h-9 rounded-full border border-white/5 flex items-center justify-center text-white/40 hover:text-[#ffdc21] hover:border-[#ffdc21] transition-all bg-[#121b2d]">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Column 2 --}}
            <div>
                <h4 class="text-xs font-bold text-white mb-5 uppercase tracking-widest" style="font-family: 'Poppins', sans-serif;">{{ __('nav.quick_links') }}</h4>
                <ul class="space-y-3 text-xs font-light text-[#7388a6]">
                    <li><a href="{{ route('articles.index') }}" class="hover:text-[#ffdc21] transition">{{ __('nav.articles') }}</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-[#ffdc21] transition">{{ __('nav.about') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-[#ffdc21] transition">{{ __('nav.contact') }}</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-[#ffdc21] transition">{{ __('nav.register') }}</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-xs font-bold text-white mb-5 uppercase tracking-widest" style="font-family: 'Poppins', sans-serif;">{{ __('nav.key_topics') }}</h4>
                <ul class="space-y-3 text-xs font-light text-[#7388a6]">
                    <li><a href="{{ route('articles.index') }}" class="hover:text-[#ffdc21] transition">{{ __('nav.mental_prep') }}</a></li>
                    <li><a href="{{ route('articles.index') }}" class="hover:text-[#ffdc21] transition">{{ __('nav.agents_scouting') }}</a></li>
                    <li><a href="{{ route('articles.nutrition') }}" class="hover:text-[#ffdc21] transition">{{ __('nav.nutrition_recovery') }}</a></li>
                    <li><a href="{{ route('articles.index') }}" class="hover:text-[#ffdc21] transition">{{ __('nav.family_role') }}</a></li>
                </ul>
            </div>

            {{-- Column 4 --}}
            <div>
                <h4 class="text-xs font-bold text-white mb-5 uppercase tracking-widest" style="font-family: 'Poppins', sans-serif;">{{ __('nav.contact_info') }}</h4>
                <ul class="space-y-3 text-xs font-light text-[#7388a6]">
                    <li class="flex items-center gap-2 min-w-0">
                        <svg class="w-3.5 h-3.5 text-[#ffdc21] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:contact@brainfocusfootball.com" class="hover:text-[#ffdc21] transition break-all lg:break-normal min-w-0">contact@brainfocusfootball.com</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-3.5 h-3.5 text-[#ffdc21]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>{{ __('nav.brussels') }}</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="border-t border-white/5 pt-6 flex flex-col md:flex-row items-center justify-between gap-3 text-[10px] text-[#7388a6] font-light">
            <p>{{ __('nav.all_rights', ['year' => date('Y')]) }}</p>
            <div class="flex gap-6">
                <a href="{{ route('legal.mentions') }}" class="hover:text-[#ffdc21] transition">{{ __('nav.legal_notice') }}</a>
                <a href="{{ route('legal.privacy') }}" class="hover:text-[#ffdc21] transition">{{ __('nav.privacy_policy') }}</a>
                <a href="{{ route('legal.cgu') }}" class="hover:text-[#ffdc21] transition">{{ __('nav.terms') }}</a>
            </div>
        </div>
    </div>
</footer>
