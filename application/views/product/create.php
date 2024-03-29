@extends(layouts/dashboard_layout)

@section(content)
<div class="p-4">
    <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
      <div class="rounded-t mb-0 px-0 border-0">
        <div class="flex flex-wrap items-center px-4 py-2">
          <div class="relative w-full max-w-full flex-grow flex-1">
            <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Add product</h3>
          </div>
        </div>
        <div class="block w-full overflow-x-auto mb-5 p-3">
        <form enctype="multipart/form-data" action="<?= base_url('dashboard/product/create') ?>" method="post">
          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
            <input value="<?= set_value('name'); ?>"  type="text" id="name" name="name" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="name" required>
            <?= form_error('name', '<small class="text-red-600 mt-3">', '</small>'); ?>
          </div>
          <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Price</label>
            <input value="<?= set_value('price'); ?>"  type="number" min="1" id="price" name="price" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="price" required>
            <?= form_error('price', '<small class="text-red-600 mt-3">', '</small>'); ?>
          </div>
          <div class="mb-4">
            <label for="stock" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Stock</label>
            <input value="<?= set_value('stock'); ?>"  type="number" min="1" id="stock" name="stock" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="stock" required>
            <?= form_error('stock', '<small class="text-red-600 mt-3">', '</small>'); ?>
          </div>
          <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
            <select name="category_id" class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-white px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all ">
                <?php foreach ($categories as $category) :?>
                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                <?php endforeach; ?>
            </select>
            <?= form_error('category_id', '<small class="text-red-600 mt-3">', '</small>'); ?> 
          </div>
          <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Image</label>
            <img class="image-preview mb-3" style="max-width: 200px">
            <input onchange="previewImage()" type="file" id="image" name="image" required class="shadow-sm bg-white rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
            <?= form_error('image', '<small class="text-red-600 mt-3">', '</small>'); ?>
          </div>
          <button type="submit" class=" flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
        </form>
        </div>
      </div>
    </div>
</div>

<script>
    function previewImage() {
      const image = document.querySelector('#image');
      const imagePreview = document.querySelector('.image-preview');
      imagePreview.style.display = 'block';
      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);
      oFReader.onload = function(oFREvent) {
        imagePreview.src = oFREvent.target.result;
      }
    }
</script>

@endsection