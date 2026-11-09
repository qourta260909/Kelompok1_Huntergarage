---
version: 1
slug: "resources-views-dashboard-blade-php"
primary_target: "resources/views/dashboard.blade.php"
related_targets: []
---

## Surface

- Scope: all admin pages—dashboard, orders, services, products, profile, and history.
- Mode: Operate.
- Audience: Hunter Garage staff and owner.
- Job: understand service and product quantities, review history, and act on new orders.
- Success: see new orders, income, stock, and service totals quickly; retain existing order CRUD.
- Content: existing application data and verified account details; no invented business claims.
- Constraints: keep current routes and data behavior; no other constraints were specified.
- Unresolved: service/product editing workflows are not currently implemented.

## Direction contract

THESIS: Make daily operations immediately legible through familiar admin conventions; replace the legacy orange/yellow palette and uneven page hierarchy, not the dashboard pattern.

OWN-WORLD: White and cool-gray surfaces, slate text, blue primary actions, restrained semantic status colors, consistent tables, fields, and navigation.

STORY: Staff and owner can read stock, service, order, and income totals, spot new work, then reach the relevant section without learning a new interaction model.

FIRST VIEWPORT: Keep a persistent left sidebar and compact top bar; lead with the page title and a clear next action, then show concise operational metrics above a readable, filterable table or activity list.

FORM: Category-standard admin dashboard, chosen via the standing category alternative; seed:779ccfa5ea515140.

FINISH: unreviewed and undocumented is unfinished; this build ends with the finish review, the verdict, DESIGN.md, and every shipping raster carrying its provenance
