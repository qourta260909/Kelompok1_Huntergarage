---
name: Hunter Garage Admin
description: Operational workspace for Hunter Garage staff and owners.
colors:
  page-bg: "#f4f7fb"
  surface: "#ffffff"
  ink: "#182338"
  muted: "#63718a"
  soft: "#8792a5"
  line: "#e3e8f0"
  sidebar: "#19263a"
  sidebar-muted: "#a7b3c5"
  blue: "#2563eb"
  blue-deep: "#1d4ed8"
  blue-soft: "#eff5ff"
  green: "#16794a"
  green-soft: "#e8f6ee"
  amber: "#9a5c08"
  amber-soft: "#fff4dc"
  red: "#b42332"
  red-soft: "#fff0f0"
  white: "#ffffff"
typography:
  display:
    fontFamily: "Figtree, sans-serif"
    fontSize: "clamp(24px, 2.2vw, 29px)"
    fontWeight: 700
    lineHeight: 1.2
    letterSpacing: "-0.8px"
  title:
    fontFamily: "Figtree, sans-serif"
    fontSize: "19px"
    fontWeight: 700
    lineHeight: 1.3
  body:
    fontFamily: "Figtree, sans-serif"
    fontSize: "14px"
    fontWeight: 400
    lineHeight: 1.5
  label:
    fontFamily: "Figtree, sans-serif"
    fontSize: "12px"
    fontWeight: 600
    lineHeight: 1.5
rounded:
  sm: "8px"
  md: "14px"
  lg: "16px"
  pill: "999px"
spacing:
  xs: "4px"
  sm: "8px"
  md: "12px"
  lg: "16px"
  xl: "24px"
  2xl: "32px"
components:
  button-primary:
    backgroundColor: "{colors.blue}"
    textColor: "{colors.white}"
    rounded: "{rounded.sm}"
    padding: "0 14px"
    height: "40px"
  button-primary-hover:
    backgroundColor: "{colors.blue-deep}"
  surface-card:
    backgroundColor: "{colors.surface}"
    rounded: "{rounded.md}"
  status-success:
    backgroundColor: "{colors.green-soft}"
    textColor: "{colors.green}"
    rounded: "{rounded.pill}"
  status-warning:
    backgroundColor: "{colors.amber-soft}"
    textColor: "{colors.amber}"
    rounded: "{rounded.pill}"
  status-danger:
    backgroundColor: "{colors.red-soft}"
    textColor: "{colors.red}"
    rounded: "{rounded.pill}"
---

## Overview

The admin area is an Operate surface: help staff and owners scan operational
metrics, find new work, and move between familiar sections. Keep the interface
calm, legible, and consistent rather than adding marketing-style decoration.

## Colors

Cool white and gray surfaces carry most content. Blue identifies primary
actions, navigation emphasis, and focus. Green, amber, and red are reserved for
success, in-progress or warning, and attention states. The dark slate sidebar
anchors navigation without competing with the page.

## Typography

Use Figtree throughout. Page headings are bold and compact; panel titles and
body labels step down clearly. Use tabular numerals for money, counts, and
dates. Keep supporting text muted, not low-contrast.

## Layout

The desktop shell uses a fixed 258px sidebar, a sticky top bar, and a centered
content area capped at 1540px. The dashboard pairs a wider activity column
with a narrower stock and shortcut column. At 900px and below, the sidebar
becomes an overlay menu and dashboard columns stack. At 640px, content gutters
and controls tighten while tables remain horizontally scrollable.

## Elevation & Depth

Prefer thin borders and subtle tonal differences over shadows. Reserve stronger
shadows for overlays such as the mobile sidebar and dialogs. Keep the top bar
distinct with a light surface and bottom rule.

## Shapes

Use restrained rounded corners: 8px for controls, 14px for cards and panels,
and pill shapes for status badges. Inputs and buttons should retain clear
borders and visible keyboard focus.

## Components

- Primary buttons use blue, white text, and a darker blue hover state.
- Secondary actions use white surfaces and quiet slate borders.
- Panels and statistic cards use white surfaces, a fine border, and consistent
  spacing.
- Tables prioritize scanability with compact uppercase headers, row dividers,
  numeric alignment, and horizontal scrolling when needed.
- Status badges pair semantic color with a text label; color is never the only
  status cue.
- Sidebar navigation uses a dark slate surface and a blue-slate active state.
- Dialogs use a dimmed backdrop, bounded scrollable content, and clear actions.

## Do's and Don'ts

- Do lead with operational totals and new activity.
- Do preserve the shared navigation and semantic status colors across admin
  pages.
- Do keep tables readable on narrow screens without compressing their columns.
- Don't reintroduce the legacy orange/yellow palette as the primary interface.
- Don't use status color without a readable label.
- Don't add unsupported business claims or decorative effects that obscure
  operational information.
