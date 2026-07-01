Created At: 2026-05-25T18:21:16Z
Completed At: 2026-05-25T18:21:16Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 455
Total Bytes: 24915
Showing lines 1 to 455
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
1: <div class="w-full">
2: 
3:     {{-- ══ FILTER TABS (HIDDEN PER USER REQUEST FOR MINIMALISM) ══════════════════════════════════════════════════════ --}}
4:     <div class="hidden items-center justify-center gap-4 mb-20 flex-wrap" id="filterTabs">
5:         @php
6:             $tabs = [
7:                 'all'           => 'Semua Menu',
8:                 'Makanan Utama' => 'Makanan Utama',
9:                 'Cemilan'       => 'Cemilan',
10:                 'Minuman'       => 'Minuman',
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
28:     {{-- ══ MENU GRID (FLUENT GRID) ═════════════════════════════════════ --}}
29:     <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5
<truncated 23592 bytes>
 {
411:                     gsap.to(frame, { rotationY: 0, rotationX: 0, duration: 0.8, ease: 'elastic.out(1, 0.3)' });
412:                 });
413:             }
414:         }
415:     };
416: 
417:     // ── Order success animation ──────────────────────────────────────────────
418:     window.animateSuccess = function() {
419:         const card = document.getElementById('successCard');
420:         if (!card || !window.gsap) return;
421: 
422:         gsap.fromTo(card,
423:             { opacity: 0, scale: 0.85, y: 50 },
424:             { opacity: 1, scale: 1, y: 0, duration: 0.6, ease: 'back.out(1.7)' }
425:         );
426: 
427:         const queue = card.querySelector('.ck-success-queue');
428:         if (queue) {
429:             gsap.fromTo(queue,
430:                 { scale: 0, opacity: 0 },
431:                 { scale: 1, opacity: 1, duration: 0.8, ease: 'elastic.out(1, 0.5)', delay: 0.3 }
432:             );
433:         }
434:     };
435: 
436:     // ── Init effects on mount ────────────────────────────────────────────────
437:     const initCardsAnimation = () => {
438:         if (window.gsap && window.ScrollTrigger) {
439:             gsap.fromTo('.ck-menu-card-item',
440:                 { y: 80, opacity: 0, scale: 0.9, rotationX: 10 },
441:                 {
442:                     y: 0, opacity: 1, scale: 1, rotationX: 0, duration: 1.2, stagger: 0.08, ease: 'power4.out',
443:                     scrollTrigger: { trigger: '#menuGrid', start: 'top 85%' }
444:                 }
445:             );
446:         }
447:     };
448: 
449:     document.addEventListener('livewire:navigated', initCardsAnimation);
450: 
451:     // First load
452:     setTimeout(initCardsAnimation, 300);
453: </script>
454: @endscript
455: 
The above content shows the entire, complete file contents of the requested file.
