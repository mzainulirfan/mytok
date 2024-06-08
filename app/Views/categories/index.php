<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold capitalize">categories</h1>
<?php if (session()->getFlashdata('success')) : ?>
    <div class="border border-green-300 bg-green-200/25 text-green-700 p-4 rounded-lg my-4" role="alert">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>

<div class="mt-6 border p-4 py-6 rounded-lg">
    <?php if (!empty($categories)) : ?>
        <a href="<?= base_url(); ?>product" class="border px-4 py-2 rounded-lg capitalize hover:bg-gray-200 hover:text-slate-900 transition duration-200">products</a>
        <a href="<?= base_url(); ?>categories/create" class="border px-4 py-2 rounded-lg capitalize hover:bg-gray-200 hover:text-slate-900 transition duration-200">create category</a>
        <div class="relative overflow-x-auto border rounded-lg my-4">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-10/12">
                            Category name
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category) : ?>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap w-10/12">
                                <a href="<?= base_url(); ?>categories/<?= esc($category['category_slug']); ?>/detail"><?= esc($category['category_name']); ?></a>
                            </th>
                            <td class="px-6 py-4 text-center flex items-center space-x-2">
                                <a href="<?= base_url(); ?>categories/<?= esc($category['category_slug']); ?>/edit" class=" font-medium text-blue-600 hover:underline">Edit</a>
                                <form action="<?= base_url(); ?>categories/<?= esc($category['category_id']); ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" title="delete" onclick="return confirm('Apakah yakin data <?= esc($category['category_name']); ?> mau dihapus?')" class="font-medium text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <nav class="flex items-center flex-column flex-wrap justify-between p-4" aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 mb-4 block w-full md:inline md:w-auto">Total Product <span class="font-semibold text-gray-900"><?= $categoriesCount; ?></span></span>
                <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">Previous</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">1</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">2</a>
                    </li>
                    <li>
                        <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700">3</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">4</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">5</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    <?php else : ?>
        <div class="text-center">
            <p class="mb-4">No category found</p>
            <a href="<?= base_url(); ?>categories/create" class="border px-4 py-2 rounded-lg capitalize">Create category</a>
        </div>
    <?php endif ?>
</div>
<?= $this->endSection(); ?>