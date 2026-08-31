# New Debug Bar Website

## Scope

- This repository powers the production website and documentation for the New Debug Bar.
- Treat published URLs and user-visible behavior as production contracts. Change them only intentionally.
- Use “the New Debug Bar” in prose. Use bare “New Debug Bar” only when the product name stands alone, such as in the logo, a title suffix, structured metadata, or a name-only label. Use `NewDebugBar` or `newdebugbar` in machine-facing names.

## Copy

- Write in plain language for Laravel developers. Lead with concrete product outcomes and use internal terms only when developers need them.
- Present MCP as exact debugging context for agents: less guessing and fewer tokens.
- Ground claims in current behavior.

## Design

- Do not use badges unless they communicate an important status or category that plain text cannot express as clearly.
- Keep `resources/css/app.css` limited to required Tailwind setup, source, variant, and theme directives. Put page and component styling in Tailwind utility classes in Blade.
- Store product screenshots under `resources/images/screenshots`, name them for the product view, and reuse them across pages. Show screenshots of the New Debug Bar without decorative frames.
- Build repeated documentation interface patterns as Blade components under `resources/views/components/docs`; keep page-specific prose and simple markup in the page view.

## Documentation

- Keep public documentation URLs unversioned.
- Build every documentation page with the shared `x-layouts.docs` layout.
- Keep release-dependent installation values in `config/newdebugbar.php`. Do not hardcode Composer commands, package constraints, or prerelease state in views.
- Link to an on-site documentation page when it exists instead of sending readers to the GitHub copy.

## Implementation

- Follow the applicable global skill and its verification steps whenever working with a technology covered by one.
- Write PHP tests with Pest and Laravel's testing helpers. Write JavaScript tests with Vitest.
- Test stable behavior and state. Do not assert marketing copy or raw rendered HTML.
