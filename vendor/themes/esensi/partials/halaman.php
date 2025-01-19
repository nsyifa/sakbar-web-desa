<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php $post = $single_halaman ?>

<nav role="navigation" aria-label="navigation" class="breadcrumb">
    <ol>
        <li><a href="<?= site_url() ?>">Beranda</a></li>
        <li><?= '<a href="' . site_url("halaman/{$post['slug']}") . '">' . $post['judul'] . '</a>' ?></li>
    </ol>
</nav>

<article>
    <h1 class="text-h1 text-center mt-6">
        <?= $post['judul'] ?>
    </h1>

    <span class="inline-flex flex-wrap gap-x-3 gap-y-2 text-xs lg:text-sm py-2 text-accent-200">
    </span>
</article>

<div class="content space-y-2 py-4">
    <?= $post['isi'] ?>
</div>