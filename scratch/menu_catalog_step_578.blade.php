Created At: 2026-05-25T09:39:06Z
Completed At: 2026-05-25T09:39:07Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 492
Total Bytes: 27223
Showing lines 28 to 80
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
28:     {{-- ══ MENU GRID (MONDRIAN LAYOUT) ═════════════════════════════════════ --}}
29:     <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8 xl:gap-10 grid-flow-row-dense" id="menuGrid">
30:         @forelse ($menus as $menu)
31:             @php
32:                 // Dynamic Mondrian Layout configuration
33:                 $isLarge = ($loop->index % 6 === 0);
34:                 $isWide = ($loop->index % 6 === 3);
35:                 $gridClass = '';
36:                 $imgAspect = 'aspect-[3/4]';
37:                 
38:                 if ($isLarge) {
39:                     $gridClass = 'md:col-span-2 md:row-span-2 col-span-1';
40:                     $imgAspect = 'aspect-[4/5]';
41:                 } elseif ($isWide) {
42:                     $gridClass = 'md:col-span-2 col-span-1';
43:                     $imgAspect = 'aspect-[16/9]';
44:                 }
45: 
46:                 // Dynamic Color Assignment for Mondrian Feel (using the GSAP palette variables)
47:                 $colors = [
48:                     ['border' => 'hover:border-[#ff8709]', 'glow' => 'hover:shadow-[0_0_24px_rgba(255,135,9,0.2)]', 'badge' => 'bg-[#ff8709] text-[#0e100f]', 'text' => 'group-hover:text-[#ff8709]'],
49:                     ['border' => 'hover:border-[#0ae448]', 'glow' => 'hover:shadow-[0_0_24px_rgba(10,228,72,0.2)]', 'badge' => 'bg-[#0ae448] text-[#0e100f]', 'text' => 'group-hover:text-[#0ae448]'
<truncated 663 bytes>
der-[#abff84]', 'glow' => 'hover:shadow-[0_0_24px_rgba(171,255,132,0.2)]', 'badge' => 'bg-[#abff84] text-[#0e100f]', 'text' => 'group-hover:text-[#abff84]'],
54:                 ];
55:                 $color = $colors[$loop->index % count($colors)];
56: 
57:                 // Dynamic Nutrition Calculation (Kemenkes Mandate)
58:                 if ($menu->category === 'Makanan Utama') {
59:                     $calorie = (($menu->id * 23) % 250) + 380;
60:                     $sugarGrade = 'B';
61:                     $sugarColor = 'bg-emerald-500 text-white';
62:                 } elseif ($menu->category === 'Minuman') {
63:                     $calorie = (($menu->id * 17) % 120) + 70;
64:                     $sugarGrade = (($menu->id % 2) === 0) ? 'C' : 'D';
65:                     $sugarColor = $sugarGrade === 'C' ? 'bg-amber-500 text-white' : 'bg-red-600 text-white';
66:                 } else {
67:                     // Cemilan
68:                     $calorie = (($menu->id * 19) % 180) + 180;
69:                     $sugarGrade = (($menu->id % 2) === 0) ? 'B' : 'C';
70:                     $sugarColor = $sugarGrade === 'B' ? 'bg-emerald-500 text-white' : 'bg-amber-500 text-white';
71:                 }
72:             @endphp
73:             <div
74:                 class="group border border-[#222222] bg-[#191919] rounded-[32px] p-5 flex flex-col justify-between transition-all duration-300 hover:scale-[1.02] {{ $color['border'] }} {{ $color['glow'] }} {{ $gridClass }}"
75:                 data-menu-id="{{ $menu->id }}"
76:                 wire:key="menu-{{ $menu->id }}"
77:             >
78:                 {{-- Food Image --}}
79:                 <div class="ck-menu-card__img-wrap {{ $imgAspect }} overflow-hidden rounded-[24px] relative cursor-pointer" wire:click="openModal({{ $menu->id }})">
80:                     <img
The above content does NOT show the entire file contents. If you need to view any lines of the file which were not shown to complete your task, call this tool again to view those lines.
