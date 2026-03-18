# 🚀 Introducción a Progressive Web Apps (PWA)

## 🧠 ¿Qué es una PWA?

Una **Progressive Web App (PWA)** es una aplicación web que utiliza tecnologías modernas del navegador para ofrecer una experiencia similar a una app nativa.

### Características clave:
- Instalable (añadir a pantalla de inicio)
- Funciona offline o con mala conexión
- Rápida y eficiente
- Responsive (adaptada a cualquier dispositivo)
- No necesita App Store

---

## 🧩 Componentes esenciales de una PWA

### 1. Manifest (`manifest.json`)

```json
{
  "name": "Mi PWA",
  "short_name": "PWA",
  "start_url": "/index.html",
  "display": "standalone",
  "background_color": "#ffffff",
  "theme_color": "#0d6efd",
  "icons": [
    {
      "src": "/icons/icon-192.png",
      "sizes": "192x192",
      "type": "image/png"
    }
  ]
}
```

```html
<link rel="manifest" href="manifest.json">
```

---

### 2. Service Worker

```javascript
if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('/sw.js')
    .then(() => console.log('Service Worker registrado'))
    .catch(err => console.error(err));
}
```

---

### 3. HTTPS

El service worker solo funciona en entorno seguro (HTTPS).

---

## ⚙️ Estrategias de caché

### Cache First

```javascript
self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => response || fetch(event.request))
  );
});
```

### Network First

```javascript
event.respondWith(
  fetch(event.request)
    .catch(() => caches.match(event.request))
);
```

---

## 🛟 Fallback

```javascript
self.addEventListener('fetch', event => {
  event.respondWith(
    fetch(event.request)
      .catch(() => caches.match('/offline.html'))
  );
});
```

---

## 🔄 Contenido dinámico

```javascript
fetch('/data.json')
  .then(res => res.json())
  .then(data => {
    document.getElementById('app').innerHTML = data.title;
  });
```

---

## 🧱 Estructura del proyecto

/mi-pwa
- index.html
- styles.css
- app.js
- manifest.json
- sw.js
- /icons

---

## 🧪 Ejemplo mínimo

### index.html

```html
<!DOCTYPE html>
<html>
<head>
  <link rel="manifest" href="manifest.json">
</head>
<body>
  <h1>Mi PWA</h1>
  <script src="app.js"></script>
</body>
</html>
```

---

### sw.js

```javascript
const CACHE_NAME = 'mi-cache-v1';
const urlsToCache = [
  '/',
  '/index.html',
  '/styles.css',
  '/app.js'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
  );
});
```

---

## 📦 Instalación

Requisitos:
- Manifest válido
- Service worker activo
- HTTPS

---

## ⚠️ Buenas prácticas

- Versionar caché
- No cachear todo sin control
- Usar DevTools
- Probar offline

---

## 🧰 Recursos

- https://web.dev/progressive-web-apps/
- https://developer.mozilla.org/es/docs/Web/Progressive_web_apps
- https://pwabuilder.com/

---

## 🎯 Resumen

Una PWA necesita:
- HTML, CSS, JS
- manifest.json
- service worker
- HTTPS
- caché + fallback
