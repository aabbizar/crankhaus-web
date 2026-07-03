<?php
    $skipBumper = request()->query('nobumper') === '1' || request()->routeIs('dashboard');
?>

<!-- Transition Overlay -->
<div id="ch-transition-overlay" class="fixed inset-0 z-[99999] pointer-events-none flex flex-col items-center justify-center overflow-hidden"
     style="opacity: <?php echo e($skipBumper ? '0' : '1'); ?>; display: <?php echo e($skipBumper ? 'none' : 'flex'); ?>;">
    
    <!-- Flat Wipe Panels -->
    <div class="ch-transition-panel absolute top-0 left-0 w-full h-1/4 bg-[#020b0a] origin-top"></div>
    <div class="ch-transition-panel absolute top-[25%] left-0 w-full h-1/4 bg-[#020b0a] origin-top"></div>
    <div class="ch-transition-panel absolute top-[50%] left-0 w-full h-1/4 bg-[#020b0a] origin-top"></div>
    <div class="ch-transition-panel absolute top-[75%] left-0 w-full h-1/4 bg-[#020b0a] origin-top"></div>

    <!-- Center Logo -->
    <div id="ch-transition-logo-container" class="relative z-10 flex items-center justify-center w-full h-full opacity-0 scale-95">
        <img id="ch-transition-logo" src="<?php echo e(asset('images/CRANK (1).png')); ?>" alt="CRANKHAUS" 
             class="h-16 md:h-20 lg:h-24 w-auto object-contain drop-shadow-2xl">
    </div>
</div>

<script>
(function() {
    var overlay = document.getElementById('ch-transition-overlay');
    var logoContainer = document.getElementById('ch-transition-logo-container');
    var panels = document.querySelectorAll('.ch-transition-panel');
    var isSkipBumper = <?php echo e($skipBumper ? 'true' : 'false'); ?>;

    function waitForGSAP(callback) {
        if (window.gsap) {
            callback();
        } else {
            var checkInterval = setInterval(function() {
                if (window.gsap) {
                    clearInterval(checkInterval);
                    callback();
                }
            }, 20);
            setTimeout(function() {
                if (!window.gsap && overlay) {
                    clearInterval(checkInterval);
                    overlay.style.display = 'none';
                }
            }, 2000);
        }
    }

    waitForGSAP(function() {
        window.addEventListener('pageshow', function(e) {
            if (e.persisted) {
                gsap.killTweensOf([overlay, logoContainer, panels]);
                gsap.set(overlay, { display: 'none' });
            }
        });

        // Entrance Animation (Sleek Wipe Open)
        if (!isSkipBumper) {
            gsap.set(overlay, { display: 'flex', opacity: 1 });
            gsap.set(logoContainer, { opacity: 1, scale: 1 });
            gsap.set(panels, { scaleY: 1 });

            var tl = gsap.timeline({
                onComplete: function() {
                    gsap.set(overlay, { display: 'none' });
                    gsap.set(panels, { clearProps: 'all' });
                }
            });

            tl.to(logoContainer, {
                opacity: 0,
                scale: 1.1,
                duration: 0.6,
                ease: 'power3.in'
            })
            .to(panels, {
                scaleY: 0,
                duration: 0.8,
                stagger: 0.1,
                ease: 'power4.inOut'
            }, '-=0.2');
        }

        // Bind transitions
        function bindTransitions() {
            document.querySelectorAll('a').forEach(function (link) {
                if (link.dataset.transitionBound) return;
                if (link.getAttribute('target') === '_blank' || link.hasAttribute('data-no-transition')) return;
                
                link.dataset.transitionBound = 'true';
                var href = link.getAttribute('href');
                
                if (href) {
                    var isInternal = href.startsWith('/') || href.startsWith(window.location.origin);
                    if (isInternal) {
                        var parser = document.createElement('a');
                        parser.href = href;

                        if (parser.pathname === window.location.pathname && parser.hash) return;
                        if (href.startsWith('javascript:')) return;

                        link.addEventListener('click', function (e) {
                            if (e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
                            e.preventDefault();

                            var targetUrl = href;
                            var originPath = window.location.origin + '/';
                            if (targetUrl === '/' || targetUrl === originPath || targetUrl.startsWith('/?') || targetUrl.startsWith(originPath + '?')) {
                                if (targetUrl.startsWith(originPath)) {
                                    targetUrl = targetUrl.replace(window.location.origin, '');
                                }
                                if (targetUrl === '/') {
                                    targetUrl = '/?nobumper=1';
                                } else if (!targetUrl.includes('nobumper=')) {
                                    targetUrl += (targetUrl.includes('?') ? '&' : '?') + 'nobumper=1';
                                }
                            } else if (targetUrl.startsWith('/#') || targetUrl.startsWith(originPath + '#')) {
                                if (targetUrl.startsWith(originPath)) {
                                    targetUrl = targetUrl.replace(window.location.origin, '');
                                }
                                targetUrl = '/?nobumper=1' + targetUrl.substring(1);
                            }

                            gsap.killTweensOf([overlay, logoContainer, panels]);
                            
                            gsap.set(overlay, { display: 'flex', opacity: 1 });
                            gsap.set(panels, { scaleY: 0, transformOrigin: 'bottom' });
                            gsap.set(logoContainer, { opacity: 0, scale: 0.9 });

                            var exitTl = gsap.timeline({
                                onComplete: function () {
                                    window.location.href = targetUrl;
                                }
                            });

                            exitTl.to(panels, {
                                scaleY: 1,
                                duration: 0.65,
                                stagger: 0.08,
                                ease: 'power4.inOut'
                            })
                            .to(logoContainer, {
                                opacity: 1,
                                scale: 1,
                                duration: 0.5,
                                ease: 'back.out(1.5)'
                            }, '-=0.2');
                        });
                    }
                }
            });
        }

        bindTransitions();
        document.addEventListener('livewire:load', bindTransitions);
        document.addEventListener('livewire:navigated', bindTransitions);
    });
})();
</script>
<?php /**PATH C:\laragon\www\agtokosahaja_project\resources\views/components/page-transitions.blade.php ENDPATH**/ ?>