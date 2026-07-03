    {{-- Crankhaus: Real-Time Order & Reservation Acceptance Modal (Reverb + Polling fallback) --}}
    <style>
        #ck-admin-toast-wrap {
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            pointer-events: none;
        }
        .ck-at {
            background: #1c1917;
            border: 1px solid rgba(235,161,61,0.4);
            border-left: 3px solid #eba13d;
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.4);
            padding: 14px 18px;
            min-width: 280px;
            max-width: 360px;
            font-family: 'Space Grotesk', sans-serif;
            pointer-events: auto;
        }
        .ck-at__label {
            font-size: 9px;
            font-weight: 500;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: #eba13d;
            margin-bottom: 3px;
        }
        .ck-at__title {
            font-size: 13px;
            font-weight: 500;
            color: #efe1d9;
            margin-bottom: 2px;
        }
        .ck-at__body {
            font-size: 11px;
            color: #999;
        }
        
        /* Popup Gate Modal Styles */
        #ck-gate-overlay {
            position: fixed;
            inset: 0;
            background: rgba(2, 11, 10, 0.85);
            backdrop-filter: blur(12px);
            z-index: 999999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .ck-gate-modal {
            background: #020b0a;
            border: 4px solid #eba13d;
            border-radius: 24px;
            max-width: 480px;
            width: 100%;
            padding: 32px;
            color: #efe1d9;
            font-family: 'Space Grotesk', sans-serif;
            box-shadow: 0 20px 60px rgba(0,0,0,0.6);
        }
    </style>
    <div id="ck-admin-toast-wrap"></div>
    
    <!-- Popup Gate Overlay -->
    <div id="ck-gate-overlay">
        <div class="ck-gate-modal">
            <div style="text-align: center; margin-bottom: 24px;">
                <div style="display: inline-flex; width: 64px; height: 64px; background: #ff385c; border-radius: 50%; align-items: center; justify-content: center; margin-bottom: 16px;">
                    <span style="font-size: 32px;">🚲</span>
                </div>
                <h2 style="font-size: 28px; font-weight: 900; color: #ff385c; letter-spacing: -0.04em; text-transform: uppercase; margin: 0; line-height: 1.1;">
                    INCOMING ORDER!
                </h2>
                <p style="font-size: 12px; text-transform: uppercase; tracking-widest; color: #eba13d; margin-top: 4px; font-weight: 700;">
                    Awaiting Chef Action
                </p>
            </div>
            
            <div style="background: rgba(255,255,255,0.05); border-radius: 14px; padding: 20px; margin-bottom: 24px;">
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 10px; margin-bottom: 10px;">
                    <span style="font-size: 13px; color: #999;">Customer:</span>
                    <span id="ck-gate-name" style="font-weight: 700; color: #fff;"></span>
                </div>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 10px; margin-bottom: 10px;">
                    <span style="font-size: 13px; color: #999;">Table:</span>
                    <span id="ck-gate-table" style="font-weight: 700; color: #eba13d;"></span>
                </div>
                <div style="display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 10px; margin-bottom: 10px;">
                    <span style="font-size: 13px; color: #999;">Queue No:</span>
                    <span id="ck-gate-queue" style="font-weight: 900; color: #ff385c;"></span>
                </div>
                
                <div style="margin-top: 14px;">
                    <span style="font-size: 11px; text-transform: uppercase; color: #999; font-weight: 700; display: block; margin-bottom: 6px;">Ordered Items:</span>
                    <ul id="ck-gate-items" style="list-style: none; padding: 0; margin: 0; font-size: 13px; color: #fff; max-height: 120px; overflow-y: auto;">
                        <!-- Javascript injection -->
                    </ul>
                </div>
            </div>
            
            <div style="display: flex; gap: 12px;">
                <button id="ck-gate-btn-cancel" style="flex: 1; padding: 14px; background: #b42638; border: none; border-radius: 12px; color: #fff; font-weight: 900; text-transform: uppercase; cursor: pointer; transition: background 0.2s;">
                    Cancel
                </button>
                <button id="ck-gate-btn-acc" style="flex: 2; padding: 14px; background: #eba13d; border: none; border-radius: 12px; color: #020b0a; font-weight: 900; text-transform: uppercase; cursor: pointer; transition: background 0.2s;">
                    Accept (ACC)
                </button>
            </div>
        </div>
    </div>
    
    <script>
    (function() {
        let lastPollTime = {{ now()->timestamp }};
        let orderQueue = [];
        let activeOrder = null;

        function loadGsap(cb) {
            if (window.gsap) { cb(); return; }
            const s = document.createElement('script');
            s.src = 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js';
            s.onload = cb;
            document.head.appendChild(s);
        }

        // Synthesize bell and success arpeggio sounds
        function playSound(type) {
            try {
                const AudioContext = window.AudioContext || window.webkitAudioContext;
                if (!AudioContext) return;
                const ctx = new AudioContext();
                
                if (type === 'bell') {
                    // Bicyclist double-ping bell sound
                    const playPing = (delay, frequency) => {
                        const osc = ctx.createOscillator();
                        const gain = ctx.createGain();
                        osc.connect(gain);
                        gain.connect(ctx.destination);
                        
                        osc.type = 'sine';
                        osc.frequency.setValueAtTime(frequency, ctx.currentTime + delay);
                        
                        gain.gain.setValueAtTime(0, ctx.currentTime + delay);
                        gain.gain.linearRampToValueAtTime(0.15, ctx.currentTime + delay + 0.01);
                        gain.gain.exponentialRampToValueAtTime(0.0001, ctx.currentTime + delay + 0.45);
                        
                        osc.start(ctx.currentTime + delay);
                        osc.stop(ctx.currentTime + delay + 0.5);
                    };
                    playPing(0, 880);      // Strike 1 (A5)
                    playPing(0.08, 1046.5); // Strike 2 (C6) with 80ms delay
                } else if (type === 'success') {
                    // Rising arpeggio sound
                    const playTone = (delay, frequency, duration) => {
                        const osc = ctx.createOscillator();
                        const gain = ctx.createGain();
                        osc.connect(gain);
                        gain.connect(ctx.destination);
                        
                        osc.type = 'sine';
                        osc.frequency.setValueAtTime(frequency, ctx.currentTime + delay);
                        
                        gain.gain.setValueAtTime(0, ctx.currentTime + delay);
                        gain.gain.linearRampToValueAtTime(0.1, ctx.currentTime + delay + 0.01);
                        gain.gain.exponentialRampToValueAtTime(0.0001, ctx.currentTime + delay + duration);
                        
                        osc.start(ctx.currentTime + delay);
                        osc.stop(ctx.currentTime + delay + duration + 0.05);
                    };
                    playTone(0, 523.25, 0.15);  // C5
                    playTone(0.06, 659.25, 0.15); // E5
                    playTone(0.12, 784.00, 0.15); // G5
                    playTone(0.18, 1046.50, 0.3); // C6
                }
            } catch (err) {}
        }

        function showToast(label, title, body) {
            playSound('bell');
            loadGsap(() => {
                const wrap = document.getElementById('ck-admin-toast-wrap');
                if (!wrap) return;
                const el = document.createElement('div');
                el.className = 'ck-at';
                el.innerHTML = `
                    <div class="ck-at__label">${label}</div>
                    <div class="ck-at__title">${title}</div>
                    <div class="ck-at__body">${body}</div>
                `;
                wrap.appendChild(el);
                window.gsap.fromTo(el,
                    { opacity: 0, x: 60, scale: 0.95 },
                    { opacity: 1, x: 0, scale: 1, duration: 0.45, ease: 'power3.out' }
                );
                setTimeout(() => {
                    window.gsap.to(el, {
                        opacity: 0, x: 60,
                        duration: 0.35, ease: 'power2.in',
                        onComplete: () => el.remove()
                    });
                }, 6000);
            });
        }

        // Open popup gate modal
        function openOrderGate(order) {
            activeOrder = order;
            playSound('bell');
            
            // Fill fields
            document.getElementById('ck-gate-name').innerText = order.customerName;
            document.getElementById('ck-gate-table').innerText = order.tableNumber;
            document.getElementById('ck-gate-queue').innerText = '#' + order.queueNumber;
            
            // Items list
            const itemsList = document.getElementById('ck-gate-items');
            itemsList.innerHTML = '';
            order.items.forEach(item => {
                const li = document.createElement('li');
                li.style.padding = '6px 0';
                li.style.borderBottom = '1px solid rgba(255,255,255,0.05)';
                li.innerHTML = `<span style="font-weight:900; color:#eba13d; margin-right:8px;">${item.quantity}x</span> ${item.name}`;
                itemsList.appendChild(li);
            });
            
            // Show overlay
            const overlay = document.getElementById('ck-gate-overlay');
            overlay.style.display = 'flex';
            
            loadGsap(() => {
                window.gsap.fromTo('.ck-gate-modal',
                    { scale: 0.8, opacity: 0, y: 50 },
                    { scale: 1, opacity: 1, y: 0, duration: 0.6, ease: 'back.out(1.5)' }
                );
            });
        }

        function closeOrderGate() {
            const overlay = document.getElementById('ck-gate-overlay');
            overlay.style.display = 'none';
            activeOrder = null;
            
            // Check queue for next order
            if (orderQueue.length > 0) {
                setTimeout(() => {
                    const nextOrder = orderQueue.shift();
                    openOrderGate(nextOrder);
                }, 300);
            }
        }

        // ACC Order status (Accept)
        function acceptActiveOrder() {
            if (!activeOrder) return;
            const orderId = activeOrder.orderId;
            
            fetch(`/api/orders/${orderId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: 'processing' })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    playSound('success');
                    // Trigger a Filament refresh of current table if possible
                    if (window.Livewire) {
                        window.Livewire.dispatch('refresh-orders');
                    }
                    // Reload location path to see immediate changes
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                }
            })
            .finally(() => {
                closeOrderGate();
            });
        }

        // Cancel Order status (Reject)
        function rejectActiveOrder() {
            if (!activeOrder) return;
            const orderId = activeOrder.orderId;
            
            fetch(`/api/orders/${orderId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: 'rejected' })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    if (window.Livewire) {
                        window.Livewire.dispatch('refresh-orders');
                    }
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                }
            })
            .finally(() => {
                closeOrderGate();
            });
        }

        // Bind buttons
        document.getElementById('ck-gate-btn-acc').addEventListener('click', acceptActiveOrder);
        document.getElementById('ck-gate-btn-cancel').addEventListener('click', rejectActiveOrder);

        // Poll every 6 seconds for orders and reservations
        function pollData() {
            // Poll Orders
            fetch('/api/orders/latest-pending?since=' + lastPollTime, {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.ok ? r.json() : null)
            .then(data => {
                if (data && data.orders && data.orders.length > 0) {
                    data.orders.forEach(o => {
                        if (activeOrder || orderQueue.some(item => item.orderId === o.orderId)) {
                            orderQueue.push(o);
                        } else {
                            openOrderGate(o);
                        }
                    });
                    lastPollTime = data.server_time;
                }
            })
            .catch(() => {});

            // Poll Reservations
            fetch('/api/reservations/latest-pending?since=' + lastPollTime, {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.ok ? r.json() : null)
            .then(data => {
                if (data && data.reservations && data.reservations.length > 0) {
                    data.reservations.forEach(r => {
                        showToast(
                            '📅 New Reservation',
                            `${r.name} — ${r.partySize} guests`,
                            `Scheduled: ${r.date} at ${r.time}`
                        );
                    });
                    lastPollTime = data.server_time;
                }
            })
            .catch(() => {});
        }

        setTimeout(() => {
            pollData();
            setInterval(pollData, 6000);
        }, 3000);

        // Reverb / Echo integration
        document.addEventListener('DOMContentLoaded', () => {
            if (!window.Echo) return;
            try {
                window.Echo.channel('orders').listen('.new-order', e => {
                    if (!e) return;
                    // Fetch details
                    fetch('/api/orders/latest-pending?since=' + (lastPollTime - 5))
                    .then(r => r.json())
                    .then(data => {
                        if (data && data.orders) {
                            const matches = data.orders.filter(item => item.orderId === e.orderId);
                            if (matches.length > 0) {
                                const match = matches[0];
                                if (activeOrder) {
                                    orderQueue.push(match);
                                } else {
                                    openOrderGate(match);
                                }
                            }
                        }
                    });
                });
                window.Echo.channel('reservations').listen('NewReservationPlaced', e => {
                    if (!e || !e.reservation) return;
                    showToast(
                        '📅 Reservation',
                        `${e.reservation.name} — ${e.reservation.party_size} guests`,
                        `${e.reservation.date} at ${e.reservation.time}`
                    );
                });
            } catch (err) {}
        });
    })();
    </script>