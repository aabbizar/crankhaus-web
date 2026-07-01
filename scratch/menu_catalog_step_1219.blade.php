Created At: 2026-05-25T18:13:45Z
Completed At: 2026-05-25T18:13:45Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 455
Total Bytes: 24915
Showing lines 1 to 100
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
1: <div class="w-full">
2: 
3:     {{-- ══ FILTER TABS (HIDDEN PER USER REQUEST FOR MINIMALISM) ══════════════════════════════════════════════════════ --}}
4:     <div class="hidden items-center justify-center gap-4 mb-20 flex-wrap" id="filterTabs">
5:         @php
6:             $tabs = [
7:                 'all'           => 'Semua Menu',
8:                 'Makanan Utama' => 'Makanan Utama',
9:                 'Cemilan'       => 'Cemilan',
10:                 'Minuman'       => 'Minuman',
11:             ];
12:         @endphp
13:         @foreach ($tabs as $key => $label)
14:             <button
15:                 wire:click="setCategory('{{ $key }}')"
16:                 id="filter-{{ $key }}"
17:                 onclick="captureFlipState()"
18:                 class="ck-filter-tab {{ $activeCategory === $key ? 'ck-filter-tab--active' : '' }}"
19:             >
20:                 {{ $label }}
21:                 @if($key !== 'all' && isset($categoryCounts[$key]))
22:                     <span class="ck-filter-badge">{{ $categoryCounts[$key] }}</span>
23:                 @endif
24:             </button>
25:         @endforeach
26:     </div>
27: 
28:     {{-- ══ MENU GRID (FLUENT GRID) ═════════════════════════════════════ --}}
29:     <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5
<truncated 3271 bytes>
e-clamp-1" wire:click="openModal({{ $menu->id }})">
68:                         {{ $menu->name }}
69:                     </h3>
70: 
71:                     <div class="flex items-center justify-between mt-3">
72:                         <span class="ck-menu-card-price text-sm font-extrabold text-[#fffce1]">
73:                             Rp {{ number_format($menu->price, 0, ',', '.') }}
74:                         </span>
75:                         <button
76:                             wire:click="addToCart({{ $menu->id }})"
77:                             class="w-8 h-8 rounded-full flex items-center justify-center text-white transition-all duration-300 {{ $color['badge'] }} hover:scale-110 active:scale-95 cursor-pointer shadow-md"
78:                         >
79:                             <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
80:                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
81:                             </svg>
82:                         </button>
83:                     </div>
84:                 </div>
85:             </div>
86:         @empty
87:             <div class="col-span-full text-center py-24 text-slate-400">
88:                 <p class="text-lg font-medium">Menu tidak tersedia</p>
89:             </div>
90:         @endforelse
91:     </div>
92: 
93:     {{-- ══ FLOATING CART BUTTON ════════════════════════════════════════════ --}}
94:     @if($cartCount > 0)
95:         <div class="fixed bottom-8 right-8 z-40" wire:ignore.self>
96:             <button
97:                 wire:click="openCheckout"
98:                 class="ck-cart-fab magnet-btn"
99:                 id="cartFab"
100:             >
The above content does NOT show the entire file contents. If you need to view any lines of the file which were not shown to complete your task, call this tool again to view those lines.
