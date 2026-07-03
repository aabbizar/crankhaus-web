<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>


    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('status')): ?>
        <div class="ck-alert" role="alert"><?php echo e(session('status')); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
        <div class="ck-alert" role="alert">
            ⚠ These credentials do not match our records.
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <form method="POST" action="<?php echo e(route('login')); ?>" class="ck-form" id="loginForm" novalidate>
        <?php echo csrf_field(); ?>

        
        <div class="ck-field">
            <input
                id="email"
                type="email"
                name="email"
                value="<?php echo e(old('email')); ?>"
                required
                autofocus
                autocomplete="username"
                placeholder="Enter email"
                class="ck-input"
                aria-describedby="emailError"
            >
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="ck-error" id="emailError"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div class="ck-field">
            <div class="ck-pw-wrap">
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="Enter password"
                    class="ck-input"
                    aria-describedby="passwordError"
                >
                
                <button
                    type="button"
                    class="ck-pw-toggle"
                    id="pwToggle"
                    aria-label="Toggle password visibility"
                    tabindex="-1"
                >
                    <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <svg id="eyeOff" xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75" style="display:none;" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.956 9.956 0 012.223-3.592M6.228 6.228A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.43 5.272M3 3l18 18"/>
                    </svg>
                </button>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="ck-error" id="passwordError"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>

        
        <div class="ck-row">
            <label for="remember_me" class="ck-checkbox-label">
                <input id="remember_me" type="checkbox" name="remember" class="ck-checkbox">
                Remember me
            </label>
        </div>

        
        <button type="submit" class="ck-btn" id="loginBtn">
            Sign In →
        </button>

    </form>

    <script>
    (function () {
        'use strict';

        // Password visibility toggle
        var toggle  = document.getElementById('pwToggle');
        var pwInput = document.getElementById('password');
        var eyeOpen = document.getElementById('eyeOpen');
        var eyeOff  = document.getElementById('eyeOff');

        if (toggle && pwInput) {
            toggle.addEventListener('click', function () {
                var hidden = pwInput.type === 'password';
                pwInput.type          = hidden ? 'text'     : 'password';
                eyeOpen.style.display = hidden ? 'none'     : '';
                eyeOff.style.display  = hidden ? ''         : 'none';
            });
        }

        // Submit loading feedback
        var form = document.getElementById('loginForm');
        var btn  = document.getElementById('loginBtn');
        if (form && btn) {
            form.addEventListener('submit', function () {
                btn.textContent = 'Signing in…';
                btn.disabled    = true;
            });
        }

        // Input micro-interactions via focus/blur
        document.querySelectorAll('.ck-input').forEach(function (input) {
            input.addEventListener('focus', function () {
                if (window.gsap) {
                    gsap.to(this, { scale: 1.008, duration: 0.25, ease: 'power2.out' });
                }
            });
            input.addEventListener('blur', function () {
                if (window.gsap) {
                    gsap.to(this, { scale: 1, duration: 0.25, ease: 'power2.out' });
                }
            });
        });
    })();
    </script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\agtokosahaja_project\resources\views/auth/login.blade.php ENDPATH**/ ?>