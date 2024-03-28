<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11?v=2"></script>
    <script src="https://cdn.tailwindcss.com?v=2"></script>
</head>
<body>
	<?php $this->load->view('components/alert') ?>
	<div class="min-h-screen flex items-center justify-center w-full dark:bg-gray-950">
		<div class="bg-white dark:bg-gray-900 shadow-md rounded-lg px-8 py-6 max-w-md">
			<h1 class="text-2xl font-bold text-center mb-4 dark:text-gray-200">Login</h1>
			<form action="<?= base_url('/') ?>" method="post">
				<div class="mb-4">
					<label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
					<input value="<?= set_value('email'); ?>"  type="email" id="email" name="email" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="your@email.com" required>
					<?= form_error('email', '<small class="text-red-600 mt-3">', '</small>'); ?>
				</div>
				<div class="mb-4">
					<label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
					<input type="password" id="password" name="password" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter your password" required>
					<?= form_error('password', '<small class="text-red-600 mt-3">', '</small><br/>'); ?>
					<a href="<?= base_url('auth/register') ?>"
						class="text-xs text-indigo-500 hover:text-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Dont have
						Account?</a>
				</div>
				<button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Login</button>
			</form>
		</div>
	</div>
</body>
</html>