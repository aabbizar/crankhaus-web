Created At: 2026-05-25T08:53:37Z
Completed At: 2026-05-25T08:53:37Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 419
Total Bytes: 21359
Showing lines 25 to 80
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
25:         @endforeach
26:     </div>
27: 
28:     {{-- ══ MENU GRID ════════════════════════════════════════════════════════ --}}
29:     <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6" id="menuGrid">
30:         @forelse ($menus as $menu)
31:             <div
32:                 class="ck-menu-card group"
33:                 data-menu-id="{{ $menu->id }}"
34:                 wire:key="menu-{{ $menu->id }}"
35:             >
36:                 {{-- Food Image --}}
37:                 <div class="ck-menu-card__img-wrap" wire:click="openModal({{ $menu->id }})">
38:                     <img
39:                         src="{{ $menu->image_url ? (Str::startsWith($menu->image_url, ['http://', 'https://']) ? $menu->image_url : Storage::url($menu->image_url)) : 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600&auto=format&fit=crop&q=80' }}"
40:                         alt="{{ $menu->name }}"
41:                         class="ck-menu-card__img"
42:                         loading="lazy"
43:                         onerror="this.src='https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600&auto=format&fit=crop&q=80'"
44:                     >
45:                     {{-- Category Badge --}}
46:                     <span class="ck-menu-card__badge">{{ $menu->category }}</span>
47:                 </div>
48: 
49:                 {{-- Card Body --}}
50:                 <div class="ck-menu-card__body">
51:                     <h3 class="ck-menu-card__title" wire:click="openModal({{ $menu->id }})">
52:                         {{ $menu->name }}
53:                     </h3>
54:                     <p class="ck-menu-card__desc">{{ $menu->description }}</p>
55: 
56:                     <div class="flex items-center justify-between mt-auto pt-2">
57:                         <span class="ck-menu-card__price">
58:                             Rp {{ number_format($menu->price, 0, ',', '.') }}
59:                         </span>
60:                         <button
61:                             wire:click="addToCart({{ $menu->id }})"
62:                             class="ck-btn-add magnet-btn"
63:                         >
64:                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
65:                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
66:                             </svg>
67:                         </button>
68:                     </div>
69:                 </div>
70:             </div>
71:         @empty
72:             <div class="col-span-full text-center py-24 text-slate-400">
73:                 <div class="text-6xl mb-4">🍽️</div>
74:                 <p class="text-lg font-medium">Menu tidak tersedia</p>
75:             </div>
76:         @endforelse
77:     </div>
78: 
79:     {{-- ══ FLOATING CART BUTTON ════════════════════════════════════════════ --}}
80:     @if($cartCount > 0)
The above content does NOT show the entire file contents. If you need to view any lines of the file which were not shown to complete your task, call this tool again to view those lines.
