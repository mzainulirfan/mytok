<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold">Dashboard</h1>
<div class="mt-6 grid grid-cols-3 gap-4">
    <div class="border border-gray-300 p-4 rounded-lg bg-gray-50">omzet</div>
    <div class="border border-gray-300 p-4 rounded-lg bg-gray-50">procuct</div>
    <div class="border border-gray-300 p-4 rounded-lg bg-gray-50">categories</div>
</div>
<?= $this->endSection(); ?>
