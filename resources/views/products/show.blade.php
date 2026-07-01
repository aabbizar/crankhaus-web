<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $product->name }} – Beli perlengkapan badminton premium dari PB Sahaja.">
    <title>{{ $product->name }} – PB Sahaja</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', 'Circular', -apple-system, system-ui, sans-serif; }
        input[type="range"] { -webkit-appearance: none; appearance: none; height: 4px; border-radius: 2px; outline: none; background: #dddddd; }
        input[type="range"]::-webkit-slider-thumb { -webkit-appearance: none; appearance: none; width: 22px; height: 22px; border-radius: 50%; background: #222222; cursor: pointer; border: 2px solid white; box-shadow: 0 1px 4px rgba(0,0,0,0.15); }
        input[type="range"]::-moz-range-thumb { width: 22px; height: 22px; border-radius: 50%; background: #222222; cursor: pointer; border: 2px solid white; box-shadow: 0 1px 4px rgba(0,0,0,0.15); }
        #racketVisual { perspective: 1000px; }
        /* Modal styles */
        #shippingModal { backdrop-filter: blur(4px); }
        .shipping-input {
            width: 100%;
            padding: 14px 12px;
            border: 1px solid #dddddd;
            border-radius: 8px;
            font-size: 16px;
            font-family: inherit;
            color: #222222;
            background: #ffffff;
            transition: border-color 0.15s;
            outline: none;
        }
        .shipping-input:focus { border-color: #222222; border-width: 2px; }
        .shipping-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #6a6a6a;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 6px;
        }
        .field-error { font-size: 13px; color: #c13515; margin-top: 4px; display: none; }
        /* Scroll reveal utility */
        .reveal-up { opacity: 0; transform: translateY(40px); }
    </style>
</head>
<body class="bg-white text-[#222222] antialiased">

    {{-- Nav --}}
    <nav id="productNav" class="bg-white/95 backdrop-blur-md border-b border-[#dddddd] h-20 flex items-center justify-between px-6 md:px-12 sticky top-0 z-50 transition-all duration-300">
        <div class="flex items-center gap-6">
            <a href="{{ route('home') }}" class="flex items-center gap-2 text-sm font-semibold text-[#6a6a6a] hover:text-[#222222] transition-colors group">
                <svg class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali
            </a>
            <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight text-[#ff385c]">PB SAHAJA</a>
        </div>
        <div class="flex items-center gap-3">
            @auth
                <span class="text-sm font-medium text-[#6a6a6a]">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm font-semibold text-[#6a6a6a] border border-[#dddddd] rounded-full px-4 py-2 hover:bg-[#f7f7f7] transition-colors">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-sm font-semibold text-white bg-[#ff385c] rounded-full px-5 py-2.5 hover:bg-[#e00b41] transition-colors shadow-[rgba(0,0,0,0.02)_0_0_0_1px,rgba(0,0,0,0.04)_0_2px_6px,rgba(0,0,0,0.1)_0_4px_8px]">Login</a>
            @endauth
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 md:px-12 py-8">

        {{-- Breadcrumbs --}}
        <nav id="breadcrumbRow" class="reveal-up flex items-center gap-2 text-sm text-[#6a6a6a] mb-8">
            <a href="{{ route('home') }}" class="hover:text-[#222222] transition-colors font-medium">Home</a>
            <span class="text-[#c1c1c1]">/</span>
            <a href="{{ route('home', ['category' => $product->category]) }}" class="hover:text-[#222222] transition-colors font-medium">{{ $product->category }}</a>
            <span class="text-[#c1c1c1]">/</span>
            <span class="text-[#222222] font-semibold">{{ $product->name }}</span>
        </nav>

        <div class="grid lg:grid-cols-2 gap-12">

            {{-- Kiri — Racket Visual + Controls --}}
            <div id="productVisualCol" class="reveal-up space-y-6">

                <div id="racketVisual" class="relative bg-gradient-to-br from-[#fafafa] to-[#f0f0f0] rounded-[14px] p-8 flex items-center justify-center min-h-[420px] overflow-hidden border border-[#ebebeb] shadow-[rgba(0,0,0,0.02)_0_0_0_1px,rgba(0,0,0,0.04)_0_2px_6px]">

                    <div class="absolute top-4 left-6 text-[10px] font-bold tracking-[0.15em] text-[#c1c1c1] select-none">{{ $product->brand }} · {{ $product->category }}</div>

                    {{-- Racket SVG --}}
                    <svg class="racket-frame w-full max-w-[280px] h-auto drop-shadow-xl" viewBox="0 0 280 400" fill="none" xmlns="http://www.w3.org/2000/svg">
                        @php
                            $brand = $product->brand;
                            $stringColor = '#222222';
                            $stringWidth = 1.0;
                        @endphp

                        @if ($brand === 'Yonex')
                            <rect x="132" y="240" width="16" height="120" rx="3" fill="#cc1a1a" />
                            <rect x="125" y="340" width="30" height="40" rx="6" fill="#222222" />
                            <ellipse cx="140" cy="130" rx="78" ry="108" stroke="#cc1a1a" stroke-width="5" fill="none" />
                            @for ($y = 60; $y <= 200; $y += 12)
                                <line x1="68" y1="{{ $y }}" x2="212" y2="{{ $y }}" class="racket-string" stroke="{{ $stringColor }}" stroke-width="{{ $stringWidth }}" />
                            @endfor
                            @for ($x = 80; $x <= 200; $x += 10)
                                <line x1="{{ $x }}" y1="28" x2="{{ $x }}" y2="232" class="racket-string" stroke="{{ $stringColor }}" stroke-width="{{ $stringWidth }}" />
                            @endfor
                            <g opacity="0.18">
                                <path d="M108 160 C108 120, 120 90, 140 90 C160 90, 172 120, 172 160" stroke="#cc1a1a" stroke-width="4" fill="none" stroke-linecap="round"/>
                                <path d="M108 100 C108 140, 120 170, 140 170 C160 170, 172 140, 172 100" stroke="#cc1a1a" stroke-width="4" fill="none" stroke-linecap="round"/>
                                <path d="M140 90 L140 170" stroke="#cc1a1a" stroke-width="3" fill="none"/>
                            </g>

                        @elseif ($brand === 'Li-Ning')
                            <rect x="132" y="240" width="16" height="120" rx="3" fill="#e31b23" />
                            <rect x="125" y="340" width="30" height="40" rx="6" fill="#222222" />
                            <ellipse cx="140" cy="130" rx="78" ry="108" stroke="#e31b23" stroke-width="5" fill="none" />
                            @for ($y = 60; $y <= 200; $y += 12)
                                <line x1="68" y1="{{ $y }}" x2="212" y2="{{ $y }}" class="racket-string" stroke="{{ $stringColor }}" stroke-width="{{ $stringWidth }}" />
                            @endfor
                            @for ($x = 80; $x <= 200; $x += 10)
                                <line x1="{{ $x }}" y1="28" x2="{{ $x }}" y2="232" class="racket-string" stroke="{{ $stringColor }}" stroke-width="{{ $stringWidth }}" />
                            @endfor
                            <g opacity="0.18">
                                <path d="M95 150 L120 180 L185 100" stroke="#e31b23" stroke-width="6" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M105 160 L120 180 L175 115" stroke="#e31b23" stroke-width="3" fill="none" stroke-linecap="round" stroke-linejoin="round" opacity="0.6"/>
                            </g>

                        @elseif ($brand === 'Victor')
                            <rect x="132" y="240" width="16" height="120" rx="3" fill="#005bac" />
                            <rect x="125" y="340" width="30" height="40" rx="6" fill="#222222" />
                            <ellipse cx="140" cy="130" rx="78" ry="108" stroke="#005bac" stroke-width="5" fill="none" />
                            @for ($y = 60; $y <= 200; $y += 12)
                                <line x1="68" y1="{{ $y }}" x2="212" y2="{{ $y }}" class="racket-string" stroke="{{ $stringColor }}" stroke-width="{{ $stringWidth }}" />
                            @endfor
                            @for ($x = 80; $x <= 200; $x += 10)
                                <line x1="{{ $x }}" y1="28" x2="{{ $x }}" y2="232" class="racket-string" stroke="{{ $stringColor }}" stroke-width="{{ $stringWidth }}" />
                            @endfor
                            <g opacity="0.18">
                                <path d="M140 85 L108 175 L140 155 L172 175 Z" stroke="#005bac" stroke-width="4" fill="none" stroke-linejoin="round"/>
                                <path d="M140 85 L116 175" stroke="#005bac" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                                <path d="M140 85 L164 175" stroke="#005bac" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                            </g>

                        @elseif ($brand === 'Felet')
                            <rect x="132" y="240" width="16" height="120" rx="3" fill="#1a1a1a" />
                            <rect x="125" y="340" width="30" height="40" rx="6" fill="#1a1a1a" />
                            <ellipse cx="140" cy="130" rx="78" ry="108" stroke="#1a1a1a" stroke-width="5" fill="none" />
                            @for ($y = 60; $y <= 200; $y += 12)
                                <line x1="68" y1="{{ $y }}" x2="212" y2="{{ $y }}" class="racket-string" stroke="{{ $stringColor }}" stroke-width="{{ $stringWidth }}" />
                            @endfor
                            @for ($x = 80; $x <= 200; $x += 10)
                                <line x1="{{ $x }}" y1="28" x2="{{ $x }}" y2="232" class="racket-string" stroke="{{ $stringColor }}" stroke-width="{{ $stringWidth }}" />
                            @endfor
                            <g opacity="0.18">
                                <path d="M115 95 L115 165" stroke="#1a1a1a" stroke-width="5" fill="none" stroke-linecap="round"/>
                                <path d="M115 95 L165 95" stroke="#1a1a1a" stroke-width="5" fill="none" stroke-linecap="round"/>
                                <path d="M115 130 L155 130" stroke="#1a1a1a" stroke-width="4" fill="none" stroke-linecap="round"/>
                            </g>
                        @endif
                    </svg>

                    <div class="absolute -bottom-16 left-1/2 -translate-x-1/2 w-72 h-72 rounded-full bg-gradient-radial from-[#ff385c]/10 to-transparent pointer-events-none"></div>
                </div>

                {{-- Color picker --}}
                <div class="flex items-center gap-3">
                    <span class="text-xs font-semibold text-[#6a6a6a] uppercase tracking-wider">Warna Senar</span>
                    <div class="flex gap-2">
                        @foreach (['#222222' => 'black', '#ffffff' => 'white', '#cc1a1a' => 'red', '#005bac' => 'blue', '#f5c518' => 'yellow', '#2e7d32' => 'green', '#ff6d00' => 'orange', '#9c27b0' => 'purple'] as $hex => $label)
                            <button class="color-swatch w-7 h-7 rounded-full border-2 border-[#dddddd] hover:scale-110 transition-transform duration-150"
                                    style="background-color: {{ $hex }}; {{ $hex === '#ffffff' ? 'border-color: #c1c1c1;' : '' }}"
                                    data-color="{{ $hex }}"
                                    aria-label="{{ $label }}"></button>
                        @endforeach
                    </div>
                </div>

                {{-- Tension slider --}}
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <label class="text-xs font-semibold text-[#6a6a6a] uppercase tracking-wider">Tegangan Senar</label>
                        <span id="tensionValue" class="text-sm font-bold text-[#222222]">28 LBS</span>
                    </div>
                    <input type="range" id="tensionSlider" min="20" max="35" value="28" step="1" class="w-full">
                    <div class="flex justify-between text-[10px] text-[#c1c1c1] font-medium">
                        <span>20 LBS</span>
                        <span>35 LBS</span>
                    </div>
                </div>
            </div>

            {{-- Kanan — Product Info + Buy --}}
            <div id="productInfoCol" class="reveal-up flex flex-col justify-center space-y-6">
                <div>
                    <span class="inline-block bg-[#f7f7f7] text-xs font-semibold px-3 py-1 rounded-full text-[#6a6a6a] mb-3 border border-[#ebebeb]">
                        {{ $product->brand }}
                    </span>
                    <h1 class="text-3xl md:text-4xl font-bold text-[#222222] leading-tight">{{ $product->name }}</h1>
                </div>

                <div class="text-[#6a6a6a] leading-relaxed prose prose-sm max-w-none">{!! $product->description !!}</div>

                <div class="flex items-center gap-4">
                    <span class="text-3xl font-bold text-[#ff385c]">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                    @if ($product->stock > 0)
                        <span class="bg-green-50 text-green-700 text-xs font-semibold px-3 py-1 rounded-full border border-green-200">Stok tersedia</span>
                    @else
                        <span class="bg-red-50 text-red-700 text-xs font-semibold px-3 py-1 rounded-full border border-red-200">Stok habis</span>
                    @endif
                </div>

                @auth
                    @if ($product->stock > 0)
                        <button id="openShippingModal"
                                class="w-full sm:w-auto bg-[#ff385c] text-white font-semibold px-10 py-4 rounded-lg hover:bg-[#e00b41] transition-all duration-200 shadow-[rgba(0,0,0,0.02)_0_0_0_1px,rgba(0,0,0,0.04)_0_2px_6px,rgba(0,0,0,0.1)_0_4px_8px] active:scale-95">
                            Beli Sekarang
                        </button>
                    @else
                        <button disabled class="w-full sm:w-auto bg-[#ffd1da] text-white font-semibold px-10 py-4 rounded-lg cursor-not-allowed">
                            Stok Habis
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                       class="inline-block w-full sm:w-auto bg-[#ff385c] text-white font-semibold px-10 py-4 rounded-lg hover:bg-[#e00b41] transition-all duration-200 shadow-[rgba(0,0,0,0.02)_0_0_0_1px,rgba(0,0,0,0.04)_0_2px_6px,rgba(0,0,0,0.1)_0_4px_8px] text-center">
                        Login untuk Membeli
                    </a>
                @endauth

                {{-- Trust badges --}}
                <div class="flex flex-wrap gap-4 pt-2 border-t border-[#ebebeb]">
                    <div class="flex items-center gap-2 text-xs text-[#6a6a6a]">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Produk Original 100%
                    </div>
                    <div class="flex items-center gap-2 text-xs text-[#6a6a6a]">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Pengiriman 1-3 Hari
                    </div>
                    <div class="flex items-center gap-2 text-xs text-[#6a6a6a]">
                        <svg class="w-4 h-4 text-[#ff385c]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        Pembayaran Aman via Midtrans
                    </div>
                </div>
            </div>
        </div>

        {{-- Produk Terkait --}}
        @if ($relatedProducts->isNotEmpty())
        <section class="mt-20 pt-12 border-t border-[#ebebeb]">
            <h2 class="text-xl font-bold text-[#222222] mb-8">Produk Serupa</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($relatedProducts as $related)
                    <a href="{{ route('products.show', $related->slug) }}"
                       class="related-card group bg-[#fafafa] rounded-[14px] p-4 border border-[#ebebeb] hover:shadow-[rgba(0,0,0,0.02)_0_0_0_1px,rgba(0,0,0,0.04)_0_2px_6px,rgba(0,0,0,0.1)_0_4px_8px] transition-all duration-300 hover:-translate-y-1">
                        <div class="text-xs font-semibold text-[#ff385c] mb-2">{{ $related->brand }}</div>
                        <div class="font-semibold text-[#222222] text-sm leading-snug mb-3 line-clamp-2">{{ $related->name }}</div>
                        <div class="text-base font-bold text-[#222222]">Rp{{ number_format($related->price, 0, ',', '.') }}</div>
                    </a>
                @endforeach
            </div>
        </section>
        @endif
    </main>

    {{-- ════════════════════════════════════════════════════ --}}
    {{-- MODAL FORM DATA PENGIRIMAN                          --}}
    {{-- ════════════════════════════════════════════════════ --}}
    @auth
    <div id="shippingModal"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4"
         style="display: none !important; background: rgba(0,0,0,0.5);">

        <div id="shippingModalBox"
             class="relative bg-white rounded-[20px] shadow-2xl w-full max-w-lg p-0 overflow-hidden"
             style="transform: scale(0.9); opacity: 0;">

            {{-- Modal Header --}}
            <div class="bg-gradient-to-r from-[#ff385c] to-[#e00b41] px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-white">Data Pengiriman</h2>
                        <p class="text-white/80 text-sm mt-1">{{ $product->name }}</p>
                    </div>
                    <button id="closeShippingModal" class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/30 transition-colors text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                {{-- Harga --}}
                <div class="mt-4 bg-white/20 rounded-xl px-4 py-2 inline-flex items-center gap-2">
                    <span class="text-white/80 text-sm">Total:</span>
                    <span class="text-white font-bold text-lg">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Modal Body --}}
            <div class="px-8 py-6 space-y-5">

                {{-- Nama Lengkap --}}
                <div>
                    <label for="shippingName" class="shipping-label">Nama Lengkap Penerima *</label>
                    <input type="text"
                           id="shippingName"
                           class="shipping-input"
                           placeholder="Contoh: Budi Santoso"
                           autocomplete="name">
                    <p id="shippingNameError" class="field-error">Nama lengkap wajib diisi.</p>
                </div>

                {{-- Nomor Telepon / WhatsApp --}}
                <div>
                    <label for="shippingPhone" class="shipping-label">Nomor WhatsApp Aktif *</label>
                    <input type="tel"
                           id="shippingPhone"
                           class="shipping-input"
                           placeholder="Contoh: 08123456789"
                           autocomplete="tel">
                    <p id="shippingPhoneError" class="field-error">Nomor WhatsApp wajib diisi (min. 9 digit).</p>
                </div>

                {{-- Alamat Pengiriman --}}
                <div>
                    <label for="shippingAddress" class="shipping-label">Alamat Lengkap Pengiriman *</label>
                    <textarea id="shippingAddress"
                              class="shipping-input resize-none"
                              rows="3"
                              placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan, kota/kabupaten, kode pos"></textarea>
                    <p id="shippingAddressError" class="field-error">Alamat pengiriman wajib diisi.</p>
                </div>

                {{-- Catatan --}}
                <div>
                    <label for="shippingNotes" class="shipping-label">Catatan (Opsional)</label>
                    <textarea id="shippingNotes"
                              class="shipping-input resize-none"
                              rows="2"
                              placeholder="Contoh: Titipkan ke satpam jika tidak ada di rumah"></textarea>
                </div>

                {{-- Error global --}}
                <div id="modalGlobalError" class="hidden bg-red-50 border border-red-200 rounded-lg px-4 py-3 text-sm text-[#c13515]"></div>

                {{-- CTA --}}
                <button id="confirmBuyButton"
                        class="w-full bg-[#ff385c] text-white font-semibold px-6 py-4 rounded-lg hover:bg-[#e00b41] transition-all duration-200 shadow-[rgba(0,0,0,0.02)_0_0_0_1px,rgba(0,0,0,0.04)_0_2px_6px,rgba(0,0,0,0.1)_0_4px_8px] active:scale-95 flex items-center justify-center gap-3">
                    <svg id="confirmBuySpinner" class="hidden w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span id="confirmBuyLabel">Konfirmasi & Bayar Sekarang</span>
                </button>

                <p class="text-center text-xs text-[#929292]">
                    Dengan melanjutkan, data pengiriman Anda akan disimpan dan Anda akan diarahkan ke halaman pembayaran aman Midtrans.
                </p>
            </div>
        </div>
    </div>
    @endauth

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // ── GSAP wait helper ──
            function waitForGsap(cb) {
                if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                    cb();
                } else {
                    setTimeout(function () { waitForGsap(cb); }, 50);
                }
            }

            waitForGsap(function () {
                gsap.config({ nullTargetWarn: false });

                // ── Page entrance animations ──
                gsap.to('#breadcrumbRow', {
                    opacity: 1,
                    y: 0,
                    duration: 0.7,
                    ease: 'power3.out',
                    delay: 0.1,
                });
                gsap.to('#productVisualCol', {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    ease: 'power3.out',
                    delay: 0.2,
                });
                gsap.to('#productInfoCol', {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    ease: 'power3.out',
                    delay: 0.35,
                });

                // ── Related cards scroll reveal ──
                if (document.querySelectorAll('.related-card').length > 0) {
                    gsap.set('.related-card', { opacity: 0, y: 50 });
                    gsap.to('.related-card', {
                        opacity: 1,
                        y: 0,
                        duration: 0.6,
                        stagger: 0.1,
                        ease: 'power2.out',
                        scrollTrigger: {
                            trigger: '.related-card',
                            start: 'top 85%',
                        },
                    });
                }
            });

            // ── 3D Rotation — GSAP mousemove parallax ──
            var frame = document.querySelector('.racket-frame');
            var visual = document.getElementById('racketVisual');
            var swatches = document.querySelectorAll('.color-swatch');
            var slider = document.getElementById('tensionSlider');
            var tensionDisplay = document.getElementById('tensionValue');

            if (frame && visual) {
                visual.addEventListener('mousemove', function (e) {
                    var rect = visual.getBoundingClientRect();
                    var x = e.clientX - rect.left;
                    var y = e.clientY - rect.top;
                    var xPercent = ((x / rect.width) - 0.5) * 20;
                    var yPercent = ((y / rect.height) - 0.5) * -20;
                    gsap.to(frame, {
                        rotationX: yPercent,
                        rotationY: xPercent,
                        transformPerspective: 1000,
                        ease: 'power2.out',
                        duration: 0.3,
                    });
                });
                visual.addEventListener('mouseleave', function () {
                    gsap.to(frame, {
                        rotationX: 0,
                        rotationY: 0,
                        transformPerspective: 1000,
                        ease: 'power2.out',
                        duration: 0.5,
                    });
                });
            }

            // ── Color picker ──
            swatches.forEach(function (swatch) {
                swatch.addEventListener('click', function () {
                    var color = this.dataset.color;
                    gsap.set('.racket-string', { stroke: color });
                    swatches.forEach(function (s) { s.style.borderColor = '#dddddd'; });
                    this.style.borderColor = '#222222';
                    this.style.borderWidth = '3px';
                });
            });

            // ── Tension slider ──
            if (slider) {
                slider.addEventListener('input', function () {
                    var val = this.value;
                    tensionDisplay.textContent = val + ' LBS';
                    var strokeW = 0.75 + (val - 20) * (0.75 / 15);
                    gsap.set('.racket-string', { strokeWidth: strokeW });
                    if (frame) {
                        gsap.to(frame, {
                            keyframes: [
                                { rotation: 0.3, duration: 0.03 },
                                { rotation: -0.3, duration: 0.03 },
                                { rotation: 0.2, duration: 0.03 },
                                { rotation: -0.2, duration: 0.03 },
                                { rotation: 0, duration: 0.03 },
                            ],
                            transformOrigin: '50% 50%',
                        });
                    }
                });
            }

            // ════════════════════════════════════════════
            // MODAL PENGIRIMAN LOGIC
            // ════════════════════════════════════════════
            var openBtn = document.getElementById('openShippingModal');
            var closeBtn = document.getElementById('closeShippingModal');
            var modal = document.getElementById('shippingModal');
            var modalBox = document.getElementById('shippingModalBox');
            var confirmBtn = document.getElementById('confirmBuyButton');
            var spinner = document.getElementById('confirmBuySpinner');
            var confirmLabel = document.getElementById('confirmBuyLabel');
            var globalError = document.getElementById('modalGlobalError');

            function openModal() {
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                gsap.to(modalBox, {
                    scale: 1,
                    opacity: 1,
                    duration: 0.35,
                    ease: 'back.out(1.4)',
                });
            }

            function closeModal() {
                gsap.to(modalBox, {
                    scale: 0.9,
                    opacity: 0,
                    duration: 0.25,
                    ease: 'power2.in',
                    onComplete: function () {
                        modal.style.display = 'none';
                        document.body.style.overflow = '';
                        clearErrors();
                    },
                });
            }

            function clearErrors() {
                ['shippingNameError', 'shippingPhoneError', 'shippingAddressError'].forEach(function (id) {
                    document.getElementById(id).style.display = 'none';
                });
                globalError.classList.add('hidden');
                globalError.textContent = '';
            }

            function showFieldError(id, show) {
                document.getElementById(id).style.display = show ? 'block' : 'none';
            }

            function validateForm() {
                var name    = document.getElementById('shippingName').value.trim();
                var phone   = document.getElementById('shippingPhone').value.trim();
                var address = document.getElementById('shippingAddress').value.trim();
                var valid   = true;

                clearErrors();

                if (!name) { showFieldError('shippingNameError', true); valid = false; }
                if (!phone || phone.replace(/\D/g, '').length < 9) { showFieldError('shippingPhoneError', true); valid = false; }
                if (!address) { showFieldError('shippingAddressError', true); valid = false; }

                return valid;
            }

            if (openBtn) {
                openBtn.addEventListener('click', openModal);
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', closeModal);
            }

            // Klik backdrop untuk tutup modal
            if (modal) {
                modal.addEventListener('click', function (e) {
                    if (e.target === modal) { closeModal(); }
                });
            }

            // Escape key
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && modal && modal.style.display !== 'none') {
                    closeModal();
                }
            });

            // ── Konfirmasi & Bayar ──
            if (confirmBtn) {
                confirmBtn.addEventListener('click', function () {
                    if (!validateForm()) {
                        gsap.to(modalBox, {
                            x: [-8, 8, -5, 5, 0],
                            duration: 0.35,
                            ease: 'power2.inOut',
                        });
                        return;
                    }

                    var name    = document.getElementById('shippingName').value.trim();
                    var phone   = document.getElementById('shippingPhone').value.trim();
                    var address = document.getElementById('shippingAddress').value.trim();
                    var notes   = document.getElementById('shippingNotes').value.trim();

                    // Tampilkan loading state
                    confirmBtn.disabled = true;
                    spinner.classList.remove('hidden');
                    confirmLabel.textContent = 'Memproses...';

                    gsap.to(confirmBtn, { scale: 0.97, duration: 0.1, yoyo: true, repeat: 1 });

                    fetch('{{ route("products.buy", $product) }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            shipping_name:    name,
                            shipping_phone:   phone,
                            shipping_address: address,
                            notes:            notes,
                        }),
                    })
                    .then(function (res) {
                        if (res.status === 401) {
                            window.location.href = '/login';
                            return Promise.reject('unauthenticated');
                        }
                        return res.json().then(function (data) {
                            if (!res.ok) {
                                throw new Error(data.message || data.error || 'Gagal memproses pesanan.');
                            }
                            return data;
                        });
                    })
                    .then(function (data) {
                        if (data && data.is_dummy) {
                            // Tutup modal dengan animasi lalu redirect
                            closeModal();
                            setTimeout(function () {
                                window.location.href = '/dummy-payment?order_id=' + data.order_id
                                    + '&product=' + encodeURIComponent(data.product)
                                    + '&amount=' + data.amount;
                            }, 300);
                        } else if (data && data.snap_token) {
                            closeModal();
                            snap.pay(data.snap_token, {
                                onSuccess: function () {
                                    window.location.reload();
                                },
                                onPending: function () {
                                    alert('Pembayaran dalam proses. Cek email Anda untuk konfirmasi.');
                                },
                                onError: function () {
                                    alert('Pembayaran gagal. Silakan coba kembali.');
                                },
                                onClose: function () {
                                    // Pengguna menutup popup Midtrans
                                },
                            });
                        } else if (data && data.error) {
                            globalError.textContent = data.error;
                            globalError.classList.remove('hidden');
                        }
                    })
                    .catch(function (err) {
                        if (err !== 'unauthenticated') {
                            globalError.textContent = err.message || 'Terjadi kesalahan. Coba lagi.';
                            globalError.classList.remove('hidden');
                        }
                    })
                    .finally(function () {
                        confirmBtn.disabled = false;
                        spinner.classList.add('hidden');
                        confirmLabel.textContent = 'Konfirmasi & Bayar Sekarang';
                    });
                });
            }
        });
    </script>

</body>
</html>
