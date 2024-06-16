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
        <button data-modal-target="create-modal" data-modal-toggle="create-modal" class="inline border px-4 py-2 rounded-lg capitalize hover:bg-gray-200 hover:text-slate-900 transition duration-200" type="button">
            Create Category
        </button>
        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="border border-red-300 bg-red-200/25 text-green-700 p-4 rounded-lg my-4" role="alert">
                <?= session()->getFlashdata('errors'); ?>
            </div>
        <?php endif; ?>
        <div class="relative overflow-x-auto border rounded-lg my-4">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 w-10/12">
                            Category name
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            &nbsp;
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
                                <button type="button" id="btnEdit" data-modal-target="edit-modal" data-modal-toggle="edit-modal" data-categoryid="<?= esc($category['category_id']); ?>" data-categoryname="<?= esc($category['category_name']); ?>" data-categorydescription="<?= esc($category['category_description']); ?>" class="font-medium capitalize text-blue-600 hover:underline">ubah</button>
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
                <span class="text-sm font-normal text-gray-500 mb-4 block w-full md:inline md:w-auto">Total Product <span class="font-semibold text-gray-900 border p-2 rounded-lg bg-gray-100"><?= $categoriesCount; ?></span></span>
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
            <button data-modal-target="create-modal" data-modal-toggle="create-modal" class="border px-4 py-2 rounded-lg capitalize hover:bg-gray-200 hover:text-slate-900 transition duration-200" type="button">
                Create Category
            </button>
        </div>
    <?php endif ?>
</div>
<?php if (!empty($categories)) : ?>
    <!-- edit modal -->
    <div id="edit-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900 capitalize">
                        Edit <span id="categoryNameLabel"></span>
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="<?= base_url(); ?>categories/update/<?= esc($category['category_id']); ?>" method="post" class="p-5">
                    <?= csrf_field() ?>
                    <input type="hidden" name="categoryId" id="categoryId" value="<?= esc($category['category_id']); ?>">
                    <div class="flex flex-col space-y-1.5 mb-3">
                        <label for="categoryName">Category Name</label>
                        <input type="text" name="categoryName" id="categoryName" value="<?= esc(old('categoryName')); ?>" placeholder="category name" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('categoryName')) ? 'invalid' : 'form-control' ?>">
                        <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('categoryName')) : ?>
                            <div class=" text-red-500 text-xs">
                                <?= $validation->getError('categoryName'); ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="flex flex-col space-y-1.5 mb-3">
                        <label for="categoryDescription">Description</label>
                        <textarea name="categoryDescription" id="categoryDescription" placeholder="enter description" rows="5" class="border p-2 border-gray-300 rounded-lg outline-none resize-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('categoryDescription')) ? 'invalid' : 'form-control' ?>"><?= esc(old('categoryDescription')); ?></textarea>
                        <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('categoryDescription')) : ?>
                            <div class=" text-red-500 text-xs">
                                <?= $validation->getError('categoryDescription'); ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <button class="border p-2 rounded-lg outline-none capitalize focus:ring focus:ring-gray-400 hover:bg-gray-200 hover:text-slate-900 transition duration-200" type="submit">update</button>
                </form>
            </div>
        </div>
    </div>
<?php endif ?>
<!-- create modal -->
<div id="create-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900 capitalize">
                    Create new category
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="create-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?= base_url(); ?>categories/save" method="post" class="p-5">
                <?= csrf_field() ?>
                <div class="flex flex-col space-y-1.5 mb-3">
                    <label for="categoryName">Category Name</label>
                    <input type="text" name="categoryName" id="categoryName" value="<?= esc(old('categoryName')); ?>" placeholder="category name" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('categoryName')) ? 'invalid' : 'form-control' ?>">
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('categoryName')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('categoryName'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="flex flex-col space-y-1.5 mb-3">
                    <label for="categoryDescription">Description</label>
                    <textarea name="categoryDescription" id="categoryDescription" placeholder="enter description" rows="5" class="border p-2 border-gray-300 rounded-lg outline-none resize-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('categoryDescription')) ? 'invalid' : 'form-control' ?>"><?= esc(old('categoryDescription')); ?></textarea>
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('categoryDescription')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('categoryDescription'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <button class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400 hover:bg-gray-200 hover:text-slate-900 transition duration-200" type="submit">Save</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
