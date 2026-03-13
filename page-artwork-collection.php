<?php get_header(); ?>

<?php
$slug = get_query_var('laura_artwork_collection');
$collection = $slug ? laura_floris_get_artwork_group($slug) : null;

if (!$collection) {
    get_footer();
    return;
}
?>

<main class="px-6 pb-24 pt-10 md:px-10 md:pb-28 md:pt-8">
    <section class="mx-auto max-w-7xl">
        <div class="mb-8 max-w-3xl">
            <p class="mb-3 text-sm text-neutral-500">Artwork Collection</p>
            <h1 class="text-4xl font-black uppercase md:text-5xl"><?php echo esc_html($collection['title']); ?></h1>
            <p class="mt-4 text-base leading-8 text-neutral-600"><?php echo esc_html($collection['description']); ?></p>
        </div>

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <?php foreach ($collection['items'] as $artwork) : ?>
                <article class="group">
                    <div class="relative overflow-hidden rounded-3xl bg-neutral-100 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <div class="aspect-[4/5] overflow-hidden">
                            <img
                                src="<?php echo esc_url($artwork['image']); ?>"
                                alt="<?php echo esc_attr($artwork['title']); ?>"
                                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                            >
                        </div>

                        <div class="absolute inset-0 flex items-center justify-center bg-black/0 p-6 opacity-0 transition duration-300 group-hover:bg-black/35 group-hover:opacity-100">
                            <p class="translate-y-3 text-center text-base text-white opacity-0 transition duration-300 group-hover:translate-y-0 group-hover:opacity-100">
                                <?php echo esc_html($artwork['title']); ?>
                            </p>
                        </div>
                    </div>

                    <h2 class="mt-4 text-center text-base text-neutral-900"><?php echo esc_html($artwork['title']); ?></h2>
                </article>
            <?php endforeach; ?>
        </div>

        <a href="<?php echo esc_url(home_url('/artworks')); ?>" class="mt-10 inline-flex rounded-full border border-neutral-900 px-6 py-3 text-xs font-semibold uppercase tracking-[0.2em] transition hover:bg-neutral-900 hover:text-white">Back to collections</a>
    </section>
</main>

<?php get_footer(); ?>
