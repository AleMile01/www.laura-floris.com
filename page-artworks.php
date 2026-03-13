<?php
/*
Template Name: Artworks
*/
get_header();
?>

<?php
$artwork_groups = laura_floris_get_artwork_groups();
?>

<main class="px-6 pb-16 pt-10 md:px-10 md:pt-8">
    <section class="mx-auto max-w-7xl">
        <div class="mb-8 text-center">
            <p class="mb-3 text-sm text-neutral-500">Artworks</p>
            <h1 class="text-4xl font-black md:text-5xl">Collections</h1>
            <p class="mx-auto mt-4 max-w-2xl text-base leading-8 text-neutral-600">
                Browse the artworks by collection and open each selection to explore the pieces inside.
            </p>
        </div>

        <div class="artwork-collections-grid grid grid-cols-3 items-start gap-3 md:gap-6">
            <?php foreach ($artwork_groups as $slug => $group) : ?>
                <a href="<?php echo esc_url(laura_floris_get_artwork_group_url($slug)); ?>" class="group overflow-hidden rounded-3xl bg-neutral-100 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                    <div class="aspect-[4/5] overflow-hidden">
                        <img
                            src="<?php echo esc_url($group['cover']); ?>"
                            alt="<?php echo esc_attr($group['title']); ?>"
                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                        >
                    </div>

                    <div class="p-3 text-center md:p-6">
                        <h2 class="text-xs font-semibold uppercase leading-tight md:text-lg"><?php echo esc_html($group['title']); ?></h2>
                        <p class="mt-2 hidden text-sm leading-7 text-neutral-600 md:block"><?php echo esc_html($group['description']); ?></p>
                        <span class="mt-3 inline-flex text-[10px] uppercase tracking-[0.18em] text-neutral-500 md:mt-5 md:text-xs md:tracking-[0.2em]">View collection</span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
