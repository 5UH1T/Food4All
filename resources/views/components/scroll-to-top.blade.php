<button id="scrollToTop" type="button"
    class="fixed bottom-5 right-5 z-50 hidden
           w-11 h-11 rounded-full
           bg-gray-900 text-white
           shadow-lg
           items-center justify-center
           hover:bg-gray-700
           transition-all duration-300"
    aria-label="Scroll to top">
    <i class="bi bi-arrow-up"></i>
</button>

<script>
    const scrollToTopBtn = document.getElementById('scrollToTop');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            scrollToTopBtn.classList.remove('hidden');
            scrollToTopBtn.classList.add('flex');
        } else {
            scrollToTopBtn.classList.add('hidden');
            scrollToTopBtn.classList.remove('flex');
        }
    });

    scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
