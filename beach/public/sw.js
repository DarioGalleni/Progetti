const CACHE_VERSION = 'v1.0-beach';
const CACHE_NAME = `beach-prod-${CACHE_VERSION}`;
const OFFLINE_CACHE = `beach-off-prod-${CACHE_VERSION}`;

const PRECACHE_URLS = [
    './',
    './offline.html'
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
                            return caches.match('./offline.html');
                        }
                    });
            })
    );
});
