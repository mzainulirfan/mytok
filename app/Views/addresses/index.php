<?= $this->extend('users/detail'); ?>
<?= $this->section('userContent'); ?>
<?php if (!empty($addresses)) : ?>
    <button data-modal-target="create-address-modal" data-modal-toggle="create-address-modal" type="button" class="mb-3 border px-4 py-1 rounded-lg">add new address</button>
    <div class="border-b pb-4"></div>
    <?php foreach ($addresses as $address) : ?>
        <div class="border-b py-4 flex items-start justify-between">
            <div class="flex flex-col space-y-2">
                <p class="flex items-center space-x-4">
                    <span class="capitalize"><?= $address['address_name']; ?></span>
                    <span class="inline-block w-[1px] h-6 bg-gray-300"></span>
                    <span class="text-gray-500"><?= $address['address_phone']; ?></span>
                </p>
                <p class="text-gray-500 font-light text-sm"><?= $address['address_line'] . ' - ' . $address['address_kecamatan'] . ' - ' . $address['address_kabupaten'] . ' - ' . $address['address_province'] . ' - ' . $address['address_postal_code']; ?></p>
            </div>
            <div class="flex flex-col gap-2 items-end">
                <?php if (!$address['address_is_main']) : ?>
                    <form action="<?= base_url(); ?>addresses/<?= $address['address_id']; ?>/asigntomain" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="userId" value="<?= $user['user_id']; ?>">
                        <input type="hidden" name="usernameUser" value="<?= $user['username_user']; ?>">
                        <button type="submit" class="px-4 py-1 border rounded-lg text-nowrap antialiased">make main</button>
                    </form>
                <?php else : ?>
                    <button class="px-4 py-1 border rounded-lg text-nowrap antialiased bg-gray-300 text-gray-400" disabled>make main</button>
                <?php endif ?>
                <div class="flex items-center space-x-3">
                    <button type="button" id="btnEditAddress" data-modal-target="edit-address-modal" data-modal-toggle="edit-address-modal" data-addressid="<?= $address['address_id']; ?>" data-addressname=" <?= $address['address_name']; ?>" data-addressline="<?= $address['address_line']; ?>" data-addressphone="<?= $address['address_phone']; ?>" data-addresskec="<?= $address['address_kecamatan']; ?>" data-addresskab="<?= $address['address_kabupaten']; ?>" data-addressprov="<?= $address['address_province']; ?>" data-addresspostal="<?= $address['address_postal_code']; ?>" class="hover:text-orange-400 transition duration-200 capitalize">edit</button>
                    <?php if (!$address['address_is_main']) : ?>
                        <form action="<?= base_url(); ?>addresses/<?= $address['address_id']; ?>" method="post">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="usernameUser" value="<?= $user['username_user']; ?>">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="hover:text-red-500 transition duration-200 capitalize" type="submit">Delete</button>
                        </form>
                    <?php else : ?>
                        <button class="hover:text-red-300 transition duration-200 capitalize" type="button" disabled>Delete</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <div class="flex flex-col items-center space-y-2">
        <p>no data found!</p>
        <button data-modal-target="create-address-modal" data-modal-toggle="create-address-modal" type="button" class="mb-4 border px-4 py-1 rounded-lg">add new address</button>
    </div>
<?php endif; ?>

<!-- edit address modal -->
<div id="edit-address-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow ">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900 capitalize">
                    edit address : <span id="nameLabel" class="underline"></span>
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-address-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?= base_url(); ?>addresses/<?= $address['address_id']; ?>/edit" method="post" class="p-5">
                <?= csrf_field() ?>
                <input type="hidden" name="usernameUser" value="<?= $user['username_user']; ?>">
                <input type="hidden" name="currentAddressId" id="currentAddressId">
                <input type="hidden" name="sessionUserId" value="<?= session()->get('user_id'); ?>">
                <div class="flex flex-col space-y-1.5 mb-3">
                    <label for="addressName">Fullname</label>
                    <input type="text" name="addressName" id="addressName" value="<?= esc(old('addressName')); ?>" placeholder="fullname" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('addressName')) ? 'invalid' : 'form-control' ?>">
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('addressName')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('addressName'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="flex flex-col space-y-1.5 mb-3">
                    <label for="addressPhone">Phone</label>
                    <input type="text" name="addressPhone" id="addressPhone" value="<?= esc(old('addressPhone')); ?>" placeholder="phone" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('addressPhone')) ? 'invalid' : 'form-control' ?>">
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('addressPhone')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('addressPhone'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="flex flex-col space-y-1.5 mb-3">
                    <label for="addressLine">Address Line</label>
                    <textarea name="addressLine" id="addressLine" rows="5" placeholder="Write your thoughts here..." class="border p-2 rounded-lg outline-none resize-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('addressLine')) ? 'invalid' : 'form-control' ?>"><?= esc(old('addressLine')); ?></textarea>
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('addressLine')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('addressLine'); ?>
                        </div>
                    <?php endif ?>
                </div>

                <div class="flex items-center justify-between space-x-2 mb-3">
                    <div class="flex flex-col space-y-1.5 w-5/12">
                        <label for="addressKecamatan">Kecamatan</label>
                        <input type="text" name="addressKecamatan" id="addressKecamatan" value="<?= esc(old('addressKecamatan')); ?>" placeholder="Kecamatan" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('addressKecamatan')) ? 'invalid' : 'form-control' ?>">
                        <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('addressKecamatan')) : ?>
                            <div class=" text-red-500 text-xs">
                                <?= $validation->getError('addressKecamatan'); ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="flex flex-col space-y-1.5 flex-1">
                        <label for="addressKabupaten">Kabupaten</label>
                        <input type="text" name="addressKabupaten" id="addressKabupaten" value="<?= esc(old('addressKabupaten')); ?>" placeholder="Kabupaten" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('addressKabupaten')) ? 'invalid' : 'form-control' ?>">
                        <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('addressKabupaten')) : ?>
                            <div class=" text-red-500 text-xs">
                                <?= $validation->getError('addressKabupaten'); ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="flex flex-col space-y-1.5 mb-3">
                    <label for="addressProvency">Provency</label>
                    <input type="text" name="addressProvency" id="addressProvency" value="<?= esc(old('addressProvency')); ?>" placeholder="Provency" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('addressProvency')) ? 'invalid' : 'form-control' ?>">
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('addressProvency')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('addressProvency'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="flex flex-col space-y-1.5 mb-3">
                    <label for="addressPostalCode">Postal Code</label>
                    <input type="text" name="addressPostalCode" id="addressPostalCode" value="<?= esc(old('addressPostalCode')); ?>" placeholder="Postal Code" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('addressPostalCode')) ? 'invalid' : 'form-control' ?>">
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('addressPostalCode')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('addressPostalCode'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <button class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400 hover:bg-gray-200 hover:text-slate-900 transition duration-200" type="submit">Save</button>
            </form>
        </div>
    </div>
</div>
<!-- create modal -->
<div id="create-address-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-lg max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900 capitalize">
                    add new address
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="create-address-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="<?= base_url(); ?>addresses/save" method="post" class="p-5">
                <?= csrf_field() ?>
                <input type="hidden" name="usernameUser" value="<?= $user['username_user']; ?>">
                <div class="flex flex-col space-y-1.5 mb-3">
                    <label for="addressName">Fullname</label>
                    <input type="text" name="addressName" id="addressName" value="<?= esc(old('addressName')); ?>" placeholder="fullname" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('addressName')) ? 'invalid' : 'form-control' ?>">
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('addressName')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('addressName'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="flex flex-col space-y-1.5 mb-3">
                    <label for="addressPhone">Phone</label>
                    <input type="text" name="addressPhone" id="addressPhone" value="<?= esc(old('addressPhone')); ?>" placeholder="phone" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('addressPhone')) ? 'invalid' : 'form-control' ?>">
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('addressPhone')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('addressPhone'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="flex flex-col space-y-1.5 mb-3">
                    <label for="addressLine">Address Line</label>
                    <textarea name="addressLine" id="addressLine" rows="5" placeholder="Write your thoughts here..." class="border p-2 rounded-lg outline-none resize-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('addressLine')) ? 'invalid' : 'form-control' ?>"><?= esc(old('addressLine')); ?></textarea>
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('addressLine')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('addressLine'); ?>
                        </div>
                    <?php endif ?>
                </div>

                <div class="flex items-center justify-between space-x-2 mb-3">
                    <div class="flex flex-col space-y-1.5 w-5/12">
                        <label for="addressKecamatan">Kecamatan</label>
                        <input type="text" name="addressKecamatan" id="addressKecamatan" value="<?= esc(old('addressKecamatan')); ?>" placeholder="Kecamatan" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('addressKecamatan')) ? 'invalid' : 'form-control' ?>">
                        <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('addressKecamatan')) : ?>
                            <div class=" text-red-500 text-xs">
                                <?= $validation->getError('addressKecamatan'); ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="flex flex-col space-y-1.5 flex-1">
                        <label for="addressKabupaten">Kabupaten</label>
                        <input type="text" name="addressKabupaten" id="addressKabupaten" value="<?= esc(old('addressKabupaten')); ?>" placeholder="Kabupaten" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('addressKabupaten')) ? 'invalid' : 'form-control' ?>">
                        <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('addressKabupaten')) : ?>
                            <div class=" text-red-500 text-xs">
                                <?= $validation->getError('addressKabupaten'); ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
                <div class="flex flex-col space-y-1.5 mb-3">
                    <label for="addressProvency">Provency</label>
                    <input type="text" name="addressProvency" id="addressProvency" value="<?= esc(old('addressProvency')); ?>" placeholder="Provency" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('addressProvency')) ? 'invalid' : 'form-control' ?>">
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('addressProvency')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('addressProvency'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="flex flex-col space-y-1.5 mb-3">
                    <label for="addressPostalCode">Postal Code</label>
                    <input type="text" name="addressPostalCode" id="addressPostalCode" value="<?= esc(old('addressPostalCode')); ?>" placeholder="Postal Code" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('addressPostalCode')) ? 'invalid' : 'form-control' ?>">
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('addressPostalCode')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('addressPostalCode'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <button class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400 hover:bg-gray-200 hover:text-slate-900 transition duration-200" type="submit">Save</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>