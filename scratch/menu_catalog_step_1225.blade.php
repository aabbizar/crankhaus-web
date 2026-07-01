Created At: 2026-05-25T18:14:14Z
Completed At: 2026-05-25T18:14:14Z
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 455
Total Bytes: 24915
Showing lines 15 to 45
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
15:                 wire:click="setCategory('{{ $key }}')"
16:                 id="filter-{{ $key }}"
17:                 onclick="captureFlipState()"
18:                 class="ck-filter-tab {{ $activeCategory === $key ? 'ck-filter-tab--active' : '' }}"
19:             >
20:                 {{ $label }}
21:                 @if($key !== 'all' && isset($categoryCounts[$key]))
22:                     <span class="ck-filter-badge">{{ $categoryCounts[$key] }}</span>
23:                 @endif
24:             </button>
25:         @endforeach
26:     </div>
27: 
28:     {{-- ══ MENU GRID (FLUENT GRID) ═════════════════════════════════════ --}}
29:     <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6" id="menuGrid">
30:         @forelse ($menus as $menu)
31:             @php
32:                 // Smaller aspects for cleaner look
33:                 $aspects = ['aspect-[4/3]', 'aspect-[1/1]', 'aspect-[4/5]'];
34:                 $imgAspect = $aspects[$menu->id % count($aspects)];
35: 
36:                 // Subtle Borders instead of crazy glows for true minimalism
37:                 $colors = [
38:                     ['border' => 'hover:border-[#ff8709]', 'badge' => 'bg-[#ff8709] text-[#0e100f]', 'text' => 'group-hover:text-[#ff8709]'],
39:                     ['border' => 'hover:border-[#0ae448]', 'badge' => 'bg-[#0ae448] text-[#0e100f]', 'text' => 'group-hover:text-[#0ae448]'],
40:                     ['border' => 'hover:border-[#fec5fb]', 'badge' => 'bg-[#fec5fb] text-[#0e100f]', 'text' => 'group-hover:text-[#fec5fb]'],
41:                     ['border' => 'hover:border-[#00bae2]', 'badge' => 'bg-[#00bae2] text-[#0e100f]', 'text' => 'group-hover:text-[#00bae2]'],
42:                     ['border' => 'hover:border-[#9d95ff]', 'badge' => 'bg-[#9d95ff] text-[#0e100f]', 'text' => 'group-hover:text-[#9d95ff]'],
43:                     ['border' => 'hover:border-[#abff84]', 'badge' => 'bg-[#abff84] text-[#0e100f]', 'text' => 'group-hover:text-[#abff84]'],
44:                 ];
45:                 $color = $colors[$loop->index % count($colors)];
The above content does NOT show the entire file contents. If you need to view any lines of the file which were not shown to complete your task, call this tool again to view those lines.
