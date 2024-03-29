@extends(layouts/dashboard_layout)

@section(content)
<div class="p-4">
    <form action="<?= base_url('dashboard/transaction/create') ?>" method="post">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-2">
                    <div class="relative w-full max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Choose product</h3>
                    </div>
                    </div>
                    <div class="block w-full overflow-x-auto mb-5 p-3">
                        <div class="mb-4">
                            <label for="product_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product</label>
                            <select id="product_id" class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-white px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all" style="height: 45px;">
                                <?php foreach ($products as $product) :?>
                                    <option data-price="<?= $product->price ?>" value="<?= $product->id ?>"><?= $product->name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="hidden" name="product_id[]" id="hidden_product_id">
                            <?= form_error('product_id[]', '<small class="text-red-600 mt-3">', '</small>'); ?> 
                        </div>
                        <div class="mb-4">
                            <label for="qty" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Quantity</label>
                            <input value="<?= set_value('qty'); ?>"  type="number" id="qty" name="qty[]" min="1" class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" placeholder="qty" required>
                            <?= form_error('qty[]', '<small class="text-red-600 mt-3">', '</small>'); ?>
                        </div>
                        <button type="button" onclick="addProduct()" class="btn bg-green-500 text-white hover:bg-green-700">Tambah product</button>
                    </div>
                </div>
            </div>
            <div class="relative col-span-2 flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full rounded">
              <div class="rounded-t mb-0 px-0 border-0">
                <div class="flex flex-wrap items-center px-4 py-2">
                  <div class="relative w-full max-w-full flex-grow flex-1">
                    <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Add transaction</h3>
                  </div>
                </div>
                <div class="block w-full overflow-x-auto mb-5 p-3">
                    <div class="mb-4">
                        <label for="member_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Member</label>
                        <select id="member_id" name="member_id" class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-white px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all ">
                            <?php foreach ($members as $member) :?>
                                <option value="<?= $member->id ?>"><?= $member->name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('member_id', '<small class="text-red-600 mt-3">', '</small>'); ?> 
                    </div>
                    <div class="mb-4">
                        <table class="table table-zebra" id="product_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Sub total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Product rows will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="grid grid-cols-2">
                        <div class="mt-32 flex items-center border border-gray-300 p-3 rounded-lg">
                            <h1 class="text-2xl">Total: <span id="total"></span></h1>
                        </div>   
                        <div class="flex mt-32 justify-end">
                            <button type="button" onclick="createTransaction()" class="btn bg-blue-500 text-white hover:bg-blue-700">Process</button>
                        </div>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </form>
</div>

<script>
    let productCounter = 1;
    const transactionData = {
        transaction: {
            transaction_date: new Date().toISOString(),
            total: 0, 
            member_id: parseInt(document.getElementById('member_id').value)
        },
        details: []
    };

    function updateTotal() {
        let total = 0;
        transactionData.details.forEach(detail => {
            total += detail.sub_total;
        });
        transactionData.transaction.total = total;
        document.getElementById('total').innerText = total;
    }

    function addProduct() {
        const productId = parseInt(document.getElementById('product_id').value);
        const productName = document.getElementById('product_id').options[document.getElementById('product_id').selectedIndex].text;
        const qty = parseInt(document.getElementById('qty').value);
        const selectedProduct = document.getElementById('product_id');
        const selectedOption = selectedProduct.options[selectedProduct.selectedIndex];
        const price = selectedOption.getAttribute('data-price');
        const subtotal = price * qty;

        transactionData.details.push({ 
            product_id: productId, 
            qty: qty, 
            sub_total: subtotal 
        });

        updateTotal();

        const newRow = document.getElementById('product_table').getElementsByTagName('tbody')[0].insertRow();
        newRow.innerHTML = `
            <td>${productCounter++}</td>
            <td>${productName}<input type="hidden" name="product_id[]" value="${productId}"></td>
            <td>${qty}<input type="hidden" name="qty[]" value="${qty}"></td>
            <td>${price}</td>
            <td>${subtotal}</td>
            <td><button type="button" onclick="removeProduct(this)" class="btn bg-red-500 text-white hover:bg-red-700">Remove</button></td>
        `;
    }

    function removeProduct(button) {
        const row = button.parentNode.parentNode;
        const rowIndex = row.rowIndex;
        transactionData.details.splice(rowIndex - 1, 1); 
        updateTotal();
        row.parentNode.removeChild(row);
    }

    function createTransaction() {
        const url = '<?= base_url('dashboard/transaction/create') ?>';
        const formData = new FormData();

        formData.append('transaction_date', transactionData.transaction.transaction_date);
        formData.append('total', transactionData.transaction.total);
        formData.append('member_id', transactionData.transaction.member_id);

        transactionData.details.forEach((detail, index) => {
            formData.append(`details[${index}][product_id]`, detail.product_id);
            formData.append(`details[${index}][qty]`, detail.qty);
            formData.append(`details[${index}][sub_total]`, detail.sub_total);
        });

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const successToast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                iconColor: 'white',
                color: '#fff',
                timerProgressBar: true,
                background: '#a5dc86',
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });
            successToast.fire({
                icon: 'success',
                title: data.message
            });
            window.location.href = '<?= base_url('dashboard/transaction') ?>';
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
    }

</script>

@endsection
