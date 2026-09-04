// Filter the rendered feature reference without a request or a client-side copy of the catalogue.
export const initializeFeatureCatalogue = ({ root = document } = {}) => {
    const catalogue = root.querySelector('[data-feature-catalogue]');
    const search = catalogue?.querySelector('[data-feature-search]');

    if (!catalogue || !search) {
        return () => {};
    }

    const categoryButtons = [...catalogue.querySelectorAll('[data-feature-category]')];
    const categorySelect = catalogue.querySelector('[data-feature-category-select]');
    const categoryCounts = [...catalogue.querySelectorAll('[data-feature-category-count]')];
    const results = catalogue.querySelector('[data-feature-results]');
    const empty = catalogue.querySelector('[data-feature-empty]');
    const clear = catalogue.querySelector('[data-feature-clear]');
    const listeners = [];
    const collections = [...catalogue.querySelectorAll('[data-feature-collection]')].map((collection) => ({
        element: collection,
        category: collection.dataset.featureCollection,
        sections: [...collection.querySelectorAll('[data-feature-section]')].map((section) => ({
            element: section,
            features: [...section.querySelectorAll('[data-feature]')].map((feature) => ({
                element: feature,
                searchText: `${section.dataset.featureContext ?? ''} ${feature.dataset.featureSearchText ?? ''}`.toLowerCase(),
            })),
        })),
    }));
    let selectedCategory = 'all';

    const listen = (element, event, handler) => {
        if (element) {
            element.addEventListener(event, handler);
            listeners.push(() => element.removeEventListener(event, handler));
        }
    };

    const update = () => {
        const query = search.value.trim().toLowerCase();
        const words = query ? query.split(/\s+/) : [];
        const counts = new Map([['all', 0]]);
        let visibleFeatures = 0;
        let visibleSections = 0;

        collections.forEach((collection) => {
            const categoryMatches = selectedCategory === 'all' || selectedCategory === collection.category;
            let collectionCount = 0;

            collection.sections.forEach((section) => {
                let sectionCount = 0;

                section.features.forEach((feature) => {
                    const matches = words.every((word) => feature.searchText.includes(word));

                    feature.element.hidden = !matches || !categoryMatches;

                    if (matches) {
                        sectionCount += 1;
                    }
                });

                section.element.hidden = sectionCount === 0 || !categoryMatches;
                collectionCount += sectionCount;

                if (!section.element.hidden) {
                    visibleFeatures += sectionCount;
                    visibleSections += 1;
                }
            });

            counts.set(collection.category, collectionCount);
            counts.set('all', counts.get('all') + collectionCount);
            collection.element.hidden = collectionCount === 0 || !categoryMatches;
        });

        categoryButtons.forEach((button) => {
            button.setAttribute('aria-pressed', String(button.dataset.featureCategory === selectedCategory));
        });

        if (categorySelect) {
            categorySelect.value = selectedCategory;
        }

        categoryCounts.forEach((count) => {
            count.textContent = String(counts.get(count.dataset.featureCategoryCount) ?? 0);
        });

        if (results) {
            const featureLabel = visibleFeatures === 1 ? 'feature' : 'features';
            const sectionLabel = visibleSections === 1 ? 'section' : 'sections';

            results.textContent = query || selectedCategory !== 'all'
                ? `${visibleFeatures} matching ${featureLabel}`
                : `${visibleFeatures} ${featureLabel} across ${visibleSections} ${sectionLabel}`;
        }

        if (empty) {
            empty.hidden = visibleFeatures > 0;
        }

        if (clear) {
            clear.hidden = search.value.length === 0;
        }
    };

    const updateFromControl = () => {
        const wasAboveViewport = catalogue.getBoundingClientRect().top < 0;

        update();

        if (wasAboveViewport) {
            catalogue.scrollIntoView?.({ block: 'start' });
        }
    };

    const clearSearch = () => {
        search.value = '';
        updateFromControl();
        search.focus();
    };

    listen(search, 'input', updateFromControl);
    listen(search, 'keydown', (event) => {
        if (event.key === 'Escape' && search.value) {
            event.preventDefault();
            clearSearch();
        }
    });
    listen(catalogue.querySelector('[data-feature-search-form]'), 'submit', (event) => event.preventDefault());
    listen(clear, 'click', clearSearch);

    catalogue.querySelectorAll('[data-feature-reset]').forEach((reset) => {
        listen(reset, 'click', () => {
            selectedCategory = 'all';
            clearSearch();
        });
    });

    categoryButtons.forEach((button) => {
        listen(button, 'click', () => {
            selectedCategory = button.dataset.featureCategory;
            updateFromControl();
        });
    });

    listen(categorySelect, 'change', () => {
        selectedCategory = categorySelect.value;
        updateFromControl();
    });

    update();
    catalogue.dataset.featureReady = '';
    catalogue.querySelectorAll('[data-feature-controls]').forEach((controls) => {
        controls.hidden = false;
    });

    return () => {
        listeners.forEach((removeListener) => removeListener());
    };
};
