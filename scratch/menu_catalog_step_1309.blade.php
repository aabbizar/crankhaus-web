The USER performed the following action:
Show the contents of file c:\Users\abiza\OneDrive\Documents Semester 7\ANTI GRAVITY\agtokosahaja_project\resources\views\livewire\menu-catalog.blade.php from lines 1 to 18
File Path: `file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php`
Total Lines: 332
Total Bytes: 19070
Showing lines 1 to 18
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
1: <div class="w-full">
2: 
3:     <!-- Category Filter Tabs (GSAP Flip trigger) -->
4:     <div class="flex items-center justify-start gap-2 overflow-x-auto pb-4 mb-6 scrollbar-hide">
5:         <button 
6:             wire:click="setCategory('all')" 
7:             onclick="captureFlipState()" 
8:             class="px-4 py-2 rounded-full text-xs font-bold tracking-wider uppercase border border-[#222222] transition-all {{ $activeCategory === 'all' ? 'bg-[#ff8709] text-[#0e100f]' : 'bg-[#111111] text-[#fffce1] hover:border-[#ff8709]' }}"
9:         >
10:             ALL
11:         </button>
12:         <button 
13:             wire:click="setCategory('Makanan Utama')" 
14:             onclick="captureFlipState()" 
15:             class="px-4 py-2 rounded-full text-xs font-bold tracking-wider uppercase border border-[#222222] transition-all {{ $activeCategory === 'Makanan Utama' ? 'bg-[#ff8709] text-[#0e100f]' : 'bg-[#111111] text-[#fffce1] hover:border-[#ff8709]' }}"
16:         >
17:             NOODLES
18:         </button>

