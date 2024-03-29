@extends(layouts/dashboard_layout)

@section(content)
<div class="p-4">
    <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
      <div class="rounded-t mb-0 px-0 border-0">
        <div class="flex flex-wrap items-center px-4 py-2">
          <div class="relative w-full max-w-full flex-grow flex-1">
            <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Add member</h3>
          </div>
        </div>
        <div class="block w-full overflow-x-auto mb-5 p-3">
        <form action="<?= base_url('dashboard/member/create') ?>" method="post">
          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
            <input value="<?= set_value('name'); ?>"  type="text" id="name" name="name" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="name" required>
            <?= form_error('name', '<small class="text-red-600 mt-3">', '</small>'); ?>
          </div>
          <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
            <input value="<?= set_value('address'); ?>"  type="text" id="address" name="address" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="address" required>
            <?= form_error('address', '<small class="text-red-600 mt-3">', '</small>'); ?>
          </div>
          <div class="mb-4">
            <label for="no_telp" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">No telp</label>
            <input value="<?= set_value('no_telp'); ?>"  type="text" id="no_telp" name="no_telp" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="no telp" required>
            <?= form_error('no_telp', '<small class="text-red-600 mt-3">', '</small>'); ?>
          </div>
          <button type="submit" class=" flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
        </form>
        </div>
      </div>
    </div>
</div>
@endsection