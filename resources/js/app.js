/**
 * app.js — CRANKHAUS Frontend
 * GSAP Premium Plugins from local gsap-public/src/
 * ReactBits-inspired effects: SplitText 3D, Magnet Button, Decay Hover, Continuous Float
 */

import './bootstrap';

import { gsap }              from 'gsap';
import { ScrollTrigger }     from 'gsap/ScrollTrigger';
import { Flip }              from 'gsap/Flip';
import { Draggable }         from 'gsap/Draggable';
import { SplitText }         from 'gsap/SplitText';
import { TextPlugin }        from 'gsap/TextPlugin';
import { Observer }          from 'gsap/Observer';
import { ScrollSmoother }    from 'gsap/ScrollSmoother';
import { ScrollToPlugin }    from 'gsap/ScrollToPlugin';
import { CustomEase }        from 'gsap/CustomEase';
import { CustomBounce }      from 'gsap/CustomBounce';
import { CustomWiggle }      from 'gsap/CustomWiggle';
import { DrawSVGPlugin }     from 'gsap/DrawSVGPlugin';
import { MorphSVGPlugin }    from 'gsap/MorphSVGPlugin';
import { MotionPathPlugin }  from 'gsap/MotionPathPlugin';
import { ScrambleTextPlugin }from 'gsap/ScrambleTextPlugin';
import { InertiaPlugin }     from 'gsap/InertiaPlugin';
import { Physics2DPlugin }   from 'gsap/Physics2DPlugin';
import { PhysicsPropsPlugin }from 'gsap/PhysicsPropsPlugin';

gsap.registerPlugin(
    ScrollTrigger, Flip, Draggable, SplitText, TextPlugin, Observer,
    ScrollSmoother, ScrollToPlugin, CustomEase, CustomBounce, CustomWiggle,
    DrawSVGPlugin, MorphSVGPlugin, MotionPathPlugin, ScrambleTextPlugin,
    InertiaPlugin, Physics2DPlugin, PhysicsPropsPlugin,
);

/* ── Expose to window global ── */
window.gsap              = gsap;
window.ScrollTrigger     = ScrollTrigger;
window.Flip              = Flip;
window.Draggable         = Draggable;
window.SplitText         = SplitText;
window.TextPlugin        = TextPlugin;
window.Observer          = Observer;
window.ScrollSmoother    = ScrollSmoother;
window.ScrollToPlugin    = ScrollToPlugin;
window.CustomEase        = CustomEase;
window.DrawSVGPlugin     = DrawSVGPlugin;
window.MorphSVGPlugin    = MorphSVGPlugin;
window.MotionPathPlugin  = MotionPathPlugin;
window.ScrambleTextPlugin = ScrambleTextPlugin;
window.InertiaPlugin     = InertiaPlugin;

/* ══════════════════════════════════════════════════════════════════════════
 * NEW: 3D SPLITTEXT HERO ENTRANCE
 * Splits element text into chars, each enters with rotationX: -90 in 3D.
 * Uses GSAP SplitText when available, falls back to manual DOM split.
 *
 * @param {string|Element} selector - CSS selector or DOM element
 * @param {object} opts             - { delay, stagger, duration, y }
 * ══════════════════════════════════════════════════════════════════════════ */
window.initSplitHero = function (selector, opts) {
    opts     = opts     || {};
    var delay    = opts.delay    || 0;
    var stagger  = opts.stagger  || 0.065;
    var duration = opts.duration || 1.05;
    var y        = opts.y        || 70;

    var el = typeof selector === 'string' ? document.querySelector(selector) : selector;
    if (!el || !window.gsap) return;

    if (window.SplitText) {
        // Premium SplitText path
        var split = new SplitText(el, { type: 'chars,words', charsClass: 'split-hero-char' });
        gsap.set(split.chars, {
            opacity: 0, rotationX: -90, y: y,
            transformPerspective: 1000, transformOrigin: 'top center',
        });
        return gsap.to(split.chars, {
            opacity: 1, rotationX: 0, y: 0,
            duration: duration, ease: 'power4.out',
            stagger: { each: stagger, from: 'start' },
            delay: delay,
        });
    } else {
        // Fallback: manual DOM character split
        var text = el.textContent.trim();
        el.innerHTML = '';
        text.split('').forEach(function (char) {
            var span = document.createElement('span');
            span.textContent = char === ' ' ? '\u00a0' : char;
            span.style.cssText = 'display:inline-block;opacity:0;transform:rotateX(-90deg) translateY(' + y + 'px);transform-origin:top center;perspective:1000px;';
            el.appendChild(span);
        });
        var spans = el.querySelectorAll('span');
        spans.forEach(function (span, i) {
            gsap.to(span, {
                opacity: 1, rotationX: 0, y: 0,
                duration: duration, ease: 'power4.out',
                delay: delay + i * stagger, transformPerspective: 1000,
            });
        });
    }
};

/* ══════════════════════════════════════════════════════════════════════════
 * NEW: CONTINUOUS FLOAT ANIMATION (yoyo)
 * Adds a looping up/down float to decorative background elements.
 *
 * @param {string} selector  - CSS selector for float targets
 * @param {object} opts      - { y: 20, duration: 3.5 }
 * ══════════════════════════════════════════════════════════════════════════ */
window.initContinuousFloat = function (selector, opts) {
    opts     = opts     || {};
    var yAmt     = opts.y        || 20;
    var duration = opts.duration || 3.5;

    var els = document.querySelectorAll(selector);
    if (!els.length || !window.gsap) return;

    els.forEach(function (el, i) {
        gsap.to(el, {
            y: -yAmt,
            duration: duration + i * 0.45,
            ease: 'sine.inOut',
            yoyo: true,
            repeat: -1,
            delay: i * 0.35,
        });
    });
};

/* ══════════════════════════════════════════════════════════════════════════
 * NEW: PARALLAX SCROLL SECTION
 * Applies intense parallax Y movement + scale to images on scroll.
 *
 * @param {string} selector  - CSS selector for parallax images
 * @param {object} opts      - { yPercent: 20 }
 * ══════════════════════════════════════════════════════════════════════════ */
window.initParallaxSection = function (selector, opts) {
    opts  = opts  || {};
    var yPct = opts.yPercent || 20;

    var els = document.querySelectorAll(selector);
    if (!els.length || !window.gsap || !window.ScrollTrigger) return;

    els.forEach(function (el) {
        gsap.fromTo(el,
            { yPercent: -(yPct / 2) },
            {
                yPercent: yPct / 2,
                ease: 'none',
                scrollTrigger: {
                    trigger: el.closest('section') || el.parentElement,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: true,
                },
            }
        );
    });
};

/* ══════════════════════════════════════════════════════════════════════════
 * NEW: GSAP FLOATING LABELS
 * Works with .lf-field-wrap + .lf-label + .lf-input structure.
 * Adds GSAP amber color tween on focus/blur.
 *
 * @param {string} formSelector - CSS selector for the form
 * ══════════════════════════════════════════════════════════════════════════ */
window.initFloatingLabels = function (formSelector) {
    var form = document.querySelector(formSelector);
    if (!form) return;

    form.querySelectorAll('.lf-field-wrap').forEach(function (wrap) {
        var input = wrap.querySelector('.lf-input');
        var label = wrap.querySelector('.lf-label');
        if (!input || !label) return;

        // Restore state on page load
        if (input.value) wrap.classList.add('has-value');

        input.addEventListener('focus', function () {
            wrap.classList.add('is-focused');
            if (window.gsap) gsap.to(label, { color: '#eba13d', duration: 0.2 });
        });

        input.addEventListener('blur', function () {
            wrap.classList.remove('is-focused');
            if (input.value) {
                wrap.classList.add('has-value');
                if (window.gsap) gsap.to(label, { color: '#eba13d', duration: 0.2 });
            } else {
                wrap.classList.remove('has-value');
                if (window.gsap) gsap.to(label, { color: '#999999', duration: 0.2 });
            }
        });

        // Live update for Livewire
        input.addEventListener('input', function () {
            if (input.value) wrap.classList.add('has-value');
            else wrap.classList.remove('has-value');
        });
    });
};

/* ══════════════════════════════════════════════════════════════════════════
 * SHINY TEXT / GSAP PULSE
 * Adds shimmer class to elements.
 * ══════════════════════════════════════════════════════════════════════════ */
window.initGsapPulse = function (selector) {
    var els = document.querySelectorAll(selector);
    if (!els.length) return;
    els.forEach(function (el) { el.classList.add('shiny-text-active'); });
};

/* ══════════════════════════════════════════════════════════════════════════
 * SPLITTEXT SCRAMBLE REVEAL
 * Breaks text into chars and reveals with a scramble effect.
 *
 * @param {string|Element} target - CSS selector or DOM element
 * @param {object} opts           - { delay, stagger, duration, chars }
 * ══════════════════════════════════════════════════════════════════════════ */
window.initSplitTextReveal = function (target, opts) {
    opts     = opts     || {};
    var delay    = opts.delay    || 0;
    var stagger  = opts.stagger  || 0.03;
    var duration = opts.duration || 0.9;
    var chars    = opts.chars    || 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%';

    var el = typeof target === 'string' ? document.querySelector(target) : target;
    if (!el || !window.SplitText) return;

    var split = new SplitText(el, { type: 'chars,words', charsClass: 'split-char' });
    gsap.set(split.chars, { opacity: 0, y: 30 });

    var tl = gsap.timeline({ delay: delay });
    split.chars.forEach(function (char, i) {
        var originalText = char.innerHTML;
        tl.to(char, { opacity: 1, y: 0, duration: duration, ease: 'power3.out' }, i * stagger);
        if (window.ScrambleTextPlugin) {
            tl.to(char, {
                scrambleText: { text: originalText, chars: chars, revealDelay: 0.1, tweenLength: false, speed: 0.3 },
                duration: duration * 0.7,
            }, i * stagger);
        }
    });
    return tl;
};

/* ══════════════════════════════════════════════════════════════════════════
 * MAGNET BUTTON EFFECT
 * Elastic pull toward cursor within a radius.
 *
 * @param {string} selector - CSS selector for magnet buttons
 * @param {number} strength - Pull strength (default 0.4)
 * @param {number} radius   - Detection radius in px (default 80)
 * ══════════════════════════════════════════════════════════════════════════ */
window.initMagnetButton = function (selector, strength, radius) {
    strength = strength || 0.4;
    radius   = radius   || 80;

    var buttons = document.querySelectorAll(selector);
    if (!buttons.length || !window.gsap) return;

    buttons.forEach(function (btn) {
        btn.addEventListener('mousemove', function (e) {
            var rect     = btn.getBoundingClientRect();
            var centerX  = rect.left + rect.width  / 2;
            var centerY  = rect.top  + rect.height / 2;
            var deltaX   = e.clientX - centerX;
            var deltaY   = e.clientY - centerY;
            var distance = Math.sqrt(deltaX * deltaX + deltaY * deltaY);
            if (distance < radius) {
                gsap.to(btn, { x: deltaX * strength, y: deltaY * strength, duration: 0.3, ease: 'power2.out' });
            }
        });
        btn.addEventListener('mouseleave', function () {
            gsap.to(btn, { x: 0, y: 0, duration: 0.6, ease: 'elastic.out(1, 0.4)' });
        });
    });
};

/* ══════════════════════════════════════════════════════════════════════════
 * DECAY HOVER CARD — 3D TILT
 * Card tilts in 3D following the mouse pointer position.
 *
 * @param {string} selector - CSS selector for cards
 * @param {number} maxTilt  - Maximum tilt degrees (default 12)
 * ══════════════════════════════════════════════════════════════════════════ */
window.initDecayHover = function (selector, maxTilt) {
    maxTilt = maxTilt || 12;

    var cards = document.querySelectorAll(selector);
    if (!cards.length || !window.gsap) return;

    cards.forEach(function (card) {
        card.addEventListener('mousemove', function (e) {
            var rect    = card.getBoundingClientRect();
            var x       = e.clientX - rect.left;
            var y       = e.clientY - rect.top;
            var rotX    = ((y - rect.height / 2) / rect.height) * -maxTilt;
            var rotY    = ((x - rect.width  / 2) / rect.width)  *  maxTilt;
            gsap.to(card, {
                rotationX: rotX, rotationY: rotY,
                transformPerspective: 900, transformOrigin: 'center center',
                scale: 1.03, duration: 0.35, ease: 'power2.out',
            });
        });
        card.addEventListener('mouseleave', function () {
            gsap.to(card, { rotationX: 0, rotationY: 0, scale: 1, duration: 0.6, ease: 'elastic.out(1, 0.5)' });
        });
    });
};

/* ══════════════════════════════════════════════════════════════════════════
 * FLIP CATALOG TRANSITION
 * Wrap around GSAP Flip for Livewire-safe catalog state transitions.
 * ══════════════════════════════════════════════════════════════════════════ */
window.getFlipState = function (selector) {
    if (!window.Flip) return null;
    var els = document.querySelectorAll(selector);
    if (!els.length) return null;
    return Flip.getState(els);
};

window.applyFlipFrom = function (state, opts) {
    if (!state || !window.Flip) return;
    opts = opts || {};
    Flip.from(state, {
        duration: opts.duration || 0.55,
        ease:     opts.ease     || 'power2.inOut',
        stagger:  opts.stagger  || 0.04,
        absolute: true,
        onEnter: function (els) { gsap.fromTo(els, { opacity: 0, scale: 0.85 }, { opacity: 1, scale: 1, duration: 0.4 }); },
        onLeave: function (els) { gsap.to(els, { opacity: 0, scale: 0.85, duration: 0.3 }); },
    });
};

/* ══════════════════════════════════════════════════════════════════════════
 * AIRBNB-STYLE TOAST NOTIFICATION
 * ══════════════════════════════════════════════════════════════════════════ */
window.showToast = function (message, type) {
    type = type || 'success';
    var container = document.getElementById('toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'toast-container';
        container.style.cssText = 'position:fixed;bottom:24px;left:50%;transform:translateX(-50%);z-index:30000;display:flex;flex-direction:column;gap:12px;pointer-events:none;';
        document.body.appendChild(container);
    }

    var toast = document.createElement('div');
    toast.style.cssText = 'display:flex;align-items:center;gap:12px;background:rgba(2,11,10,0.95);color:#efe1d9;padding:14px 24px;border-radius:50px;box-shadow:0 8px 32px rgba(0,0,0,0.4);pointer-events:auto;border:1px solid rgba(239,225,217,0.12);min-width:300px;justify-content:space-between;opacity:0;transform:translateY(24px);transition:all 0.3s ease;';
    var icon = type === 'success' ? '✔' : 'ℹ';
    toast.innerHTML = '<div style="display:flex;align-items:center;gap:12px;"><span style="font-size:18px;">' + icon + '</span><span style="font-family:Space Mono,monospace;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;">' + message + '</span></div><button style="color:rgba(239,225,217,0.4);font-size:14px;font-weight:700;background:none;border:none;cursor:pointer;">✕</button>';

    toast.querySelector('button').addEventListener('click', function () {
        if (window.gsap) { gsap.to(toast, { opacity: 0, y: -20, duration: 0.3, onComplete: function () { toast.remove(); } }); }
        else { toast.remove(); }
    });

    container.appendChild(toast);

    if (window.gsap) {
        gsap.to(toast, { opacity: 1, y: 0, duration: 0.45, ease: 'power3.out' });
        gsap.delayedCall(3.8, function () { gsap.to(toast, { opacity: 0, y: -20, duration: 0.35, onComplete: function () { toast.remove(); } }); });
    } else {
        setTimeout(function () { toast.style.opacity = '1'; toast.style.transform = 'translateY(0)'; }, 50);
        setTimeout(function () { toast.style.opacity = '0'; toast.style.transform = 'translateY(-20px)'; setTimeout(function () { toast.remove(); }, 300); }, 4000);
    }
};

/* ══════════════════════════════════════════════════════════════════════════
 * REAL-TIME ORDER DASHBOARD POPUP
 * Polls /api/orders/latest-pending every 5s when on /admin paths.
 * Also listens on Echo channel if Reverb is configured.
 * ══════════════════════════════════════════════════════════════════════════ */
(function registerOrderListener() {
    var lastOrderTime = Date.now();
    var isPolling = false;

    setInterval(async function () {
        if (!window.location.pathname.includes('/admin')) return;
        if (isPolling) return;
        isPolling = true;
        try {
            var response = await fetch('/api/orders/latest-pending?since=' + lastOrderTime);
            if (response.ok) {
                var data = await response.json();
                if (data.orders && data.orders.length > 0) {
                    data.orders.forEach(function (order) {
                        playNotificationSound();
                        showOrderPopup(order);
                    });
                    lastOrderTime = Date.now();
                }
            }
        } catch (e) { /* Ignore polling errors */ } finally { isPolling = false; }
    }, 5000);

    if (window.Echo && typeof window.Echo.channel === 'function') {
        window.Echo.channel('orders').listen('.new-order', function (data) {
            if (window.location.pathname.includes('/admin')) {
                playNotificationSound();
                showOrderPopup(data);
                lastOrderTime = Date.now();
            }
        });
    } else {
        setTimeout(registerOrderListener, 500);
    }
})();

function playNotificationSound() {
    try {
        var audioCtx = new (window.AudioContext || window.webkitAudioContext)();
        var playNote = function (frequency, startTime, duration) {
            var osc = audioCtx.createOscillator();
            var gain = audioCtx.createGain();
            osc.connect(gain);
            gain.connect(audioCtx.destination);
            osc.type = 'sine';
            osc.frequency.setValueAtTime(frequency, startTime);
            gain.gain.setValueAtTime(0.3, startTime);
            gain.gain.exponentialRampToValueAtTime(0.001, startTime + duration);
            osc.start(startTime);
            osc.stop(startTime + duration);
        };
        var now = audioCtx.currentTime;
        playNote(523.25, now, 0.4);
        playNote(783.99, now + 0.15, 0.6);
    } catch (err) { console.error('Notification sound error:', err); }
}

function showOrderPopup(order) {
    var existing = document.getElementById('admin-order-popup-overlay');
    if (existing) existing.remove();

    var overlay = document.createElement('div');
    overlay.id = 'admin-order-popup-overlay';
    overlay.className = 'fixed inset-0 z-[99999] bg-slate-950/80 backdrop-blur-md flex items-center justify-center p-4';

    var formattedPrice = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(order.totalPrice);

    overlay.innerHTML = '\
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-[24px] p-8 max-w-md w-full shadow-2xl transform scale-95 opacity-0 transition-all duration-300">\
            <div class="flex items-center gap-4 mb-6">\
                <div class="w-12 h-12 rounded-full bg-[#ff385c]/10 flex items-center justify-center text-2xl text-[#ff385c]">🔔</div>\
                <div>\
                    <h3 class="text-sm font-bold text-[#ff385c] tracking-widest uppercase">New Order!</h3>\
                    <p class="text-xs text-gray-500 dark:text-gray-400">Order ID: #' + order.orderId + '</p>\
                </div>\
            </div>\
            <div class="space-y-4 mb-8 bg-gray-50 dark:bg-gray-800/50 p-5 rounded-2xl border border-gray-100 dark:border-gray-800">\
                <div class="flex justify-between border-b border-gray-200/50 dark:border-gray-700/50 pb-2">\
                    <span class="text-xs text-gray-500 dark:text-gray-400">Customer</span>\
                    <span class="text-xs font-bold text-gray-900 dark:text-white">' + order.customerName + '</span>\
                </div>\
                <div class="flex justify-between border-b border-gray-200/50 dark:border-gray-700/50 pb-2">\
                    <span class="text-xs text-gray-500 dark:text-gray-400">Table</span>\
                    <span class="text-xs font-bold text-gray-900 dark:text-white">' + order.tableNumber + '</span>\
                </div>\
                <div class="flex justify-between border-b border-gray-200/50 dark:border-gray-700/50 pb-2">\
                    <span class="text-xs text-gray-500 dark:text-gray-400">Queue</span>\
                    <span class="text-xs font-bold text-gray-900 dark:text-white">#' + String(order.queueNumber).padStart(3, '0') + '</span>\
                </div>\
                <div class="flex justify-between pt-1">\
                    <span class="text-xs font-semibold text-gray-900 dark:text-white">Total</span>\
                    <span class="text-sm font-black text-[#ff385c]">' + formattedPrice + '</span>\
                </div>\
            </div>\
            <div class="flex flex-col gap-3">\
                <button id="btn-popup-accept" class="w-full py-3.5 px-4 bg-[#ff385c] hover:bg-[#e0314f] text-white font-bold rounded-xl transition-all shadow-md shadow-[#ff385c]/20 hover:scale-[1.02] active:scale-[0.98] cursor-pointer">Accept &amp; Cook 🔥</button>\
                <div class="grid grid-cols-2 gap-3">\
                    <button id="btn-popup-pending" class="w-full py-3 px-4 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-xl transition-all cursor-pointer text-xs">Queue (Pending)</button>\
                    <button id="btn-popup-reject" class="w-full py-3 px-4 bg-red-500/10 hover:bg-red-500/20 text-red-600 dark:text-red-400 font-semibold rounded-xl transition-all border border-red-500/20 cursor-pointer text-xs">Reject &amp; Remove</button>\
                </div>\
            </div>\
        </div>';

    document.body.appendChild(overlay);

    setTimeout(function () {
        var card = overlay.firstElementChild;
        card.classList.remove('scale-95', 'opacity-0');
        card.classList.add('scale-100', 'opacity-100');
    }, 10);

    var handleAction = async function (status) {
        var csrfToken = document.querySelector('meta[name="csrf-token"]') && document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        try {
            var response = await fetch('/api/orders/' + order.orderId + '/status', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                body: JSON.stringify({ status: status }),
            });
            var result = await response.json();
            if (result.success) {
                overlay.remove();
                if (window.showToast) window.showToast(result.message, status === 'rejected' ? 'info' : 'success');
                setTimeout(function () { window.location.reload(); }, 800);
            } else {
                alert('Failed to process order: ' + result.message);
            }
        } catch (err) {
            console.error('Error updating status:', err);
            alert('Connection error while processing.');
        }
    };

    document.getElementById('btn-popup-accept').addEventListener('click', function () { handleAction('processing'); });
    document.getElementById('btn-popup-pending').addEventListener('click', function () { handleAction('pending'); });
    document.getElementById('btn-popup-reject').addEventListener('click', function () {
        if (confirm('Are you sure you want to reject and remove this order?')) handleAction('rejected');
    });
}

/* ══════════════════════════════════════════════════════════════════════════
 * SPATIAL MOTION ENGINE — "The Z-Axis Journey"
 * Z-Axis ScrollTrigger · Global Mouse Tilt · Magnetic Hover · Stagger Reveal
 * All exposed on window.* for use across all Blade pages.
 * ══════════════════════════════════════════════════════════════════════════ */

window.initZAxisScrollEngine = function (selector, opts) {
    if (!window.gsap || !window.ScrollTrigger) return;
    selector = selector || '.spatial-enter';
    opts = opts || {};
    var isMobile = window.innerWidth < 1024;
    gsap.utils.toArray(selector).forEach(function (el, i) {
        if (isMobile) {
            gsap.fromTo(el,
                { opacity: 0, y: 55 },
                { scrollTrigger: { trigger: el, start: 'top 90%', toggleActions: 'play none none none' }, opacity: 1, y: 0, duration: opts.duration || 0.85, ease: 'power3.out', delay: (opts.stagger || 0.09) * i }
            );
        } else {
            gsap.set(el, { transformPerspective: 1500, transformStyle: 'preserve-3d' });
            gsap.fromTo(el,
                { opacity: 0, z: opts.zFrom !== undefined ? opts.zFrom : -280, scale: opts.scaleFrom !== undefined ? opts.scaleFrom : 0.58, rotationX: opts.rotX || 7 },
                { scrollTrigger: { trigger: el, start: opts.start || 'top 87%', toggleActions: 'play none none none' }, opacity: 1, z: 0, scale: 1, rotationX: 0, duration: opts.duration || 1.1, ease: opts.ease || 'expo.out', delay: (opts.stagger || 0.08) * i }
            );
        }
    });
};

window.initGlobalMouseTilt = function (sceneSelector, maxX, maxY, lag) {
    if (!window.gsap) return;
    maxX = maxX || 10; maxY = maxY || 14; lag = lag || 0.07;
    document.querySelectorAll(sceneSelector).forEach(function (scene) {
        var panels = scene.querySelectorAll('.tilt-3d');
        if (!panels.length) return;
        var tRX = 0, tRY = 0, cRX = 0, cRY = 0, rafId = null;
        scene.addEventListener('mousemove', function (e) {
            var r = scene.getBoundingClientRect();
            tRY =  ((e.clientX - r.left) / r.width  - 0.5) * maxY * 2;
            tRX = -((e.clientY - r.top)  / r.height - 0.5) * maxX * 2;
            if (!rafId) loop();
        }, { passive: true });
        scene.addEventListener('mouseleave', function () { tRX = 0; tRY = 0; }, { passive: true });
        function loop() {
            cRX += (tRX - cRX) * lag; cRY += (tRY - cRY) * lag;
            panels.forEach(function (p) { gsap.set(p, { rotationX: cRX, rotationY: cRY, transformPerspective: 1500, transformStyle: 'preserve-3d' }); });
            if (Math.abs(tRX - cRX) < 0.01 && Math.abs(tRY - cRY) < 0.01 && Math.abs(cRX) < 0.01 && Math.abs(cRY) < 0.01) { rafId = null; return; }
            rafId = requestAnimationFrame(loop);
        }
    });
};

window.initHeroMouseTilt = function (selector, maxX, maxY, lag) {
    if (!window.gsap) return;
    maxX = maxX || 8; maxY = maxY || 12; lag = lag || 0.05;
    var el = typeof selector === 'string' ? document.querySelector(selector) : selector;
    if (!el) return;
    var tRX = 0, tRY = 0, cRX = 0, cRY = 0, rafId = null;
    gsap.set(el, { transformPerspective: 1500, transformStyle: 'preserve-3d' });
    window.addEventListener('mousemove', function (e) {
        tRY =  (e.clientX / window.innerWidth  - 0.5) * maxY * 2;
        tRX = -(e.clientY / window.innerHeight - 0.5) * maxX * 2;
        if (!rafId) loop();
    }, { passive: true });
    function loop() {
        cRX += (tRX - cRX) * lag; cRY += (tRY - cRY) * lag;
        gsap.set(el, { rotationX: cRX, rotationY: cRY });
        if (Math.abs(tRX - cRX) < 0.005 && Math.abs(tRY - cRY) < 0.005) { rafId = null; return; }
        rafId = requestAnimationFrame(loop);
    }
};

window.initMagneticHover = function (selector, strength) {
    if (!window.gsap) return;
    strength = strength || 0.35;
    document.querySelectorAll(selector).forEach(function (btn) {
        gsap.set(btn, { transformPerspective: 800, transformStyle: 'preserve-3d' });
        btn.addEventListener('mousemove', function (e) {
            var r = btn.getBoundingClientRect();
            var dx = e.clientX - (r.left + r.width / 2);
            var dy = e.clientY - (r.top  + r.height / 2);
            gsap.to(btn, { x: dx * strength, y: dy * strength, rotationY: dx * 0.12, rotationX: -dy * 0.12, duration: 0.35, ease: 'power2.out', overwrite: true });
        });
        btn.addEventListener('mouseleave', function () {
            gsap.to(btn, { x: 0, y: 0, rotationX: 0, rotationY: 0, duration: 0.9, ease: 'elastic.out(1, 0.45)', overwrite: true });
        });
    });
};

window.initStaggerReveal = function (selector, triggerEl, opts) {
    if (!window.gsap || !window.ScrollTrigger) return;
    opts = opts || {};
    var els = document.querySelectorAll(selector);
    if (!els.length) return;
    var isMobile = window.innerWidth < 1024;
    gsap.fromTo(els,
        { opacity: 0, y: opts.y || 50, z: isMobile ? 0 : (opts.z || -100), scale: opts.scale || 0.92 },
        {
            scrollTrigger: { trigger: triggerEl || els[0], start: opts.start || 'top 86%', toggleActions: 'play none none none' },
            opacity: 1, y: 0, z: 0, scale: 1,
            duration: opts.duration || 1.0, ease: opts.ease || 'expo.out',
            stagger: { each: opts.stagger || 0.12, from: 'start' },
            transformPerspective: 1500,
        }
    );
};
