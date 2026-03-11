<?php get_header(); ?>

<?php
$collaborations = laura_floris_get_collaborations();
?>

<main id="home">
    <section class="px-6 pb-3 pt-14 md:px-10 md:pb-3 md:pt-10">
        <div id="hero-logo-wrap" class="mx-auto mb-10 max-w-7xl text-center transition-opacity duration-300">
            <div class="brandLogoCenter">
                <img
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>"
                    alt="Laura Floris"
                    class="mx-auto h-36 w-auto"
                >
            </div>
        </div>
    </section>

    <section class="px-6 pb-16 md:px-10">
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">
            <a href="<?php echo esc_url(home_url('/artworks')); ?>" class="group relative overflow-hidden rounded-3xl shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                <div class="h-[22vh] min-h-[150px] max-h-[210px] overflow-hidden md:h-auto md:aspect-[4/5]">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/namaste.png'); ?>" alt="Artworks" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                </div>
                <div class="absolute inset-0 bg-black/20 transition duration-300 group-hover:bg-black/35"></div>
                <div class="absolute inset-0 flex items-center justify-center p-6">
                    <h2 class="text-center text-xl font-semibold uppercase tracking-[0.18em] text-white md:text-2xl">Artworks</h2>
                </div>
            </a>

            <a href="<?php echo esc_url(home_url('/about')); ?>" class="group relative overflow-hidden rounded-3xl shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                <div class="h-[22vh] min-h-[150px] max-h-[210px] overflow-hidden md:h-auto md:aspect-[4/5]">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/laurafoto.png'); ?>" alt="About" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                </div>
                <div class="absolute inset-0 bg-black/20 transition duration-300 group-hover:bg-black/35"></div>
                <div class="absolute inset-0 flex items-center justify-center p-6">
                    <h2 class="text-center text-xl font-semibold uppercase tracking-[0.18em] text-white md:text-2xl">About</h2>
                </div>
            </a>

            <a href="<?php echo esc_url(home_url('/shop')); ?>" class="group relative overflow-hidden rounded-3xl shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                <div class="h-[22vh] min-h-[150px] max-h-[210px] overflow-hidden md:h-auto md:aspect-[4/5]">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/2020.png'); ?>" alt="Shop" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                </div>
                <div class="absolute inset-0 bg-black/20 transition duration-300 group-hover:bg-black/35"></div>
                <div class="absolute inset-0 flex items-center justify-center p-6">
                    <h2 class="text-center text-xl font-semibold uppercase tracking-[0.18em] text-white md:text-2xl">Shop</h2>
                </div>
            </a>
        </div>
    </section>
    <section class="border-t border-neutral-200 px-6 py-16 md:px-10" id="collaborations">
        <div class="mx-auto max-w-7xl">
            <div class="mb-10 max-w-2xl">
                <p class="mb-3 text-xs font-semibold uppercase tracking-[0.35em] text-neutral-500">Collaborations</p>
                <h3 class="text-3xl font-black uppercase md:text-4xl">Discover my collaboration</h3>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="flex flex-col rounded-[2rem] border border-neutral-200 bg-neutral-50 p-8 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <p class="mb-3 text-xs font-semibold uppercase tracking-[0.3em] text-neutral-500">Collaboration</p>
                    <h4 class="text-2xl font-bold uppercase leading-tight"><?php echo esc_html($collaborations['agatha-ruiz-de-la-prada']['title']); ?></h4>
                    <p class="mt-4 text-sm leading-7 text-neutral-600"><?php echo esc_html($collaborations['agatha-ruiz-de-la-prada']['excerpt']); ?></p>
                    <a href="<?php echo esc_url(laura_floris_get_collaboration_url('agatha-ruiz-de-la-prada')); ?>" class="mt-auto inline-flex w-fit rounded-full border border-neutral-900 px-5 py-3 text-xs font-semibold uppercase tracking-[0.2em] transition hover:bg-neutral-900 hover:text-white">Show</a>
                </div>

                <div class="flex flex-col rounded-[2rem] border border-neutral-200 bg-neutral-50 p-8 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <p class="mb-3 text-xs font-semibold uppercase tracking-[0.3em] text-neutral-500">Collaboration</p>
                    <h4 class="text-2xl font-bold uppercase leading-tight"><?php echo esc_html($collaborations['netflix']['title']); ?></h4>
                    <p class="mt-4 text-sm leading-7 text-neutral-600"><?php echo esc_html($collaborations['netflix']['excerpt']); ?></p>
                    <a href="<?php echo esc_url(laura_floris_get_collaboration_url('netflix')); ?>" class="mt-auto inline-flex w-fit rounded-full border border-neutral-900 px-5 py-3 text-xs font-semibold uppercase tracking-[0.2em] transition hover:bg-neutral-900 hover:text-white">Show</a>
                </div>

                <div class="flex flex-col rounded-[2rem] border border-neutral-200 bg-neutral-50 p-8 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <p class="mb-3 text-xs font-semibold uppercase tracking-[0.3em] text-neutral-500">Collaboration</p>
                    <h4 class="text-2xl font-bold uppercase leading-tight"><?php echo esc_html($collaborations['hbo']['title']); ?></h4>
                    <p class="mt-4 text-sm leading-7 text-neutral-600"><?php echo esc_html($collaborations['hbo']['excerpt']); ?></p>
                    <a href="<?php echo esc_url(laura_floris_get_collaboration_url('hbo')); ?>" class="mt-auto inline-flex w-fit rounded-full border border-neutral-900 px-5 py-3 text-xs font-semibold uppercase tracking-[0.2em] transition hover:bg-neutral-900 hover:text-white">Show</a>
                </div>
            </div>
        </div>
    </section>

    <section class="border-t border-neutral-200 px-6 py-16 md:px-10" id="about">
        <div class="mx-auto grid max-w-7xl gap-10 md:grid-cols-[1.1fr_0.9fr] md:items-center">
            <div>
                <p class="mb-3 text-xs font-semibold uppercase tracking-[0.35em] text-neutral-500">About</p>
                <h3 class="text-3xl font-black uppercase md:text-4xl">Find more about me</h3>
                <p class="mt-6 max-w-2xl text-base leading-8 text-neutral-600">
                    Hi, I'm Laura Floris !! <br>
                    I’m from Madrid but I grew up in Italy, <br>
                    I’m bilingual italian and spanish native speaker. <br>
                    Fashion Designer and Digital Artist Freelance.
                </p>
                <p class="mt-6 max-w-2xl text-base leading-8 text-neutral-600">
                    For greetings, small or pro-scale jobs please send an email to laflorisart@gmail.com
                </p>
            </div>

            <a href="<?php echo esc_url(home_url('/about')); ?>" class="group block overflow-hidden rounded-3xl bg-neutral-100 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl" aria-label="Go to About page">
                <div class="h-[22vh] min-h-[150px] max-h-[210px] overflow-hidden md:h-auto md:aspect-[4/5]">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/laurafoto.png'); ?>" alt="Laura Floris" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                </div>
                <div class="flex items-center justify-between px-5 py-4">
                    <span class="text-xs uppercase tracking-[0.2em] text-neutral-500">View</span>
                </div>
            </a>
        </div>
    </section>

    <section class="border-t border-neutral-200 px-6 py-16 md:px-10" id="shop">
        <div class="mx-auto max-w-7xl rounded-[2rem] bg-neutral-100 px-8 py-10 md:flex md:items-center md:justify-between md:px-12">
            <div class="max-w-2xl">
                <p class="mb-3 text-xs font-semibold uppercase tracking-[0.35em] text-neutral-500">Shop</p>
                <h3 class="text-3xl font-black uppercase md:text-4xl">Take a look at my shop</h3>
                <p class="mt-4 text-base leading-8 text-neutral-600">Discover the shop section with my prints, limited editions and digital works.</p>
            </div>
            <a href="<?php echo esc_url(home_url('/shop')); ?>" class="mt-8 inline-flex rounded-full bg-neutral-900 px-6 py-4 text-xs font-semibold uppercase tracking-[0.2em] text-white transition hover:opacity-85 md:mt-0">Go to my shop</a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
