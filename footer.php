<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
</div>

<footer class="border-t border-neutral-200 px-6 py-12 md:px-10">

    <div class="mx-auto max-w-5xl text-center">

        <!-- Copyright -->
        <p class="text-sm text-neutral-500 leading-relaxed">
            All works &copy; <?php echo date('Y'); ?> Laura Floris Art. All rights reserved.<br>
            Do not reproduce without the express written consent of Laura Floris.
        </p>

        <!-- Social -->
        <div class="mt-6 flex justify-center gap-6">

            <!-- Instagram -->
            <a href="https://www.instagram.com/laurafloris" target="_blank" class="text-neutral-500 transition hover:text-neutral-900">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     width="20" 
                     height="20" 
                     viewBox="0 0 24 24" 
                     fill="none" 
                     stroke="currentColor" 
                     stroke-width="1.6" 
                     stroke-linecap="round" 
                     stroke-linejoin="round">
                    <rect x="2" y="2" width="20" height="20" rx="5"></rect>
                    <circle cx="12" cy="12" r="4"></circle>
                    <circle cx="17.5" cy="6.5" r="1"></circle>
                </svg>
            </a>

            <!-- Email -->
            <a href="mailto:laflorisart@gmail.com" class="text-neutral-500 transition hover:text-neutral-900">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     width="20" 
                     height="20" 
                     viewBox="0 0 24 24" 
                     fill="none" 
                     stroke="currentColor" 
                     stroke-width="1.6" 
                     stroke-linecap="round" 
                     stroke-linejoin="round">
                    <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
            </a>

        </div>

    </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
