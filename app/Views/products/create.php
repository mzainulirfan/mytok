<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold">Create Product</h1>
<div class="mt-6 border p-6 rounded-lg">
    <form action="<?= base_url(); ?>product/save" method="post" class="w-8/12 space-y-4">
        <div class="flex flex-col space-y-1.5">
            <label for="productName">Product Name</label>
            <input type="text" name="productName" id="productName" placeholder="product name" autofocus class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400">
        </div>
        <div class="flex flex-col space-y-1.5">
            <label for="productCategory">Category</label>
            <select name="productCategory" id="productCategory" class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= esc($category['category_id']); ?>"><?= esc($category['category_name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="flex flex-col space-y-1.5">
            <label for="productDescription">Description</label>
            <textarea name="productDescription" id="productDescription" rows="5" class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400 resize-none"></textarea>
        </div>
        <div class="flex flex-col space-y-1.5">
            <label for="productPrice">Price</label>
            <input type="text" name="productPrice" id="productPrice" placeholder="product price" class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400">
        </div>
        <div class="flex flex-col space-y-1.5">
            <label for="productStock">Stock</label>
            <input type="text" name="productStock" id="productStock" placeholder="product Stock" class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400">
        </div>
        <button class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400" type="submit">Save</button>
    </form>
</div>
<?= $this->endSection(); ?>
