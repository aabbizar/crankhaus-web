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

<script src="https://unpkg.com/lenis@1.1.2/dist/lenis.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. Lenis Smooth Scrolling
    const lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
        smoothWheel: true
    });
    
    if (window.gsap && window.ScrollTrigger) {
        lenis.on('scroll', ScrollTrigger.update);
        gsap.ticker.add((time)=>{
          lenis.raf(time * 1000)
        });
        gsap.ticker.lagSmoothing(0);
    } else {
        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);
    }

    // 2. Advanced PPT GSAP Transitions
    const layers = [
        document.getElementById('gsap-layer-3'),
        document.getElementById('gsap-layer-2'),
        document.getElementById('gsap-layer-1')
    ];
    
    if (window.gsap) {
        // Initial Page Load: Animate out (unveil the new page)
        // Reverse order: 3 goes up first, then 2, then 1
        gsap.to(layers, { 
            yPercent: -100, 
            duration: 0.8, 
            ease: 'power3.inOut',
            stagger: 0.1,
            delay: 0.1,
            onComplete: () => {
                gsap.set(layers, { pointerEvents: 'none' });
            }
        });

        // Intercept clicks for PPT Sweep
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                
                if (!href || href.startsWith('#')) return;
                
                try {
                    const url = new URL(href, window.location.origin);
                    if (url.origin !== window.location.origin) return; 
                    if (this.target === '_blank') return;
                    if (url.pathname === window.location.pathname && url.hash) return;
                } catch(err) { return; }

                e.preventDefault();
                
                // Sweep IN (layer 1, then 2, then 3)
                // Set layers at the bottom first
                gsap.set(layers, { yPercent: 100, pointerEvents: 'all' });
                
                // Animate up from bottom
                gsap.to(layers.slice().reverse(), {
                    yPercent: 0,
                    duration: 0.8,
                    ease: 'power3.inOut',
                    stagger: 0.1,
                    onComplete: () => {
                        window.location.href = href;
                    }
                });
            });
        });
    } else {
        layers.forEach(l => l.style.display = 'none');
    }
});
</script>
