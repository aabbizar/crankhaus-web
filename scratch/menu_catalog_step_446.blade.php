Created At: 2026-05-25T09:33:53Z
Completed At: 2026-05-25T09:33:53Z
File Path: `file:///C:/Users/abiza/.gemini/antigravity-ide/brain/19f3aa68-d6f0-4d25-874b-d3161afdbeb7/implementation_plan.md`
Total Lines: 78
Total Bytes: 5267
Showing lines 1 to 78
The following code has been modified to include a line number before every line, in the format: <line_number>: <original_line>. Please note that any changes targeting the original code should remove the line number, colon, and leading space.
1: # Revamp Spacing, Landscape Grid, Theme Toggle, Bilingual Support, and Dashboard Cash Flow
2: 
3: This plan outlines the design details to address contrast highlight bugs, switch grids to horizontal layout, implement a Light/Dark toggle, add Bilingual Support (ID/EN) on the front-end, build a new Cash Flow / Accounting resource in Filament, and add a real-time order filter popup on the admin dashboard.
4: 
5: ## User Review Required
6: 
7: > [!IMPORTANT]
8: > - **Accounting & Cash Flow CRUD**: A new `cash_flows` table will be created. A new Filament Resource (`CashFlowResource`) will be created to manage income/expense records.
9: > - **Auto-Ledger**: Completing any order (manually or via bulk action) in the admin panel will automatically record an income transaction in the `cash_flows` ledger.
10: > - **Bilingual Support (ID/EN)**: A language toggle button (🌐 ID / 🌐 EN) will be placed in the navigation header. Translates all texts on the home page and menu catalog instantly.
11: > - **Real-time Order Popups**: Real-time websocket listener in `app.js` will intercept incoming orders on any Filament admin page and show an action modal (Accept & Cook, Pending, Reject & Delete) with alert sound.
12: 
13: ## Proposed Changes
14: 
15: ### Database & Models
16: 
17: ---
18: 
19: #### [NEW] [create_cash_flows_table.php](file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/database/migrations/2026_05_25_000001_create_cash_flows_table.php)
20: - Column definition: `id`, `date` (date), `type` 
<truncated 2049 bytes>
menu.blade.php](file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/menu.blade.php)
56: - Define light theme CSS variables (cream background, dark text).
57: - Fix active filter tabs text highlight (`.ck-filter-tab--active` background cream and text dark, rather than white text).
58: - Inject language switcher button (`🌐 ID` / `🌐 EN`) and theme toggle button (`🌙` / `☀️`) in the nav header.
59: - Add Javascript translation mapper to translate all UI text nodes instantly.
60: - Listen for the custom `theme-changed` event inside Three.js script to dynamically update fog color.
61: 
62: #### [MODIFY] [welcome.blade.php](file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/welcome.blade.php)
63: - Align navigation style and layout spacing.
64: - Change home pins to horizontal layout (`aspect-[16/9]` and `aspect-[4/3]`) with Kemenkes sugar badges.
65: - Inject theme toggle, language switcher, and translation scripts.
66: - Listen for `theme-changed` in Three.js background script.
67: 
68: #### [MODIFY] [menu-catalog.blade.php](file:///c:/Users/abiza/OneDrive/Documents%20Semester%207/ANTI%20GRAVITY/agtokosahaja_project/resources/views/livewire/menu-catalog.blade.php)
69: - Restructure cards to landscape proportions (`aspect-[16/9]` and `aspect-[4/3]`).
70: - Clean up active state highlights and text overlays to match light/dark properties.
71: 
72: ## Verification Plan
73: 
74: ### Manual Verification
75: - Open home page and `/menu`. Toggle language (`ID` <-> `EN`) and theme (`Light` <-> `Dark`) and verify visual accuracy.
76: - Log in to `/admin` dashboard. Place a new order on the frontend, check that the real-time modal popup triggers on the dashboard with audio, and test completing it.
77: - Open the `/admin/cash-flows` page to verify that completing the order automatically recorded the sales transaction.
78: 
The above content shows the entire, complete file contents of the requested file.
