<?php
/*
Template Name: About
*/
get_header();
?>

<main class="px-6 pb-16 pt-10 md:px-10 md:pt-8">
    <section class="mx-auto max-w-7xl">
        <div class="mb-8 text-center">
            <p class="notranslate mb-3 text-sm text-neutral-500" translate="no">About</p>
            <h1 class="text-4xl font-black md:text-5xl">About the artist</h1>
        </div>

        <div class="grid items-start gap-8 md:grid-cols-[minmax(0,18rem)_minmax(0,1fr)] md:gap-10">
            <div class="group overflow-hidden rounded-3xl bg-neutral-100 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-xl">
                <div class="aspect-[4/5] overflow-hidden">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/laurafoto.webp'); ?>"
                        alt="Laura Floris"
                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                    >
                </div>

                <div class="p-5 text-center">
                    <h2 class="text-lg font-semibold">Laura Floris</h2>
                    <p class="mt-2 text-sm text-neutral-600">Digital artist</p>

                    <div class="mt-6 flex justify-center gap-4">
                        <a href="https://www.instagram.com/laurafloris" target="_blank" rel="noreferrer" class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-neutral-900 text-white shadow-lg transition hover:-translate-y-1 hover:bg-neutral-700" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5"></rect>
                                <circle cx="12" cy="12" r="4"></circle>
                                <circle cx="17.5" cy="6.5" r="1"></circle>
                            </svg>
                        </a>

                        <a href="mailto:laflorisart@gmail.com" class="inline-flex h-14 w-14 items-center justify-center rounded-full border border-neutral-900 bg-white text-neutral-900 shadow-lg transition hover:-translate-y-1 hover:bg-neutral-900 hover:text-white" aria-label="Email">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="self-start rounded-3xl border border-neutral-200 bg-neutral-50 p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg md:p-8">
                <h2 class="mb-5 text-2xl font-semibold">Laura Floris</h2>
                <p class="text-neutral-600 leading-7">
                    Laura Floris de Las Casas, artistically known as La Floris, is an illustrator who has created a visual universe where color is the true protagonist. Born in Madrid and raised in Imperia, Italy, she studied Fashion at IED Madrid, beginning a creative path that led her to work on television productions such as Zapeando, El Intermedio, and in the costume department of La Catedral del Mar.
                </p>
                <p class="mt-5 text-neutral-600 leading-7">
                    Her journey took a new direction with the discovery of digital illustration, where she developed a vibrant and recognizable style filled with references to fashion, cinema, and pop culture. She has worked for clients such as El Pais, Eme21 Magazine, Madrid's illustrated cultural magazine, Elle Italia, Citroen, and Desigual.
                </p>
                <p class="mt-4 text-neutral-600 leading-7">
                    Among her most notable projects is the writing and illustration of Lady Gaga's biography for the publisher Lunwerg, part of Grupo Planeta.
                </p>
                <p class="mt-4 text-neutral-600 leading-7">
                    After years focused on portraits and human figures, since 2024 cities have become her new muses. Madrid was the starting point of a project that expands to different cities around the world in 2025, reinterpreting urban landscapes through an explosive palette and transforming them into scenes full of life, energy, and personality.
                </p>
            </div>
        </div>

        <?php
        $press_mentions = array(
            array(
                'title' => 'Metal Magazine',
                'url'   => 'https://metalmagazine.eu/es/post/laura-floris',
                'image' => 'https://www.google.com/s2/favicons?sz=256&domain_url=https://metalmagazine.eu',
            ),
            array(
                'title' => 'Vogue Spain',
                'url'   => 'https://www.vogue.es/living/galerias/arte-para-todos-los-bolsillos-tiendas-digitales-obra-grafica',
                'image' => 'https://www.google.com/s2/favicons?sz=256&domain_url=https://www.vogue.es',
            ),
            array(
                'title' => 'EL PAIS',
                'url'   => 'https://elpais.com/elviajero/2020/12/27/actualidad/1609092667_507599.html',
                'image' => 'https://www.google.com/s2/favicons?sz=256&domain_url=https://elpais.com',
            ),
            array(
                'title' => 'Shit Magazine',
                'url'   => 'https://shitmagazine.es/laura-floris/',
                'image' => 'https://www.google.com/s2/favicons?sz=256&domain_url=https://shitmagazine.es',
            ),
            array(
                'title' => 'Kluid Magazine',
                'url'   => 'https://kluidmagazine.com/laura-floris/',
                'image' => 'https://www.google.com/s2/favicons?sz=256&domain_url=https://kluidmagazine.com',
            ),
            array(
                'title' => 'Vanidad',
                'url'   => '',
                'image' => 'https://www.google.com/s2/favicons?sz=256&domain_url=https://vanidad.es',
            ),
        );
        ?>

        <section class="mt-16 border-t border-neutral-200 pt-16">
            <div class="mx-auto max-w-7xl">
                <div class="mb-10 max-w-2xl">
                    <p class="mb-3 text-xs font-semibold uppercase tracking-[0.35em] text-neutral-500">Press</p>
                    <h2 class="text-3xl font-black uppercase md:text-4xl">Featured in magazines</h2>
                </div>

                <div class="grid items-start grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    <?php foreach ($press_mentions as $mention) : ?>
                        <?php if (!empty($mention['url'])) : ?>
                            <a href="<?php echo esc_url($mention['url']); ?>" target="_blank" rel="noreferrer" class="group self-start overflow-hidden rounded-3xl border border-neutral-200 bg-white shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">
                                <div class="flex aspect-[16/10] items-center justify-center bg-neutral-100 p-6">
                                    <img
                                        src="<?php echo esc_url($mention['image']); ?>"
                                        alt="<?php echo esc_attr($mention['title']); ?>"
                                        class="h-20 w-20 rounded-2xl object-contain shadow-sm transition duration-300 group-hover:scale-105"
                                        loading="lazy"
                                    >
                                </div>
                                <div class="flex flex-col p-8">
                                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-neutral-500">Magazine</p>
                                    <h3 class="mt-4 text-2xl font-bold uppercase leading-tight"><?php echo esc_html($mention['title']); ?></h3>
                                    <span class="mt-5 text-sm uppercase tracking-[0.2em] text-neutral-500 transition group-hover:text-neutral-900">Open article</span>
                                </div>
                            </a>
                        <?php else : ?>
                            <div class="self-start overflow-hidden rounded-3xl border border-neutral-200 bg-neutral-50 shadow-sm">
                                <div class="flex aspect-[16/10] items-center justify-center bg-neutral-100 p-6">
                                    <img
                                        src="<?php echo esc_url($mention['image']); ?>"
                                        alt="<?php echo esc_attr($mention['title']); ?>"
                                        class="h-20 w-20 rounded-2xl object-contain shadow-sm"
                                        loading="lazy"
                                    >
                                </div>
                                <div class="flex flex-col p-8">
                                    <p class="text-xs font-semibold uppercase tracking-[0.3em] text-neutral-500">Magazine</p>
                                    <h3 class="mt-4 text-2xl font-bold uppercase leading-tight"><?php echo esc_html($mention['title']); ?></h3>
                                    <span class="mt-5 text-sm uppercase tracking-[0.2em] text-neutral-400">Featured mention</span>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </section>
</main>

<?php get_footer(); ?>

