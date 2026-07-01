<div class="space-y-12">
    {{-- Search Bar (Pop Art / Brutalism) --}}
    <div class="relative max-w-2xl mx-auto">
        <input type="text" wire:model.live.debounce.300ms="search"
               placeholder="Cari raket, sepatu, apparel..."
               class="w-full h-16 pl-14 pr-6 rounded-none brutal-border brutal-shadow naive-box bg-white text-lg font-bold text-black focus:outline-none focus:ring-4 focus:ring-[#06b6d4] transition-all font-body">
        <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-black" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
        </svg>
    </div>

    {{-- Category Pills (Kidcore / Pop Art) --}}
    <div class="flex items-center justify-center gap-3 flex-wrap">
        <button wire:click="setCategory('all')"
                class="cat-pill px-6 py-3 text-[14px] font-900 transition-transform duration-300 font-nav uppercase brutal-border brutal-shadow naive-box
                       {{ $activeCategory === 'all' ? 'bg-[#ff385c] text-white -rotate-2 scale-110' : 'bg-[#fde047] text-black hover:-rotate-2 hover:bg-[#ff385c] hover:text-white' }}">
            Semua ({{ $totalProducts }})
        </button>
        @foreach ($validCategories as $cat)
            @php
                $pillColors = ['bg-[#06b6d4]', 'bg-[#a3e635]', 'bg-[#fde047]', 'bg-[#ec4899]', 'bg-white'];
                $randomColor = $pillColors[crc32($cat) % count($pillColors)];
            @endphp
            <button wire:click="setCategory('{{ $cat }}')"
                    class="cat-pill px-6 py-3 text-[14px] font-900 transition-transform duration-300 font-nav uppercase brutal-border brutal-shadow naive-box-alt
                           {{ $activeCategory === $cat ? 'bg-[#ff385c] text-white rotate-2 scale-110' : $randomColor . ' text-black hover:rotate-2 hover:bg-[#ff385c] hover:text-white' }}">
                {{ $cat }}
                <span class="ml-1 opacity-80">({{ $categoryCounts[$cat] ?? 0 }})</span>
            </button>
        @endforeach
    </div>

    {{-- Product Grid (Vaporwave Luxury Minimalist) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="catalogGrid">
        @forelse ($products as $product)
            @php
                $badgeClass = 'bg-[#fde047] text-black';
                if ($product->brand === 'Li-Ning') $badgeClass = 'bg-[#ff385c] text-white';
                if ($product->brand === 'Victor')  $badgeClass = 'bg-[#06b6d4] text-white';
                if ($product->brand === 'Felet')   $badgeClass = 'bg-black text-[#a3e635]';
            @endphp
            <div class="catalog-card catalog-card-wrap" data-flip-id="product-{{ $product->id }}">
                <a href="{{ route('products.show', $product->slug) }}"
                   class="group block vapor-glass rounded-2xl overflow-hidden brutal-border hover:-translate-y-3 transition-transform duration-500 h-full flex flex-col relative">
                    
                    {{-- Soft Vaporwave Glow --}}
                    <div class="absolute inset-0 bg-gradient-to-tr from-white/10 via-white/40 to-transparent pointer-events-none z-10"></div>

                    {{-- Image Area --}}
                    <div class="aspect-[4/3] bg-white/50 flex items-center justify-center relative overflow-hidden card-visual border-b-2 border-black">
                        {{-- Brand Initial --}}
                        <div class="brand-initial text-7xl font-black transition-transform duration-500 font-blackhan opacity-80 group-hover:scale-110 group-hover:opacity-100">
                            @switch($product->brand)
                                @case('Yonex') <span class="text-[#cc1a1a] text-7xl font-blackhan">YY</span> @break
                                @case('Li-Ning') <span class="text-[#e31b23] text-7xl font-blackhan italic">LN</span> @break
                                @case('Victor') <span class="text-[#005bac] text-7xl font-blackhan">V</span> @break
                                @case('Felet') <span class="text-[#1a1a1a] text-7xl font-blackhan">F</span> @break
                                @default <span class="text-[#ff385c] text-6xl">●</span>
                            @endswitch
                        </div>
                        
                        {{-- Brand Badge (Kidcore/Brutal) --}}
                        <span class="absolute top-4 left-4 text-[12px] font-900 px-4 py-1 naive-box brutal-border brutal-shadow font-nav uppercase tracking-wider z-20 {{ $badgeClass }}">
                            {{ $product->brand }}
                        </span>

                        {{-- Stock Badge --}}
                        @if ($product->stock < 5)
                            <span class="absolute top-4 right-4 bg-black text-[#ff385c] text-[12px] font-900 px-4 py-1 naive-box-alt brutal-border brutal-shadow font-nav uppercase tracking-wider z-20">Stok Tipis</span>
                        @endif
                    </div>

                    {{-- Info Area --}}
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-4 relative z-20 bg-white/60">
                        <div>
                            <h3 class="text-[18px] font-900 text-black leading-snug line-clamp-2 group-hover:text-[#ff385c] transition-colors font-nav uppercase">
                                {{ $product->name }}
                            </h3>
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-[12px] font-bold bg-black text-white px-2 py-0.5 rounded-sm uppercase font-nav">{{ $product->category }}</span>
                                <span class="text-[12px] font-bold text-black border-b-2 border-black">{{ $product->stock }} left</span>
                            </div>
                        </div>
                        <div class="pt-4 border-t-2 border-black flex items-center justify-between">
                            <p class="text-[20px] font-900 text-black font-nav tracking-tight">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            <button onclick="event.preventDefault(); event.stopPropagation(); window.buyNow({{ $product->id }})"
                                    class="text-[12px] font-900 text-black bg-[#a3e635] naive-box px-5 py-2 brutal-border brutal-shadow hover:bg-[#fde047] transition-colors font-nav uppercase">
                                BELI
                            </button>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <div class="col-span-full text-center py-32 brutal-border brutal-shadow naive-box bg-white">
                <div class="text-[64px] mb-4 animate-bounce">🏸</div>
                <p class="text-black text-[24px] font-900 font-nav uppercase">Oops! Kosong Bro</p>
                <p class="text-[#6a6a6a] text-[16px] mt-2 font-bold font-body border-t-2 border-black pt-4 max-w-xs mx-auto">Coba cari keyword atau kategori lain yang lebih masuk akal.</p>
            </div>
        @endforelse
    </div>
</div>

@script
<script>
    $wire.on('catalog-loaded', () => {
        // Triggered when Livewire updates
    });
</script>
@endscript
