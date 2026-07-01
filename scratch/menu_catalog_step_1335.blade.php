Created At: 2026-05-25T19:11:28Z
Completed At: 2026-05-25T19:11:28Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 332
Total Bytes: 19070
Showing lines 1 to 332
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
1: <div class="w-full">
2: 
3:     <!-- Category Filter Tabs (GSAP Flip trigger) -->
4:     <div class="flex items-center justify-start gap-2 overflow-x-auto pb-4 mb-6 scrollbar-hide">
5:         <button 
6:             wire:click="setCategory('all')" 
7:             onclick="captureFlipState()" 
8:             class="px-4 py-2 rounded-full text-xs font-bold tracking-wider uppercase border border-[#222222] transition-all {{ $activeCategory === 'all' ? 'bg-[#ff8709] text-[#0e100f]' : 'bg-[#111111] text-[#fffce1] hover:border-[#ff8709]' }}"
9:         >
10:             ALL
11:         </button>
12:         <button 
13:             wire:click="setCategory('Makanan Utama')" 
14:             onclick="captureFlipState()" 
15:             class="px-4 py-2 rounded-full text-xs font-bold tracking-wider uppercase border border-[#222222] transition-all {{ $activeCategory === 'Makanan Utama' ? 'bg-[#ff8709] text-[#0e100f]' : 'bg-[#111111] text-[#fffce1] hover:border-[#ff8709]' }}"
16:         >
17:             NOODLES
18:         </button>
19:         <button 
20:             wire:click="setCategory('Cemilan')" 
21:             onclick="captureFlipState()" 
22:             class="px-4 py-2 rounded-full text-xs font-bold tracking-wider uppercase border border-[#222222] transition-all {{ $activeCategory === 'Cemilan' ? 'bg-[#ff8709] text-[#0e100f]' : 'bg-[#111111] text-[#fffce1] hover:border-[#ff8709]' }}"
23:         >
24:             DIMSUM
25:         </button>
26:         <button 
27:             wire:click="s
<truncated 17132 bytes>
,
287:                 { opacity: 1, y: 0, scale: 1, duration: 0.8, stagger: 0.08, ease: 'power3.out' }
288:             );
289:         }
290:     };
291: 
292:     // Trigger grid cards entry
293:     setTimeout(animateGridCards, 200);
294: 
295:     // ── capture flip state hook ──────────────────────────────────────────────
296:     let flipState = null;
297:     window.captureFlipState = function() {
298:         if (window.Flip) {
299:             flipState = window.Flip.getState('.menu-card');
300:         }
301:     };
302: 
303:     $wire.on('category-changed', () => {
304:         setTimeout(() => {
305:             if (flipState && window.Flip) {
306:                 window.Flip.from(flipState, {
307:                     duration: 0.6,
308:                     ease: 'power3.inOut',
309:                     stagger: 0.04,
310:                     scale: true,
311:                     onEnter: els => window.gsap.fromTo(els, { opacity: 0, scale: 0.8 }, { opacity: 1, scale: 1, duration: 0.4 }),
312:                     onLeave: els => window.gsap.to(els, { opacity: 0, scale: 0.8, duration: 0.3 })
313:                 });
314:             }
315:         }, 30);
316:     });
317: 
318:     // ── auto focus on success confirmation ───────────────────────────────────
319:     $wire.on('order-confirmed', () => {
320:         setTimeout(() => {
321:             const card = document.getElementById('successCard');
322:             if (card && window.gsap) {
323:                 window.gsap.fromTo(card,
324:                     { scale: 0.8, opacity: 0, y: 50 },
325:                     { scale: 1, opacity: 1, y: 0, duration: 0.6, ease: 'back.out(1.4)' }
326:                 );
327:             }
328:         }, 50);
329:     });
330: </script>
331: @endscript
332: 
The above content shows the entire, complete file contents of the requested file.
