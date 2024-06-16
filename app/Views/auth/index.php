<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url(); ?>dist/css/style.css">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>dist/img/logo.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <title><?= isset($title) ? $title . ' | ' : ''; ?> myTok</title>
</head>

<body class="font-inter text-slate-900">
    <div class="flex items-center justify-center w-full h-screen bg-gray-100/65">
        <div class="border p-6 rounded-lg shadow-xl bg-white w-5/12">
            <h4 class="mb-6 text-center text-3xl">Login</h4>
            <?php if (session()->getFlashdata('errors')) : ?>
                <div class="border border-red-300 bg-red-200/25 text-red-700 p-4 rounded-lg my-4" role="alert">
                    <?= session()->getFlashdata('errors'); ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="border border-red-300 bg-red-200/25 text-red-700 p-4 rounded-lg my-4" role="alert">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url(); ?>auth/login" method="post" class="space-y-2 px-6 py-4 w-full">
                <?= csrf_field() ?>
                <div class="flex flex-col space-y-1.5">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?= esc(old('username')); ?>" placeholder="username" autofocus class="border border-gray-300 p-2 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('username')) ? 'invalid' : 'form-control' ?>">
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('username')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('username'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="flex flex-col space-y-1.5">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="<?= esc(old('password')); ?>" placeholder="password" class="border border-gray-300 p-2 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('password')) ? 'invalid' : 'form-control' ?>">
                    <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('password')) : ?>
                        <div class=" text-red-500 text-xs">
                            <?= $validation->getError('password'); ?>
                        </div>
                    <?php endif ?>
                </div>
                <div>
                    <button class="border border-gray-300 px-4 py-2 rounded-lg capitalize hover:bg-gray-200 hover:text-slate-900 transition duration-200 outline-none focus:ring-blue-500 focus:ring-2" type="submit">Login</button>
                    <button type="button" data-modal-target="create-modal" data-modal-toggle="create-modal" class="block mt-4 capitalize text-gray-500 hover:text-blue-500 transition duration-200">Register new user?</button>
                </div>
            </form>
        </div>
    </div>

    <!-- create modal -->
    <div id="create-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between px-12 py-6 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900 capitalize">
                        Create new user
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="create-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="<?= base_url(); ?>register/save" method="post" class="px-12 py-6">
                    <?= csrf_field() ?>
                    <div class="flex flex-col space-y-1.5 mb-3">
                        <label for="fullnameUser">Fullname</label>
                        <input type="text" name="fullnameUser" id="fullnameUser" value="<?= esc(old('fullnameUser')); ?>" placeholder="fullname" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('fullnameUser')) ? 'invalid' : 'form-control' ?>">
                        <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('fullnameUser')) : ?>
                            <div class=" text-red-500 text-xs">
                                <?= $validation->getError('fullnameUser'); ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="flex flex-col space-y-1.5 mb-3">
                        <label for="emailUser">Email User</label>
                        <input type="email" name="emailUser" id="emailUser" value="<?= esc(old('emailUser')); ?>" placeholder="email" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('emailUser')) ? 'invalid' : 'form-control' ?>">
                        <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('emailUser')) : ?>
                            <div class=" text-red-500 text-xs">
                                <?= $validation->getError('emailUser'); ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="flex flex-col space-y-1.5 mb-3">
                        <label for="phoneUser">Phone User</label>
                        <input type="text" name="phoneUser" id="phoneUser" value="<?= esc(old('phoneUser')); ?>" placeholder="phone" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('phoneUser')) ? 'invalid' : 'form-control' ?>">
                        <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('phoneUser')) : ?>
                            <div class=" text-red-500 text-xs">
                                <?= $validation->getError('phoneUser'); ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="flex flex-col space-y-1.5 mb-3">
                        <label for="passwordUser">Password User</label>
                        <input type="password" name="passwordUser" id="passwordUser" value="<?= esc(old('passwordUser')); ?>" placeholder="*********" class="border p-2 border-gray-300 rounded-lg outline-none <?= (session()->has('validation') && ($validation = session('validation'))->hasError('passwordUser')) ? 'invalid' : 'form-control' ?>">
                        <?php if (session()->has('validation') && ($validation = session('validation'))->hasError('passwordUser')) : ?>
                            <div class=" text-red-500 text-xs">
                                <?= $validation->getError('passwordUser'); ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <button class="border p-2 rounded-lg outline-none focus:ring focus:ring-gray-400 hover:bg-gray-200 hover:text-slate-900 transition duration-200" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>