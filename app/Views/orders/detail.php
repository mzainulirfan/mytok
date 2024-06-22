<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold capitalize">Detail : #order <?= esc($order['order_id']); ?></h1>
<a href="<?= base_url(); ?>orders" class="inline-flex items-center space-x-1 my-3 capitalize hover:text-blue-500 transition duration-200">
    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M18 17L13 12L18 7M11 17L6 12L11 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
    <span>back to orders</span>
</a>
<div class="mt-3 border p-4 py-6 rounded-lg">
    Billed to :
    <h3 class="font-semibold mb-1">Address</h3>
    <div class="flex flex-col space-y-2">
        <h5 class="font-semibold">Nahla Aufa <span class="text-gray-400 text-base">08499494949</span></h5>
        <p class="text-sm text-gray-400">kp sukamanah no 41 desa bojongkunci kec pameungpeuk kab bandung jawa barat</p>
        <p class="text-sm text-gray-400">8393939</p>
    </div>
    <p>product list</p>

    <div class="relative overflow-x-auto border rounded-lg my-4">
        <table class="w-full text-sm text-left text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Product Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3 text-end">
                        Qty
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderItems as $item) : ?>
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            <a href="" class="hover:underline hover:text-blue-500 transition duration-200"><?= $item['product_name']; ?></a>
                        </th>
                        <td class="px-6 py-4">
                            <span class="font-semibold text-gray-700"><?= formatRupiah($item['product_price']); ?></span>
                        </td>
                        <td class="px-6 py-4 flex items-center space-x-2 justify-end">
                            <span class="font-semibold text-gray-700"><?= $item['item_order_qty']; ?></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr class="font-semibold text-gray-900">
                    <th scope="row" class="px-6 py-3 text-base">&nbsp;</th>
                    <td class="px-6 py-3"><?= esc(formatRupiah($order['order_total_amount'])); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>
