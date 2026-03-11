<?php get_header(); ?>

<main class="px-6 py-16 md:px-10">
    <section class="mx-auto max-w-7xl">
        <div class="mb-12 text-center">
            <p class="mb-3 text-sm text-neutral-500">Artworks</p>
            <h1 class="text-4xl font-black md:text-5xl">Selected artworks</h1>
        </div>

        <?php
        $fallback_artworks = array(
            array(
                'title' => 'Namaste',
                'image' => get_template_directory_uri() . '/assets/images/namaste.png',
            ),
            array(
                'title' => 'Girl Coronavirus',
                'image' => get_template_directory_uri() . '/assets/images/girl-coronavirus.png',
            ),
            array(
                'title' => 'Madrid',
                'image' => get_template_directory_uri() . '/assets/images/madrid.png',
            ),
            array(
                'title' => 'Templo De Debod Madrid',
                'image' => get_template_directory_uri() . '/assets/images/templo-de-debod-madrid.png',
            ),
            array(
                'title' => '2020',
                'image' => get_template_directory_uri() . '/assets/images/2020.png',
            ),
            array(
                'title' => 'Coronavirus Metro',
                'image' => get_template_directory_uri() . '/assets/images/coronavirus-metro.png',
            ),
        );
        ?>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="group block">
                        <div class="relative overflow-hidden rounded-3xl bg-neutral-100 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                            <div class="aspect-[4/5] overflow-hidden">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large', array(
                                        'class' => 'h-full w-full object-cover transition duration-500 group-hover:scale-105'
                                    )); ?>
                                <?php else : ?>
                                    <div class="flex h-full items-center justify-center bg-neutral-200 text-sm uppercase tracking-[0.2em] text-neutral-500">Artwork</div>
                                <?php endif; ?>
                            </div>

                            <div class="absolute inset-0 flex items-end bg-black/0 p-6 transition duration-300 group-hover:bg-black/45 group-hover:backdrop-blur-[1px]">
                                <div class="translate-y-4 opacity-0 transition duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                                    <p class="text-sm text-white/80">View artwork</p>
                                    <h2 class="mt-1 text-lg font-medium text-white"><?php the_title(); ?></h2>
                                </div>
                            </div>
                        </div>

                        <h3 class="mt-4 text-center text-base text-neutral-900"><?php the_title(); ?></h3>
                    </a>
                <?php endwhile; ?>
            <?php else : ?>
                <?php foreach ($fallback_artworks as $artwork) : ?>
                    <div class="group block">
                        <div class="relative overflow-hidden rounded-3xl bg-neutral-100 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                            <div class="aspect-[4/5] overflow-hidden">
                                <img
                                    src="<?php echo esc_url($artwork['image']); ?>"
                                    alt="<?php echo esc_attr($artwork['title']); ?>"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                >
                            </div>

                            <div class="absolute inset-0 flex items-center justify-center bg-black/20 p-6 transition duration-300 group-hover:bg-black/35">
                                <h2 class="text-center text-lg font-medium uppercase tracking-[0.12em] text-white">
                                    <?php echo esc_html($artwork['title']); ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
