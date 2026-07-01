Created At: 2026-05-25T16:51:23Z
Completed At: 2026-05-25T16:51:23Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 493
Total Bytes: 27316
Showing lines 1 to 493
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
1: <div class="w-full">
2: 
3:     {{-- ══ FILTER TABS ══════════════════════════════════════════════════════ --}}
4:     <div class="flex items-center justify-center gap-4 mb-20 flex-wrap" id="filterTabs">
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
<truncated 26183 bytes>
EventListener('mouseleave', () => {
449:                     gsap.to(frame, { rotationY: 0, rotationX: 0, duration: 0.8, ease: 'elastic.out(1, 0.3)' });
450:                 });
451:             }
452:         }
453:     };
454: 
455:     // ── Order success animation ──────────────────────────────────────────────
456:     window.animateSuccess = function() {
457:         const card = document.getElementById('successCard');
458:         if (!card || !window.gsap) return;
459: 
460:         gsap.fromTo(card,
461:             { opacity: 0, scale: 0.85, y: 50 },
462:             { opacity: 1, scale: 1, y: 0, duration: 0.6, ease: 'back.out(1.7)' }
463:         );
464: 
465:         const queue = card.querySelector('.ck-success-queue');
466:         if (queue) {
467:             gsap.fromTo(queue,
468:                 { scale: 0, opacity: 0 },
469:                 { scale: 1, opacity: 1, duration: 0.8, ease: 'elastic.out(1, 0.5)', delay: 0.3 }
470:             );
471:         }
472:     };
473: 
474:     // ── Init effects on mount ────────────────────────────────────────────────
475:     const initCardsAnimation = () => {
476:         if (window.gsap && window.ScrollTrigger) {
477:             gsap.fromTo('.ck-menu-card',
478:                 { y: 60, opacity: 0, scale: 0.95 },
479:                 {
480:                     y: 0, opacity: 1, scale: 1, duration: 0.8, stagger: 0.05, ease: 'power4.out',
481:                     scrollTrigger: { trigger: '#menuGrid', start: 'top 90%' }
482:                 }
483:             );
484:         }
485:     };
486: 
487:     document.addEventListener('livewire:navigated', initCardsAnimation);
488: 
489:     // First load
490:     setTimeout(initCardsAnimation, 300);
491: </script>
492: @endscript
493: 
The above content shows the entire, complete file contents of the requested file.
