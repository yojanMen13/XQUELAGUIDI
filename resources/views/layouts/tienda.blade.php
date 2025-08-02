<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('titulo', 'XQUELAGUIDI')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Compila Tailwind CSS y JS con Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


</head>

<body class="flex flex-col min-h-screen bg-white text-gray-800">

    {{-- Banner superior de promoción --}}
    <div class="bg-orange-600 text-white text-center text-sm py-2 px-4 font-medium tracking-wide shadow-sm">
        🚚 ¡Envío gratis en compras mayores a $999! · Promoción válida hasta el domingo 🧡
    </div>


    <!-- Navegación principal -->
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-screen-2xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('tienda.inicio') }}"
                class="text-2xl font-bold tracking-wide text-gray-800 hover:text-indigo-600 transition">
                XQUELAGUIDI
            </a>
            <form action="{{ route('tienda.buscar') }}" method="GET"
                class="hidden sm:flex items-center bg-gray-100 rounded-md px-3 py-1">
                <input type="text" name="q" placeholder="Buscar..."
                    class="bg-transparent text-sm focus:outline-none px-2 w-32 sm:w-40 lg:w-60"
                    value="{{ request('q') }}">
                <button type="submit" class="text-gray-500 hover:text-orange-600 ml-1">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <div class="flex items-center space-x-6 text-sm font-medium">
                <a href="{{ route('tienda.categoria', 'damas') }}"
                    class="text-gray-700 hover:text-indigo-600 transition">Damas</a>
                <a href="{{ route('tienda.categoria', 'caballeros') }}"
                    class="text-gray-700 hover:text-indigo-600 transition">Caballeros</a>
                <a href="{{ route('carrito.index') }}"
                    class="text-gray-700 hover:text-indigo-600 transition flex items-center">
                    <i class="fas fa-shopping-cart mr-1"></i> Carrito
                </a>
            </div>
        </div>
    </nav>

    <!-- Contenedor del contenido principal -->
    <main class="flex-1 w-full px-4 py-8">
        @yield('contenido')
    </main>


    <!-- Pie de página -->
    <footer class="bg-gray-900 text-white text-center py-5 mt-auto text-sm">
        XQUELAGUIDI &copy; {{ date('Y') }} · Huaraches Artesanales con orgullo mexicano
    </footer>

    {{-- Botón flotante de WhatsApp --}}
    <a href="https://wa.me/+529532118715?text=Hola%20XQUELAGUIDI,%20quiero%20más%20información%20sobre%20sus%20huaraches"
        target="_blank"
        class="fixed bottom-4 right-4 z-50 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg flex items-center justify-center w-14 h-14 transition-all duration-300"
        title="Contáctanos por WhatsApp" aria-label="Contáctanos por WhatsApp">

        <i class="fab fa-whatsapp text-2xl"></i>
    </a>


</body>

</html>
