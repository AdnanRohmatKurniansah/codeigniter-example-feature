@extends(layouts/dashboard_layout)

@section(content)
<div class="p-4">
    <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
      <div class="rounded-t mb-0 px-0 border-0">
        <div class="flex flex-wrap items-center px-4 py-2">
          <div class="relative w-full max-w-full flex-grow flex-1">
            <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Data member</h3>
          </div>
          <div class="relative w-full max-w-full flex-grow flex-1 text-right">
            <a href="<?= base_url('dashboard/member/create') ?>" class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">Add new member</a>
          </div>
        </div>
        <div class="block w-full overflow-x-auto mb-5">
            <table class="table table-zebra">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>No telp</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($members as $index => $member) : ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= $member->name; ?></td>
                            <td><?= $member->address; ?></td>
                            <td><?= $member->no_telp; ?></td>
                            <td class="flex">
                                <a class="btn bg-green-500 text-white hover:bg-green-700" href="<?= base_url('dashboard/member/edit/' . $member->id) ?>">Edit</a>
                                <form id="deleteForm<?= $member->id ?>" action="<?= base_url('dashboard/member/delete/' . $member->id) ?>" method="post">
                                    <button type="button" onclick="confirmDelete(<?= $member->id ?>)"  class="btn bg-red-500 text-white hover:bg-red-700">Hapus</button>
                                </form>
                            </td>
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

<script>
    const confirmDelete = (memberId) => {
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this member!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector(`form#deleteForm${memberId}`).submit();
            }
        });
    }
</script>

@endsection