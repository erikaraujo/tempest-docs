<?php
use App\Web\Blog\BlogController;
use App\Web\Documentation\ChapterController;
use App\Web\RedirectsController;

use function Tempest\uri;

?>

<x-base full-title="Tempest, the PHP framework that gets out of your way" :stargazers="$stargazers" body-class="bg-[#f1f7ff]">
  <div class="flex flex-col grow font-display">
    <!-- Falling leaves -->
    <x-falling-leaves class="dark:hidden" />
    <!-- Aurora -->
    <x-aurora class="dark:hidden" />
    <!-- Rain -->
    <x-rain />
    <!-- Moonlight -->
    <x-moonlight />
    <!-- Content -->
    <main class="container mx-auto relative flex flex-col gap-4 grow -mt-(--ui-header-height)" style="tab-size: 2">
      <!-- Hero -->
      <section class="md:h-[85svh] min-h-[75vh] md:pt-24 flex justify-center flex-col tracking-tighter px-6 mt-32 md:mt-0">
        <h1 class="text-4xl md:text-5xl xl:text-6xl leading-none flex flex-col">
          <span>The framework that</span>
          <span class="text-(--ui-primary)">gets out of your way.</span>
        </h1>
        <p class="mt-4 md:mt-6 xl:mt-8 max-w-xl text-xl xl:text-2xl text-(--ui-text-toned)">
            Tempest embraces modern PHP and covers a wide range of features, giving you all the tools you need to focus on your code.
        </p>
        <div class="mt-6 md:mt-8 xl:mt-10 flex gap-x-4 items-center font-medium text-lg">
          <a :href="uri([ChapterController::class, 'index'])" class="bg-(--ui-bg-inverted) text-(--ui-bg) hover:bg-(--ui-bg-inverted)/90 rounded-xl px-6 py-2.5 gap-1.5 transition">
            Get started
          </a>
          <a :href="uri([RedirectsController::class, 'github'])" class="hidden min-[401px]:flex text(--ui-text) hover:bg-(--ui-info)/10 group rounded-xl px-6 py-2.5 items-center gap-x-1.5 transition">
            <x-icon name="tabler:brand-github" class="size-6" />
            Source code
            <svg class="group-hover:translate-x-0 size-5 scale-85 group-hover:scale-100 transition opacity-0 group-hover:opacity-100 -translate-x-full" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 7l5 5l-5 5m6-10l5 5l-5 5" />
            </svg>
          </a>
        </div>
        <button data-copy="#install-tempest-snippet" class="hidden md:flex group mt-6 md:mt-8 xl:mt-10  items-center justify-start gap-x-2 text-base font-mono relative cursor-pointer">
            <x-icon name="tabler:terminal" class="size-5 text-(--ui-primary)" />
            <span id="install-tempest-snippet" class="text-(--ui-text-muted)">composer require tempest/framework:{{ \Tempest\Core\Kernel::VERSION }}</span>
            <span class="ml-4 flex items-center justify-center opacity-0 group-hover:opacity-100 transition text-(--ui-text-dimmed) bg-(--ui-bg-muted) rounded border border-(--ui-border)">
                <x-icon name="tabler:copy" class="size-5 absolute" />
                <x-icon name="tabler:copy-check-filled" class="size-5 absolute opacity-0 group-[[data-copied]]:opacity-100 transition text-(--ui-success)" />
            </span>
        </button>
      </section>
      <!-- Discovery -->
			<x-home-section
				heading="Automatic code discovery"
				:paragraphs="[
					'Tempest scans your code and finds out what to do with it without you having to write a single line of configuration or bootstrap code.',
				]"
				link-label="Discovery"
				:link-uri="uri(ChapterController::class, version: \App\Web\Documentation\Version::default(), category: 'internals', slug: 'discovery')"
				:snippets="['controller', 'view-processor']"
			></x-home-section>
      <!-- Template engine -->
			<x-home-section
				heading="A refreshing new template engine"
				:paragraphs="[
					'Tempest reimagines templating in PHP with a clean front-end engine, inspired by modern front-end frameworks.',
					'Do you prefer something tried and tested? Tempest has built-in support for Blade and Twig as well.',
				]"
				link-label="Templating"
				:link-uri="uri(ChapterController::class, version: \App\Web\Documentation\Version::default(), category: 'framework', slug: 'views')"
				:snippets="['templating-view', 'templating-component']"
			></x-home-section>
      <!-- ORM-->
			<x-home-section
				heading="An ORM that embraces modern PHP"
				:paragraphs="[
					'Define models with simple, clean code.',
					'We don\'t try to reinvent database querying from scratch, so whenever you need a complex query, you can write SQL directly.',
				]"
				link-label="ORM"
				:link-uri="uri(ChapterController::class, version: \App\Web\Documentation\Version::default(), category: 'framework', slug: 'models')"
				:snippets="['model', 'orm']"
			></x-home-section>
      <!-- Much more-->
			<x-home-section
				heading="And much, much more."
				:paragraphs="[
					'Configuration objects for easy autocompletion and injection, a data mapper, a powerful dependency container with autowiring. Tempest is designed to be frictionless.',
				]"
				link-label="Get started"
				:link-uri="uri([ChapterController::class, 'index'])"
				:snippets="['config', 'markdown-initializer']"
			></x-home-section>
    </main>
  </div>
</x-base>
