Created At: 2026-05-25T08:30:42Z
Completed At: 2026-05-25T08:30:42Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 419
Total Bytes: 21382
Showing lines 1 to 419
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
28:     {{-- ══ MENU GRID ════════════════════════════════════════════════════════ --}}
29:     <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4
<truncated 19879 bytes>
EventListener('mouseleave', () => {
375:                     gsap.to(frame, { rotationY: 0, rotationX: 0, duration: 0.8, ease: 'elastic.out(1, 0.3)' });
376:                 });
377:             }
378:         }
379:     };
380: 
381:     // ── Order success animation ──────────────────────────────────────────────
382:     window.animateSuccess = function() {
383:         const card = document.getElementById('successCard');
384:         if (!card || !window.gsap) return;
385: 
386:         gsap.fromTo(card,
387:             { opacity: 0, scale: 0.85, y: 50 },
388:             { opacity: 1, scale: 1, y: 0, duration: 0.6, ease: 'back.out(1.7)' }
389:         );
390: 
391:         const queue = card.querySelector('.ck-success-queue');
392:         if (queue) {
393:             gsap.fromTo(queue,
394:                 { scale: 0, opacity: 0 },
395:                 { scale: 1, opacity: 1, duration: 0.8, ease: 'elastic.out(1, 0.5)', delay: 0.3 }
396:             );
397:         }
398:     };
399: 
400:     // ── Init effects on mount ────────────────────────────────────────────────
401:     const initCardsAnimation = () => {
402:         if (window.gsap && window.ScrollTrigger) {
403:             gsap.fromTo('.ck-menu-card',
404:                 { y: 60, opacity: 0, scale: 0.95 },
405:                 {
406:                     y: 0, opacity: 1, scale: 1, duration: 0.8, stagger: 0.05, ease: 'power4.out',
407:                     scrollTrigger: { trigger: '#menuGrid', start: 'top 90%' }
408:                 }
409:             );
410:         }
411:     };
412: 
413:     document.addEventListener('livewire:navigated', initCardsAnimation);
414: 
415:     // First load
416:     setTimeout(initCardsAnimation, 300);
417: </script>
418: @endscript
419: 
The above content shows the entire, complete file contents of the requested file.
