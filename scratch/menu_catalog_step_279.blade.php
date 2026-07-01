Created At: 2026-05-25T08:54:11Z
Completed At: 2026-05-25T08:54:11Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 460
Total Bytes: 23572
Showing lines 125 to 169
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
125:                 class="ck-cart-fab magnet-btn"
126:                 id="cartFab"
127:             >
128:                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
129:                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m1.6 8L5 6m2 7a2 2 0 100 4 2 2 0 000-4zm10 0a2 2 0 100 4 2 2 0 000-4z"/>
130:                 </svg>
131:                 <span class="ck-cart-fab__count">{{ $cartCount }}</span>
132:                 <span class="text-sm ml-2 font-bold">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
133:             </button>
134:         </div>
135:     @endif
136: 
137:     {{-- ══ FOOD DETAIL MODAL ══════════════════════════════════════════════ --}}
138:     @if($showModal && $selectedMenu)
139:         <div
140:             class="ck-modal-backdrop"
141:             wire:click.self="closeModal"
142:             x-data
143:             x-init="initDetailModal({{ $selectedMenu->id }})"
144:         >
145:             <div class="ck-modal" id="foodModal">
146:                 {{-- Close Button --}}
147:                 <button wire:click="closeModal" class="ck-modal__close magnet-btn">
148:                     <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
149:                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
150:                     </svg>
151:                 </button>
152: 
153:                 <div class="ck-modal__inner">
154:                     {{-- Left: 3D Tilt Image --}}
155:                     <div class="ck-modal__img-side" id="modalImgSide">
156:                         <div class="ck-modal__img-frame" id="modalImgFrame">
157:                             <img 
158:                                 src="{{ $selectedMenu->image_url ? (Str::startsWith($selectedMenu->image_url, ['http://', 'https://']) ? $selectedMenu->image_url : Storage::url($selectedMenu->image_url)) : 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600&auto=format&fit=crop&q=80' }}" 
159:                                 alt="{{ $selectedMenu->name }}"
160:                                 class="ck-modal__img"
161:                                 id="modalImg"
162:                                 onerror="this.src='https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600&auto=format&fit=crop&q=80'"
163:                             >
164:                             <div class="ck-modal__cat-pill" id="modalCatPill">{{ $selectedMenu->category }}</div>
165:                         </div>
166:                     </div>
167: 
168:                     {{-- Right: Details --}}
169:                     <div class="ck-modal__detail-side" id="modalDetailSide">
The above content does NOT show the entire file contents. If you need to view any lines of the file which were not shown to complete your task, call this tool again to view those lines.
