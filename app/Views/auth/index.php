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
    <div class="grid place-content-center w-full h-screen bg-gray-100/65">
        <div class="border p-6 rounded-lg shadow-xl bg-white">
            <h4 class="mb-6 text-center">Login</h4>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="border border-red-300 bg-red-200/25 text-green-700 p-4 rounded-lg my-4" role="alert">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url(); ?>auth/login" method="post" class="space-y-2 px-6 py-4">
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
                <button class="border border-gray-300 px-4 py-2 rounded-lg capitalize hover:bg-gray-200 hover:text-slate-900 transition duration-200 outline-none focus:ring-blue-500 focus:ring-2" type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
