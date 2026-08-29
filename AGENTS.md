# New Debug Bar Website

## Scope

- This repository is the public New Debug Bar landing page. Do not add docs or guides until asked.
- Use “New Debug Bar” in human-facing copy and `NewDebugBar` or `newdebugbar` in machine-facing names.

## Copy

- Write for Laravel developers as end users. Lead with concrete outcomes that make them want to try it, not implementation details.
- Avoid internal terms like “structured profiles” unless required to use the product.
- Present MCP as exact debugging context for agents: less guessing and fewer tokens.
- Ground claims in current behavior.
- Write related information as natural phrases or complete sentences. Never use `•`, `|`, or symbol-only separators as a shortcut.
- State compatibility directly. Do not pad it with a generic slogan or list the highest supported framework version.

## Design

- Do not use badges unless they communicate an important status or category that plain text cannot express as clearly.
- Keep `resources/css/app.css` limited to required Tailwind setup, source, variant, and theme directives. Put page and component styling in Tailwind utility classes in Blade.
- Store product screenshots under `resources/images/screenshots` and name them for the product view, not the page. Reuse the same source file across pages instead of making page-specific copies.
- Show New Debug Bar screenshots without a decorative frame, border, or container background.
- Build repeated documentation interface patterns as Blade components under `resources/views/components/docs`; keep page-specific prose and simple markup in the page view.
- In the header, keep the Sponsor link at the normal navigation size on desktop. Highlight it with the same medium-weight violet text treatment as the footer, without chip padding or a hover animation, and preserve a clear gap from nearby controls.

## Documentation

- Keep documentation routes unversioned and named. Do not add a version segment unless the user explicitly reverses this decision.
- Build every documentation page with `x-layouts.docs`. Keep documentation navigation, the article shell, the “On this page” rail, responsive breadcrumbs, and SEO metadata in the shared layout instead of rebuilding them per page.
- Keep the documentation article visually centered in the page on wide desktop layouts. Use equal-width left and right rails so navigation never shifts the article off center.
- Give every public documentation page a unique title and description, canonical URL, social metadata, and structured breadcrumbs through the shared layout.
- Keep release-dependent installation values in `config/newdebugbar.php`. Do not hardcode Composer commands, package constraints, or prerelease state in views.
- Treat the old website as a list of topics, not a technical source. Rewrite pages for the current product and verify installation, compatibility, behavior, and troubleshooting claims against the package repository.
- Verify third-party MCP setup instructions against current official client documentation or installed CLI help before publishing them.
- Link to an on-site documentation page when it exists instead of sending readers to the GitHub copy.
- Verify documentation layout changes at mobile, the two-column breakpoint, and the centered three-column breakpoint in both themes. Check horizontal overflow, section anchors, and interactive controls.

## Implementation

- Follow the applicable global skill and its verification steps whenever working with a technology covered by one.
- Write PHP tests with Pest and Laravel's testing helpers. Write JavaScript tests with Vitest.
- Test stable behavior and state. Do not assert marketing copy or raw rendered HTML.
