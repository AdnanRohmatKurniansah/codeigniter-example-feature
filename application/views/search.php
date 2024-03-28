@extends(layouts/dashboard_layout)

@section(content)
<div class="p-4">
    <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
      <div class="rounded-t mb-0 px-0 border-0">
        <div class="flex flex-wrap items-center px-4 py-2">
          <div class="relative w-full max-w-full flex-grow flex-1">
            <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Search Product</h3>
            </div>
        </div>
        <div class="block w-full overflow-x-auto mb-5">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $index => $product) : ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td>
                                <img width="50px" src="<?= base_url('public/uploads/') . $product->image ?>" alt="">
                            </td>
                            <td><?= $product->name; ?></td>
                            <td><?= $product->category_name; ?></td>
                            <td><?= $product->price; ?></td>
                            <td class="flex">
                                <a class="btn bg-green-500 text-white hover:bg-green-700" href="<?= base_url('dashboard/product/edit/' . $product->id) ?>">Edit</a>
                                <form action="<?= base_url('dashboard/product/delete/' . $product->id) ?>" method="post">
                                    <button onclick="return confirm('Hapus product ini')" type="submit" class="btn bg-red-500 text-white hover:bg-red-700">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
      </div>
    </div>
</div>
@endsection