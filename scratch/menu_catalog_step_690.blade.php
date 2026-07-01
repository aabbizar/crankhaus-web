Created At: 2026-05-25T09:58:01Z
Completed At: 2026-05-25T09:58:01Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 493
Total Bytes: 27242
Showing lines 401 to 493
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
401:                 spans.push(span);
402:             });
403:             return spans;
404:         }
405: 
406:         if (window.gsap) {
407:             const tl = gsap.timeline();
408:             
409:             // Backdrop fade
410:             gsap.to(backdrop, { opacity: 1, duration: 0.3, ease: 'power2.out' });
411:             
412:             // Modal pop in
413:             tl.to(modal, { opacity: 1, scale: 1, y: 0, duration: 0.6, ease: 'back.out(1.2)' });
414:             
415:             // Image and badge pop
416:             tl.fromTo(frame, { scale: 0.8, opacity: 0, rotationY: -15 }, { scale: 1, opacity: 1, rotationY: 0, duration: 0.8, ease: 'power3.out' }, "-=0.2");
417:             tl.fromTo("#modalCatPill", { scale: 0, opacity: 0 }, { scale: 1, opacity: 1, duration: 0.5, ease: 'back.out(2)' }, "-=0.4");
418: 
419:             // Text elements stagger
420:             tl.fromTo(["#modalEyebrow", "#modalMenuDesc", "#modalMeta", "#modalPrice", "#modalActions"], 
421:                 { y: 30, opacity: 0 }, 
422:                 { y: 0, opacity: 1, duration: 0.6, stagger: 0.1, ease: 'power3.out' }, 
423:                 "-=0.6"
424:             );
425: 
426:             // Title character split animation
427:             const nameChars = simpleSplitText('#modalMenuName');
428:             if (nameChars.length) {
429:                 gsap.to(nameChars, { opacity: 1, y: 0, duration: 0.05, stagger: 0.02, ease: 'none', 
430:                     onStart: () => gsap.set(nameChars,
<truncated 907 bytes>
, duration: 0.8, ease: 'elastic.out(1, 0.3)' });
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
The above content does NOT show the entire file contents. If you need to view any lines of the file which were not shown to complete your task, call this tool again to view those lines.
