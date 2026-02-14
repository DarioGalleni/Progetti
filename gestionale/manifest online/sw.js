const CACHE_VERSION = 'v-online-fixed-1.0';
const CACHE_NAME = `gemma-prod-${CACHE_VERSION}`;
const OFFLINE_CACHE = `gemma-off-prod-${CACHE_VERSION}`;

// URL ASSOLUTI WEB per evitare errori di percorso
const PRECACHE_URLS = [
    '/gest/',
    '/gest/offline.html'
];

self.addEventListener('install', (event) => {
    self.skipWaiting();
    event.waitUntil(
        caches.open(OFFLINE_CACHE).then((cache) => {
            // Aggiungiamo catch per evitare che un errore blocchi tutto
            return cache.addAll(PRECACHE_URLS).catch(err => {
                console.error('Errore precaching:', err);
            });
        })
    );
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) => Promise.all(
            keys.map((key) => {
                if (!key.includes(CACHE_VERSION)) return caches.delete(key);
            })
        )).then(() => self.clients.claim())
    );
});

self.addEventListener('fetch', (event) => {
    if (event.request.method !== 'GET') return;

    event.respondWith(
        fetch(event.request)
            .then((networkResponse) => {
                return caches.open(CACHE_NAME).then((cache) => {
                    cache.put(event.request, networkResponse.clone());
                    return networkResponse;
                });
            })
            .catch(() => {
                return caches.match(event.request)
                    .then((cachedResp) => {
                        if (cachedResp) return cachedResp;
                        // Fallback offline con percorso assoluto
                        if (event.request.mode === 'navigate') {
                            return caches.match('/gest/offline.html');
                        }
                    });
            })
    );
});