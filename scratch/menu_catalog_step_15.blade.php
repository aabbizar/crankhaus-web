Created At: 2026-05-25T07:47:23Z
Completed At: 2026-05-25T07:47:23Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 488
Total Bytes: 24695
Showing lines 1 to 488
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
29:     <div class="columns-2 sm:columns-2 lg:columns-3 xl:columns
<truncated 23537 bytes>
)',
442:                 });
443:             });
444:         }
445:     };
446: 
447:     // ── Order success animation ──────────────────────────────────────────────
448:     window.animateSuccess = function() {
449:         const card = document.getElementById('successCard');
450:         if (!card || !window.gsap) return;
451: 
452:         gsap.fromTo(card,
453:             { opacity: 0, scale: 0.85, y: 50 },
454:             { opacity: 1, scale: 1, y: 0, duration: 0.6, ease: 'back.out(1.7)' }
455:         );
456: 
457:         const queue = card.querySelector('.ck-success-queue');
458:         if (queue) {
459:             gsap.fromTo(queue,
460:                 { scale: 0, opacity: 0 },
461:                 { scale: 1, opacity: 1, duration: 0.8, ease: 'elastic.out(1, 0.5)', delay: 0.3 }
462:             );
463:         }
464:     };
465: 
466:     // ── Init effects on mount ────────────────────────────────────────────────
467:     const initCardsAnimation = () => {
468:         if (window.initDecayHover) window.initDecayHover('.ck-menu-card', 6);
469:         if (window.initMagnetButton) window.initMagnetButton('.magnet-btn');
470: 
471:         if (window.gsap && window.ScrollTrigger) {
472:             gsap.fromTo('.ck-menu-card',
473:                 { y: 50, opacity: 0 },
474:                 {
475:                     y: 0, opacity: 1, duration: 0.8, stagger: 0.1, ease: 'power3.out',
476:                     scrollTrigger: { trigger: '#menuGrid', start: 'top 85%' }
477:                 }
478:             );
479:         }
480:     };
481: 
482:     document.addEventListener('livewire:navigated', initCardsAnimation);
483: 
484:     // First load
485:     setTimeout(initCardsAnimation, 300);
486: </script>
487: @endscript
488: 
The above content shows the entire, complete file contents of the requested file.
