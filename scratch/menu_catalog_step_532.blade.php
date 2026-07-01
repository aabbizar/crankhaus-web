Created At: 2026-05-25T09:36:45Z
Completed At: 2026-05-25T09:36:45Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 492
Total Bytes: 27223
Showing lines 1 to 492
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
29:     <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8 xl:gap-10 grid-flow-row
<truncated 26085 bytes>
EventListener('mouseleave', () => {
448:                     gsap.to(frame, { rotationY: 0, rotationX: 0, duration: 0.8, ease: 'elastic.out(1, 0.3)' });
449:                 });
450:             }
451:         }
452:     };
453: 
454:     // ── Order success animation ──────────────────────────────────────────────
455:     window.animateSuccess = function() {
456:         const card = document.getElementById('successCard');
457:         if (!card || !window.gsap) return;
458: 
459:         gsap.fromTo(card,
460:             { opacity: 0, scale: 0.85, y: 50 },
461:             { opacity: 1, scale: 1, y: 0, duration: 0.6, ease: 'back.out(1.7)' }
462:         );
463: 
464:         const queue = card.querySelector('.ck-success-queue');
465:         if (queue) {
466:             gsap.fromTo(queue,
467:                 { scale: 0, opacity: 0 },
468:                 { scale: 1, opacity: 1, duration: 0.8, ease: 'elastic.out(1, 0.5)', delay: 0.3 }
469:             );
470:         }
471:     };
472: 
473:     // ── Init effects on mount ────────────────────────────────────────────────
474:     const initCardsAnimation = () => {
475:         if (window.gsap && window.ScrollTrigger) {
476:             gsap.fromTo('.ck-menu-card',
477:                 { y: 60, opacity: 0, scale: 0.95 },
478:                 {
479:                     y: 0, opacity: 1, scale: 1, duration: 0.8, stagger: 0.05, ease: 'power4.out',
480:                     scrollTrigger: { trigger: '#menuGrid', start: 'top 90%' }
481:                 }
482:             );
483:         }
484:     };
485: 
486:     document.addEventListener('livewire:navigated', initCardsAnimation);
487: 
488:     // First load
489:     setTimeout(initCardsAnimation, 300);
490: </script>
491: @endscript
492: 
The above content shows the entire, complete file contents of the requested file.
