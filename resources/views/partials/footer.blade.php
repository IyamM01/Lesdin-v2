<footer id="footer" class="bg-[#3C5148] text-white px-6 md:px-40 py-10">
    {{-- Slogan --}}
    <h2 class="text-2xl md:text-3xl font-bold mb-15 mt-5">
        Jiwa Kesatria, Prestasi Mendunia
    </h2>

    {{-- Grid 4 kolom --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
        {{-- Kolom 1 --}}
        <div>
            <h3 class="font-bold mb-5">SMK Negeri 2 Depok</h3>
            <p class="text-sm leading-relaxed mb-4">
                Sekolah menengah kejuruan yang berkomitmen menghasilkan lulusan
                berkualitas, siap kerja, dan memiliki karakter yang kuat.
            </p>
            <div class="flex gap-4 text-lg">
                <a href="https://facebook.com/smkn2depok" target="_blank" rel="noopener noreferrer"
                   class="hover:text-blue-400 transition-colors duration-200" title="Facebook SMK Negeri 2 Depok">
                    {{-- Facebook Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3.6l.4-4H14V7a1 1 0 0 1 1-1h3V2z"/>
                    </svg>
                </a>
                <a href="https://www.instagram.com/smkn2depoksleman.official/" target="_blank" rel="noopener noreferrer"
                   class="hover:text-pink-400 transition-colors duration-200" title="Instagram SMK Negeri 2 Depok">
                    {{-- Instagram Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                    </svg>
                </a>
                <a href="https://youtube.com/@smkn2depok" target="_blank" rel="noopener noreferrer"
                   class="hover:text-red-400 transition-colors duration-200" title="YouTube SMK Negeri 2 Depok">
                    {{-- YouTube Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                         viewBox="0 0 24 24">
                        <path
                            d="M23.5 6.2s-.2-1.6-.8-2.2c-.8-.9-1.7-.9-2.1-1C17.2 2.5 12 2.5 12 2.5h-.1s-5.2 0-8.6.5c-.4.1-1.3.1-2.1 1-.6.6-.8 2.2-.8 2.2S0 7.8 0 9.5v1c0 1.7.2 3.3.2 3.3s.2 1.6.8 2.2c.8.9 1.9.9 2.4 1 1.8.2 7.6.5 7.6.5s5.2 0 8.6-.5c.4-.1 1.3-.1 2.1-1 .6-.6.8-2.2.8-2.2s.2-1.6.2-3.3v-1c0-1.7-.2-3.3-.2-3.3zM9.7 13.5V7.9l6 2.8-6 2.8z"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Kolom 2 --}}
        <div>
            <h3 class="font-bold mb-5">Navigasi</h3>
            <ul class="space-y-1">
                <li><a href="{{ url('/') }}" class="hover:underline">Beranda</a></li>
                <li><a href="{{ url('/mitra') }}" class="hover:underline">Mitra</a></li>
            </ul>
        </div>

        {{-- Kolom 3 --}}
        <div>
            <h3 class="font-bold mb-5">Kontak</h3>
            <p class="flex items-center gap-2">
                {{-- Phone Icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path
                        d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 3.1 5.18 2 2 0 0 1 5 3h3a2 2 0 0 1 2 1.72c.12.81.37 1.6.73 2.34a2 2 0 0 1-.45 2.11l-1.27 1.27a16 16 0 0 0 7.07 7.07l1.27-1.27a2 2 0 0 1 2.11-.45c.74.36 1.53.61 2.34.73A2 2 0 0 1 22 16.92z"/>
                </svg>
                (0274) 513515
            </p>
            <p class="flex items-center gap-2 mt-2">
                {{-- Mail Icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path
                        d="M4 4h16c1.1 0 2 .9 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2z"/>
                    <polyline points="22,6 12,13 2,6"/>
                </svg>
                info@smkn2depoksleman.sch.id
            </p>
            <div class="mt-4 flex items-start gap-2">
                {{-- Clock Icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-1" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/>
                    <polyline points="12 6 12 12 16 14"/>
                </svg>
                <div>
                    <p>Senin-Selasa : 07.00 WIB - 15.30 WIB</p>
                    <p>Jumat : 07.00 WIB - 14.00 WIB</p>
                </div>
            </div>
        </div>

        {{-- Kolom 4 --}}
        <div>
            <h3 class="font-bold mb-5">Lokasi</h3>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3783.29665125938!2d110.38938057483126!3d-7.772964177108618!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a583a61290129%3A0x668d51a34b3a7ee8!2sSMK%20Negeri%202%20Depok%20-%20Sleman!5e1!3m2!1sid!2sid!4v1755249577114!5m2!1sid!2sid"
                width="100%" height="150" style="border:0; border-radius:10px;"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    {{-- Garis dan Copyright --}}
    <div class="border-t border-gray-300 mt-10 pt-4 text-center text-sm">
        Copyright © 2025 SMK Negeri 2 Depok Sleman. All Rights Reserved
    </div>
</footer>
