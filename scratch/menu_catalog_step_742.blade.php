Created At: 2026-05-25T10:00:32Z
Completed At: 2026-05-25T10:00:32Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 493
Total Bytes: 27242
Showing lines 70 to 125
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
70:                     $sugarGrade = (($menu->id % 2) === 0) ? 'B' : 'C';
71:                     $sugarColor = $sugarGrade === 'B' ? 'bg-emerald-500 text-white' : 'bg-amber-500 text-white';
72:                 }
73:             @endphp
74:             <div
75:                 class="group border border-[#222222] bg-[#191919] rounded-[32px] p-5 flex flex-col justify-between transition-all duration-300 hover:scale-[1.02] {{ $color['border'] }} {{ $color['glow'] }} {{ $gridClass }}"
76:                 data-menu-id="{{ $menu->id }}"
77:                 wire:key="menu-{{ $menu->id }}"
78:             >
79:                 {{-- Food Image --}}
80:                 <div class="ck-menu-card__img-wrap {{ $imgAspect }} overflow-hidden rounded-[24px] relative cursor-pointer" wire:click="openModal({{ $menu->id }})">
81:                     <img
82:                         src="{{ $menu->image_url ? (Str::startsWith($menu->image_url, ['http://', 'https://']) ? $menu->image_url : Storage::url($menu->image_url)) : 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600&auto=format&fit=crop&q=80' }}"
83:                         alt="{{ $menu->name }}"
84:                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
85:                         loading="lazy"
86:                         onerror="this.src='https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600&auto=format&fit=crop&q=80'"
87:                     >
88:                     {{
<truncated 719 bytes>
tify-center text-[11px] font-black {{ $sugarColor }} shadow-md" title="Sugar Grade (Kemenkes)">
97:                             {{ $sugarGrade }}
98:                         </span>
99:                     </div>
100:                 </div>
101: 
102:                 {{-- Card Body --}}
103:                 <div class="flex flex-col flex-1 mt-4">
104:                     <h3 class="text-lg font-bold text-[#fffce1] tracking-tight cursor-pointer transition-colors {{ $color['text'] }}" wire:click="openModal({{ $menu->id }})">
105:                         {{ $menu->name }}
106:                     </h3>
107:                     <p class="text-sm text-[#bbbaa6] line-clamp-2 mt-1 flex-1">{{ $menu->description }}</p>
108: 
109:                     <div class="flex items-center justify-between mt-4">
110:                         <span class="text-lg font-extrabold text-[#fffce1]">
111:                             Rp {{ number_format($menu->price, 0, ',', '.') }}
112:                         </span>
113:                         <button
114:                             wire:click="addToCart({{ $menu->id }})"
115:                             class="w-11 h-11 rounded-full flex items-center justify-center text-white transition-all duration-300 {{ $color['badge'] }} hover:scale-110 active:scale-95 cursor-pointer shadow-md"
116:                         >
117:                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
118:                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
119:                             </svg>
120:                         </button>
121:                     </div>
122:                 </div>
123:             </div>
124:         @empty
125:             <div class="col-span-full text-center py-24 text-slate-400">
The above content does NOT show the entire file contents. If you need to view any lines of the file which were not shown to complete your task, call this tool again to view those lines.
