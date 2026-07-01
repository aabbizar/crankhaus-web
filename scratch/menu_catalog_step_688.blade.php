Created At: 2026-05-25T09:58:00Z
Completed At: 2026-05-25T09:58:00Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 493
Total Bytes: 27242
Showing lines 1 to 400
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
1: <div class="w-full">
2: 
3:     {{-- ══ FILTER TABS ══════════════════════════════════════════════════════ --}}
4:     <div class="flex items-center justify-center gap-3 mb-12 flex-wrap" id="filterTabs">
5:         @php
6:             $tabs = [
7:                 'all'           => 'Semua Menu',
8:                 'Makanan Utama' => '🍜 Makanan Utama',
9:                 'Cemilan'       => '🥟 Cemilan',
10:                 'Minuman'       => '🥤 Minuman',
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
28:     {{-- ══ MENU GRID (MONDRIAN LAYOUT) ═════════════════════════════════════ --}}
29:     <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-10 grid-fl
<truncated 21921 bytes>
───────────────────────────────────────────────
367:     $wire.on('cart-updated', (e) => {
368:         if (window.showToast) {
369:             let itemName = "Menu";
370:             if (e && e[0] && e[0].addedName) itemName = e[0].addedName;
371:             else if (e && e.addedName) itemName = e.addedName;
372:             window.showToast("Berhasil", itemName + " ditambahkan ke tray.", "success");
373:         }
374:     });
375: 
376:     $wire.on('order-confirmed', () => {
377:         if (window.showToast) window.showToast("Pesanan Berhasil Dikirim!");
378:     });
379: 
380:     // ── Modal Intense GSAP Animation ─────────────────────────────────────────
381:     window.initDetailModal = function(menuId) {
382:         const modal = document.getElementById('foodModal');
383:         const backdrop = document.querySelector('.ck-modal-backdrop');
384:         const frame = document.getElementById('modalImgFrame');
385:         
386:         if (!modal || !backdrop) return;
387: 
388:         // Custom split text function since SplitText plugin is not included
389:         function simpleSplitText(selector) {
390:             const el = document.querySelector(selector);
391:             if (!el) return [];
392:             const text = el.innerText;
393:             el.innerHTML = '';
394:             const spans = [];
395:             text.split('').forEach(char => {
396:                 const span = document.createElement('span');
397:                 span.style.display = 'inline-block';
398:                 span.style.opacity = '0';
399:                 span.innerText = char === ' ' ? '\u00A0' : char;
400:                 el.appendChild(span);
The above content does NOT show the entire file contents. If you need to view any lines of the file which were not shown to complete your task, call this tool again to view those lines.
