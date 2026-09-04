import { afterEach, beforeEach, describe, expect, it, vi } from 'vitest';
import { initializeFeatureCatalogue } from '../../resources/js/features.js';

const categories = ['all', 'requests', 'laravel', 'livewire', 'services', 'agents', 'workflow'];

const mountCatalogue = () => {
    document.body.innerHTML = `
        <main data-feature-catalogue>
            <div data-feature-controls hidden>
                <form data-feature-search-form>
                    <label for="feature-search">Search features</label>
                    <input id="feature-search" type="search" data-feature-search>
                    <button type="button" data-feature-clear hidden>Clear search</button>
                </form>
                ${categories.map((category) => `
                    <button type="button" data-feature-category="${category}" aria-pressed="false">
                        ${category}<span data-feature-category-count="${category}"></span>
                    </button>
                `).join('')}
                <label for="feature-category">Category</label>
                <select id="feature-category" data-feature-category-select>
                    ${categories.map((category) => `<option value="${category}">${category}</option>`).join('')}
                </select>
            </div>
            <p data-feature-results role="status" aria-live="polite"></p>
            <div data-feature-empty hidden>
                No matching features
                <button type="button" data-feature-reset>Reset filters</button>
            </div>
            <div data-feature-collection="requests">
                <section data-feature-section="http" data-feature-context="Requests HTTP">
                    <article data-feature="route" data-feature-search-text="Route middleware and response headers"></article>
                    <article data-feature="timing" data-feature-search-text="Request duration and memory usage"></article>
                </section>
                <section data-feature-section="database" data-feature-context="Requests Database SQL">
                    <article data-feature="queries" data-feature-search-text="Query grouping N+1 detection"></article>
                </section>
            </div>
            <div data-feature-collection="livewire">
                <section data-feature-section="components" data-feature-context="Livewire Components">
                    <article data-feature="properties" data-feature-search-text="Edit state properties"></article>
                </section>
            </div>
            <div data-feature-collection="agents">
                <section data-feature-section="mcp" data-feature-context="Agents MCP">
                    <article data-feature="context" data-feature-search-text="Inspect exact query evidence"></article>
                </section>
            </div>
        </main>
    `;
};

const search = (value) => {
    const input = document.querySelector('[data-feature-search]');

    input.value = value;
    input.dispatchEvent(new Event('input', { bubbles: true }));
};
const visibleFeatures = () => [...document.querySelectorAll('[data-feature]')]
    .filter((feature) => !feature.hidden)
    .map((feature) => feature.dataset.feature);
const countFor = (category) => document.querySelector(`[data-feature-category-count="${category}"]`).textContent;
const selectCategory = (category) => document.querySelector(`[data-feature-category="${category}"]`).click();
const results = () => document.querySelector('[data-feature-results]').textContent;
let destroy;

beforeEach(() => {
    mountCatalogue();
});

afterEach(() => {
    destroy?.();
    destroy = undefined;
    document.body.innerHTML = '';
});

describe('feature catalogue', () => {
    it('reveals the controls only after initializing all content and counts', () => {
        expect(document.querySelector('[data-feature-controls]').hidden).toBe(true);
        expect(visibleFeatures()).toHaveLength(5);

        destroy = initializeFeatureCatalogue({ root: document });

        expect(document.querySelector('[data-feature-catalogue]').hasAttribute('data-feature-ready')).toBe(true);
        expect(document.querySelector('[data-feature-controls]').hidden).toBe(false);
        expect(countFor('all')).toBe('5');
        expect(countFor('requests')).toBe('3');
        expect(countFor('services')).toBe('0');
        expect(results()).toBe('5 features across 4 sections');
        expect(document.querySelector('[data-feature-category="all"]').getAttribute('aria-pressed')).toBe('true');
        expect(document.querySelector('[data-feature-empty]').hidden).toBe(true);
    });

    it('matches every word regardless of case, whitespace, or word order using section context', () => {
        destroy = initializeFeatureCatalogue({ root: document });

        search('  DETECTION\t sQl \n query  ');

        expect(visibleFeatures()).toEqual(['queries']);
        expect(results()).toBe('1 matching feature');

        search('query missing');

        expect(visibleFeatures()).toEqual([]);
    });

    it('combines categories and search while keeping query counts independent of category', () => {
        destroy = initializeFeatureCatalogue({ root: document });

        search('query');
        selectCategory('agents');

        expect(visibleFeatures()).toEqual(['context']);
        expect(countFor('all')).toBe('2');
        expect(countFor('requests')).toBe('1');
        expect(countFor('agents')).toBe('1');
        expect(countFor('livewire')).toBe('0');

        selectCategory('requests');

        expect(visibleFeatures()).toEqual(['queries']);
        expect(document.querySelector('[data-feature-search]').value).toBe('query');
    });

    it('hides empty sections and collections along with nonmatching entries', () => {
        destroy = initializeFeatureCatalogue({ root: document });

        search('middleware');

        expect(visibleFeatures()).toEqual(['route']);
        expect(document.querySelector('[data-feature-section="http"]').hidden).toBe(false);
        expect(document.querySelector('[data-feature-section="database"]').hidden).toBe(true);
        expect(document.querySelector('[data-feature-collection="requests"]').hidden).toBe(false);
        expect(document.querySelector('[data-feature-collection="livewire"]').hidden).toBe(true);
        expect(document.querySelector('[data-feature-collection="agents"]').hidden).toBe(true);
    });

    it('shows the empty state for a query with no matches', () => {
        destroy = initializeFeatureCatalogue({ root: document });

        search('not-present');

        expect(visibleFeatures()).toEqual([]);
        expect([...document.querySelectorAll('[data-feature-section], [data-feature-collection]')].every((element) => element.hidden)).toBe(true);
        expect(document.querySelector('[data-feature-empty]').hidden).toBe(false);
        expect(results()).toBe('0 matching features');
        expect(countFor('all')).toBe('0');
    });

    it('clears search while preserving the category and restoring input focus', () => {
        destroy = initializeFeatureCatalogue({ root: document });
        selectCategory('requests');
        search('query');

        const clear = document.querySelector('[data-feature-clear]');

        expect(clear.hidden).toBe(false);
        clear.focus();
        clear.click();

        expect(visibleFeatures()).toEqual(['route', 'timing', 'queries']);
        expect(document.querySelector('[data-feature-category-select]').value).toBe('requests');
        expect(document.querySelector('[data-feature-search]').value).toBe('');
        expect(document.activeElement).toBe(document.querySelector('[data-feature-search]'));
        expect(clear.hidden).toBe(true);
    });

    it('resets query and category from the empty state and restores input focus', () => {
        destroy = initializeFeatureCatalogue({ root: document });
        selectCategory('livewire');
        search('query');

        document.querySelector('[data-feature-reset]').click();

        expect(visibleFeatures()).toHaveLength(5);
        expect(document.querySelector('[data-feature-search]').value).toBe('');
        expect(document.querySelector('[data-feature-category-select]').value).toBe('all');
        expect(document.querySelector('[data-feature-category="all"]').getAttribute('aria-pressed')).toBe('true');
        expect(document.querySelector('[data-feature-empty]').hidden).toBe(true);
        expect(document.activeElement).toBe(document.querySelector('[data-feature-search]'));
    });

    it('syncs native category selection with desktop buttons and results', () => {
        destroy = initializeFeatureCatalogue({ root: document });

        const select = document.querySelector('[data-feature-category-select]');

        select.value = 'livewire';
        select.dispatchEvent(new Event('change', { bubbles: true }));

        expect(visibleFeatures()).toEqual(['properties']);
        expect(document.querySelector('[data-feature-category="livewire"]').getAttribute('aria-pressed')).toBe('true');
        expect(document.querySelector('[data-feature-category="all"]').getAttribute('aria-pressed')).toBe('false');
        expect(results()).toBe('1 matching feature');

        selectCategory('requests');

        expect(select.value).toBe('requests');
        expect(visibleFeatures()).toEqual(['route', 'timing', 'queries']);
    });

    it('treats whitespace-only searches as empty', () => {
        destroy = initializeFeatureCatalogue({ root: document });

        search(' \n\t ');

        expect(visibleFeatures()).toHaveLength(5);
        expect(results()).toBe('5 features across 4 sections');
    });

    it('clears a nonempty search with Escape', () => {
        destroy = initializeFeatureCatalogue({ root: document });
        search('query');

        const input = document.querySelector('[data-feature-search]');
        const escape = new KeyboardEvent('keydown', { key: 'Escape', bubbles: true, cancelable: true });

        input.dispatchEvent(escape);

        expect(input.value).toBe('');
        expect(visibleFeatures()).toHaveLength(5);
        expect(escape.defaultPrevented).toBe(true);
    });

    it('returns to the catalogue after filtering when it was above the viewport', () => {
        const catalogue = document.querySelector('[data-feature-catalogue]');

        catalogue.getBoundingClientRect = vi.fn(() => ({ top: -500 }));
        catalogue.scrollIntoView = vi.fn();
        destroy = initializeFeatureCatalogue({ root: document });

        expect(catalogue.scrollIntoView).not.toHaveBeenCalled();

        search('query');

        expect(catalogue.scrollIntoView).toHaveBeenCalledWith({ block: 'start' });
        catalogue.scrollIntoView.mockClear();
        catalogue.getBoundingClientRect.mockReturnValue({ top: 120 });
        selectCategory('requests');

        expect(catalogue.scrollIntoView).not.toHaveBeenCalled();
    });

    it('prevents the search form from navigating and removes its listeners on cleanup', () => {
        destroy = initializeFeatureCatalogue({ root: document });

        const form = document.querySelector('[data-feature-search-form]');
        const submit = new Event('submit', { bubbles: true, cancelable: true });

        form.dispatchEvent(submit);
        expect(submit.defaultPrevented).toBe(true);

        destroy();
        destroy = undefined;
        search('query');

        expect(visibleFeatures()).toHaveLength(5);

        const laterSubmit = new Event('submit', { bubbles: true, cancelable: true });

        form.dispatchEvent(laterSubmit);
        expect(laterSubmit.defaultPrevented).toBe(false);
    });

    it('is a no-op on pages without the catalogue', () => {
        document.body.innerHTML = '<main>Another page</main>';

        expect(() => initializeFeatureCatalogue({ root: document })()).not.toThrow();
    });
});
