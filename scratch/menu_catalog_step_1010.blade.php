Created At: 2026-05-25T17:12:40Z
Completed At: 2026-05-25T17:12:40Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 483
Total Bytes: 26976
Showing lines 1 to 483
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
29:     <div class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-6 space-y-6" id="menuGrid">
30: 
<truncated 25793 bytes>
EventListener('mouseleave', () => {
439:                     gsap.to(frame, { rotationY: 0, rotationX: 0, duration: 0.8, ease: 'elastic.out(1, 0.3)' });
440:                 });
441:             }
442:         }
443:     };
444: 
445:     // ── Order success animation ──────────────────────────────────────────────
446:     window.animateSuccess = function() {
447:         const card = document.getElementById('successCard');
448:         if (!card || !window.gsap) return;
449: 
450:         gsap.fromTo(card,
451:             { opacity: 0, scale: 0.85, y: 50 },
452:             { opacity: 1, scale: 1, y: 0, duration: 0.6, ease: 'back.out(1.7)' }
453:         );
454: 
455:         const queue = card.querySelector('.ck-success-queue');
456:         if (queue) {
457:             gsap.fromTo(queue,
458:                 { scale: 0, opacity: 0 },
459:                 { scale: 1, opacity: 1, duration: 0.8, ease: 'elastic.out(1, 0.5)', delay: 0.3 }
460:             );
461:         }
462:     };
463: 
464:     // ── Init effects on mount ────────────────────────────────────────────────
465:     const initCardsAnimation = () => {
466:         if (window.gsap && window.ScrollTrigger) {
467:             gsap.fromTo('.ck-menu-card',
468:                 { y: 60, opacity: 0, scale: 0.95 },
469:                 {
470:                     y: 0, opacity: 1, scale: 1, duration: 0.8, stagger: 0.05, ease: 'power4.out',
471:                     scrollTrigger: { trigger: '#menuGrid', start: 'top 90%' }
472:                 }
473:             );
474:         }
475:     };
476: 
477:     document.addEventListener('livewire:navigated', initCardsAnimation);
478: 
479:     // First load
480:     setTimeout(initCardsAnimation, 300);
481: </script>
482: @endscript
483: 
The above content shows the entire, complete file contents of the requested file.
