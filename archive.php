<?php get_header(); ?>

<main class="px-6 py-16 md:px-10">
    <div class="mx-auto max-w-7xl">
        <header class="mb-10">
            <h1 class="text-3xl font-black uppercase md:text-5xl"><?php the_archive_title(); ?></h1>
            <?php if (get_the_archive_description()) : ?>
                <div class="mt-4 text-neutral-600">
                    <?php the_archive_description(); ?>
                </div>
            <?php endif; ?>
        </header>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article <?php post_class('overflow-hidden rounded-3xl border border-neutral-200 bg-white p-6 shadow-sm'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="mb-5 overflow-hidden rounded-2xl">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium_large', array('class' => 'h-auto w-full object-cover')); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <p class="mb-2 text-xs font-semibold uppercase tracking-[0.25em] text-neutral-500">
                        <?php echo esc_html(get_the_date()); ?>
                    </p>

                    <h2 class="text-xl font-bold uppercase leading-tight">
                        <a href="<?php the_permalink(); ?>" class="transition hover:opacity-60">
                            <?php the_title(); ?>
                        </a>
                    </h2>

                    <div class="mt-4 text-sm leading-7 text-neutral-600">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; else : ?>
                <p>Nessun contenuto trovato.</p>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>