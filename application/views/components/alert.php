<?php if ($this->session->flashdata('success')): ?>
    <script>
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
            title: '<?= $this->session->flashdata('success') ?>'
        });
    </script>
<?php elseif ($this->session->flashdata('error')): ?>
    <script>
        const errorToast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            iconColor: 'white',
            color: '#fff',
            background: '#f27474',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        errorToast.fire({
            icon: 'error',
            title: '<?= $this->session->flashdata('error'); ?>'
        });
    </script>
<?php elseif ($this->session->flashdata('update')): ?>
    <script>
        const infoToast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            iconColor: 'white',
            color: '#fff',
            background: '#3fc3ee',
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        infoToast.fire({
            icon: 'info',
            title: '<?= $this->session->flashdata('update'); ?>'
        });
    </script>
<?php endif; ?>
