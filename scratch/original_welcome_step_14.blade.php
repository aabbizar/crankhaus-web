Created At: 2026-05-25T07:47:23Z
Completed At: 2026-05-25T07:47:23Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/welcome.blade.php`
Total Lines: 364
Total Bytes: 18590
Showing lines 1 to 364
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
1: <!DOCTYPE html>
2: <html lang="id">
3: <head>
4:     <meta charset="utf-8">
5:     <meta name="viewport" content="width=device-width, initial-scale=1.0">
6:     <title>CRANKHAUS — Pedal & Spice</title>
7: 
8:     <link rel="preconnect" href="https://fonts.googleapis.com">
9:     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
10:     <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&family=Unbounded:wght@300;400;500;600;700;900&family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
11: 
12:     @vite(['resources/css/app.css', 'resources/js/app.js'])
13: 
14:     <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
15:     <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
16: 
17:     <style>
18:         :root {
19:             --ck-red:       #ff385c;
20:             --ck-red-dark:  #e02e50;
21:             --ck-black:     #050505;
22:             --ck-white:     #ffffff;
23:             --ck-surface:   #f4f5f5;
24:             --ck-gray-100:  #eaebec;
25:             --ck-gray-400:  #8b8c8d;
26:             --ck-gray-600:  #4a4b4c;
27:         }
28: 
29:         *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
30:         body {
31:             font-family: 'Inter', system-ui, sans-serif;
32:             background: var(--ck-white);
33:             color: var(--ck-black);
34:             overflow-x
<truncated 16798 bytes>
: 1, duration: 1, ease: "power3.out" }, "-=1");
322:                 }
323: 
324:                 tl.fromTo(".gs-reveal-y", { y: 40, opacity: 0 }, { y: 0, opacity: 1, duration: 1, stagger: 0.1, ease: "power3.out" }, "-=0.5")
325:                   .fromTo(".ck-hero__collage", { x: 100, opacity: 0 }, { x: 0, opacity: 1, duration: 1.2, ease: "power3.out" }, "-=0.8");
326: 
327:                 // Parallax Scroll for Collage
328:                 gsap.utils.toArray(".gs-parallax").forEach(layer => {
329:                     const speed = layer.getAttribute("data-speed");
330:                     gsap.to(layer, {
331:                         y: () => (ScrollTrigger.maxScroll(window) - ScrollTrigger.maxScroll(window) * speed) * 0.1,
332:                         ease: "none",
333:                         scrollTrigger: {
334:                             trigger: ".ck-hero",
335:                             start: "top top",
336:                             end: "bottom top",
337:                             scrub: true
338:                         }
339:                     });
340:                 });
341: 
342:                 // Scroll Reveals
343:                 gsap.utils.toArray(".gs-reveal-up").forEach(elem => {
344:                     gsap.fromTo(elem, 
345:                         { y: 80, opacity: 0 }, 
346:                         {
347:                             y: 0, opacity: 1, duration: 1, ease: "power3.out",
348:                             scrollTrigger: {
349:                                 trigger: elem,
350:                                 start: "top 85%",
351:                             }
352:                         }
353:                     );
354:                 });
355: 
356:                 if (window.initMagnetButton) {
357:                     window.initMagnetButton('.ck-btn', 0.4, 60);
358:                 }
359:             }, 100);
360:         });
361:     </script>
362: </body>
363: </html>
364: 
The above content shows the entire, complete file contents of the requested file.
