<?php get_header(); ?>

<main class="px-6 py-16 md:px-10">
    <div class="mx-auto max-w-4xl">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article <?php post_class('mb-12'); ?>>
                <h2 class="mb-4 text-2xl font-bold uppercase">
                    <a href="<?php the_permalink(); ?>" class="transition hover:opacity-60">
                        <?php the_title(); ?>
                    </a>
                </h2>
                <div class="text-base leading-8 text-neutral-700">
                    <?php the_excerpt(); ?>
                </div>
            </article>
        <?php endwhile; else : ?>
            <p>Nessun contenuto trovato.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>