Created At: 2026-05-25T08:54:16Z
Completed At: 2026-05-25T08:54:16Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 460
Total Bytes: 23572
Showing lines 168 to 220
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
168:                     {{-- Right: Details --}}
169:                     <div class="ck-modal__detail-side" id="modalDetailSide">
170:                         <div class="ck-modal__eyebrow" id="modalEyebrow">CRANKHAUS KITCHEN</div>
171:                         <h2 class="ck-modal__name" id="modalMenuName">{{ $selectedMenu->name }}</h2>
172:                         <p class="ck-modal__desc-full" id="modalMenuDesc">{{ $selectedMenu->description }}</p>
173: 
174:                         <div class="ck-modal__meta" id="modalMeta">
175:                             <div class="ck-modal__meta-item">
176:                                 <span class="ck-modal__meta-label">KATEGORI</span>
177:                                 <span class="ck-modal__meta-value">{{ $selectedMenu->category }}</span>
178:                             </div>
179:                             <div class="ck-modal__meta-item">
180:                                 <span class="ck-modal__meta-label">STATUS</span>
181:                                 <span class="ck-modal__meta-value {{ $selectedMenu->is_available ? 'text-emerald-600' : 'text-red-500' }}">
182:                                     {{ $selectedMenu->is_available ? '✓ Tersedia' : '✗ Habis' }}
183:                                 </span>
184:                             </div>
185:                         </div>
186: 
187:                         <div class="ck-modal__price-row" id="modalPrice">
188:                             <span class="ck-modal__price">Rp {{ numbe
<truncated 214 bytes>
 class="flex gap-4 mt-8" id="modalActions">
193:                             @if($selectedMenu->is_available)
194:                                 <button
195:                                     wire:click="addSelectedToCartAndClose"
196:                                     class="ck-btn-primary magnet-btn flex-1 text-lg py-4"
197:                                     id="modalAddBtn"
198:                                 >
199:                                     + Tambah ke Keranjang
200:                                 </button>
201:                             @else
202:                                 <div class="ck-btn-primary flex-1 opacity-40 cursor-not-allowed text-center text-lg py-4">Menu Habis</div>
203:                             @endif
204:                         </div>
205:                     </div>
206:                 </div>
207:             </div>
208:         </div>
209:     @endif
210: 
211:     {{-- ══ CART / CHECKOUT DRAWER ══════════════════════════════════════════ --}}
212:     @if($showCheckout)
213:         <div class="ck-modal-backdrop !opacity-100" wire:click.self="closeCheckout">
214:             <div class="ck-checkout-drawer !opacity-100 !transform-none !scale-100">
215:                 <div class="ck-checkout-drawer__header">
216:                     <h3 class="ck-checkout-drawer__title">Keranjang Pesanan</h3>
217:                     <button wire:click="closeCheckout" class="ck-modal__close magnet-btn" style="position:relative;top:0;right:0;">
218:                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
219:                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
220:                         </svg>
The above content does NOT show the entire file contents. If you need to view any lines of the file which were not shown to complete your task, call this tool again to view those lines.
