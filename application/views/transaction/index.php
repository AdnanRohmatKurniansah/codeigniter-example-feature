@extends(layouts/dashboard_layout)

@section(content)
<div class="p-4">
    <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
      <div class="rounded-t mb-0 px-0 border-0">
        <div class="flex flex-wrap items-center px-4 py-2">
          <div class="relative w-full max-w-full flex-grow flex-1">
            <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Data transaction</h3>
          </div>
          <div class="relative w-full max-w-full flex-grow flex-1 text-right">
            <a href="<?= base_url('dashboard/transaction/create') ?>" class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">Add transaction</a>
          </div>
          <form class="mt-2" action="<?= base_url('dashboard/transaction/report') ?>" method="post">
              <button class="bg-green-500 dark:bg-gray-100 text-white active:bg-green-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="submit">Generate report</button>
          </form>
        </div>
        <div class="block w-full overflow-x-auto mb-5">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Member</th>
                        <th>Product</th>
                        <th>Total</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transactions as $index => $transaction) : ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= $transaction->member_name; ?></td>
                            <td><?= $transaction->product_names ?></td>
                            <td><?= $transaction->total; ?></td>
                            <td><?= $transaction->transaction_date; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="flex justify-center my-4">
                <ul class="flex list-none rounded-md space-x-2">
                    <?php echo str_replace(['pagination', 'page-item', 'page-link'], ['pagination flex', 'page-item inline-block rounded-sm border border-gray-300', 'page-link block px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-200'], $links); ?>
                </ul>
            </div>
        </div>
      </div>
    </div>
</div>

@endsection
