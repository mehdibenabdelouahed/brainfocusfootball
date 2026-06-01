const CACHE_NAME = 'bff-v4';
const ASSETS = [
  '/manifest.json',
  '/images/logoBFF.png'
];

// Install: cache uniquement les assets statiques (PAS la page /)
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      return cache.addAll(ASSETS);
    })
  );
  self.skipWaiting();
});

// Activate: supprime les anciens caches
self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(keys => {
      return Promise.all(
        keys.filter(key => key !== CACHE_NAME).map(key => caches.delete(key))
      );
    })
  );
  self.clients.claim();
});

// Fetch: network-first pour les pages HTML, cache-first pour les assets
self.addEventListener('fetch', event => {
  const request = event.request;

  // Pour les requêtes de navigation (pages HTML) : toujours réseau d'abord
  if (request.mode === 'navigate') {
    event.respondWith(
      fetch(request).catch(() => caches.match(request))
    );
    return;
  }

  // Pour les assets statiques : cache d'abord, puis réseau
  event.respondWith(
    caches.match(request).then(response => {
      return response || fetch(request);
    })
  );
});
