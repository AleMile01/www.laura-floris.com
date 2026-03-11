<?php get_header(); ?>

<main class="px-6 py-16 md:px-10">
    <section class="mx-auto max-w-5xl">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article <?php post_class(); ?>>
                <header class="mb-10 text-center">
                    <p class="mb-3 text-sm text-neutral-500">Artwork</p>
                    <h1 class="text-4xl font-black md:text-5xl"><?php the_title(); ?></h1>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <div class="overflow-hidden rounded-3xl bg-neutral-100 shadow-sm">
                        <?php the_post_thumbnail('full', array(
                            'class' => 'h-auto w-full object-cover'
                        )); ?>
                    </div>
                <?php endif; ?>

                <?php if (get_the_excerpt()) : ?>
                    <div class="mx-auto mt-8 max-w-3xl text-center">
                        <p class="text-lg leading-8 text-neutral-600">
                            <?php echo esc_html(get_the_excerpt()); ?>
                        </p>
                    </div>
                <?php endif; ?>

                <div class="mx-auto mt-10 max-w-3xl text-base leading-8 text-neutral-700">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </section>
</main>

<?php get_footer(); ?>