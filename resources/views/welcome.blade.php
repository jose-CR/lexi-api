<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel Docs</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-900 text-white scroll-smooth">

  <div class="flex min-h-screen">
    
    <!-- 📌 ASIDE (sticky con scroll independiente) -->
    <aside class="w-64 bg-gray-800 p-4 space-y-4 h-screen sticky top-0 overflow-y-auto">
      <div class="relative" data-dropdown-root>
        <button type="button" data-dropdown-button data-target="dropdown1" 
          onclick="toggleDropdown(this.dataset.target)"
          class="w-full text-center px-5 py-2 rounded-lg shadow-md text-white transition bg-blue-600 hover:bg-blue-700">
          📘 Documentación General
        </button>
        
        <div id="dropdown1"
          class="hidden mt-2 w-full rounded-lg shadow-lg bg-gray-700 ring-1 ring-black/20 z-20"
          data-dropdown-menu>
          <a href="#Introduccion" class="block px-4 py-2 text-sm text-gray-200 hover:bg-gray-600 transition">Introducción</a>
          <a href="#ApiCall" class="block px-4 py-2 text-sm text-gray-200 hover:bg-gray-600 transition">Llamada a la API</a>
          <a href="#ApiResources" class="block px-4 py-2 text-sm text-gray-200 hover:bg-gray-600 transition">Recursos de la API</a>
        </div>
      </div>
    </aside>

    <!-- 📌 MAIN CONTENT -->
    <main class="flex-1 p-8 overflow-y-auto h-screen">
      <h1 class="text-3xl font-bold mb-6">📖 API Documentation</h1>

      <!-- Introducción -->
      <section id="Introduccion" class="mb-10">
        <h2 class="text-2xl font-semibold text-white mb-4">Introducción</h2>
        <p class="text-lg text-gray-300 leading-relaxed">
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nostrum, a?
        </p>
      </section>

      <!-- API Call -->
      <section id="ApiCall" class="mb-10">
        <h2 class="text-2xl font-semibold text-white mb-4">REST API Overview</h2>

        <p class="text-lg text-gray-300 mb-4">
          <strong class="font-semibold text-white">Base URL:</strong>
          <a class="text-indigo-400 hover:underline">http://localhost:8000/api</a>
        </p>

        <p class="text-lg text-gray-300 mb-8">
          All requests are <span class="bg-gray-800 text-red-400 px-2 py-1 rounded">GET</span> 
          and use <span class="bg-gray-800 text-red-400 px-2 py-1 rounded">https</span>. 
          Responses are returned in <span class="bg-gray-800 text-red-400 px-2 py-1 rounded">JSON</span> format.
        </p>

        <div class="bg-gray-800 text-green-400 rounded-xl p-6">
          <pre><code>GET http://localhost:8000/api</code></pre>
        </div>
      </section>

      <!-- API Resources -->
      <section id="ApiResources" class="mb-10">
        <h2 class="text-2xl font-semibold text-white mb-4">Available Resources</h2>
        <div class="bg-gray-800 text-white rounded-xl p-6">
          <pre><code>{
  <span class="text-yellow-400">"categories"</span>: <span class="text-blue-400">"http://localhost:8000/api/categories"</span>,
  <span class="text-yellow-400">"subcategories"</span>: <span class="text-blue-400">"http://localhost:8000/api/subcategories"</span>,
  <span class="text-yellow-400">"words"</span>: <span class="text-blue-400">"http://localhost:8000/api/words"</span>
}</code></pre>
        </div>
      </section>
    </main>
  </div>

  <script>
    // Abre/cierra el menú indicado y cierra los otros
    function toggleDropdown(id) {
      document.querySelectorAll('[data-dropdown-menu]').forEach(el => {
        if (el.id !== id) el.classList.add('hidden');
      });
      const menu = document.getElementById(id);
      if (menu) menu.classList.toggle('hidden');
    }

    // Cierra si haces click fuera de cualquier dropdown (botón o menú)
    document.addEventListener('click', (e) => {
      const insideDropdown = e.target.closest('[data-dropdown-root]');
      if (!insideDropdown) {
        document.querySelectorAll('[data-dropdown-menu]').forEach(el => el.classList.add('hidden'));
      }
    });
  </script>
</body>
</html>