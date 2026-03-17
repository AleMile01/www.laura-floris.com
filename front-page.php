<?php get_header(); ?>

<main id="home">
    <h1 class="sr-only">Laura Floris, digital artist and fashion designer</h1>

    <section class="px-6 pb-0 pt-12 md:px-10 md:pb-1 md:pt-6">
        <div id="hero-logo-wrap" class="mx-auto mb-4 max-w-7xl text-center transition-opacity duration-300">
            <div class="brandLogoCenter">
                <img
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.webp'); ?>"
                    alt="Laura Floris"
                    class="mx-auto h-36 w-auto"
                    fetchpriority="high"
                >
            </div>
        </div>
    </section>

    <section class="px-6 pb-16 md:px-10" aria-label="Featured sections">
        <div class="home-feature-grid mx-auto grid max-w-7xl grid-cols-1 gap-4 md:grid-cols-3">
            <a href="<?php echo esc_url(laura_floris_get_projects_url()); ?>" class="home-feature-card group relative overflow-hidden rounded-3xl shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl" aria-label="Explore projects">
                <div class="home-feature-card__media overflow-hidden">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/laurafoto.webp'); ?>" alt="Projects" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                </div>
                <div class="absolute inset-0 bg-black/20 transition duration-300 group-hover:bg-black/35"></div>
                <div class="absolute inset-0 flex items-center justify-center p-6">
                    <h2 class="text-center text-xl font-semibold uppercase tracking-[0.18em] text-white md:text-2xl">Projects</h2>
                </div>
            </a>

            <a href="<?php echo esc_url(home_url('/artworks')); ?>" class="home-feature-card group relative overflow-hidden rounded-3xl shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl" aria-label="Explore artworks">
                <div class="home-feature-card__media overflow-hidden">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/newyork.webp'); ?>" alt="Artworks" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                </div>
                <div class="absolute inset-0 bg-black/20 transition duration-300 group-hover:bg-black/35"></div>
                <div class="absolute inset-0 flex items-center justify-center p-6">
                    <h2 class="text-center text-xl font-semibold uppercase tracking-[0.18em] text-white md:text-2xl">Artworks</h2>
                </div>
            </a>

            <a href="<?php echo esc_url(home_url('/shop')); ?>" class="home-feature-card group relative overflow-hidden rounded-3xl shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl" aria-label="Open the shop">
                <div class="home-feature-card__media overflow-hidden">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/shopfoto.webp'); ?>" alt="Laura Floris shop" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                </div>
                <div class="absolute inset-0 bg-black/20 transition duration-300 group-hover:bg-black/35"></div>
                <div class="absolute inset-0 flex items-center justify-center p-6">
                    <h2 class="text-center text-xl font-semibold uppercase tracking-[0.18em] text-white md:text-2xl">Shop</h2>
                </div>
            </a>
        </div>
    </section>

    <section class="border-t border-neutral-200 px-6 py-16 md:px-10" id="about">
        <div class="mx-auto grid max-w-7xl gap-10 md:grid-cols-[1.15fr_0.85fr] md:items-center">
            <div>
                <p class="notranslate mb-3 text-xs font-semibold uppercase tracking-[0.35em] text-neutral-700" translate="no">About</p>
                <h2 class="text-3xl font-black uppercase md:text-4xl">Find more about me</h2>
                <p class="mt-6 max-w-2xl text-base leading-8 text-neutral-600">
                    Hi, I'm Laura Floris. <br>
                    I'm from Madrid but I grew up in Italy, <br>
                    I'm a bilingual Italian and Spanish native speaker. <br>
                    Digital Artist Freelance.
                </p>
                <p class="mt-6 max-w-2xl text-base leading-8 text-neutral-600">
                    For greetings, small or pro-scale jobs please send an email to laflorisart@gmail.com
                </p>
            </div>

            <a href="<?php echo esc_url(home_url('/about')); ?>" class="group block w-full max-w-[17rem] justify-self-center overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-neutral-200 transition duration-300 hover:-translate-y-1 hover:shadow-xl" aria-label="Go to About page">
                <div class="aspect-[4/5] overflow-hidden">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/laurafoto.webp'); ?>" alt="Laura Floris" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                </div>
                <div class="p-5 text-center">
                    <h3 class="text-base font-semibold">Laura Floris</h3>
                    <p class="mt-2 text-xs text-neutral-600">Digital artist</p>
                    <span class="mt-5 inline-flex text-xs font-medium tracking-[0.1em] text-neutral-700">Show more</span>
                </div>
            </a>
        </div>
    </section>

    <section class="border-t border-neutral-200 px-6 py-16 md:px-10" id="shop">
        <div class="mx-auto max-w-7xl rounded-[2rem] bg-neutral-100 px-8 py-10 ring-1 ring-neutral-200 md:flex md:items-center md:justify-between md:px-12">
            <div class="max-w-2xl">
                <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-full border border-neutral-300 bg-white text-neutral-900 shadow-sm">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" class="h-5 w-5">
                        <path d="M6.5 8.5H17.5L16.7 18H7.3L6.5 8.5Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M9 9V7.8C9 6.25 10.12 5 11.5 5H12.5C13.88 5 15 6.25 15 7.8V9" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <p class="mb-3 text-xs font-semibold uppercase tracking-[0.35em] text-neutral-700">Shop</p>
                <h2 class="text-3xl font-black uppercase md:text-4xl">Take a look at my shop</h2>
                <p class="mt-4 text-base leading-8 text-neutral-600">Discover the shop section with my prints, limited editions and digital works.</p>
            </div>
            <a href="<?php echo esc_url(home_url('/shop')); ?>" class="mt-8 inline-flex w-fit self-start rounded-full bg-neutral-900 px-5 py-3 text-center text-xs font-semibold uppercase tracking-[0.2em] text-white transition hover:opacity-85 md:mt-0 md:self-auto">Go to my shop</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>

