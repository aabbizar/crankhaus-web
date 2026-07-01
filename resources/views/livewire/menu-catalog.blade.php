<div class="w-full" id="menu-catalog-root">

    {{-- ══════════════════════════════════════════════════════════════
         CINEMATIC FLOATING MEDIA MENU — CRANKHAUS × LUCKYFOLKS STYLE
         ══════════════════════════════════════════════════════════════ --}}

    {{-- ── SECTION HEADER (Removed to favor minimalist main header) ── --}}

    {{-- ── CATEGORY FILTER BAR ── --}}
    @php
        $tabs = [
            ['key' => 'all',           'label' => 'Everything', 'num' => 'I'],
            ['key' => 'Makanan Utama', 'label' => 'Mains',      'num' => 'II'],
            ['key' => 'Cemilan',       'label' => 'Snacks',     'num' => 'III'],
            ['key' => 'Minuman',       'label' => 'Drinks',     'num' => 'IV'],
        ];
    @endphp

    <div class="w-full" style="background: #020b0a; border-bottom: 1px solid rgba(239,225,217,0.06);">
        <div class="max-w-screen-2xl mx-auto px-4 md:px-8">
            <div class="flex" role="tablist" aria-label="Menu categories">
                @foreach($tabs as $tab)
                    @php $isActive = $activeCategory === $tab['key']; @endphp
                    <button
                        wire:key="tab-{{ $tab['key'] }}"
                        wire:click="setCategory('{{ $tab['key'] }}')"
                        role="tab"
                        id="tab-{{ $tab['key'] }}"
                        aria-selected="{{ $isActive ? 'true' : 'false' }}"
                        class="ch-filter-tab font-display font-black uppercase cursor-pointer focus:outline-none"
                        data-active="{{ $isActive ? '1' : '0' }}"
                        style="
                            position: relative;
                            padding: 1.4rem 2rem;
                            font-size: clamp(0.65rem, 1.2vw, 0.78rem);
                            letter-spacing: 0.18em;
                            color: {{ $isActive ? '#eba13d' : 'rgba(239,225,217,0.35)' }};
                            border-bottom: 2px solid {{ $isActive ? '#eba13d' : 'transparent' }};
                            transition: color 0.25s ease, border-color 0.25s ease;
                            background: none;
                            border-top: none;
                            border-left: none;
                            border-right: none;
                        "
                    >
                        <span class="font-mono mr-2 opacity-40" style="font-size: 0.6rem;">{{ $tab['num'] }}</span>
                        {{ $tab['label'] }}
                        <span class="font-mono ml-1.5 opacity-30" style="font-size: 0.6rem;">
                            ({{ $tab['key'] === 'all' ? $categoryCounts->sum() : ($categoryCounts[$tab['key']] ?? 0) }})
                        </span>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         HIDDEN CART DATA STORE (always rendered — lets JS read cart without opening checkout modal)
         ══════════════════════════════════════════════ --}}
    @if(count($cart) > 0)
    <script id="ck-cart-data" type="application/json">
    {
        "total": {{ collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']) }},
        "totalFormatted": "Rp {{ number_format(collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']), 0, ',', '.') }}",
        "totalQty": {{ collect($cart)->sum('quantity') }},
        "items": [
            @foreach($cart as $id => $item)
            {
                "id": {{ $id }},
                "name": "{{ addslashes($item['name']) }}",
                "price": {{ $item['price'] }},
                "priceFormatted": "Rp {{ number_format($item['price'], 0, ',', '.') }}",
                "quantity": {{ $item['quantity'] }},
                "subtotal": "Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}"
            }{{ !$loop->last ? ',' : '' }}
            @endforeach
        ]
    }
    </script>
    @endif

    {{-- ══════════════════════════════════════════════
         3D SPATIAL GALLERY — MENU GRID (PHYSICS ENHANCED)
         ══════════════════════════════════════════════ --}}
    <style>
        /* ── Effect 2: Spotlight CSS Variables ── */
        .ch-spatial-card {
            --x: 50%;
            --y: 50%;
        }
        .ch-card-spotlight {
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: radial-gradient(
                circle 220px at var(--x) var(--y),
                rgba(235, 161, 61, 0.12) 0%,
                rgba(235, 161, 61, 0.04) 40%,
                transparent 70%
            );
            pointer-events: none;
            z-index: 5;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .ch-spatial-card:hover .ch-card-spotlight {
            opacity: 1;
        }
        /* ── Effect 3: Z-axis depth layers ── */
        .ch-card-img-layer {
            position: absolute;
            inset: 0;
            will-change: transform;
        }
        .ch-card-content-layer {
            position: absolute;
            inset-inline: 0;
            bottom: 0;
            padding: 1.5rem;
            will-change: transform;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }
        /* ── Effect 4: Magnetic Liquid Button ── */
        .ch-add-btn {
            position: relative;
            width: 44px;
            height: 44px;
            min-width: 44px;
            border-radius: 50%;
            background: #eba13d;
            color: #020b0a;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            will-change: transform;
            box-shadow: 0 4px 14px rgba(235,161,61,0.25);
            transition: width 0.4s cubic-bezier(0.16,1,0.3,1), border-radius 0.4s cubic-bezier(0.16,1,0.3,1);
        }
        .ch-add-btn.morphed {
            width: 88px;
            border-radius: 22px;
        }
        .ch-add-btn-plus {
            position: absolute;
            font-family: inherit;
            font-size: 1.3rem;
            font-weight: 900;
            will-change: transform, opacity;
            pointer-events: none;
        }
        .ch-add-btn-add {
            position: absolute;
            font-family: inherit;
            font-size: 0.65rem;
            font-weight: 900;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            opacity: 0;
            will-change: transform, opacity;
            pointer-events: none;
        }
    </style>

    <div class="ch-spatial-gallery-section" style="background: #020b0a; padding: clamp(4rem, 8vw, 8rem) 0; position: relative; z-index: 1;">
        <div class="max-w-screen-2xl mx-auto px-4 md:px-8">
            {{-- Effect 1: The grid wrapper that receives velocity skew --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8" id="menu-grid-container">
                @if($menus->isEmpty())
                    <div class="col-span-full text-center py-32 px-8">
                        <div class="font-display font-black uppercase"
                             style="font-size: clamp(3rem, 8vw, 6rem); color: rgba(235,161,61,0.15); line-height: 1;">
                            Coming<br>Soon
                        </div>
                        <p class="font-mono font-bold mt-6" style="color: rgba(239,225,217,0.3); font-size: 0.8rem; letter-spacing: 0.15em; text-transform: uppercase;">
                            The kitchen is warming up
                        </p>
                    </div>
                @else
                    @foreach($menus as $idx => $item)
                        @php
                            if ($activeCategory !== 'all' && $activeCategory !== $item->category) continue;
                            $imgSrc = $item->image_url
                                ? (\Illuminate\Support\Str::startsWith($item->image_url, ['http://', 'https://']) ? $item->image_url : \Illuminate\Support\Facades\Storage::url($item->image_url))
                                : 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600&auto=format&fit=crop&q=80';
                            $accent = $item->category === 'Cemilan' ? '#eba13d' : ($item->category === 'Minuman' ? '#235c47' : '#b42638');
                            $catLabel = $item->category === 'Makanan Utama' ? 'Mains' : ($item->category === 'Cemilan' ? 'Snacks' : 'Drinks');
                            $colClass = $idx % 4; // column index for staggered skew
                        @endphp

                        {{-- Effect 3 wrapper: perspective container for holographic 3D hover --}}
                        <div class="ch-card-perspective-wrap"
                             style="perspective: 1000px; perspective-origin: center;"
                             data-col="{{ $colClass }}">

                            <div class="ch-spatial-card gsap-card-reveal"
                                 wire:key="card-{{ $item->id }}"
                                 data-id="{{ $item->id }}"
                                 data-name="{{ $item->name }}"
                                 data-image="{{ $imgSrc }}"
                                 data-desc="{{ $item->description }}"
                                 data-price="{{ number_format($item->price, 0, ',', '.') }}"
                                 style="
                                    background: #0d1a18;
                                    border-radius: 24px;
                                    overflow: visible;
                                    border: 1px solid rgba(239,225,217,0.06);
                                    cursor: pointer;
                                    position: relative;
                                    aspect-ratio: 3/4;
                                    transform-style: preserve-3d;
                                    will-change: transform;
                                 ">

                                {{-- Effect 2: Spotlight overlay --}}
                                <div class="ch-card-spotlight"></div>

                                {{-- Image layer (Effect 3: translateZ(40px) on hover) --}}
                                <div class="ch-card-img-layer" style="border-radius: 24px; overflow: hidden;">
                                    <img src="{{ $imgSrc }}"
                                         alt="{{ $item->name }}"
                                         class="ch-card-img w-full h-full object-cover"
                                         loading="lazy"
                                         onerror="this.src='https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600&auto=format&fit=crop&q=80'">
                                    <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(2,11,10,0.95) 0%, rgba(2,11,10,0.4) 40%, transparent 100%);"></div>
                                </div>

                                {{-- Content layer (Effect 3: translateZ(80px) on hover — floats above image) --}}
                                <div class="ch-card-content-layer" style="pointer-events: none;">
                                    <div style="display: inline-block; background: {{ $accent }}; color: {{ $accent === '#eba13d' ? '#020b0a' : 'white' }}; font-size: 0.6rem; font-weight: 900; letter-spacing: 0.18em; text-transform: uppercase; padding: 5px 12px; border-radius: 6px; width: fit-content; margin-bottom: 12px;">
                                        {{ $catLabel }}
                                    </div>

                                    <h3 class="ch-card-title font-display font-black uppercase leading-[0.95] mb-2"
                                        style="font-size: clamp(1.4rem, 2.5vw, 1.8rem); color: #eba13d; letter-spacing: -0.02em;">
                                        {{ $item->name }}
                                    </h3>

                                    <p class="ch-card-desc font-mono font-bold uppercase mb-4"
                                       style="font-size: 0.65rem; color: rgba(239,225,217,0.5); letter-spacing: 0.1em; max-width: 95%; opacity: 0; transform: translateY(8px); transition: none;">
                                        {{ str($item->description ?: 'Premium cyclist fuel.')->limit(60) }}
                                    </p>

                                    <div class="flex items-center justify-between" style="pointer-events: auto;">
                                        <span class="font-display font-black" style="font-size: 1.3rem; color: #eba13d;">
                                            Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </span>

                                        {{-- Effect 4: Magnetic Liquid Button --}}
                                        <button wire:click.stop="addToCart({{ $item->id }})"
                                                class="ch-add-btn font-display font-black"
                                                data-item-id="{{ $item->id }}"
                                                aria-label="Add {{ $item->name }} to basket">
                                            <span class="ch-add-btn-plus">+</span>
                                            <span class="ch-add-btn-add">ADD</span>
                                        </button>
                                    </div>
                                </div>

                                {{-- Effect 5: FLIP origin marker (invisible, used for bounding math) --}}
                                <div class="ch-flip-origin" style="position: absolute; inset: 0; pointer-events: none;"></div>

                            </div>{{-- .ch-spatial-card --}}

                            {{-- Invisible click target on card (delegates to chOpenShowcase) --}}
                            <div onclick="window.chOpenShowcase(this.closest('.ch-card-perspective-wrap').querySelector('.ch-spatial-card').dataset, this.closest('.ch-card-perspective-wrap').querySelector('.ch-spatial-card'))"
                                 style="position: absolute; inset: 0; cursor: pointer; z-index: 3;"></div>

                        </div>{{-- .ch-card-perspective-wrap --}}
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════
         3D SPATIAL SHOWCASE MODAL
         ══════════════════════════════════════════════ --}}
    <div id="ch-3d-showcase"
         class="fixed inset-0 z-[100] flex items-center justify-center p-0 md:p-12 lg:p-20 pointer-events-none"
         style="background: rgba(2,11,10,0.65); backdrop-filter: blur(40px); opacity: 0;"
         aria-hidden="true">

        {{-- Background Graphic / Mesh --}}
        <div class="absolute inset-0 z-0 opacity-50 pointer-events-none" style="background: radial-gradient(circle at center, rgba(235,161,61,0.1) 0%, transparent 60%);"></div>

        {{-- Main Showcase Container --}}
        <div id="ch-showcase-container"
             class="relative z-10 w-full h-full max-w-[1200px] flex flex-col md:flex-row items-center justify-center overflow-hidden"
             style="border-radius: 36px; background: linear-gradient(135deg, rgba(255,255,255,0.03) 0%, rgba(255,255,255,0.01) 100%); border: 1px solid rgba(239,225,217,0.05); box-shadow: 0 40px 100px rgba(0,0,0,0.8);">

            {{-- Close Button --}}
            <button onclick="window.chCloseShowcase()"
                    class="absolute top-6 right-6 md:top-8 md:right-8 z-50 w-12 h-12 flex items-center justify-center font-display font-black text-xl cursor-pointer"
                    style="background: rgba(2,11,10,0.5); border-radius: 50%; color: #efe1d9; border: 1px solid rgba(239,225,217,0.1); transition: all 0.3s ease; backdrop-filter: blur(10px);"
                    onmouseover="this.style.background='rgba(235,161,61,0.9)'; this.style.color='#020b0a'"
                    onmouseout="this.style.background='rgba(2,11,10,0.5)'; this.style.color='#efe1d9'"
                    aria-label="Close showcase">✕</button>

            {{-- 3D Image Wrapper --}}
            <div id="ch-showcase-img-wrap"
                 class="w-full md:w-1/2 h-[50vh] md:h-full relative flex-shrink-0 flex items-center justify-center p-6 md:p-12"
                 style="perspective: 1500px;">
                <div id="ch-showcase-img-inner"
                     class="w-full aspect-[3/4] max-h-full relative"
                     style="transform-style: preserve-3d; will-change: transform;">
                    <img id="ch-showcase-img"
                         src=""
                         alt="Menu Item"
                         class="absolute inset-0 w-full h-full object-cover"
                         style="filter: drop-shadow(0 30px 60px rgba(0,0,0,0.7)); border-radius: 28px;">
                    <div class="absolute inset-0" style="background: linear-gradient(to right, rgba(2,11,10,0.3) 0%, transparent 60%); border-radius: 28px;"></div>
                </div>
            </div>

            {{-- Typography & Details --}}
            <div class="w-full md:w-1/2 h-[50vh] md:h-full flex flex-col justify-center relative z-10 px-8 md:px-16"
                 style="background: linear-gradient(to left, rgba(2,11,10,0.8) 0%, transparent 100%);">
                <div id="ch-showcase-text-wrap" style="transform: translateZ(50px);">
                    <h2 id="ch-showcase-title"
                        class="font-display font-black uppercase leading-[0.85] mb-6"
                        style="font-size: clamp(3rem, 6vw, 5.5rem); color: #eba13d; letter-spacing: -0.03em;">
                        TITLE
                    </h2>
                    
                    <p id="ch-showcase-desc"
                       class="font-mono font-bold leading-relaxed mb-10 max-w-md"
                       style="font-size: clamp(0.85rem, 1.2vw, 1rem); color: rgba(239,225,217,0.7); text-transform: uppercase; letter-spacing: 0.05em;">
                        Description
                    </p>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 sm:gap-10 border-t border-[rgba(239,225,217,0.08)] pt-8">
                        <div>
                            <div class="font-mono font-black uppercase" style="font-size: 0.65rem; letter-spacing: 0.25em; color: rgba(239,225,217,0.4); margin-bottom: 0.5rem;">Price</div>
                            <div id="ch-showcase-price" class="font-display font-black" style="font-size: clamp(2rem, 3.5vw, 2.5rem); color: #eba13d;">
                                Rp 0
                            </div>
                        </div>
                        
                        <button id="ch-showcase-add-btn"
                                class="font-display font-black uppercase shadow-2xl"
                                style="font-size: 0.85rem; letter-spacing: 0.15em; color: #020b0a; background: #eba13d; border: none; border-radius: 16px; padding: 20px 40px; cursor: pointer; transition: transform 0.2s cubic-bezier(0.16,1,0.3,1), box-shadow 0.2s ease;"
                                onmouseover="this.style.transform='translateY(-6px) scale(1.05)';this.style.boxShadow='0 20px 40px rgba(235,161,61,0.35)'"
                                onmouseout="this.style.transform='';this.style.boxShadow='0 10px 20px rgba(0,0,0,0.5)'"
                                aria-label="Add to basket">
                            Add to Basket
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function() {
        let showcaseTl;
        let isShowcaseOpen = false;
        let tiltHandler;

        window.chOpenShowcase = function(dataset) {
            if (!window.gsap) return;
            isShowcaseOpen = true;

            const showcase = document.getElementById('ch-3d-showcase');
            const img = document.getElementById('ch-showcase-img');
            const title = document.getElementById('ch-showcase-title');
            const desc = document.getElementById('ch-showcase-desc');
            const price = document.getElementById('ch-showcase-price');
            const addBtn = document.getElementById('ch-showcase-add-btn');
            const imgInner = document.getElementById('ch-showcase-img-inner');
            const container = document.getElementById('ch-showcase-container');

            // Populate Data
            img.src = dataset.image || '';
            title.innerHTML = dataset.name || '';
            desc.innerHTML = dataset.desc || '';
            price.innerHTML = dataset.price ? 'Rp ' + dataset.price : 'Rp 0';
            
            // Bind Add to Cart via Livewire
            addBtn.onclick = function() {
                if (window.Livewire && dataset.id) {
                    const origText = addBtn.innerHTML;
                    addBtn.innerHTML = 'Adding...';
                    window.Livewire.find(
                        document.getElementById('menu-catalog-root').getAttribute('wire:id')
                    ).call('addToCart', dataset.id).then(() => {
                        addBtn.innerHTML = 'Added ✓';
                        setTimeout(() => addBtn.innerHTML = origText, 1500);
                    });
                }
            };

            // Setup entrance timeline (Spatial Zoom)
            gsap.set(showcase, { pointerEvents: 'auto' });
            gsap.set(container, { scale: 1.1, y: 50, rotateX: 10, opacity: 0 });
            gsap.set(imgInner, { scale: 0.8, rotateX: -20, rotateY: 15, z: -100 });
            gsap.set([title, desc, price, addBtn], { y: 60, opacity: 0, z: -50 });

            showcaseTl = gsap.timeline();
            showcaseTl.to(showcase, { opacity: 1, duration: 0.6, ease: 'power2.out' })
                      .to(container, { scale: 1, y: 0, rotateX: 0, opacity: 1, duration: 0.8, ease: 'expo.out' }, '-=0.4')
                      .to(imgInner, { scale: 1, rotateX: 0, rotateY: 0, z: 0, duration: 1.0, ease: 'elastic.out(1, 0.75)' }, '-=0.6')
                      .to([title, desc, price, addBtn], { y: 0, opacity: 1, z: 0, duration: 0.7, stagger: 0.1, ease: 'back.out(1.2)' }, '-=0.8');

            // 3D Hover Tracking for Apple Vision Pro feel
            tiltHandler = function(e) {
                if (!isShowcaseOpen) return;
                const rect = showcase.getBoundingClientRect();
                const xPos = e.clientX / rect.width - 0.5;
                const yPos = e.clientY / rect.height - 0.5;

                gsap.to(imgInner, {
                    rotateY: xPos * 30,
                    rotateX: -yPos * 30,
                    x: xPos * 50,
                    y: yPos * 50,
                    duration: 1.2,
                    ease: 'power3.out'
                });
                
                gsap.to(container, {
                    rotateY: xPos * 5,
                    rotateX: -yPos * 5,
                    duration: 2,
                    ease: 'power2.out'
                });
            };
            showcase.addEventListener('mousemove', tiltHandler);
        };

        window.chCloseShowcase = function() {
            if (!isShowcaseOpen || !window.gsap) return;
            isShowcaseOpen = false;
            
            const showcase = document.getElementById('ch-3d-showcase');
            showcase.removeEventListener('mousemove', tiltHandler);

            if (showcaseTl) {
                showcaseTl.reverse().then(() => {
                    gsap.set(showcase, { pointerEvents: 'none' });
                });
            } else {
                gsap.to(showcase, { opacity: 0, duration: 0.3, onComplete: () => gsap.set(showcase, { pointerEvents: 'none' }) });
            }
        };
    })();
    </script>

    {{-- ══════════════════════════════════════════════
         FLOATING CAPSULE CART BAR
         ══════════════════════════════════════════════ --}}
    @if(count($cart) > 0)
        <div class="fixed bottom-6 left-4 right-4 z-40 max-w-4xl mx-auto shadow-2xl"
             id="floatingCart"
             style="background: rgba(13,26,24,0.97); backdrop-filter: blur(20px); border-radius: 20px; padding: 18px 24px; border: 1px solid rgba(239,225,217,0.08);">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center font-display font-black"
                         style="width: 48px; height: 48px; background: #eba13d; border-radius: 12px; color: #020b0a; font-size: 1.3rem;">
                        {{ collect($cart)->sum('quantity') }}
                    </div>
                    <div>
                        <div class="font-display font-black uppercase" style="font-size: 1.1rem; color: #efe1d9; letter-spacing: -0.01em;">Your Basket</div>
                        <div class="font-mono font-bold" style="font-size: 0.72rem; color: rgba(239,225,217,0.4);">
                            Total: <span style="color: #eba13d;">Rp {{ number_format(collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']), 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3 w-full sm:w-auto">
                    <button wire:click="emptyCart"
                            class="font-display font-black uppercase"
                            style="flex: 1; font-size: 0.6rem; letter-spacing: 0.18em; color: rgba(239,225,217,0.5); background: transparent; border: 1px solid rgba(239,225,217,0.12); border-radius: 10px; padding: 13px 20px; cursor: pointer; transition: border-color 0.2s ease;"
                            onmouseover="this.style.borderColor='rgba(239,225,217,0.3)'" onmouseout="this.style.borderColor='rgba(239,225,217,0.12)'">
                        Clear
                    </button>
                    <button wire:click="openCheckout"
                            class="font-display font-black uppercase"
                            style="flex: 1; font-size: 0.7rem; letter-spacing: 0.18em; color: #ffffff; background: #b42638; border: none; border-radius: 10px; padding: 13px 28px; cursor: pointer; transition: transform 0.2s ease;"
                            onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">
                        Checkout →
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- ══════════════════════════════════════════════
         SCROLL-TO-TOP BUTTON
         ══════════════════════════════════════════════ --}}
    <button id="ch-scroll-top"
            aria-label="Back to top"
            onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
            style="
               position: fixed;
               bottom: 96px;
               right: 24px;
               z-index: 39;
               width: 48px;
               height: 48px;
               border-radius: 50%;
               background: rgba(13,26,24,0.95);
               backdrop-filter: blur(12px);
               border: 1px solid rgba(235,161,61,0.2);
               color: #eba13d;
               font-size: 18px;
               cursor: pointer;
               display: flex;
               align-items: center;
               justify-content: center;
               opacity: 0;
               transform: translateY(16px) scale(0.85);
               transition: border-color 0.2s, background 0.2s;
               will-change: transform, opacity;
               box-shadow: 0 8px 24px rgba(0,0,0,0.4);
            "
            onmouseover="this.style.background='rgba(235,161,61,0.15)';this.style.borderColor='rgba(235,161,61,0.5)'"
            onmouseout="this.style.background='rgba(13,26,24,0.95)';this.style.borderColor='rgba(235,161,61,0.2)'">
        ↑
    </button>

    {{-- ══════════════════════════════════════════════
         CHECKOUT MODAL
         ══════════════════════════════════════════════ --}}
    @if($showCheckout)
        <div class="fixed inset-0 z-[110] flex items-center justify-center p-4 sm:p-6"
             style="background: rgba(2,11,10,0.92); backdrop-filter: blur(18px);"
             wire:click.self="closeCheckout">

            <div class="w-full max-w-3xl flex flex-col relative shadow-2xl overflow-hidden"
                 style="background: #0d1a18; border-radius: 24px; max-height: 92vh; border: 1px solid rgba(239,225,217,0.07);">

                <div class="flex justify-between items-center flex-shrink-0"
                     style="background: #eba13d; padding: 22px 32px;">
                    <h2 class="font-display font-black uppercase" style="font-size: 1.6rem; color: #020b0a; letter-spacing: -0.01em;">Confirm Basket</h2>
                    <button wire:click="closeCheckout"
                            class="font-display font-black text-2xl transition-colors cursor-pointer focus:outline-none"
                            style="color: #020b0a; background: none; border: none;"
                            aria-label="Close checkout">✕</button>
                </div>

                <div class="overflow-y-auto flex-grow" style="padding: clamp(1.5rem, 5vw, 3rem);">
                    <div class="space-y-3 mb-10">
                        @foreach($cart as $id => $item)
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 18px 22px; border-radius: 14px; background: rgba(35,92,71,0.12); border: 1px solid rgba(239,225,217,0.05);">
                                <div>
                                    <div class="font-display font-black uppercase" style="font-size: 1.1rem; color: #efe1d9; letter-spacing: -0.01em; line-height: 1;">{{ $item['name'] }}</div>
                                    <div class="font-mono font-bold" style="font-size: 0.7rem; color: rgba(239,225,217,0.35); margin-top: 6px; text-transform: uppercase; letter-spacing: 0.1em;">Rp {{ number_format($item['price'], 0, ',', '.') }} × {{ $item['quantity'] }}</div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 14px; background: rgba(2,11,10,0.6); border: 1px solid rgba(239,225,217,0.1); border-radius: 10px; padding: 7px 16px;">
                                    <button wire:click="decrementQty({{ $id }})" class="font-display font-black w-6 h-6 flex items-center justify-center focus:outline-none" style="font-size: 1.1rem; color: #efe1d9; background: none; border: none; cursor: pointer;" aria-label="Decrease">−</button>
                                    <span class="font-display font-black" style="font-size: 1.1rem; color: #ffffff; min-width: 24px; text-align: center;">{{ $item['quantity'] }}</span>
                                    <button wire:click="addToCart({{ $id }})" class="font-display font-black w-6 h-6 flex items-center justify-center focus:outline-none" style="font-size: 1.1rem; color: #eba13d; background: none; border: none; cursor: pointer;" aria-label="Increase">+</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6" style="border-top: 1px solid rgba(239,225,217,0.06); padding-top: 2rem;">
                        <div class="flex flex-col gap-2">
                            <label class="font-mono font-black uppercase" style="font-size: 0.65rem; letter-spacing: 0.2em; color: #eba13d;">Customer Name</label>
                            <input type="text" wire:model="customerName"
                                   class="bg-transparent rounded-xl font-mono focus:outline-none"
                                   style="border: 1px solid rgba(239,225,217,0.1); color: #efe1d9; padding: 14px 18px; font-size: 0.9rem; transition: border-color 0.2s ease;"
                                   onfocus="this.style.borderColor='rgba(235,161,61,0.4)'" onblur="this.style.borderColor='rgba(239,225,217,0.1)'"
                                   placeholder="Your name">
                            @error('customerName') <span class="font-mono font-bold" style="font-size: 0.7rem; color: #b42638;">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-mono font-black uppercase" style="font-size: 0.65rem; letter-spacing: 0.2em; color: #eba13d;">Table / Location</label>
                            <input type="text" wire:model="tableNumber"
                                   class="bg-transparent rounded-xl font-mono focus:outline-none"
                                   style="border: 1px solid rgba(239,225,217,0.1); color: #efe1d9; padding: 14px 18px; font-size: 0.9rem; transition: border-color 0.2s ease;"
                                   onfocus="this.style.borderColor='rgba(235,161,61,0.4)'" onblur="this.style.borderColor='rgba(239,225,217,0.1)'"
                                   placeholder="e.g. Table 5 or Takeaway">
                            @error('tableNumber') <span class="font-mono font-bold" style="font-size: 0.7rem; color: #b42638;">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div style="flex-shrink: 0; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1.2rem; border-top: 1px solid rgba(239,225,217,0.06); padding: 1.5rem 2rem; background: rgba(2,11,10,0.4);">
                    <div>
                        <div class="font-mono font-black uppercase" style="font-size: 0.6rem; letter-spacing: 0.2em; color: rgba(239,225,217,0.25); margin-bottom: 6px;">Total</div>
                        <div class="font-display font-black" style="font-size: clamp(1.6rem, 4vw, 2.2rem); color: #eba13d;">
                            Rp {{ number_format(collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']), 0, ',', '.') }}
                        </div>
                    </div>
                    <button wire:click="submitOrder"
                            wire:loading.attr="disabled"
                            class="font-display font-black uppercase"
                            style="font-size: 0.7rem; letter-spacing: 0.18em; color: #ffffff; background: #b42638; border: none; border-radius: 10px; padding: 16px 36px; cursor: pointer; transition: transform 0.2s ease;"
                            onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform=''">
                        <span wire:loading.remove>Place Order →</span>
                        <span wire:loading>Processing…</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- ══════════════════════════════════════════════
         ORDER SUCCESS CARD
         ══════════════════════════════════════════════ --}}
    @if($orderPlaced)
        <div class="fixed inset-0 z-[120] flex items-center justify-center p-6"
             style="background: rgba(2,11,10,0.94); backdrop-filter: blur(24px);">
            <div class="w-full max-w-md text-center shadow-2xl order-success-card"
                 style="background: #eba13d; border-radius: 28px; padding: clamp(2.5rem, 8vw, 4rem);">
                <div style="width: 80px; height: 80px; margin: 0 auto 2rem; background: #b42638; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <span class="font-display font-black" style="font-size: 2.5rem; color: white; line-height: 1;">✓</span>
                </div>
                <h2 class="font-display font-black uppercase leading-none mb-3" style="font-size: clamp(2rem, 6vw, 3rem); color: #020b0a;">Order Received!</h2>
                <p class="font-mono font-bold mb-8" style="font-size: 0.8rem; color: rgba(2,11,10,0.55); line-height: 1.6;">Proceed to the cashier to pay and secure your kitchen slot.</p>
                <div style="background: white; border-radius: 18px; padding: 2rem; margin-bottom: 2rem;">
                    <div class="font-mono font-black uppercase" style="font-size: 0.6rem; letter-spacing: 0.2em; color: rgba(0,0,0,0.3); margin-bottom: 8px;">Queue Number</div>
                    <div class="font-display font-black" style="font-size: clamp(4rem, 10vw, 5.5rem); color: #b42638; line-height: 1;">#{{ $queueNumber }}</div>
                </div>
                <button wire:click="resetOrder"
                        class="font-display font-black uppercase w-full"
                        style="background: #020b0a; color: #eba13d; border: none; border-radius: 10px; padding: 18px; font-size: 0.72rem; letter-spacing: 0.18em; cursor: pointer;">
                    Back to Menu
                </button>
            </div>
        </div>
        <script>
            if (window.gsap) {
                gsap.fromTo('.order-success-card', { scale: 0.82, opacity: 0, y: 40 }, { scale: 1, opacity: 1, y: 0, duration: 0.65, ease: 'back.out(1.6)' });
            }
        </script>
    @endif

    {{-- ══════════════════════════════════════════════
         GSAP — 3D SPATIAL GALLERY LOGIC
         ══════════════════════════════════════════════ --}}
    <script>
    (function () {
        /* ═══════════════════════════════════════════════════════════════════
           CRANKHAUS MENU — MASTER PHYSICS ENGINE
           5 Elite GSAP Micro-Interactions
           ═══════════════════════════════════════════════════════════════════ */

        if (window.gsap && window.ScrollTrigger) {
            try { gsap.registerPlugin(ScrollTrigger); } catch(e) {}
        }

        /* ─────────────────────────────────────────────────────────────────
           EFFECT 1: DYNAMIC MATRIX SCROLL — Velocity Skew & Column Stagger
           ───────────────────────────────────────────────────────────────── */
        function initVelocitySkew() {
            if (!window.gsap || !window.ScrollTrigger) return;

            const grid = document.getElementById('menu-grid-container');
            if (!grid) return;

            let lastScrollY = window.scrollY;
            let currentVelocity = 0;
            let targetVelocity = 0;
            let skewTweens = {};

            // Cache column positions at rest
            const colGroups = {};
            grid.querySelectorAll('.ch-card-perspective-wrap').forEach(wrap => {
                const col = parseInt(wrap.dataset.col || 0);
                if (!colGroups[col]) colGroups[col] = [];
                colGroups[col].push(wrap);
            });

            let rafId;
            function onScroll() {
                const now = window.scrollY;
                targetVelocity = (now - lastScrollY) * 0.5; // sensitivity
                lastScrollY = now;

                // Clamp velocity
                targetVelocity = Math.max(-18, Math.min(18, targetVelocity));

                cancelAnimationFrame(rafId);
                rafId = requestAnimationFrame(applySkew);
            }

            function applySkew() {
                // Lerp toward target for organic feel
                currentVelocity += (targetVelocity - currentVelocity) * 0.15;

                Object.keys(colGroups).forEach(col => {
                    const colInt = parseInt(col);
                    // Each column gets a slight stagger delay multiplier
                    const staggerFactor = 1 + colInt * 0.18;
                    const skewAmount = currentVelocity * staggerFactor * -0.7;

                    colGroups[col].forEach(wrap => {
                        gsap.set(wrap, { skewY: skewAmount });
                    });
                });

                // Decay velocity toward 0 (spring snap back)
                targetVelocity *= 0.75;

                if (Math.abs(currentVelocity) > 0.01) {
                    rafId = requestAnimationFrame(applySkew);
                } else {
                    // Spring snap to rest with elastic ease
                    Object.keys(colGroups).forEach(col => {
                        gsap.to(colGroups[col], {
                            skewY: 0,
                            duration: 1.4,
                            ease: 'elastic.out(1, 0.4)',
                            overwrite: true
                        });
                    });
                }
            }

            window.addEventListener('scroll', onScroll, { passive: true });
        }

        /* ─────────────────────────────────────────────────────────────────
           EFFECT 2: REAL-TIME CURSOR SPOTLIGHT (CSS Variables flashlight)
           ───────────────────────────────────────────────────────────────── */
        function initCursorSpotlight() {
            // Run on each card using quickSetter for perf (avoids layout thrash)
            document.querySelectorAll('.ch-spatial-card').forEach(card => {
                const setX = gsap.quickSetter(card, '--x');
                const setY = gsap.quickSetter(card, '--y');

                card.addEventListener('mousemove', function(e) {
                    const rect = card.getBoundingClientRect();
                    const x = ((e.clientX - rect.left) / rect.width * 100).toFixed(1) + '%';
                    const y = ((e.clientY - rect.top)  / rect.height * 100).toFixed(1) + '%';
                    card.style.setProperty('--x', x);
                    card.style.setProperty('--y', y);
                }, { passive: true });
            });
        }

        /* ─────────────────────────────────────────────────────────────────
           EFFECT 3: HOLOGRAPHIC 3D DEPTH HOVER — Z-Axis Separation
           ───────────────────────────────────────────────────────────────── */
        function initHolographic3DHover() {
            document.querySelectorAll('.ch-card-perspective-wrap').forEach(wrap => {
                const card  = wrap.querySelector('.ch-spatial-card');
                const img   = wrap.querySelector('.ch-card-img-layer');
                const content = wrap.querySelector('.ch-card-content-layer');
                const desc  = wrap.querySelector('.ch-card-desc');
                if (!card || !img || !content) return;

                // quickTo for smooth, throttle-free mouse tracking
                const qRotX = gsap.quickTo(card, 'rotationX', { duration: 0.55, ease: 'power3.out' });
                const qRotY = gsap.quickTo(card, 'rotationY', { duration: 0.55, ease: 'power3.out' });
                const qImgZ = gsap.quickTo(img,  'z', { duration: 0.6, ease: 'power3.out' });
                const qConZ = gsap.quickTo(content, 'z', { duration: 0.5, ease: 'power3.out' });

                function onMove(e) {
                    const rect = card.getBoundingClientRect();
                    // Normalized -1 to +1
                    const nx = ((e.clientX - rect.left) / rect.width  - 0.5) * 2;
                    const ny = ((e.clientY - rect.top)  / rect.height - 0.5) * 2;

                    // Max 15deg tilt
                    qRotY(nx * 15);
                    qRotX(-ny * 15);

                    // Z depth separation: image at 40px, content floats at 80px
                    qImgZ(40);
                    qConZ(80);
                }

                card.addEventListener('mouseenter', function() {
                    card.style.transformStyle = 'preserve-3d';
                    // Show description
                    gsap.to(desc, { opacity: 1, y: 0, duration: 0.4, ease: 'power3.out' });
                    card.addEventListener('mousemove', onMove, { passive: true });
                });

                card.addEventListener('mouseleave', function() {
                    card.removeEventListener('mousemove', onMove);
                    // Spring back to flat
                    gsap.to(card, { rotationX: 0, rotationY: 0, duration: 1.2, ease: 'elastic.out(1, 0.5)' });
                    gsap.to(img,  { z: 0, duration: 0.8, ease: 'power3.out' });
                    gsap.to(content, { z: 0, duration: 0.8, ease: 'power3.out' });
                    gsap.to(desc, { opacity: 0, y: 8, duration: 0.3, ease: 'power2.in' });
                });
            });
        }

        /* ─────────────────────────────────────────────────────────────────
           EFFECT 4: MAGNETIC LIQUID BUTTON MORPHING
           ───────────────────────────────────────────────────────────────── */
        function initMagneticButtons() {
            const MAGNETIC_RADIUS = 60; // px

            document.querySelectorAll('.ch-add-btn').forEach(btn => {
                const plusEl = btn.querySelector('.ch-add-btn-plus');
                const addEl  = btn.querySelector('.ch-add-btn-add');
                if (!plusEl || !addEl) return;

                let magnetActive = false;

                // Global mousemove for magnetic pull (within 60px radius)
                function onGlobalMove(e) {
                    const rect = btn.getBoundingClientRect();
                    const btnCX = rect.left + rect.width  / 2;
                    const btnCY = rect.top  + rect.height / 2;
                    const dx = e.clientX - btnCX;
                    const dy = e.clientY - btnCY;
                    const dist = Math.sqrt(dx * dx + dy * dy);

                    if (dist < MAGNETIC_RADIUS) {
                        // Pull strength falls off with distance (inverse)
                        const strength = (1 - dist / MAGNETIC_RADIUS);
                        gsap.to(btn, {
                            x: dx * strength * 0.5,
                            y: dy * strength * 0.5,
                            duration: 0.35,
                            ease: 'power3.out',
                            overwrite: 'auto'
                        });
                    } else if (magnetActive) {
                        // Spring back to origin
                        gsap.to(btn, { x: 0, y: 0, duration: 0.8, ease: 'elastic.out(1, 0.4)', overwrite: 'auto' });
                    }
                    magnetActive = dist < MAGNETIC_RADIUS;
                }

                document.addEventListener('mousemove', onGlobalMove, { passive: true });

                // Morph on hover: circle → pill, '+' → 'ADD'
                btn.addEventListener('mouseenter', function() {
                    btn.classList.add('morphed');
                    // Slide '+' up and fade out
                    gsap.to(plusEl, { y: -14, opacity: 0, duration: 0.25, ease: 'power2.in' });
                    // Slide 'ADD' up from below and fade in
                    gsap.fromTo(addEl, { y: 14, opacity: 0 }, { y: 0, opacity: 1, duration: 0.35, ease: 'back.out(2)', delay: 0.1 });
                    // Button scale pulse
                    gsap.to(btn, { scale: 1.08, duration: 0.3, ease: 'back.out(2)' });
                });

                btn.addEventListener('mouseleave', function() {
                    btn.classList.remove('morphed');
                    // Snap 'ADD' back down
                    gsap.to(addEl, { y: 14, opacity: 0, duration: 0.25, ease: 'power2.in' });
                    // Spring '+' back
                    gsap.to(plusEl, { y: 0, opacity: 1, duration: 0.5, ease: 'elastic.out(1, 0.5)', delay: 0.08 });
                    // Liquid spring back to circle
                    gsap.to(btn, { scale: 1, x: 0, y: 0, duration: 0.9, ease: 'elastic.out(1, 0.45)' });
                });
            });
        }

        /* ─────────────────────────────────────────────────────────────────
           EFFECT 5: FLIP-TECHNIQUE SEAMLESS MODAL EXPANSION
           Manual bounding-box math (no plugin dep)
           ───────────────────────────────────────────────────────────────── */
        // Extend the global chOpenShowcase to use FLIP math
        const _origOpen = window.chOpenShowcase;
        window.chOpenShowcase = function(dataset, originCardEl) {
            if (!window.gsap) return;

            const grid = document.getElementById('menu-grid-container');
            const showcase = document.getElementById('ch-3d-showcase');

            // Blur the grid behind
            if (grid) gsap.to(grid.closest('.ch-spatial-gallery-section'), { filter: 'blur(8px)', duration: 0.6, ease: 'power2.out' });

            // Call original open logic
            _origOpen(dataset, originCardEl);
        };

        // Extend close to unblur grid
        const _origClose = window.chCloseShowcase;
        window.chCloseShowcase = function() {
            const grid = document.getElementById('menu-grid-container');
            if (grid) gsap.to(grid.closest('.ch-spatial-gallery-section'), { filter: 'blur(0px)', duration: 0.6, ease: 'power2.out' });
            _origClose && _origClose();
        };

        /* ─────────────────────────────────────────────────────────────────
           INITIAL ENTRANCE: 3D Fly-In Stagger
           ───────────────────────────────────────────────────────────────── */
        function initSpatialGallery() {
            if (!window.gsap) return;

            const cards = document.querySelectorAll('.gsap-card-reveal');

            gsap.set(cards, { opacity: 0, y: 100, z: -150, rotationX: -15, scale: 0.9 });
            gsap.to(cards, {
                opacity: 1, y: 0, z: 0, rotationX: 0, scale: 1,
                duration: 0.9,
                stagger: 0.07,
                ease: 'back.out(1.2)',
                onComplete: function() {
                    // After entrance, initialize all physics effects
                    initCursorSpotlight();
                    initHolographic3DHover();
                    initMagneticButtons();
                    initVelocitySkew();
                }
            });

            var cart = document.getElementById('floatingCart');
            if (cart) gsap.fromTo(cart, { y: 80, opacity: 0 }, { y: 0, opacity: 1, duration: 0.5, ease: 'power3.out', delay: 0.5 });
        }

        // ── Bootstrap ──
        if (window.gsap) {
            initSpatialGallery();
        } else {
            document.addEventListener('DOMContentLoaded', initSpatialGallery);
        }

        // Re-init after Livewire updates (category filter etc.)
        document.addEventListener('livewire:update', function () {
            setTimeout(initSpatialGallery, 60);
        });
        document.addEventListener('livewire:initialized', initSpatialGallery);

        /* ─────────────────────────────────────────────────────────────────
           SCROLL-TO-TOP BUTTON CONTROLLER
           ───────────────────────────────────────────────────────────────── */
        (function initScrollTop() {
            var btn = document.getElementById('ch-scroll-top');
            if (!btn || !window.gsap) return;

            var visible = false;
            window.addEventListener('scroll', function() {
                var shouldShow = window.scrollY > 500;
                if (shouldShow !== visible) {
                    visible = shouldShow;
                    if (visible) {
                        gsap.to(btn, { opacity: 1, y: 0, scale: 1, duration: 0.45, ease: 'back.out(1.8)' });
                    } else {
                        gsap.to(btn, { opacity: 0, y: 16, scale: 0.85, duration: 0.3, ease: 'power2.in' });
                    }
                }
            }, { passive: true });

            // Micro-bounce on click
            btn.addEventListener('click', function() {
                gsap.fromTo(btn, { scale: 0.75 }, { scale: 1, duration: 0.6, ease: 'elastic.out(1, 0.4)' });
            });
        })();

        /* ─────────────────────────────────────────────────────────────────
           CART BADGE PULSE — Animate the qty badge each time cart updates
           ───────────────────────────────────────────────────────────────── */
        document.addEventListener('livewire:updated', function() {
            // Animate the cart qty badge when it updates
            var badge = document.querySelector('#floatingCart [style*="background: #eba13d"]');
            if (badge && window.gsap) {
                gsap.timeline()
                    .to(badge, { scale: 1.4, rotation: -12, duration: 0.18, ease: 'power3.out' })
                    .to(badge, { scale: 1,   rotation:   0, duration: 0.7,  ease: 'elastic.out(1, 0.4)' });
            }
        });

        /* ─────────────────────────────────────────────────────────────────
           CATEGORY PILL PRESS ANIMATION
           Active pill gets a burst ripple when clicked
           ───────────────────────────────────────────────────────────────── */
        (function initCategoryPillRipple() {
            document.querySelectorAll('[wire\\:click*="setCategory"]').forEach(function(pill) {
                pill.addEventListener('click', function() {
                    if (!window.gsap) return;
                    gsap.timeline()
                        .to(pill, { scale: 0.88, duration: 0.1, ease: 'power3.in' })
                        .to(pill, { scale: 1,    duration: 0.6, ease: 'elastic.out(1, 0.5)' });
                });
            });
        })();

    })();
    </script>

</div>
