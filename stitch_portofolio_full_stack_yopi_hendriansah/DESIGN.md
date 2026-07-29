---
name: Full-Stack Portfolio System
colors:
  surface: '#131313'
  surface-dim: '#131313'
  surface-bright: '#3a3939'
  surface-container-lowest: '#0e0e0e'
  surface-container-low: '#1c1b1b'
  surface-container: '#201f1f'
  surface-container-high: '#2a2a2a'
  surface-container-highest: '#353534'
  on-surface: '#e5e2e1'
  on-surface-variant: '#c1c6d7'
  inverse-surface: '#e5e2e1'
  inverse-on-surface: '#313030'
  outline: '#8b90a0'
  outline-variant: '#414754'
  surface-tint: '#aec6ff'
  primary: '#aec6ff'
  on-primary: '#002e6b'
  primary-container: '#0070f3'
  on-primary-container: '#ffffff'
  inverse-primary: '#0059c5'
  secondary: '#ffb3ad'
  on-secondary: '#68000a'
  secondary-container: '#8f191d'
  on-secondary-container: '#ff9e97'
  tertiary: '#ffb77d'
  on-tertiary: '#4d2600'
  tertiary-container: '#b36100'
  on-tertiary-container: '#ffffff'
  error: '#ffb4ab'
  on-error: '#690005'
  error-container: '#93000a'
  on-error-container: '#ffdad6'
  primary-fixed: '#d8e2ff'
  primary-fixed-dim: '#aec6ff'
  on-primary-fixed: '#001a43'
  on-primary-fixed-variant: '#004397'
  secondary-fixed: '#ffdad7'
  secondary-fixed-dim: '#ffb3ad'
  on-secondary-fixed: '#410004'
  on-secondary-fixed-variant: '#8c171b'
  tertiary-fixed: '#ffdcc3'
  tertiary-fixed-dim: '#ffb77d'
  on-tertiary-fixed: '#2f1500'
  on-tertiary-fixed-variant: '#6e3900'
  background: '#131313'
  on-background: '#e5e2e1'
  surface-variant: '#353534'
  digitalent-blue: '#0056B3'
  digitalent-orange: '#F9A825'
  ipn-maroon: '#800000'
  surface-border: '#1F1F1F'
  text-muted: '#888888'
typography:
  headline-xl:
    fontFamily: Geist
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 56px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Geist
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
    letterSpacing: -0.01em
  headline-lg-mobile:
    fontFamily: Geist
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  code-sm:
    fontFamily: JetBrains Mono
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-caps:
    fontFamily: JetBrains Mono
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.05em
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  container-max: 1200px
  gutter: 24px
  section-padding: 80px
  stack-sm: 8px
  stack-md: 16px
  stack-lg: 32px
---

## Brand & Style

This design system is built for a professional full-stack programmer portfolio, blending a high-tech developer aesthetic with a localized Indonesian professional feel. It is characterized by a "Dark & Crisp" style—drawing inspiration from the Resend brand while integrating vibrant corporate accents from the Digitalent and IPN identities.

The personality is **Expert, Technical, and Reliable**. It utilizes deep obsidian backgrounds and subtle borders to create a sense of focused architecture. High-contrast accents (Blue and Maroon) are used sparingly to highlight technical proficiency and significant milestones. The emotional response should be one of "clean complexity"—conveying that the programmer can manage sophisticated systems while maintaining a tidy, high-quality user experience.

## Colors

The palette is optimized for dark mode, using a true black or near-black background to minimize eye strain and maximize the "glow" of code and accents.

- **Primary (Digitalent Blue):** Used for interactive elements, primary buttons, and active link states. It represents technological innovation.
- **Secondary (IPN Maroon):** Used for structural accents and significant achievements. It adds a layer of established, formal professionalism.
- **Tertiary (Orange/Gold):** An accent color used for "success" indicators, badges, or "available for work" statuses.
- **Neutrals:** The background is `#0A0A0A`. Borders use a subtle grey (`#1F1F1F`) to define sections without breaking the dark-mode immersion. Text is high-contrast white for headers and muted grey for supporting descriptions.

## Typography

The typography system relies on a hierarchy of technical and functional typefaces.

- **Headlines:** Use **Geist** for its precise, modern geometric feel. It mimics the look of high-end developer tools.
- **Body:** **Inter** is used for readability across long-form project descriptions and professional bios.
- **Labels & Code:** **JetBrains Mono** is reserved for technical labels, skill badges, and code snippets, grounding the design in the programmer's native environment.

Indonesian phrasing should be used for section headers (e.g., "Tentang Saya," "Proyek Terbaru"), while technical terms (e.g., "Full-Stack," "Middleware," "Deployment") remain in English to maintain industry credibility.

## Layout & Spacing

This system utilizes a **fixed-grid** model for desktop to ensure a tight, gallery-like feel, and a fluid model for mobile.

- **Desktop:** 12-column grid with a max width of 1200px. Sections are separated by generous vertical padding (80px) to allow the content to "breathe."
- **Mobile:** Single column with 20px side margins.
- **Spacing Rhythm:** Based on an 8px base unit. Component internal spacing should favor `stack-md` (16px) for a balanced density. 

Layouts should prioritize large, high-quality professional photography for the profile section and clear, distinct cards for projects and skills.

## Elevation & Depth

Hierarchy is achieved through **low-contrast outlines** rather than heavy shadows.

- **Surface Tiers:** The main background is level 0. Cards and containers sit on level 1, using a slightly lighter background (e.g., `#161616`) and a 1px border of `#1F1F1F`.
- **Interactions:** On hover, cards may increase border brightness or apply a very subtle, large-radius ambient shadow with a hint of the primary blue color (`rgba(0, 112, 243, 0.1)`).
- **Glassmorphism:** Use a light backdrop blur (8px-12px) on fixed navigation bars and sticky headers to maintain a sense of context while scrolling.

## Shapes

The design system uses a **Soft** shape language.

- **Components:** Standard buttons, input fields, and skill badges use `0.25rem` (4px) corner radii. This creates a professional, sharp look that isn't as aggressive as 0px corners.
- **Containers:** Project cards and the main profile container use `rounded-lg` (0.5rem / 8px) to softly distinguish larger sections from the page background.
- **Avatars:** Professional profile photos should use circular masks or `rounded-xl` for a more modern, friendly appearance.

## Components

### Professional Profile
A hero section featuring a high-quality professional photo on the right and a brief "About Me" (Tentang Saya) on the left. Use `headline-xl` for the name and a secondary colored accent for the current role.

### Technical Skill Badges
Small, monochromatic chips using `code-sm` typography. On hover, the badge border should change to `primary_color_hex`. Group badges by category (e.g., Frontend, Backend, DevOps).

### Project Timeline
A vertical line (2px, `surface-border`) with nodes. Each node represents a milestone or project. Title in `headline-lg`, date in `label-caps`. Use the secondary maroon for employment history and primary blue for personal projects.

### Social Media Footer
A simple, centered section with icon-only links to GitHub, LinkedIn, and Email. Use muted icons that transition to full white on hover. Include a "Made in Indonesia" or "Buatan Indonesia" tagline in `label-caps` for a local touch.

### Buttons
- **Primary:** Solid `digitalent-blue` with white text.
- **Secondary:** Transparent with a 1px `surface-border` and white text.
- **Action:** For "Call to Action" like "Hubungi Saya," use a subtle gradient blending primary and secondary colors.