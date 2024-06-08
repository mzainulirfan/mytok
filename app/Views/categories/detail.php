<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold capitalize"><?= $category['category_name']; ?></h1>
<div class="mt-6 border p-4 py-6 rounded-lg">
  <?php if (!empty($relatedCategory)) : ?>
    <a href="<?= base_url(); ?>categories" class="border px-4 py-2 rounded-lg capitalize hover:bg-gray-200 hover:text-slate-900 transition duration-200">back to category</a>
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
          <?php foreach ($relatedCategory as $related) : ?>
            <tr class="bg-white border-b hover:bg-gray-50">
              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap w-10/12">
                <a href="<?= base_url(); ?>product/<?= esc($related['product_slug']); ?>/detail"><?= esc($related['product_name']); ?></a>
              </th>
              <td class="px-6 py-4 text-center">
                <a href="<?= base_url(); ?>product/<?= esc($related['product_slug']); ?>/detail" class=" font-medium text-blue-600 hover:underline">detail</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php else : ?>
    <div class="text-center">
      <p class="mb-4">No product found</p>
      <a href="<?= base_url(); ?>categories" class="border px-4 py-2 rounded-lg capitalize">back to category</a>
    </div>
  <?php endif ?>
</div>
<?= $this->endSection(); ?>