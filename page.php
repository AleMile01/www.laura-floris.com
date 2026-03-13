<?php get_header(); ?>

<main class="px-6 pb-16 pt-10 md:px-10 md:pt-8">
    <div class="mx-auto max-w-4xl">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article <?php post_class(); ?>>
                <header class="mb-8">
                    <h1 class="text-3xl font-black uppercase md:text-5xl"><?php the_title(); ?></h1>
                </header>

                <div class="prose max-w-none text-base leading-8 text-neutral-700">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>

