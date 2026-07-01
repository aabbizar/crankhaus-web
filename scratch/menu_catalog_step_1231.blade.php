Created At: 2026-05-25T18:14:32Z
Completed At: 2026-05-25T18:14:32Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 455
Total Bytes: 24915
Showing lines 150 to 250
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
150:                                 $modalSugarGrade = (($selectedMenu->id % 2) === 0) ? 'C' : 'D';
151:                                 $modalSugarColor = $modalSugarGrade === 'C' ? 'bg-amber-500 text-white' : 'bg-red-600 text-white';
152:                             } else {
153:                                 $modalCalorie = (($selectedMenu->id * 19) % 180) + 180;
154:                                 $modalSugarGrade = (($selectedMenu->id % 2) === 0) ? 'B' : 'C';
155:                                 $modalSugarColor = $modalSugarGrade === 'B' ? 'bg-emerald-500 text-white' : 'bg-amber-500 text-white';
156:                             }
157:                         @endphp
158:                         <div class="ck-modal__eyebrow" id="modalEyebrow">CRANKHAUS KITCHEN</div>
159:                         <h2 class="ck-modal__name" id="modalMenuName">{{ $selectedMenu->name }}</h2>
160:                         <p class="ck-modal__desc-full" id="modalMenuDesc">{{ $selectedMenu->description }}</p>
161: 
162:                         <div class="ck-modal__meta" id="modalMeta">
163:                             <div class="ck-modal__meta-item">
164:                                 <span class="ck-modal__meta-label">KATEGORI</span>
165:                                 <span class="ck-modal__meta-value">{{ $selectedMenu->category }}</span>
166:                             </div>
167:                             <div class="ck-modal__meta-item">
168:                                 <span class="ck-modal__meta
<truncated 3274 bytes>
21:                     @foreach($cart as $key => $item)
222:                         <div class="ck-cart-item">
223:                             <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="ck-cart-item__img"
224:                                  onerror="this.src='https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=200&auto=format&fit=crop'">
225:                             <div class="flex-1">
226:                                 <p class="ck-cart-item__name">{{ $item['name'] }}</p>
227:                                 <p class="ck-cart-item__price">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
228:                             </div>
229:                             <div class="ck-qty-ctrl">
230:                                 <button wire:click="decrementQty({{ $item['id'] }})" class="ck-qty-btn">−</button>
231:                                 <span class="ck-qty-value">{{ $item['quantity'] }}</span>
232:                                 <button wire:click="incrementQty({{ $item['id'] }})" class="ck-qty-btn">+</button>
233:                             </div>
234:                         </div>
235:                     @endforeach
236:                 </div>
237: 
238:                 {{-- Total --}}
239:                 <div class="ck-checkout-total">
240:                     <span class="text-sm font-medium">Total</span>
241:                     <span class="text-2xl font-bold">
242:                         Rp {{ number_format($cartTotal, 0, ',', '.') }}
243:                     </span>
244:                 </div>
245: 
246:                 {{-- Customer Form --}}
247:                 <div class="ck-checkout-form">
248:                     <div class="ck-form-group">
249:                         <label class="ck-form-label">Nama Pelanggan</label>
250:                         <input
The above content does NOT show the entire file contents. If you need to view any lines of the file which were not shown to complete your task, call this tool again to view those lines.
