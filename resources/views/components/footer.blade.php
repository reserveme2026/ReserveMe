<footer class="bg-white dark:bg-gray-800 border-t border-violet-100 dark:border-gray-700 shadow-sm mt-auto transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col sm:flex-row items-center justify-between gap-3">
        <a href="{{ route('businesses.index') }}"
            class="flex items-center gap-2 text-sm font-bold text-violet-700 dark:text-violet-400 hover:text-violet-900 dark:hover:text-violet-300 transition-colors duration-150 shrink-0">
            <img src="{{ asset('favicon.svg') }}" alt="ReservMe" class="w-5 h-5">
            ReservMe
        </a>

        <p class="text-xs text-violet-400 dark:text-violet-500">
            © {{ date('Y') }} ReservMe. Todos los derechos reservados.
        </p>

    </div>
</footer>