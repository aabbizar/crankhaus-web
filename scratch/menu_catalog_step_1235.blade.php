Created At: 2026-05-25T18:14:39Z
Completed At: 2026-05-25T18:14:39Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 455
Total Bytes: 24915
Showing lines 355 to 455
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
355:             el.innerHTML = '';
356:             const spans = [];
357:             text.split('').forEach(char => {
358:                 const span = document.createElement('span');
359:                 span.style.display = 'inline-block';
360:                 span.style.opacity = '0';
361:                 span.innerText = char === ' ' ? '\u00A0' : char;
362:                 el.appendChild(span);
363:                 spans.push(span);
364:             });
365:             return spans;
366:         }
367: 
368:         if (window.gsap) {
369:             const tl = gsap.timeline();
370:             
371:             // Backdrop fade
372:             gsap.to(backdrop, { opacity: 1, duration: 0.3, ease: 'power2.out' });
373:             
374:             // Modal pop in
375:             tl.to(modal, { opacity: 1, scale: 1, y: 0, duration: 0.6, ease: 'back.out(1.2)' });
376:             
377:             // Image and badge pop
378:             tl.fromTo(frame, { scale: 0.8, opacity: 0, rotationY: -15 }, { scale: 1, opacity: 1, rotationY: 0, duration: 0.8, ease: 'power3.out' }, "-=0.2");
379:             tl.fromTo("#modalCatPill", { scale: 0, opacity: 0 }, { scale: 1, opacity: 1, duration: 0.5, ease: 'back.out(2)' }, "-=0.4");
380: 
381:             // Text elements stagger
382:             tl.fromTo(["#modalEyebrow", "#modalMenuDesc", "#modalMeta", "#modalPrice", "#modalActions"], 
383:                 { y: 30, opacity: 0 }, 
384:                 { y: 0, opacity: 1, duration: 0.6, stagger: 0.1, e
<truncated 1345 bytes>
ut(1, 0.3)' });
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
The above content does NOT show the entire file contents. If you need to view any lines of the file which were not shown to complete your task, call this tool again to view those lines.
