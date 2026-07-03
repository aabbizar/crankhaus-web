{{--
    ═══════════════════════════════════════════════════════════════
    CRANKHAUS — GLOBAL PHYSICS ENGINE  v2.0
    5 Macro-Level Frontend Features:
    1. Enhanced SPA-like page transitions (3D rotateX depth reveal)
    2. Gravity-Pull "Add to Cart" bezier trajectory animation
    3. 3D Receipt Unroll checkout overlay
    4. Variable-font breathing on scroll velocity
    5. Cinematic film grain + vignette engine
    ═══════════════════════════════════════════════════════════════
--}}

{{-- ── FEATURE 3: 3D Receipt Unroll Overlay DOM ── --}}
<div id="ck-receipt-overlay"
     aria-hidden="true"
     style="
        position: fixed;
        inset: 0;
        z-index: 9000;
        display: none;
        align-items: flex-start;
        justify-content: center;
        background: rgba(2, 11, 10, 0.85);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        padding-top: 60px;
        perspective: 1200px;
        overflow-y: auto;
     ">

    <div id="ck-receipt-paper"
         style="
            width: 100%;
            max-width: 460px;
            background: #f5f0e8;
            border-radius: 4px 4px 0 0;
            transform-origin: top center;
            transform-style: preserve-3d;
            transform: rotateX(-90deg);
            opacity: 0;
            will-change: transform, opacity;
            margin: 0 auto 80px auto;
            box-shadow: 0 40px 120px rgba(0,0,0,0.7);
         ">

        {{-- Receipt Header --}}
        <div style="background: #020b0a; padding: 28px 32px; text-align: center; position: relative;">
            <button id="ck-receipt-close" aria-label="Close cart"
                    style="position: absolute; top: 16px; right: 16px;
                           background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);
                           border-radius: 50%; width: 36px; height: 36px; color: #efe1d9;
                           font-size: 16px; cursor: pointer; display: flex; align-items: center;
                           justify-content: center; transition: background 0.2s;"
                    onmouseover="this.style.background='rgba(235,161,61,0.3)'"
                    onmouseout="this.style.background='rgba(255,255,255,0.08)'">✕</button>
            <div style="font-family: 'Space Grotesk', 'Inter', sans-serif; font-weight: 900; color: #eba13d;
                        font-size: 10px; letter-spacing: 0.3em; text-transform: uppercase; margin-bottom: 8px;">
                CRANKHAUS · EAT.DRINK.RIDE
            </div>
            <div style="font-family: 'Space Grotesk', 'Inter', sans-serif; font-weight: 900; color: white;
                        font-size: 24px; letter-spacing: -0.02em;">YOUR BASKET</div>
        </div>

        {{-- Perforated Edge Top --}}
        <div style="height: 16px; background: repeating-linear-gradient(90deg, #f5f0e8 0, #f5f0e8 10px, transparent 10px, transparent 20px), #020b0a; background-size: 20px 100%, 100% 100%;"></div>

        {{-- Receipt Body --}}
        <div id="ck-receipt-items" style="padding: 20px 28px; min-height: 60px;"></div>

        {{-- Receipt Footer --}}
        <div id="ck-receipt-footer" style="padding: 0 28px 28px; opacity: 0;">
            <div style="border-top: 2px dashed rgba(2,11,10,0.15); margin-bottom: 20px; padding-top: 20px; font-family: monospace;">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 10px; font-weight: 900; letter-spacing: 0.2em; text-transform: uppercase; color: rgba(2,11,10,0.45);">SUBTOTAL</span>
                    <span id="ck-receipt-total" style="font-size: 22px; font-weight: 900; color: #020b0a; font-family: 'Space Grotesk', 'Inter', sans-serif;"></span>
                </div>
            </div>
            <button id="ck-receipt-checkout-btn"
                    style="width: 100%; background: #b42638; color: white; border: none;
                           border-radius: 12px; padding: 18px; font-family: 'Space Grotesk', 'Inter', sans-serif;
                           font-weight: 900; font-size: 13px; letter-spacing: 0.15em; text-transform: uppercase;
                           cursor: pointer; box-shadow: 0 8px 24px rgba(180,38,56,0.35); margin-bottom: 10px;
                           transition: transform 0.2s, box-shadow 0.2s;"
                    onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 12px 32px rgba(180,38,56,0.5)'"
                    onmouseout="this.style.transform='';this.style.boxShadow='0 8px 24px rgba(180,38,56,0.35)'">
                Place Order →
            </button>
            <button id="ck-receipt-clear-btn"
                    style="width: 100%; background: transparent; border: 1px solid rgba(2,11,10,0.15);
                           border-radius: 12px; padding: 12px; font-family: 'Space Grotesk', 'Inter', sans-serif;
                           font-weight: 700; font-size: 10px; letter-spacing: 0.15em; text-transform: uppercase;
                           color: rgba(2,11,10,0.4); cursor: pointer; transition: all 0.2s;"
                    onmouseover="this.style.borderColor='rgba(2,11,10,0.4)';this.style.color='rgba(2,11,10,0.7)'"
                    onmouseout="this.style.borderColor='rgba(2,11,10,0.15)';this.style.color='rgba(2,11,10,0.4)'">
                Clear Basket
            </button>
        </div>

        {{-- Tear Edge --}}
        <div style="height: 20px; background:
            radial-gradient(circle at 10px 20px, transparent 9px, #f5f0e8 9px) -10px 0 / 20px 20px,
            radial-gradient(circle at 10px 0, transparent 9px, #ede8e0 9px) 0 0 / 20px 20px;
            background-repeat: repeat-x;"></div>
    </div>
</div>


{{-- ── Cart fly-to anchor ── --}}
<div id="ck-cart-target" aria-hidden="true"
     style="position:fixed;top:28px;right:80px;width:1px;height:1px;pointer-events:none;z-index:50;"></div>

<style>
    @supports (font-variation-settings: normal) {
        .vf-breathe, h1.font-display, h2.font-display {
            font-variation-settings: 'wght' var(--vf-weight, 900);
        }
    }
    .ck-receipt-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 16px;
        padding: 12px 0;
        border-bottom: 1px dashed rgba(2,11,10,0.1);
        font-family: monospace;
        opacity: 0;
        transform: translateY(10px);
    }
    .ck-receipt-row:last-child { border-bottom: none; }
    .ck-rr-left { flex: 1; }
    .ck-rr-name { font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; color: #020b0a; line-height: 1.3; }
    .ck-rr-sub  { font-size: 10px; color: rgba(2,11,10,0.4); margin-top: 2px; }
    .ck-rr-price{ font-size: 12px; font-weight: 900; color: #020b0a; white-space: nowrap; }
    .ck-fly-clone {
        position: fixed;
        border-radius: 50%;
        object-fit: cover;
        pointer-events: none;
        z-index: 99998;
        will-change: transform, opacity, left, top;
    }
</style>

<script>
(function () {
'use strict';

/* ─────────────────────────────────────────────────────────────────────────────
   FEATURE 1: Enhanced SPA Transition (3D rotateX incoming page reveal)
   Works on top of the existing smooth-site layer wipe system.
   ─────────────────────────────────────────────────────────────────────────────*/
function initEnhancedTransitions() {
    if (!window.gsap) return;

    // Reveal new page content with 3D entry from behind + depth
    var pageMain = document.querySelector('main') || document.querySelector('.ch-page-content');
    if (pageMain) {
        gsap.set(pageMain, {
            rotationX: 8, y: 50, opacity: 0,
            transformPerspective: 1400, transformOrigin: 'top center'
        });
        gsap.to(pageMain, {
            rotationX: 0, y: 0, opacity: 1,
            duration: 1.15, ease: 'expo.out', delay: 0.95,
            clearProps: 'rotationX,y,opacity,transform,perspective'
        });
    }

    // Scale-down the outgoing content before layers wipe
    document.addEventListener('click', function (e) {
        var link = e.target.closest('a');
        if (!link || !pageMain) return;
        var href = link.getAttribute('href');
        if (!href || href.startsWith('#') || href.startsWith('javascript:') || link.target === '_blank') return;
        try {
            var u = new URL(href, window.location.origin);
            if (u.origin !== window.location.origin) return;
            if (u.pathname === window.location.pathname && u.hash) return;
        } catch (e) { return; }

        gsap.to(pageMain, {
            scale: 0.96, y: -20, opacity: 0.5,
            duration: 0.3, ease: 'power2.in', overwrite: true
        });
    }, { capture: true, passive: true });
}

/* ─────────────────────────────────────────────────────────────────────────────
   FEATURE 2: Gravity-Pull Add to Cart Trajectory
   Quadratic bezier arc math from card → cart corner.
   ─────────────────────────────────────────────────────────────────────────────*/
function initCartTrajectory() {
    function getCartPos() {
        var t = document.getElementById('ck-cart-target');
        if (t) { var r = t.getBoundingClientRect(); return { x: r.left, y: r.top }; }
        return { x: window.innerWidth - 80, y: 40 };
    }

    window.ckFlyToCart = function (imgSrc, originEl) {
        if (!imgSrc || !originEl) return;
        var rect   = originEl.getBoundingClientRect();
        var target = getCartPos();
        var SIZE   = Math.min(rect.width, 80);

        var clone = document.createElement('img');
        clone.src = imgSrc;
        clone.className = 'ck-fly-clone';
        clone.style.width  = SIZE + 'px';
        clone.style.height = SIZE + 'px';
        clone.style.left   = (rect.left + rect.width  / 2 - SIZE / 2) + 'px';
        clone.style.top    = (rect.top  + rect.height / 2 - SIZE / 2) + 'px';
        document.body.appendChild(clone);

        var sx = rect.left + rect.width  / 2 - SIZE / 2;
        var sy = rect.top  + rect.height / 2 - SIZE / 2;
        var ex = target.x - SIZE / 2;
        var ey = target.y - SIZE / 2;
        var cpX = (sx + ex) / 2 + (Math.random() - 0.5) * 100;
        var cpY = Math.min(sy, ey) - 200;

        var dur = 750;
        var startTime = null;

        function ease(t) { return t < 0.5 ? 4*t*t*t : 1-Math.pow(-2*t+2,3)/2; }

        function frame(ts) {
            if (!startTime) startTime = ts;
            var t  = Math.min((ts - startTime) / dur, 1);
            var et = ease(t);
            var bx = (1-et)*(1-et)*sx + 2*(1-et)*et*cpX + et*et*ex;
            var by = (1-et)*(1-et)*sy + 2*(1-et)*et*cpY + et*et*ey;
            var s  = 1 - et * 0.82;
            clone.style.left      = bx + 'px';
            clone.style.top       = by + 'px';
            clone.style.width     = (SIZE * s) + 'px';
            clone.style.height    = (SIZE * s) + 'px';
            clone.style.opacity   = String(1 - et * 0.4);
            clone.style.transform = 'rotate(' + (et * 720) + 'deg)';
            if (t < 1) { requestAnimationFrame(frame); }
            else {
                clone.remove();
                // Jiggle floating cart
                var bar = document.getElementById('floatingCart');
                if (bar && window.gsap) {
                    gsap.timeline()
                        .to(bar, { scale: 1.12, duration: 0.1, ease: 'power3.out' })
                        .to(bar, { scale: 1,    duration: 0.9, ease: 'elastic.out(1, 0.35)' });
                }
            }
        }
        requestAnimationFrame(frame);
    };

    // Track last clicked card, trigger fly on addToCart
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('.ch-add-btn, [wire\\:click*="addToCart"]');
        if (!btn) return;
        var card = btn.closest('.ch-spatial-card, .ch-card-perspective-wrap, [data-image]');
        if (!card) return;
        window._ckLastCard = card;
        var src = card.getAttribute('data-image') || (card.querySelector('img,  .ch-card-img') || {}).src;
        if (src) setTimeout(function () { window.ckFlyToCart(src, card); }, 80);
    }, { capture: true });
}

/* ─────────────────────────────────────────────────────────────────────────────
   FEATURE 3: 3D Receipt Unroll Checkout Overlay
   ─────────────────────────────────────────────────────────────────────────────*/
function initReceiptCheckout() {
    var overlay  = document.getElementById('ck-receipt-overlay');
    var paper    = document.getElementById('ck-receipt-paper');
    var itemsEl  = document.getElementById('ck-receipt-items');
    var footerEl = document.getElementById('ck-receipt-footer');
    var totalEl  = document.getElementById('ck-receipt-total');
    var closeBtn = document.getElementById('ck-receipt-close');
    var checkBtn = document.getElementById('ck-receipt-checkout-btn');
    var clearBtn = document.getElementById('ck-receipt-clear-btn');
    if (!overlay || !paper || !itemsEl) return;

    // Prevent double-binding
    if (overlay._bound) return;
    overlay._bound = true;

    function populate() {
        if (!itemsEl) return;
        itemsEl.innerHTML = '';

        // Read from the always-rendered hidden JSON data store
        var dataScript = document.getElementById('ck-cart-data');
        if (!dataScript) {
            // Cart is empty
            var ph = document.createElement('div');
            ph.style.cssText = 'text-align:center;padding:36px 0;font-family:monospace;font-size:10px;color:rgba(2,11,10,0.3);text-transform:uppercase;letter-spacing:0.2em;line-height:2;';
            ph.innerHTML = '🛒<br>Your basket is empty<br><span style="font-size:9px;opacity:0.6;">Head back to the menu to add items</span>';
            itemsEl.appendChild(ph);
            if (totalEl) totalEl.textContent = '';
            return;
        }

        var cartData;
        try { cartData = JSON.parse(dataScript.textContent.trim()); }
        catch(e) { return; }

        // Render each cart item as a receipt row
        (cartData.items || []).forEach(function(item) {
            var div = document.createElement('div');
            div.className = 'ck-receipt-row';
            div.innerHTML = '<div class="ck-rr-left">'
                + '<div class="ck-rr-name">' + item.name + '</div>'
                + '<div class="ck-rr-sub">× ' + item.quantity + '  ·  ' + item.priceFormatted + ' each</div>'
                + '</div>'
                + '<div class="ck-rr-price">' + item.subtotal + '</div>';
            itemsEl.appendChild(div);
        });

        // Set total
        if (totalEl) totalEl.textContent = cartData.totalFormatted || '';
    }

    function open() {
        if (!window.gsap) return;
        populate();
        overlay.style.display = 'flex';
        overlay.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        gsap.fromTo(overlay, { backgroundColor: 'rgba(2,11,10,0)' }, { backgroundColor: 'rgba(2,11,10,0.85)', duration: 0.45, ease: 'power2.out' });
        gsap.set(paper, { rotationX: -90, opacity: 0, y: -30 });
        gsap.to(paper, {
            rotationX: 0, opacity: 1, y: 0,
            duration: 0.9, ease: 'expo.out',
            onComplete: function () {
                var rows = itemsEl.querySelectorAll('.ck-receipt-row');
                gsap.to(Array.from(rows), { opacity: 1, y: 0, duration: 0.38, stagger: 0.07, ease: 'power3.out' });
                gsap.to(footerEl, { opacity: 1, duration: 0.4, ease: 'power2.out', delay: 0.1 });
            }
        });
    }

    function close() {
        if (!window.gsap) return;
        document.body.style.overflow = '';
        gsap.to(paper, {
            rotationX: -80, opacity: 0, y: -50,
            duration: 0.45, ease: 'power3.in',
            onComplete: function () {
                overlay.style.display = 'none';
                overlay.setAttribute('aria-hidden', 'true');
                // Only reset the GSAP-animated transform props — NOT 'all' (that would wipe background, border-radius etc.)
                gsap.set(paper,    { clearProps: 'rotationX,rotationY,y,opacity,transform' });
                gsap.set(footerEl, { clearProps: 'opacity' });
            }
        });
        gsap.to(overlay, { backgroundColor: 'rgba(2,11,10,0)', duration: 0.4, ease: 'power2.in' });
    }

    if (closeBtn) closeBtn.addEventListener('click', close);
    overlay.addEventListener('click', function (e) { if (e.target === overlay) close(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') close(); });

    if (checkBtn) checkBtn.addEventListener('click', function () {
        close();
        setTimeout(function () {
            var lw = document.querySelector('[wire\\:id]');
            if (lw && window.Livewire) {
                var comp = window.Livewire.find(lw.getAttribute('wire:id'));
                if (comp) comp.call('openCheckout');
            }
        }, 450);
    });

    if (clearBtn) clearBtn.addEventListener('click', function () {
        var lw = document.querySelector('[wire\\:id]');
        if (lw && window.Livewire) {
            var comp = window.Livewire.find(lw.getAttribute('wire:id'));
            if (comp) { comp.call('emptyCart'); close(); }
        }
    });

    // Intercept the "Checkout →" button click inside the floating cart bar
    document.addEventListener('click', function (e) {
        var btn = e.target.closest('#floatingCart [wire\\:click="openCheckout"]');
        if (btn) { e.preventDefault(); e.stopPropagation(); open(); }
    }, { capture: true });

    window.ckOpenReceipt  = open;
    window.ckCloseReceipt = close;
}




/* ─────────────────────────────────────────────────────────────────────────────
   BOOTSTRAP
   ─────────────────────────────────────────────────────────────────────────────*/
function boot() {
    initEnhancedTransitions();
    initCartTrajectory();
    initReceiptCheckout();
}

// GSAP may not be ready immediately (Vite async)
if (window.gsap) {
    boot();
} else {
    var interval = setInterval(function () {
        if (window.gsap) { clearInterval(interval); boot(); }
    }, 30);
    setTimeout(function () { clearInterval(interval); boot(); }, 2000);
}

// Re-init receipt + cart trajectory after Livewire DOM updates
document.addEventListener('livewire:updated', function () {
    setTimeout(function () { initReceiptCheckout(); }, 100);
});

}());
</script>
