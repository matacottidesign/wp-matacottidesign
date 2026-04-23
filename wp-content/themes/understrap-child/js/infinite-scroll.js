(function () {
    'use strict';

    const grid     = document.querySelector('.row.progetti-listing');
    const sentinel = document.getElementById('infinite-sentinel');

    if (!grid || !sentinel) return;

    const MOBILE_BP  = 768;
    const isMobile   = () => window.innerWidth < MOBILE_BP;
    const totalPosts = parseInt(infiniteScrollData.totalPosts, 10);

    let offset       = parseInt(infiniteScrollData.initialCount, 10);
    let loading      = false;
    let pendingItems = [];

    // Su mobile nascondi i post oltre il quarto (index >= 4)
    if (isMobile()) {
        Array.from(grid.querySelectorAll(':scope > .col-12'))
            .slice(4)
            .forEach(function (item) {
                item.style.display = 'none';
                pendingItems.push(item);
            });
    }

    // Nessun altro post da caricare
    if (offset >= totalPosts && pendingItems.length === 0) {
        sentinel.remove();
        return;
    }

    async function loadMore() {
        if (loading) return;

        // Prima mostra i post nascosti (solo mobile, primo scroll)
        if (pendingItems.length > 0) {
            pendingItems.forEach(function (item) { item.style.display = ''; });
            pendingItems = [];
            if (offset >= totalPosts) {
                sentinel.remove();
                observer.disconnect();
            }
            return;
        }

        if (offset >= totalPosts) {
            sentinel.remove();
            observer.disconnect();
            return;
        }

        loading = true;
        sentinel.classList.add('is-loading');

        const perPage = isMobile() ? 4 : 6;
        const body    = new FormData();
        body.append('action',   'load_more_progetti');
        body.append('nonce',    infiniteScrollData.nonce);
        body.append('offset',   offset);
        body.append('per_page', perPage);

        try {
            const res  = await fetch(infiniteScrollData.ajaxUrl, { method: 'POST', body: body });
            const data = await res.json();

            if (data.success && data.data.html) {
                grid.insertAdjacentHTML('beforeend', data.data.html);
                offset += perPage;
            }
        } catch (_) {
            // Errore di rete: riprova al prossimo scroll
        }

        sentinel.classList.remove('is-loading');
        loading = false;

        if (offset >= totalPosts) {
            sentinel.remove();
            observer.disconnect();
        }
    }

    var observer = new IntersectionObserver(
        function (entries) {
            if (entries[0].isIntersecting) loadMore();
        },
        { rootMargin: '300px 0px' }
    );

    observer.observe(sentinel);
}());
