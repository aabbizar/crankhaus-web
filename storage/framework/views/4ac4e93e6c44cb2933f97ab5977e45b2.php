<div class="w-full" id="reservation-form-root">
    
    <style>
        /* Spacing and visual adjustments for the cinematic Crankhaus theme */
        .lf-field-wrap {
            position: relative;
            border-bottom: 2px solid rgba(255, 255, 255, 0.15);
            padding-bottom: 8px;
            margin-bottom: 80px !important; /* Generous gap to prevent overlap and feel airy */
            transition: border-color 0.35s ease;
        }
        .lf-field-wrap:hover {
            border-color: rgba(255, 255, 255, 0.45);
        }
        .lf-field-wrap.is-focused {
            border-color: #eba13d !important;
        }
        .lf-field-wrap .lf-label {
            position: absolute;
            left: 0;
            top: 24px;
            width: 100%;
            text-align: center;
            font-family: var(--font-display), sans-serif;
            font-size: 1.15rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(239, 225, 217, 0.55);
            transform-origin: center top;
            pointer-events: none;
            transition: color 0.35s ease;
        }
        /* Input overrides */
        .lf-field-wrap .lf-input {
            width: 100%;
            background: transparent;
            border: none;
            outline: none;
            color: #eba13d;
            font-family: var(--font-display), sans-serif;
            font-weight: 900;
            font-size: 1.6rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding-top: 36px;
            padding-bottom: 8px;
            transition: color 0.3s ease;
        }
        /* Style date input calendar icon */
        .lf-field-wrap .lf-input[type="date"] {
            color-scheme: dark;
            color: transparent;
            cursor: pointer;
        }
        .lf-field-wrap.is-focused .lf-input[type="date"],
        .lf-field-wrap.has-value .lf-input[type="date"] {
            color: #eba13d;
        }
        /* Underline line animation (Elastic Liquid Curve) */
        .lf-field-wrap svg {
            overflow: visible;
        }
        .lf-field-wrap svg path.underline-active {
            stroke-dasharray: 200;
            stroke-dashoffset: 200;
            transition: stroke-dashoffset 0.45s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .lf-field-wrap.is-focused svg path.underline-active,
        .lf-field-wrap.has-value svg path.underline-active {
            stroke-dashoffset: 0;
        }
        
        /* Custom date picker popups */
        ::-webkit-calendar-picker-indicator {
            filter: invert(0.6) sepia(1) saturate(5) hue-rotate(350deg); /* Gold icon */
            cursor: pointer;
        }

        /* Party size button overrides */
        .party-btn {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            border: 2px solid rgba(235,161,61,0.25);
            background: rgba(2,11,10,0.3);
            color: #eba13d;
            font-family: var(--font-display), sans-serif;
            font-weight: 900;
            font-size: 1.15rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .party-btn:hover {
            border-color: #eba13d;
            color: #ffffff;
            transform: scale(1.08);
        }
        .party-btn.active-party {
            background: #eba13d !important;
            border-color: #eba13d !important;
            color: #020b0a !important;
            box-shadow: 0 0 15px rgba(235,161,61,0.5);
            transform: scale(1.08);
        }

        /* ── MILK-WHITE LIGHT THEME OVERRIDES ── */
        .bg-milk-white-form .lf-field-wrap {
            border-bottom-color: rgba(2, 11, 10, 0.12);
        }
        .bg-milk-white-form .lf-field-wrap:hover {
            border-color: rgba(2, 11, 10, 0.3);
        }
        .bg-milk-white-form .lf-field-wrap.is-focused {
            border-color: #235c47 !important;
        }
        .bg-milk-white-form .lf-field-wrap .lf-label {
            color: rgba(2, 11, 10, 0.45);
        }
        .bg-milk-white-form .lf-field-wrap.is-focused .lf-label,
        .bg-milk-white-form .lf-field-wrap.has-value .lf-label {
            color: #235c47 !important;
        }
        .bg-milk-white-form .lf-field-wrap .lf-input {
            color: #020b0a;
        }
        .bg-milk-white-form .lf-field-wrap .lf-input[type="date"] {
            color-scheme: light;
            color: transparent;
        }
        .bg-milk-white-form .lf-field-wrap.is-focused .lf-input[type="date"],
        .bg-milk-white-form .lf-field-wrap.has-value .lf-input[type="date"] {
            color: #020b0a;
        }
        .bg-milk-white-form ::-webkit-calendar-picker-indicator {
            filter: none; /* Reset webkit calendar filter */
            cursor: pointer;
        }
        .bg-milk-white-form .lf-field-wrap svg path.underline-base {
            stroke: rgba(2, 11, 10, 0.12);
        }
        .bg-milk-white-form .lf-field-wrap svg path.underline-active {
            stroke: #235c47;
        }

        /* Party buttons light mode overrides */
        .bg-milk-white-form .party-btn {
            border-color: rgba(35, 92, 71, 0.2);
            background: #ffffff;
            color: #235c47;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }
        .bg-milk-white-form .party-btn:hover {
            border-color: #235c47;
            color: #ffffff;
            background: #235c47;
        }
        .bg-milk-white-form .party-btn.active-party {
            background: #235c47 !important;
            border-color: #235c47 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(35, 92, 71, 0.25);
            transform: scale(1.08);
        }
        
        /* Time dropdown light mode overrides */
        .bg-milk-white-form #time-dropdown-btn {
            color: #020b0a !important;
        }
        .bg-milk-white-form #time-dropdown-list {
            background: #ffffff;
            border-color: rgba(35, 92, 71, 0.15);
            box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        }
        .bg-milk-white-form #time-dropdown-list button {
            border-bottom-color: rgba(0, 0, 0, 0.03);
            color: #020b0a !important;
        }
        .bg-milk-white-form #time-dropdown-list button:hover {
            background: rgba(35, 92, 71, 0.05);
            color: #235c47 !important;
        }
        .bg-milk-white-form #time-dropdown-arrow {
            color: #235c47 !important;
        }

        /* Success state card light overrides */
        .bg-milk-white-form .reservation-success-card {
            background: #ffffff !important;
            border-color: rgba(35, 92, 71, 0.1) !important;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04) !important;
        }
        .bg-milk-white-form .reservation-success-card p {
            color: rgba(2, 11, 10, 0.6) !important;
        }
        .bg-milk-white-form .party-size-container {
            border-color: rgba(2, 11, 10, 0.08) !important;
        }
        .bg-milk-white-form .party-size-container div {
            color: #235c47 !important;
        }
        .bg-milk-white-form .submit-container {
            border-color: rgba(2, 11, 10, 0.08) !important;
        }
        .bg-milk-white-form .submit-container div {
            color: rgba(2, 11, 10, 0.5) !important;
        }
    </style>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($submitted): ?>

        <div class="text-center py-16 reservation-success-card" style="background: rgba(2, 11, 10, 0.4); border: 2px solid rgba(235,161,61,0.1); border-radius: 14px; padding: 48px;">
            
            <div class="w-24 h-24 mx-auto flex items-center justify-center mb-8 shadow-2xl animate-bounce"
                 style="background: #b42638; border-radius: 50%; box-shadow: 0 0 20px rgba(180,38,56,0.4);">
                <span class="font-display font-black text-[#eba13d] select-none" style="font-size: 3.5rem; line-height: 1;">✓</span>
            </div>

            <h3 class="font-display font-black text-[#eba13d] uppercase leading-none mb-4 animate-pulse"
                style="font-size: clamp(2rem, 5vw, 3rem);">
                Request Sent!
            </h3>

            <p class="font-mono text-sm md:text-base text-[#efe1d9]/70 leading-relaxed mb-12 max-w-md mx-auto">
                Your reservation request has been submitted. We will confirm your table within 2 hours via email.
            </p>

            <button
                wire:click="resetForm"
                class="font-display font-black text-sm uppercase tracking-widest text-[#eba13d] py-5 px-12 rounded-full transition-all hover:scale-105 cursor-pointer shadow-lg hover:shadow-2xl"
                style="background: #b42638; letter-spacing: 0.15em;"
                aria-label="Make another reservation"
            >
                Make Another Reservation
            </button>
        </div>

        <script>
            (function () {
                var card = document.querySelector('.reservation-success-card');
                if (card && window.gsap) {
                    gsap.fromTo(card,
                        { scale: 0.8, opacity: 0, y: 40 },
                        { scale: 1, opacity: 1, y: 0, duration: 0.65, ease: 'back.out(1.8)', delay: 0.1 }
                    );
                }
            })();
        </script>

    
    <?php else: ?>

    <form wire:submit.prevent="submit" id="lf-reservation-form" novalidate class="flex flex-col">

        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-12 gap-y-4">
            
            
            <div class="lf-field-wrap light-mode <?php if($name): ?> has-value <?php endif; ?>" id="wrap-name">
                <label for="rf-name" class="lf-label">Full Name</label>
                <input
                    type="text"
                    id="rf-name"
                    wire:model.defer="name"
                    class="lf-input"
                    placeholder=""
                    autocomplete="name"
                    aria-label="Full name"
                >
                <svg class="absolute bottom-0 left-0 w-full h-[12px] pointer-events-none" viewBox="0 0 100 12" preserveAspectRatio="none">
                    <path class="underline-base" d="M0 2 Q50 2 100 2" stroke="rgba(255, 255, 255, 0.15)" stroke-width="2" fill="none" />
                    <path class="underline-active" d="M0 2 Q50 2 100 2" stroke="#eba13d" stroke-width="2" fill="none" />
                </svg>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="font-mono text-xs font-bold mt-2 text-red-500"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="lf-field-wrap light-mode <?php if($email): ?> has-value <?php endif; ?>" id="wrap-email">
                <label for="rf-email" class="lf-label">Email Address</label>
                <input
                    type="email"
                    id="rf-email"
                    wire:model.defer="email"
                    class="lf-input"
                    placeholder=""
                    autocomplete="email"
                    aria-label="Email address"
                >
                <svg class="absolute bottom-0 left-0 w-full h-[12px] pointer-events-none" viewBox="0 0 100 12" preserveAspectRatio="none">
                    <path class="underline-base" d="M0 2 Q50 2 100 2" stroke="rgba(255, 255, 255, 0.15)" stroke-width="2" fill="none" />
                    <path class="underline-active" d="M0 2 Q50 2 100 2" stroke="#eba13d" stroke-width="2" fill="none" />
                </svg>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="font-mono text-xs font-bold mt-2 text-red-500"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        
        <div>
            <div class="lf-field-wrap light-mode <?php if($phone): ?> has-value <?php endif; ?>" id="wrap-phone">
                <label for="rf-phone" class="lf-label">Phone Number</label>
                <input
                    type="tel"
                    id="rf-phone"
                    wire:model.defer="phone"
                    class="lf-input"
                    placeholder=""
                    autocomplete="tel"
                    aria-label="Phone number"
                >
                <svg class="absolute bottom-0 left-0 w-full h-[12px] pointer-events-none" viewBox="0 0 100 12" preserveAspectRatio="none">
                    <path class="underline-base" d="M0 2 Q50 2 100 2" stroke="rgba(255, 255, 255, 0.15)" stroke-width="2" fill="none" />
                    <path class="underline-active" d="M0 2 Q50 2 100 2" stroke="#eba13d" stroke-width="2" fill="none" />
                </svg>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="font-mono text-xs font-bold mt-2 text-red-500"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-12 gap-y-4">

            
            <div class="lf-field-wrap light-mode <?php if($date): ?> has-value <?php endif; ?>" id="wrap-date">
                <label for="rf-date" class="lf-label">Reservation Date</label>
                <input
                    type="date"
                    id="rf-date"
                    wire:model.defer="date"
                    class="lf-input"
                    min="<?php echo e(date('Y-m-d')); ?>"
                    aria-label="Reservation date"
                >
                <svg class="absolute bottom-0 left-0 w-full h-[12px] pointer-events-none" viewBox="0 0 100 12" preserveAspectRatio="none">
                    <path class="underline-base" d="M0 2 Q50 2 100 2" stroke="rgba(255, 255, 255, 0.15)" stroke-width="2" fill="none" />
                    <path class="underline-active" d="M0 2 Q50 2 100 2" stroke="#eba13d" stroke-width="2" fill="none" />
                </svg>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="font-mono text-xs font-bold mt-2 text-red-500"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="lf-field-wrap light-mode <?php if($time): ?> has-value <?php endif; ?> select-none" id="wrap-time">
                <label class="lf-label">Arrival Time</label>
                <div class="relative w-full">
                    <button
                        type="button"
                        id="time-dropdown-btn"
                        class="w-full text-center font-display font-black text-2xl uppercase pt-8 pb-3 border-none bg-transparent outline-none flex justify-between items-center transition-all duration-300"
                        style="color: <?php echo e($time ? '#eba13d' : '#efe1d9'); ?>; cursor: pointer;"
                    >
                        <span class="flex-1 text-center pl-8"><?php echo e($time ? \Carbon\Carbon::createFromFormat('H:i', $time)->format('g:i A') : 'Select Arrival Time'); ?></span>
                        <span class="text-xs transition-transform duration-300 text-[#eba13d]" id="time-dropdown-arrow">▼</span>
                    </button>
                    
                    <div id="time-dropdown-list" class="absolute left-0 right-0 mt-2 max-h-60 overflow-y-auto bg-[#020b0a] border border-[#eba13d]/25 rounded-lg z-50 hidden shadow-[0_20px_50px_rgba(0,0,0,0.6)]">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <button
                                type="button"
                                wire:click="$set('time', '<?php echo e($t); ?>')"
                                onclick="document.getElementById('time-dropdown-list').classList.add('hidden')"
                                class="w-full text-center px-6 py-5 hover:bg-[#eba13d]/10 hover:text-[#eba13d] transition-all font-mono text-base font-bold border-b border-white/5"
                                style="color: <?php echo e($time === $t ? '#eba13d' : '#efe1d9'); ?>;"
                            >
                                <?php echo e(\Carbon\Carbon::createFromFormat('H:i', $t)->format('g:i A')); ?>

                            </button>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>
                <svg class="absolute bottom-0 left-0 w-full h-[12px] pointer-events-none" viewBox="0 0 100 12" preserveAspectRatio="none">
                    <path class="underline-base" d="M0 2 Q50 2 100 2" stroke="rgba(255, 255, 255, 0.15)" stroke-width="2" fill="none" />
                    <path class="underline-active" d="M0 2 Q50 2 100 2" stroke="#eba13d" stroke-width="2" fill="none" />
                </svg>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="font-mono text-xs font-bold mt-2 text-red-500"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        
        <div class="border-y border-white/10 party-size-container text-center flex flex-col items-center" style="margin-top: 80px; margin-bottom: 80px; padding-top: 24px; padding-bottom: 24px;">
            <div class="font-mono text-sm uppercase tracking-[0.2em] text-[#eba13d] font-bold mb-8">
                Party Size (<?php echo e($party_size); ?> <?php echo e($party_size === 1 ? 'Guest' : 'Guests'); ?>)
            </div>
            <div class="flex flex-wrap gap-6 justify-center max-w-2xl w-full" role="group" aria-label="Select party size">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = range(1, 10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <button
                        type="button"
                        wire:click="$set('party_size', <?php echo e($n); ?>)"
                        class="party-btn <?php echo e($party_size === $n ? 'active-party' : ''); ?>"
                        aria-pressed="<?php echo e($party_size === $n ? 'true' : 'false'); ?>"
                        aria-label="<?php echo e($n); ?> <?php echo e($n === 1 ? 'guest' : 'guests'); ?>"
                    >
                        <?php echo e($n); ?>

                    </button>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <button
                    type="button"
                    wire:click="$set('party_size', 15)"
                    class="party-btn <?php echo e($party_size > 10 ? 'active-party' : ''); ?>"
                    style="width: 72px; border-radius: 9999px;"
                    aria-pressed="<?php echo e($party_size > 10 ? 'true' : 'false'); ?>"
                    aria-label="Large group of more than 10"
                >
                    10+
                </button>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['party_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="font-mono text-xs font-bold mt-4 text-red-500"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div style="margin-bottom: 80px;">
            <div class="lf-field-wrap light-mode <?php if($special_requests): ?> has-value <?php endif; ?>" id="wrap-requests">
                <label for="rf-requests" class="lf-label">Special Requests (Optional)</label>
                <textarea
                    id="rf-requests"
                    wire:model.defer="special_requests"
                    class="lf-input resize-none overflow-hidden text-center"
                    rows="1"
                    placeholder=""
                    aria-label="Special requests"
                ></textarea>
                <svg class="absolute bottom-0 left-0 w-full h-[12px] pointer-events-none" viewBox="0 0 100 12" preserveAspectRatio="none">
                    <path class="underline-base" d="M0 2 Q50 2 100 2" stroke="rgba(255, 255, 255, 0.15)" stroke-width="2" fill="none" />
                    <path class="underline-active" d="M0 2 Q50 2 100 2" stroke="#eba13d" stroke-width="2" fill="none" />
                </svg>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['special_requests'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="font-mono text-xs font-bold mt-2 text-red-500"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        
        <div class="flex flex-col items-center gap-6 border-t border-white/10 submit-container" style="padding-top: 60px; margin-bottom: 80px;">

            <div class="font-mono text-sm text-white/50 font-bold uppercase tracking-widest leading-relaxed text-center max-w-md">
                We confirm reservations within 2 hours.<br>
                Check your email inbox after submitting.
            </div>

            <button
                type="submit"
                id="rf-submit-btn"
                wire:loading.attr="disabled"
                wire:target="submit"
                class="relative font-display font-black text-base uppercase tracking-widest text-[#eba13d] px-18 py-8 rounded-full overflow-hidden shadow-[0_15px_45px_rgba(0,0,0,0.4)] group cursor-pointer focus:outline-none flex-shrink-0 z-10"
                style="background: #b42638; letter-spacing: 0.15em; padding: 24px 64px;"
                aria-label="Submit reservation request"
            >
                <div class="absolute inset-0 bg-[#eba13d] translate-y-[100%] transition-transform duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] group-hover:translate-y-0 z-0 pointer-events-none"></div>
                
                <span class="relative z-10 transition-colors duration-300 group-hover:text-[#b42638] flex items-center justify-center gap-3 pointer-events-none" wire:loading.remove wire:target="submit">
                     <span>Reserve My Table →</span>
                </span>
                <span class="relative z-10 transition-colors duration-300 group-hover:text-[#b42638] flex items-center justify-center gap-3 pointer-events-none" wire:loading wire:target="submit">
                    <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    <span>Submitting…</span>
                </span>
            </button>
        </div>

    </form>

    
    <script>
    (function initReservationForm() {
        if (!window.gsap) return;

        // Entrance stagger reveal for form parts
        gsap.fromTo('#lf-reservation-form .lf-field-wrap, #lf-reservation-form .party-size-container, #lf-reservation-form .submit-container',
            { opacity: 0, y: 30 },
            { opacity: 1, y: 0, duration: 0.8, stagger: 0.08, ease: 'power3.out', delay: 0.15 }
        );

        // Underline and floating labels
        document.querySelectorAll('#lf-reservation-form .lf-field-wrap').forEach(function (wrap) {
            var input = wrap.querySelector('.lf-input, input[type="date"]');
            var label = wrap.querySelector('.lf-label');
            var activePath = wrap.querySelector('svg path.underline-active');
            if (!input || !label) return;

            var isLightMode = wrap.closest('.bg-milk-white-form') !== null;
            var activeColor = isLightMode ? '#235c47' : '#eba13d';
            var inactiveColor = isLightMode ? 'rgba(2, 11, 10, 0.45)' : 'rgba(239, 225, 217, 0.55)';

            // Make sure initial state matches values (especially after Livewire updates)
            if (wrap.classList.contains('has-value') || (input.value && input.value.trim())) {
                wrap.classList.add('has-value');
                gsap.set(label, { y: -34, scale: 0.7, color: activeColor });
            }

            // Focus states with plucked guitar string curve effect
            input.addEventListener('focus', function () {
                wrap.classList.add('is-focused');
                gsap.to(label, { y: -34, scale: 0.7, color: activeColor, duration: 0.35, ease: 'power3.out' });
                if (activePath) {
                    gsap.timeline()
                        .to(activePath, { attr: { d: "M0 2 Q50 10 100 2" }, duration: 0.15, ease: "power1.out" })
                        .to(activePath, { attr: { d: "M0 2 Q50 2 100 2" }, duration: 0.85, ease: "elastic.out(1.5, 0.3)" });
                }
            });

            input.addEventListener('blur', function () {
                wrap.classList.remove('is-focused');
                if (input.value && input.value.trim()) {
                    wrap.classList.add('has-value');
                    gsap.to(label, { y: -34, scale: 0.7, color: activeColor, duration: 0.35, ease: 'power3.out' });
                } else {
                    wrap.classList.remove('has-value');
                    gsap.to(label, { y: 0, scale: 1, color: inactiveColor, duration: 0.35, ease: 'power3.out' });
                }
            });

            // Swipe pluck on mousemove near bottom of the field
            wrap.addEventListener('mousemove', function (e) {
                // If it is focused, keep focused state curve.
                if (wrap.classList.contains('is-focused')) return;

                var rect = wrap.getBoundingClientRect();
                var x = e.clientX - rect.left;
                var y = e.clientY - rect.top;
                
                // Calculate cursor distance to the underline path (bottom of wrap)
                var distanceToBottom = Math.abs(y - rect.height);
                var pctX = (x / rect.width) * 100;
                
                // Keep percentage boundaries solid
                if (pctX < 0) pctX = 0;
                if (pctX > 100) pctX = 100;

                // Pluck effect threshold (within 28px of bottom)
                if (distanceToBottom < 28) {
                    var strength = (1 - (distanceToBottom / 28)); // 0 to 1
                    var bendDepth = 2 + (strength * 10); // bend down up to 12px
                    
                    if (activePath) {
                        gsap.killTweensOf(activePath);
                        gsap.to(activePath, {
                            attr: { d: "M0 2 Q" + pctX + " " + bendDepth + " 100 2" },
                            duration: 0.12,
                            ease: "power2.out"
                        });
                    }
                } else {
                    // Reset to straight line if moved too far vertically within the wrap
                    if (activePath) {
                        gsap.to(activePath, {
                            attr: { d: "M0 2 Q50 2 100 2" },
                            duration: 0.7,
                            ease: "elastic.out(2.0, 0.28)"
                        });
                    }
                }
            });

            wrap.addEventListener('mouseleave', function () {
                if (wrap.classList.contains('is-focused')) return;
                if (activePath) {
                    gsap.killTweensOf(activePath);
                    gsap.to(activePath, {
                        attr: { d: "M0 2 Q50 2 100 2" },
                        duration: 0.85,
                        ease: "elastic.out(2.0, 0.28)"
                    });
                }
            });

            // Handle date types color update dynamically
            if (input.type === 'date') {
                input.addEventListener('change', function () {
                    if (input.value) {
                        wrap.classList.add('has-value');
                        gsap.to(label, { y: -34, scale: 0.7, color: activeColor, duration: 0.35, ease: 'power3.out' });
                    } else {
                        wrap.classList.remove('has-value');
                        gsap.to(label, { y: 0, scale: 1, color: inactiveColor, duration: 0.35, ease: 'power3.out' });
                    }
                });
            }
        });

        // Custom time dropdown interaction
        var dropdownBtn = document.getElementById('time-dropdown-btn');
        var dropdownList = document.getElementById('time-dropdown-list');
        var dropdownArrow = document.getElementById('time-dropdown-arrow');
        var wrapTime = document.getElementById('wrap-time');
        var dropdownItems = dropdownList ? dropdownList.querySelectorAll('button') : [];

        if (dropdownBtn && dropdownList) {
            dropdownBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                var isHidden = dropdownList.classList.contains('hidden');
                
                // Toggle list visibility with smooth sliding GSAP scale
                if (isHidden) {
                    dropdownList.classList.remove('hidden');
                    if (wrapTime) wrapTime.classList.add('is-focused');
                    if (dropdownArrow) gsap.to(dropdownArrow, { rotation: 180, duration: 0.3 });
                    
                    gsap.killTweensOf(dropdownList);
                    gsap.killTweensOf(dropdownItems);
                    
                    gsap.fromTo(dropdownList,
                        { opacity: 0, scaleY: 0, transformOrigin: 'top center' },
                        { opacity: 1, scaleY: 1, duration: 0.4, ease: 'power3.out' }
                    );
                    gsap.fromTo(dropdownItems,
                        { opacity: 0, y: -12 },
                        { opacity: 1, y: 0, duration: 0.3, stagger: 0.015, ease: 'power2.out', delay: 0.05 }
                    );
                } else {
                    closeDropdown();
                }
            });

            function closeDropdown() {
                if (dropdownList.classList.contains('hidden')) return;
                if (wrapTime) wrapTime.classList.remove('is-focused');
                if (dropdownArrow) gsap.to(dropdownArrow, { rotation: 0, duration: 0.3 });
                
                gsap.killTweensOf(dropdownList);
                gsap.to(dropdownList, {
                    opacity: 0,
                    scaleY: 0,
                    transformOrigin: 'top center',
                    duration: 0.3,
                    ease: 'power3.inOut',
                    onComplete: function() {
                        dropdownList.classList.add('hidden');
                    }
                });
            }

            document.addEventListener('click', closeDropdown);
        }

        // Textarea Autogrow
        var textarea = document.getElementById('rf-requests');
        if (textarea) {
            // Setup initial height
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
            
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        }

        // Magnetic submit button follow
        var submitBtn = document.getElementById('rf-submit-btn');
        if (submitBtn) {
            submitBtn.addEventListener('mousemove', function (e) {
                var rect = submitBtn.getBoundingClientRect();
                var x = e.clientX - rect.left - rect.width  / 2;
                var y = e.clientY - rect.top  - rect.height / 2;
                gsap.to(submitBtn, { x: x * 0.35, y: y * 0.35, duration: 0.28, ease: 'power2.out' });
            });
            submitBtn.addEventListener('mouseleave', function () {
                gsap.to(submitBtn, { x: 0, y: 0, duration: 0.65, ease: 'elastic.out(1.2, 0.4)' });
            });
        }

        // Re-init after Livewire DOM updates
        document.addEventListener('livewire:update', function () {
            setTimeout(initReservationForm, 80);
        });
    })();
    </script>

    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>
<?php /**PATH C:\laragon\www\agtokosahaja_project\resources\views/livewire/reservation-form.blade.php ENDPATH**/ ?>