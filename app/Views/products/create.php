<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold">Create Product</h1>
<div class="mt-6 p-6 rounded-lg">
    <div class="w-8/12 mx-auto">
        <a href="<?= base_url(); ?>product" class="inline-flex items-center space-x-1 mb-3 capitalize hover:text-blue-500 transition duration-200">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 17L13 12L18 7M11 17L6 12L11 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span>back to product</span>
        </a>
        <form action="<?= base_url(); ?>product/save" method="post" class="space-y-4 border p-8 rounded-lg shadow-2xl">
            <?= csrf_field() ?>
            <div class="flex flex-col space-y-1.5">
                <label for="productName">Product Name</label>
                <input type="text" value="<?= esc(old('productName')); ?>" name="productName" id="productName" placeholder="product name" class="border p-2 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('productName')) ? 'invalid' : 'form-control' ?>">
                <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('productName')) : ?>
                    <div class=" text-red-500 text-xs">
                        <?= $validation->getError('productName'); ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="flex flex-col space-y-1.5">
                <label for="productCategory">Category</label>
                <select name="productCategory" id="productCategory" class="border p-2 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('productCategory')) ? 'invalid' : 'form-control' ?>">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= esc($category['category_id']); ?>" <?= (old('productCategory') == $category['category_id']) ? 'selected' : ''; ?> class="capitalize"><?= esc($category['category_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex flex-col space-y-1.5">
                <label for="productDescription">Description</label>
                <textarea name="productDescription" id="productDescription" rows="5" placeholder="Write your thoughts here..." class="border p-2 rounded-lg outline-none resize-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('productDescription')) ? 'invalid' : 'form-control' ?>"><?= esc(old('productDescription')); ?></textarea>
                <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('productDescription')) : ?>
                    <div class=" text-red-500 text-xs">
                        <?= $validation->getError('productDescription'); ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="flex flex-col space-y-1.5">
                <label for="productPrice">Price</label>
                <input type="text" value="<?= esc(old('productPrice')); ?>" name="productPrice" id="productPrice" placeholder="product price" class="border p-2 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('productPrice')) ? 'invalid' : 'form-control' ?>">
                <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('productPrice')) : ?>
                    <div class=" text-red-500 text-xs">
                        <?= $validation->getError('productPrice'); ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="flex flex-col space-y-1.5">
                <label for="productStock">Stock</label>
                <input type="text" value="<?= esc(old('productStock')); ?>" name="productStock" id="productStock" placeholder="product Stock" class="border p-2 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('productStock')) ? 'invalid' : 'form-control' ?>">
                <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('productStock')) : ?>
                    <div class=" text-red-500 text-xs">
                        <?= $validation->getError('productStock'); ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="isActive" id="isActive" class="rounded" checked>
                <label for="isActive">
                    Publish this product?
                </label>
            </div>
            <button class="border p-2 rounded-lg outline-none form-control hover:bg-gray-200 hover:text-slate-900 transition duration-200" type="submit">Save</button>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>
