Created At: 2026-05-25T08:55:29Z
Completed At: 2026-05-25T08:55:29Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 481
Total Bytes: 25115
Showing lines 1 to 481
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
29:     <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 grid-flow-row-dense" id="menuGri
<truncated 23922 bytes>
EventListener('mouseleave', () => {
437:                     gsap.to(frame, { rotationY: 0, rotationX: 0, duration: 0.8, ease: 'elastic.out(1, 0.3)' });
438:                 });
439:             }
440:         }
441:     };
442: 
443:     // ── Order success animation ──────────────────────────────────────────────
444:     window.animateSuccess = function() {
445:         const card = document.getElementById('successCard');
446:         if (!card || !window.gsap) return;
447: 
448:         gsap.fromTo(card,
449:             { opacity: 0, scale: 0.85, y: 50 },
450:             { opacity: 1, scale: 1, y: 0, duration: 0.6, ease: 'back.out(1.7)' }
451:         );
452: 
453:         const queue = card.querySelector('.ck-success-queue');
454:         if (queue) {
455:             gsap.fromTo(queue,
456:                 { scale: 0, opacity: 0 },
457:                 { scale: 1, opacity: 1, duration: 0.8, ease: 'elastic.out(1, 0.5)', delay: 0.3 }
458:             );
459:         }
460:     };
461: 
462:     // ── Init effects on mount ────────────────────────────────────────────────
463:     const initCardsAnimation = () => {
464:         if (window.gsap && window.ScrollTrigger) {
465:             gsap.fromTo('.ck-menu-card',
466:                 { y: 60, opacity: 0, scale: 0.95 },
467:                 {
468:                     y: 0, opacity: 1, scale: 1, duration: 0.8, stagger: 0.05, ease: 'power4.out',
469:                     scrollTrigger: { trigger: '#menuGrid', start: 'top 90%' }
470:                 }
471:             );
472:         }
473:     };
474: 
475:     document.addEventListener('livewire:navigated', initCardsAnimation);
476: 
477:     // First load
478:     setTimeout(initCardsAnimation, 300);
479: </script>
480: @endscript
481: 
The above content shows the entire, complete file contents of the requested file.
