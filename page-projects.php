<?php get_header(); ?>

<?php
$projects = laura_floris_get_collaborations();
?>

<main class="px-6 pb-16 pt-10 md:px-10 md:pt-8">
    <section class="mx-auto max-w-7xl">
        <div class="mb-8 max-w-3xl">
            <p class="mb-3 text-sm text-neutral-500">Projects</p>
            <h1 class="text-4xl font-black uppercase md:text-5xl">Selected Projects</h1>
            <p class="mt-4 text-base leading-8 text-neutral-600">
                Explore a curated selection of visual projects spanning fashion, editorial storytelling and entertainment.
            </p>
        </div>

        <div class="project-overview-grid grid grid-cols-1 gap-4 md:grid-cols-3 md:gap-6">
            <?php foreach ($projects as $slug => $project) : ?>
                <article class="project-overview-card flex h-full flex-col overflow-hidden rounded-[2rem] border border-neutral-200 bg-neutral-50 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                    <div class="project-overview-card__media aspect-[4/5] overflow-hidden bg-neutral-100">
                        <img
                            src="<?php echo esc_url($project['image']); ?>"
                            alt="<?php echo esc_attr($project['title']); ?>"
                            class="h-full w-full object-cover transition duration-500 hover:scale-105"
                        >
                    </div>

                    <div class="project-overview-card__content flex grow flex-col p-5 md:p-7">
                        <p class="mb-2 text-[10px] font-semibold uppercase tracking-[0.3em] text-neutral-500 md:mb-3 md:text-xs">Project</p>
                        <h2 class="text-lg font-bold uppercase leading-tight md:text-2xl"><?php echo esc_html($project['title']); ?></h2>
                        <p class="mt-3 text-sm leading-6 text-neutral-600 md:mt-4 md:leading-7"><?php echo esc_html($project['excerpt']); ?></p>
                        <a href="<?php echo esc_url(laura_floris_get_collaboration_url($slug)); ?>" class="mt-4 inline-flex w-fit rounded-full border border-neutral-900 px-4 py-2 text-[10px] font-semibold uppercase tracking-[0.2em] transition hover:bg-neutral-900 hover:text-white md:mt-auto md:px-5 md:py-3 md:text-xs">Open project</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
