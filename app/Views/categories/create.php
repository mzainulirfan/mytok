<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold">Create Category</h1>
<div class="mt-6 border p-4 py-6 rounded-lg">
    <form action="<?= base_url(); ?>categories/save" method="post" class="w-8/12 space-y-4">
        <div class="flex flex-col space-y-1.5">
            <label for="categoryName">Category Name</label>
            <input type="text" name="categoryName" id="categoryName" placeholder="category name" autofocus class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400">
        </div>
        <div class="flex flex-col space-y-1.5">
            <label for="categoryDescription">Description</label>
            <textarea name="categoryDescription" id="categoryDescription" rows="5" class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400 resize-none"></textarea>
        </div>
        <button class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400" type="submit">Save</button>
    </form>
</div>
<?= $this->endSection(); ?>
