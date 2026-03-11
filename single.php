<?php get_header(); ?>

<main class="px-6 py-16 md:px-10">
    <div class="mx-auto max-w-4xl">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article <?php post_class(); ?>>
                <header class="mb-10">
                    <p class="mb-3 text-xs font-semibold uppercase tracking-[0.35em] text-neutral-500">
                        <?php echo esc_html(get_the_date()); ?>
                    </p>
                    <h1 class="text-3xl font-black uppercase md:text-5xl"><?php the_title(); ?></h1>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="mb-10 overflow-hidden rounded-3xl">
                        <?php the_post_thumbnail('large', array('class' => 'h-auto w-full object-cover')); ?>
                    </div>
                <?php endif; ?>

                <div class="prose max-w-none text-base leading-8 text-neutral-700">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>