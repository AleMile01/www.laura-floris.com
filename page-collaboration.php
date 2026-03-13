<?php get_header(); ?>

<?php
$slug = get_query_var('laura_collaboration');
$collaboration = $slug ? laura_floris_get_collaboration($slug) : null;

if (!$collaboration) {
    get_footer();
    return;
}
?>

<main class="px-6 pb-16 pt-10 md:px-10 md:pt-8">
    <section class="mx-auto max-w-6xl">
        <div class="mb-8 text-center">
            <p class="mb-3 text-sm text-neutral-500">Collaboration</p>
            <h1 class="text-4xl font-black md:text-5xl"><?php echo esc_html($collaboration['title']); ?></h1>
            <p class="mt-4 text-sm uppercase tracking-[0.25em] text-neutral-500"><?php echo esc_html($collaboration['subtitle']); ?></p>
        </div>

        <div class="grid items-start gap-7 md:grid-cols-[0.9fr_1fr]">
            <div class="overflow-hidden rounded-[2rem] border border-neutral-200 bg-white p-3 shadow-sm">
                <div class="overflow-hidden rounded-[1.5rem] bg-neutral-100">
                    <img
                        src="<?php echo esc_url($collaboration['image']); ?>"
                        alt="<?php echo esc_attr($collaboration['title']); ?>"
                        class="aspect-[4/5] h-full w-full object-cover"
                    >
                </div>
            </div>

            <div class="rounded-[2rem] border border-neutral-200 bg-neutral-50 p-7 shadow-sm md:p-8">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-neutral-500">Project</p>
                <h2 class="mt-4 text-3xl font-black uppercase leading-tight"><?php echo esc_html($collaboration['title']); ?></h2>
                <p class="mt-5 text-base leading-8 text-neutral-600"><?php echo esc_html($collaboration['excerpt']); ?></p>

                <?php foreach ($collaboration['description'] as $paragraph) : ?>
                    <p class="mt-5 text-base leading-8 text-neutral-600"><?php echo esc_html($paragraph); ?></p>
                <?php endforeach; ?>

                <a href="<?php echo esc_url(home_url('/#collaborations')); ?>" class="mt-8 inline-flex rounded-full border border-neutral-900 px-6 py-3 text-xs font-semibold uppercase tracking-[0.2em] transition hover:bg-neutral-900 hover:text-white">Back to collaborations</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>


