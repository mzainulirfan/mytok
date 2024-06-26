<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<h1 class="text-2xl font-semibold capitalize">orders</h1>
<div class="mt-6 border p-4 py-6 rounded-lg">
    <?php if (!empty($orders)) : ?>
        <a href="<?= base_url(); ?>orders/create" class="border px-4 py-2 rounded-lg capitalize hover:bg-gray-200 hover:text-slate-900 transition duration-200">Create order</a>
        <div class="relative overflow-x-auto border rounded-lg my-4">
            <table class="w-full text-sm text-left text-gray-500 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Id Order
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Amount
                        </th>
                        <th scope="col" class="px-6 py-3">
                            payment status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            date
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                <a href="<?= base_url(); ?>orders/<?= esc($order['order_id']); ?>/detail" class="hover:underline hover:text-blue-500 transition duration-200">#order<?= esc($order['order_id']); ?></a>
                            </th>
                            <td class="px-6 py-4">
                                <a href="<?= base_url(); ?>users/<?= esc($order['username_user']); ?>/detail/">
                                    <span class="font-semibold text-gray-700"><?= esc($order['fullname_user']); ?></span>
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-gray-700"><?= formatRupiah(esc($order['order_total_amount'])); ?></span>
                            </td>
                            <td class="px-6 py-4">
                                <?php if ($order['order_payment_status'] == 'unpaid') : ?>
                                    <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full capitalize">
                                        <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                                        <?= esc($order['order_payment_status']); ?>
                                    </span>
                                <?php else : ?>
                                    <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full capitalize">
                                        <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                        <?= esc($order['order_payment_status']); ?>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= esc($order['created_at']); ?>
                            </td>
                            <td class="px-6 py-4 flex space-x-2 items-center">
                                <a href="<?= base_url(); ?>orders/<?= esc($order['order_id']); ?>/detail" class="font-medium text-blue-600 hover:underline capitalize">detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <div class="flex flex-col space-y-2 items-center">
            <p>no order found</p>
            <a href="<?= base_url(); ?>orders/create" class="border px-4 py-2 w-max rounded-lg capitalize hover:bg-gray-200 hover:text-slate-900 transition duration-200">Create order</a>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection(); ?>
