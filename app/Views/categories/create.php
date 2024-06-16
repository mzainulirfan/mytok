<?= $this->extend('layout');
?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold">Create Category</h1>
<div class="mt-6 border p-4 py-6 rounded-lg">
    <form action="<?= base_url(); ?>categories/save" method="post" class="w-8/12 space-y-4">
        <?= csrf_field() ?>
        <div class="flex flex-col space-y-1.5">
            <label for="categoryName">Category Name</label>
            <input type="text" name="categoryName" id="categoryName" value="<?= esc(old('categoryName')); ?>" placeholder="category name" autofocus class="border p-2 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('categoryName')) ? 'invalid' : 'form-control' ?>">
            <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('categoryName')) : ?>
                <div class=" text-red-500 text-xs">
                    <?= $validation->getError('categoryName'); ?>
                </div>
            <?php endif ?>
        </div>
        <div class="flex flex-col space-y-1.5">
            <label for="categoryDescription">Description</label>
            <textarea name="categoryDescription" id="categoryDescription" rows="5" class="border p-2 rounded-lg outline-none resize-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('categoryDescription')) ? 'invalid' : 'form-control' ?>"><?= esc(old('categoryDescription')); ?></textarea>
            <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('categoryDescription')) : ?>
                <div class=" text-red-500 text-xs">
                    <?= $validation->getError('categoryDescription'); ?>
                </div>
            <?php endif ?>
        </div>
        <button class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400 hover:bg-gray-200 hover:text-slate-900 transition duration-200" type="submit">Save</button>
    </form>
</div>
<?= $this->endSection(); ?>
