<?php
/*
Template Name: Artworks
*/
get_header();
?>

<main class="px-6 py-16 md:px-10">
    <section class="mx-auto max-w-7xl">
        <div class="mb-12 text-center">
            <p class="mb-3 text-sm text-neutral-500">Artworks</p>
            <h1 class="text-4xl font-black md:text-5xl">My Artworks</h1>
        </div>

        <?php
        $artworks = [
            [
                'title' => 'Namaste',
                'image' => get_template_directory_uri() . '/assets/images/namaste.png',
            ],
            [
                'title' => 'Girl Coronavirus',
                'image' => get_template_directory_uri() . '/assets/images/girl-coronavirus.png',
            ],
            [
                'title' => 'Madrid',
                'image' => get_template_directory_uri() . '/assets/images/madrid.png',
            ],
            [
                'title' => 'Templo De Debod Madrid',
                'image' => get_template_directory_uri() . '/assets/images/templo-de-debod-madrid.png',
            ],
            [
                'title' => '2020',
                'image' => get_template_directory_uri() . '/assets/images/2020.png',
            ],
            [
                'title' => 'Coronavirus Metro',
                'image' => get_template_directory_uri() . '/assets/images/coronavirus-metro.png',
            ],
        ];
        ?>

        <section class="sm:hidden" data-artworks-carousel>
            <div class="relative overflow-hidden rounded-[2rem] bg-neutral-50 p-4 shadow-sm">
                <div class="flex transition-transform duration-500 ease-out" data-artworks-track>
                    <?php foreach ($artworks as $index => $artwork) : ?>
                        <article class="w-full shrink-0" data-artwork-slide aria-hidden="<?php echo 0 === $index ? 'false' : 'true'; ?>">
                            <div class="relative overflow-hidden rounded-3xl bg-neutral-100 shadow-sm">
                                <div class="aspect-[4/5] overflow-hidden">
                                    <img
                                        src="<?php echo esc_url($artwork['image']); ?>"
                                        alt="<?php echo esc_attr($artwork['title']); ?>"
                                        class="h-full w-full object-cover"
                                    >
                                </div>

                                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                                    <p class="text-center text-base text-white">
                                        <?php echo esc_html($artwork['title']); ?>
                                    </p>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <div class="mt-5 flex items-center justify-between gap-4">
                    <button
                        type="button"
                        class="inline-flex h-12 w-12 items-center justify-center rounded-full border border-neutral-300 bg-white text-neutral-900 shadow-sm transition hover:-translate-y-0.5 hover:border-neutral-900"
                        data-artworks-prev
                        aria-label="Previous artwork"
                    >
                        <span aria-hidden="true">&#8592;</span>
                    </button>

                    <p class="text-sm uppercase tracking-[0.24em] text-neutral-500">
                        <span data-artworks-current>1</span>
                        /
                        <span><?php echo count($artworks); ?></span>
                    </p>

                    <button
                        type="button"
                        class="inline-flex h-12 w-12 items-center justify-center rounded-full border border-neutral-300 bg-white text-neutral-900 shadow-sm transition hover:-translate-y-0.5 hover:border-neutral-900"
                        data-artworks-next
                        aria-label="Next artwork"
                    >
                        <span aria-hidden="true">&#8594;</span>
                    </button>
                </div>
            </div>
        </section>

        <div class="hidden grid-cols-1 gap-6 sm:grid sm:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($artworks as $artwork) : ?>
                <div class="group">
                    <div class="relative overflow-hidden rounded-3xl bg-neutral-100 shadow-sm">
                        <div class="aspect-[4/5] overflow-hidden">
                            <img
                                src="<?php echo esc_url($artwork['image']); ?>"
                                alt="<?php echo esc_attr($artwork['title']); ?>"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                            >
                        </div>

                        <div class="absolute inset-0 flex items-center justify-center bg-black/0 p-6 opacity-0 transition duration-300 group-hover:bg-black/45 group-hover:opacity-100 group-active:bg-black/45 group-active:opacity-100">
                            <p class="translate-y-3 text-center text-base text-white opacity-0 transition duration-300 group-hover:translate-y-0 group-hover:opacity-100 group-active:translate-y-0 group-active:opacity-100">
                                <?php echo esc_html($artwork['title']); ?>
                            </p>
                        </div>
                    </div>

                    <h2 class="mt-4 text-center text-base text-neutral-900">
                        <?php echo esc_html($artwork['title']); ?>
                    </h2>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
