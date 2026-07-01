# Design System Inspired by LuckyFolks

> Auto-extracted from `https://www.luckyfolks.fr/` on 2026-05-25

## 1. Visual Theme & Atmosphere

High-contrast dark mode with vivid accents — feels modern, technical, and focused.

The hero section leads with "Eat.Drink.Play.".

**Key Characteristics:**
- Motter Corpus Std as the heading font (custom web font loaded via @font-face)
- GT Pressura Mono as the body font for all running text
- Heading weight 700, letter-spacing 3.6px
- Dark background (#235c47) as the primary canvas
- Primary accent `#eba13d` used for CTAs and brand highlights
- 1 shadow level(s) detected — tinted shadows
- Rounded corners (6px+) creating a friendly, approachable feel
- Tags: dark, rounded, colorful, bold-typography, monospace, serif

## 2. Color Palette & Roles

### Primary
- **Primary Accent** (`#eba13d`) · `--color-primary`: Brand color, CTA backgrounds, link text, interactive highlights.
- **Secondary Accent** (`#b42638`) · `--color-secondary`: Secondary brand, hover states, complementary highlights.
- **Background** (`#235c47`) · `--color-bg`: Page background, primary canvas.

### Text
- **Text Primary** (`#eba13d`) · `--color-text`: Headings and body text.
- **Text Secondary** (`#999999`) · `--color-text-secondary`: Muted text, captions, placeholders.

### Borders & Surfaces
- **Border** (`#efe1d9`) · `--color-border`: Dividers, outlines, input borders.

### Full Extracted Palette

| # | Hex | CSS Variable | Role | Area | Contrast |
|---|---|---|---|---|---|
| 1 | `#eba13d` | `--palette-1` | text-accent | large | text-dark |
| 2 | `#235c47` | `--palette-2` | section | large | text-light |
| 3 | `#efe1d9` | `--palette-3` | section | large | text-dark |
| 4 | `#020b0a` | `--palette-4` | section | large | text-light |
| 5 | `#b42638` | `--palette-5` | button | medium | text-light |
| 6 | `#e3902f` | `--palette-6` | badge | small | text-dark |
| 7 | `#000000` | `--palette-7` | badge | small | text-light |
| 8 | `#c23c48` | `--palette-8` | text-accent | small | text-light |

## 3. Typography Rules

- **Heading Font:** `Motter Corpus Std` (web font)
- **Body Font:** `GT Pressura Mono` (web font)

### Type Hierarchy

| Role | Font | Size | Weight | Line Height | Letter Spacing |
|---|---|---|---|---|---|
| H1 | Motter Corpus Std | 120px | 700 | 120px | 3.6px |
| H2 | Pangram | 40px | 700 | 48px | 5.2px |
| H3 | Always In My Heart | 35px | 500 | 35px | normal |
| H4 | GT Pressura Mono | 16px | 700 | 22.4px | normal |
| Body | Motter Corpus Std | 45px | 400 | 65.25px | normal |

### Type Scale

| Token | Size | Suggested Usage |
|---|---|---|
| Display | `225.28px` | headings |
| H1 | `120px` | headings |
| H2 | `110px` | headings |
| H3 | `85px` | headings |
| H4 | `84px` | headings |
| Body L | `80px` | body / supporting text |
| Body | `78px` | body / supporting text |
| Small | `77px` | body / supporting text |
| XS | `58px` | body / supporting text |
| Caption | `45px` | body / supporting text |

## 4. Component Stylings

### Primary Button

```css
.btn-primary {
  background: #b42638;
  color: #000000;
  border-radius: 6px;
  padding: 8px 25px;
  font-size: 14px;
  font-weight: 400;
  border: none;
  cursor: pointer;
}
```

### Filled Button

```css
.btn-filled {
  background: #e3902f;
  color: #000000;
  border-radius: 6px;
  padding: 0px 16px;
  font-size: 14px;
  font-weight: 400;
  border: none;
  cursor: pointer;
}
```

### Ghost Button

```css
.btn-ghost {
  background: transparent;
  color: #ffffff;
  border-radius: 0px;
  padding: 0px 0px;
  font-size: 34px;
  font-weight: 700;
  border: none;
  cursor: pointer;
}
```

### Ghost Button 2

```css
.btn-ghost-2 {
  background: transparent;
  color: #eba13d;
  border-radius: 0px;
  padding: 0px 0px;
  font-size: 34px;
  font-weight: 700;
  border: none;
  cursor: pointer;
}
```

### Filled Button 2

```css
.btn-filled-2 {
  background: #eba13d;
  color: #b42638;
  border-radius: 0px;
  padding: 0px 0px;
  font-size: 14px;
  font-weight: 400;
  border: none;
  cursor: pointer;
}
```

### Filled Button 3

```css
.btn-filled-3 {
  background: #efe1d9;
  color: #235c47;
  border-radius: 0px;
  padding: 0px 0px;
  font-size: 14px;
  font-weight: 400;
  border: none;
  cursor: pointer;
}
```

## 5. Layout Principles

- **Base spacing unit:** `160px` — use multiples (320px, 480px, 640px, etc.)

### Spacing Scale (extracted from real elements)

| Token | Value | Role |
|---|---|---|
| spacing-1 | `160px` | section |
| spacing-2 | `1px` | element |
| spacing-3 | `10px` | element |
| spacing-4 | `40px` | card |
| spacing-5 | `8px` | element |
| spacing-6 | `2px` | element |
| spacing-7 | `12px` | element |
| spacing-8 | `60px` | section |

### Border Radius Scale

| Token | Value | Element |
|---|---|---|
| radius-button | `6px` | button |
| radius-subtle | `5px` | subtle |
| radius-button | `10px` | button |
| radius-card | `24px` | card |
| radius-button | `12px` | button |

## 6. Depth & Elevation

| Level | Shadow | Usage |
|---|---|---|
| High | `rgba(0, 0, 0, 0.2) 0px 4px 16px 0px` | Modals, floating elements |


## 7. Do's and Don'ts

### Do
- Use `#235c47` as the primary background color
- Use `Motter Corpus Std` for all headings and `GT Pressura Mono` for body text
- Use `#eba13d` as the single dominant accent/CTA color
- Maintain `160px` as the base spacing unit — all gaps should be multiples
- Keep the overall feel dark — use dark surfaces throughout
- Use rounded corners (`6px`+) consistently for all interactive elements
- Use serif fonts for headlines to maintain editorial authority
- Make headlines large and bold — typography is the hero element
- Embrace bold color combinations — playful energy is the point
- Apply the shadow system for elevation — use the extracted shadow values
- Use weight 700 for headings to match the brand's typographic voice

### Don't
- Don't use colors outside the extracted palette without justification
- Don't substitute Motter Corpus Std/GT Pressura Mono with generic alternatives
- Don't use irregular spacing — stick to 160px grid
- Don't introduce bright white surfaces — they break the dark palette
- Don't use sharp corners — they feel hostile in this rounded design language
- Don't mix in geometric sans-serif headlines — it breaks the editorial tone
- Don't use pure black (#000000) for text — use `#eba13d` instead
- Don't add decorative elements not present in the original design — no badges, ribbons, banners, or ornaments unless the source site uses them
- Don't invent UI patterns the source site doesn't have — if the original has no NEW badge, don't add one just because a red is in the palette

## 8. Responsive Behavior

| Breakpoint | Width | Notes |
|---|---|---|
| Mobile | < 640px | Single column, stack sections, reduce font sizes ~80% |
| Tablet | 640–1024px | 2-column where appropriate, maintain spacing ratios |
| Desktop | 1024–1440px | Full layout as designed |
| Wide | > 1440px | Max-width container, center content |

- Touch targets: minimum 44×44px on mobile
- Maintain 160px base unit across breakpoints — only scale multipliers

## 9. Agent Prompt Guide

### Quick Color Reference

```
Background:  #235c47
Text:        #eba13d
Accent:      #eba13d
Secondary:   #b42638
Border:      #efe1d9
```

### Example Prompts

1. "Build a hero section with a `#235c47` background, `Motter Corpus Std` heading in `#eba13d`, and a `#eba13d` CTA button with 6px radius."
2. "Create a pricing card using background `#235c47`, border `#efe1d9`, `GT Pressura Mono` for text, and 480px padding."
3. "Design a navigation bar — `#235c47` background, `#eba13d` links, `#eba13d` for active state."
4. "Build a feature grid with 3 columns, 480px gap, each card using the card component style."
5. "Create a footer with `#235c47` background, `#eba13d` text, and 320px padding."

### Iteration Guide

1. Start with layout structure (sections, grid, spacing)
2. Apply colors from the palette — background first, then text, then accents
3. Set typography — font families, sizes from the type scale, weights
4. Add components — buttons, cards, inputs using the specs above
5. Apply border-radius consistently across all elements
6. Add shadows for depth — use the extracted shadow values, not defaults
7. Check responsive behavior — test mobile and tablet layouts
8. Final pass — verify all colors match, spacing is consistent, fonts are correct

## 10. CSS Custom Properties

> 2 custom properties extracted from `:root` / `html` stylesheets.

### Color Variables

| Variable | Value |
|---|---|
| `--swiper-theme-color` | `#007aff` |

### Spacing Variables

| Variable | Value |
|---|---|
| `--swiper-navigation-size` | `44px` |
