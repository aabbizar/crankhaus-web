/** @type {import('tailwindcss').Config} */
const plugin = require('tailwindcss/plugin');

module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
  ],
  theme: {
    extend: {
      colors: {
        // ── FIGMADESIGN.md brand tokens ──────────────────────────────────
        "nb-ink":           "#000000",
        "nb-canvas":        "#ffffff",
        "nb-inv-canvas":    "#000000",
        "nb-inv-ink":       "#ffffff",
        "nb-hairline":      "#e6e6e6",
        "nb-hairline-soft": "#f1f1f1",
        "nb-surface-soft":  "#f7f7f5",
        // Pastel color blocks from FIGMADESIGN
        "nb-lime":          "#dceeb1",
        "nb-lilac":         "#c5b0f4",
        "nb-cream":         "#f4ecd6",
        "nb-pink":          "#efd4d4",
        "nb-mint":          "#c8e6cd",
        "nb-coral":         "#f3c9b6",
        "nb-navy":          "#1f1d3d",
        "nb-magenta":       "#ff3d8b",
        "nb-success":       "#1ea64a",
        // ── Neobrutalism vibrant accent palette (PB Sahaja) ─────────────
        "brutal-yellow":    "#f9e84e",
        "brutal-lime":      "#b8f400",
        "brutal-blue":      "#2563eb",
        "brutal-red":       "#dc2626",
        "brutal-orange":    "#f97316",
        "brutal-purple":    "#7c3aed",
        "brutal-teal":      "#0d9488",
      },

      fontFamily: {
        sans:    ["Inter", "ui-sans-serif", "system-ui", "sans-serif"],
        mono:    ["JetBrains Mono", "ui-monospace", "SFMono-Regular", "monospace"],
        loud:    ["Inter", "ui-sans-serif", "system-ui", "sans-serif"],
      },

      fontSize: {
        "display-xl": ["5.375rem", { lineHeight: "1.00", letterSpacing: "-1.72px" }],
        "display-lg": ["4rem",     { lineHeight: "1.10", letterSpacing: "-0.96px" }],
        "headline":   ["1.625rem", { lineHeight: "1.35", letterSpacing: "-0.26px" }],
        "subhead":    ["1.625rem", { lineHeight: "1.35", letterSpacing: "-0.26px" }],
        "card-title": ["1.5rem",   { lineHeight: "1.45", letterSpacing: "0"       }],
        "body-lg":    ["1.25rem",  { lineHeight: "1.40", letterSpacing: "-0.14px" }],
        "body":       ["1.125rem", { lineHeight: "1.45", letterSpacing: "-0.26px" }],
        "body-sm":    ["1rem",     { lineHeight: "1.45", letterSpacing: "-0.14px" }],
        "eyebrow":    ["1.125rem", { lineHeight: "1.30", letterSpacing: "0.54px"  }],
        "caption":    ["0.75rem",  { lineHeight: "1.00", letterSpacing: "0.60px"  }],
      },

      fontWeight: {
        "320": "320",
        "330": "330",
        "340": "340",
        "480": "480",
        "540": "540",
        "900": "900",
      },

      borderRadius: {
        "xs":   "2px",
        "sm":   "4px",
        "md":   "6px",
        "lg":   "12px",
        "xl":   "16px",
        "pill": "9999px",
        "full": "9999px",
        "brutal": "0px",
      },

      spacing: {
        "hair":    "1px",
        "xxs":     "4px",
        "xs":      "8px",
        "sm":      "12px",
        "md":      "16px",
        "lg":      "24px",
        "xl":      "32px",
        "xxl":     "48px",
        "section": "96px",
      },

      boxShadow: {
        "brutal":       "6px 6px 0px 0px rgba(0,0,0,1)",
        "brutal-sm":    "3px 3px 0px 0px rgba(0,0,0,1)",
        "brutal-lg":    "8px 8px 0px 0px rgba(0,0,0,1)",
        "brutal-xl":    "12px 12px 0px 0px rgba(0,0,0,1)",
        "brutal-hover": "10px 10px 0px 0px rgba(0,0,0,1)",
        // Coloured variants
        "brutal-yellow": "6px 6px 0px 0px #f9e84e",
        "brutal-lime":   "6px 6px 0px 0px #b8f400",
        "brutal-lilac":  "6px 6px 0px 0px #c5b0f4",
        "brutal-coral":  "6px 6px 0px 0px #f3c9b6",
        "brutal-mint":   "6px 6px 0px 0px #c8e6cd",
        "brutal-navy":   "6px 6px 0px 0px #1f1d3d",
        "brutal-red":    "6px 6px 0px 0px #dc2626",
        "brutal-blue":   "6px 6px 0px 0px #2563eb",
        "soft":          "0 4px 16px rgba(0,0,0,0.06)",
        "modal":         "0 16px 48px rgba(0,0,0,0.18)",
      },

      animation: {
        "marquee":    "marquee 22s linear infinite",
        "fade-in":    "fadeIn 0.4s ease forwards",
        "slide-up":   "slideUp 0.5s cubic-bezier(0.16,1,0.3,1) forwards",
        "scale-pop":  "scalePop 0.3s cubic-bezier(0.34,1.56,0.64,1) forwards",
        "shake":      "shake 0.3s ease",
      },

      keyframes: {
        marquee: {
          "0%":   { transform: "translateX(0%)"  },
          "100%": { transform: "translateX(-50%)" },
        },
        fadeIn: {
          from: { opacity: "0" },
          to:   { opacity: "1" },
        },
        slideUp: {
          from: { opacity: "0", transform: "translateY(24px)" },
          to:   { opacity: "1", transform: "translateY(0)"    },
        },
        scalePop: {
          from: { opacity: "0", transform: "scale(0.85)"  },
          to:   { opacity: "1", transform: "scale(1)"     },
        },
        shake: {
          "0%, 100%": { transform: "translateX(0)" },
          "25%":      { transform: "translateX(-4px)" },
          "75%":      { transform: "translateX(4px)" },
        },
      },
    },
  },

  plugins: [
    plugin(function ({ addUtilities, addComponents }) {

      // ── Core Neobrutalism Utilities ─────────────────────────────────────
      addUtilities({

        // BORDER
        '.border-brutal': {
          border: '4px solid #000000',
        },
        '.border-brutal-2': {
          border: '2px solid #000000',
        },
        '.border-brutal-6': {
          border: '6px solid #000000',
        },
        '.border-brutal-white': {
          border: '4px solid #ffffff',
        },

        // SHADOW
        '.shadow-brutal': {
          boxShadow: '6px 6px 0px 0px rgba(0,0,0,1)',
        },
        '.shadow-brutal-sm': {
          boxShadow: '3px 3px 0px 0px rgba(0,0,0,1)',
        },
        '.shadow-brutal-lg': {
          boxShadow: '8px 8px 0px 0px rgba(0,0,0,1)',
        },
        '.shadow-brutal-xl': {
          boxShadow: '12px 12px 0px 0px rgba(0,0,0,1)',
        },
        '.shadow-brutal-yellow': {
          boxShadow: '6px 6px 0px 0px #f9e84e',
        },
        '.shadow-brutal-lime': {
          boxShadow: '6px 6px 0px 0px #b8f400',
        },
        '.shadow-brutal-lilac': {
          boxShadow: '6px 6px 0px 0px #c5b0f4',
        },
        '.shadow-brutal-red': {
          boxShadow: '6px 6px 0px 0px #dc2626',
        },
        '.shadow-brutal-blue': {
          boxShadow: '6px 6px 0px 0px #2563eb',
        },
        '.shadow-brutal-navy': {
          boxShadow: '6px 6px 0px 0px #1f1d3d',
        },

        // FONT LOUD (Uppercase + Black weight)
        '.font-loud': {
          fontFamily: '"Inter", ui-sans-serif, system-ui, sans-serif',
          fontWeight: '900',
          textTransform: 'uppercase',
          letterSpacing: '-0.02em',
        },

        // HOVER: Shift + Shadow swell
        '.hover-brutal': {
          transition: 'transform 120ms ease, box-shadow 120ms ease',
          '&:hover': {
            transform: 'translate(-4px, -4px)',
            boxShadow: '10px 10px 0px 0px rgba(0,0,0,1)',
          },
          '&:active': {
            transform: 'translate(4px, 4px)',
            boxShadow: '2px 2px 0px 0px rgba(0,0,0,1)',
          },
        },

        // Eyebrow (mono, all-caps, wide tracking)
        '.eyebrow': {
          fontFamily: '"JetBrains Mono", ui-monospace, monospace',
          fontSize: '0.75rem',
          fontWeight: '700',
          lineHeight: '1.30',
          letterSpacing: '0.12em',
          textTransform: 'uppercase',
        },
      });

      // ── Compound Component Classes ───────────────────────────────────────
      addComponents({

        // Card
        '.card-brutal': {
          background: '#ffffff',
          border: '4px solid #000000',
          boxShadow: '6px 6px 0px 0px rgba(0,0,0,1)',
          borderRadius: '0px',
          transition: 'transform 120ms ease, box-shadow 120ms ease',
          '&:hover': {
            transform: 'translate(-3px, -3px)',
            boxShadow: '9px 9px 0px 0px rgba(0,0,0,1)',
          },
          '&:active': {
            transform: 'translate(3px, 3px)',
            boxShadow: '3px 3px 0px 0px rgba(0,0,0,1)',
          },
        },

        // Button Primary (Yellow / Black)
        '.btn-brutal': {
          display: 'inline-flex',
          alignItems: 'center',
          justifyContent: 'center',
          gap: '8px',
          background: '#f9e84e',
          color: '#000000',
          border: '4px solid #000000',
          boxShadow: '5px 5px 0px 0px rgba(0,0,0,1)',
          borderRadius: '0px',
          fontWeight: '900',
          textTransform: 'uppercase',
          letterSpacing: '0.04em',
          padding: '12px 24px',
          cursor: 'pointer',
          transition: 'transform 120ms ease, box-shadow 120ms ease',
          '&:hover': {
            transform: 'translate(-2px, -2px)',
            boxShadow: '7px 7px 0px 0px rgba(0,0,0,1)',
          },
          '&:active': {
            transform: 'translate(3px, 3px)',
            boxShadow: '2px 2px 0px 0px rgba(0,0,0,1)',
          },
        },

        // Button Inverse (Black / Yellow)
        '.btn-brutal-inv': {
          display: 'inline-flex',
          alignItems: 'center',
          justifyContent: 'center',
          gap: '8px',
          background: '#000000',
          color: '#f9e84e',
          border: '4px solid #000000',
          boxShadow: '5px 5px 0px 0px #f9e84e',
          borderRadius: '0px',
          fontWeight: '900',
          textTransform: 'uppercase',
          letterSpacing: '0.04em',
          padding: '12px 24px',
          cursor: 'pointer',
          transition: 'transform 120ms ease, box-shadow 120ms ease',
          '&:hover': {
            transform: 'translate(-2px, -2px)',
            boxShadow: '8px 8px 0px 0px #f9e84e',
          },
          '&:active': {
            transform: 'translate(3px, 3px)',
            boxShadow: '2px 2px 0px 0px #f9e84e',
          },
        },

        // Color-block sections from FIGMADESIGN
        '.color-block': {
          borderRadius: '0px',
          padding: '48px',
        },
        '.color-block-lime':  { backgroundColor: '#dceeb1', border: '4px solid #000' },
        '.color-block-lilac': { backgroundColor: '#c5b0f4', border: '4px solid #000' },
        '.color-block-cream': { backgroundColor: '#f4ecd6', border: '4px solid #000' },
        '.color-block-pink':  { backgroundColor: '#efd4d4', border: '4px solid #000' },
        '.color-block-mint':  { backgroundColor: '#c8e6cd', border: '4px solid #000' },
        '.color-block-coral': { backgroundColor: '#f3c9b6', border: '4px solid #000' },
        '.color-block-navy':  { backgroundColor: '#1f1d3d', border: '4px solid #000', color: '#ffffff' },
        '.color-block-yellow': { backgroundColor: '#f9e84e', border: '4px solid #000' },
      });
    }),
  ],
};
