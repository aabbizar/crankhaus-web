<style>
    /* Prevent scroll-behavior: smooth from breaking Lenis */
    html { scroll-behavior: auto !important; }
    
    .gsap-transition-layer {
        position: fixed; 
        left: 0; 
        width: 100vw; 
        height: 100vh; 
        z-index: 999999;
        pointer-events: all;
        transform: translateY(0%); /* covers screen on initial load */
    }
    #gsap-layer-1 { background: #b42638; top: 0; z-index: 999997; }
    #gsap-layer-2 { background: #eba13d; top: 0; z-index: 999998; }
    #gsap-layer-3 { 
        background: #235c47; top: 0; z-index: 999999;
        display: flex; 
        align-items: center; 
        justify-content: center; 
        flex-direction: column;
    }
    
    .gsap-transition-logo {
        color: #eba13d; 
        font-family: 'Barlow Condensed', sans-serif; 
        font-weight: 900; 
        font-size: clamp(3rem, 8vw, 6rem); 
        text-transform: uppercase;
        letter-spacing: 0.05em;
        line-height: 1;
    }
</style>

<div class="gsap-transition-layer" id="gsap-layer-1"></div>
<div class="gsap-transition-layer" id="gsap-layer-2"></div>
<div class="gsap-transition-layer" id="gsap-layer-3">
    <span class="gsap-transition-logo">CRANKHAUS</span>
</div>


<script>
(function () {
    // This runs synchronously — hides layers immediately if page is restored
    // from browser bfcache (back/forward navigation) so screen isn't stuck.
    function hideLayers() {
        ['gsap-layer-1','gsap-layer-2','gsap-layer-3'].forEach(function(id) {
            var el = document.getElementById(id);
            if (el) {
                el.style.transform    = 'translateY(-100%)';
                el.style.pointerEvents = 'none';
            }
        });
    }

    // pageshow fires on bfcache restore (e.persisted = true)
    window.addEventListener('pageshow', function (e) {
        if (e.persisted) { hideLayers(); }
    });

    // popstate = browser back/forward button
    // Show a quick sweep animation so navigation feels smooth, then reload
    window.addEventListener('popstate', function () {
        hideLayers();
        var layers = [
            document.getElementById('gsap-layer-1'),
            document.getElementById('gsap-layer-2'),
            document.getElementById('gsap-layer-3')
        ];
        
        layers.forEach(function(el) {
            if(el) {
                el.style.transform = 'translateY(100%)';
                el.style.pointerEvents = 'all';
                el.style.transition = 'none';
            }
        });

        // Small delay to allow reflow, then animate up
        setTimeout(function() {
            layers.forEach(function(el, i) {
                if(el) {
                    el.style.transition = 'transform 0.75s cubic-bezier(0.16,1,0.3,1) ' + (i * 0.09) + 's';
                    el.style.transform = 'translateY(0%)';
                }
            });
            
            // Reload page once cover is up
            setTimeout(function() {
                window.location.reload();
            }, 900);
        }, 20);
    });
})();
</script>

<script src="https://unpkg.com/lenis@1.1.2/dist/lenis.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    var layers = [
        document.getElementById('gsap-layer-3'),
        document.getElementById('gsap-layer-2'),
        document.getElementById('gsap-layer-1')
    ];

    // ── 1. Lenis Smooth Scrolling ────────────────────────────────────────────
    var lenis = new Lenis({
        duration: 1.2,
        easing: function(t) { return Math.min(1, 1.001 - Math.pow(2, -10 * t)); },
        smoothWheel: true
    });

    // Expose lenis globally so other scripts can use it
    window.lenisInstance = lenis;

    function waitForGSAP(cb) {
        if (window.gsap && window.ScrollTrigger) { cb(); return; }
        var t = setInterval(function() {
            if (window.gsap && window.ScrollTrigger) { clearInterval(t); cb(); }
        }, 20);
        setTimeout(function() { clearInterval(t); }, 3000);
    }

    waitForGSAP(function() {
        // ── Connect Lenis → ScrollTrigger so scroll-driven animations work ──
        gsap.registerPlugin(ScrollTrigger);

        // This is the CRITICAL bridge: Lenis fires 'scroll', ScrollTrigger recalcs
        lenis.on('scroll', function() {
            ScrollTrigger.update();
        });

        // GSAP ticker drives Lenis RAF — keeps them in perfect sync
        gsap.ticker.add(function(time) {
            lenis.raf(time * 1000);
        });
        gsap.ticker.lagSmoothing(0);

        // ── 2. Page entrance: layers slide UP (unveil page) ─────────────────
        gsap.to(layers, {
            yPercent: -100,
            duration: 0.8,
            ease: 'power3.inOut',
            stagger: 0.1,
            delay: 0.1,
            onComplete: function() {
                gsap.set(layers, { pointerEvents: 'none' });
            }
        });

        // ── 3. Intercept link clicks for PPT sweep transition ────────────────
        function bindLinks() {
            document.querySelectorAll('a').forEach(function(link) {
                if (link.dataset.smoothBound) return;
                link.dataset.smoothBound = 'true';

                link.addEventListener('click', function(e) {
                    var href = this.getAttribute('href');

                    if (!href || href.startsWith('#') || href.startsWith('javascript:')) return;
                    if (this.getAttribute('target') === '_blank') return;
                    if (this.getAttribute('data-no-transition')) return;

                    try {
                        var url = new URL(href, window.location.origin);
                        if (url.origin !== window.location.origin) return;
                        if (url.pathname === window.location.pathname && url.hash) return;
                    } catch(err) { return; }

                    e.preventDefault();
                    var dest = href;

                    // Stop Lenis during transition
                    lenis.stop();

                    // Set layers below viewport, then sweep up
                    gsap.set(layers, { yPercent: 100, pointerEvents: 'all' });

                    gsap.to(layers.slice().reverse(), {
                        yPercent: 0,
                        duration: 0.75,
                        ease: 'power3.inOut',
                        stagger: 0.09,
                        onComplete: function() {
                            window.location.href = dest;
                        }
                    });
                });
            });
        }

        bindLinks();

        // Re-bind after Livewire navigations
        document.addEventListener('livewire:navigated', bindLinks);
    });

    // Fallback if GSAP never loads
    setTimeout(function() {
        if (!window.gsap) {
            layers.forEach(function(l) { if (l) l.style.display = 'none'; });
            (function raf(time) { lenis.raf(time); requestAnimationFrame(raf); })(0);
        }
    }, 3000);
});
</script>
<?php /**PATH C:\laragon\www\agtokosahaja_project\resources\views/components/smooth-site.blade.php ENDPATH**/ ?>