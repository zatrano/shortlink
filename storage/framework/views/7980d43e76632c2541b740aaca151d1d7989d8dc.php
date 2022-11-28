<!DOCTYPE html>
<html>
<head>
    <title>Subaşı Yapım - Link Kısaltma Servisi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
</head>
<body>
<div class="container">
    <div class="card">
      <div class="card-header">
        <form method="POST" action="<?php echo e(route('generate.shorten.link.post')); ?>">
            <?php echo csrf_field(); ?>
            <div class="input-group mb-3">
              <input type="text" name="link" class="form-control" placeholder="Orjilinal Linki Buraya Yapıştırın">
              <input type="text" name="code" class="form-control" placeholder="Kısa Kodunuzu Giriniz">
              <div class="input-group-append">
                <button class="btn btn-success" type="submit">Kısa Link Oluştur</button>
              </div>
            </div>
        </form>
      </div>
      <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kısa Link</th>
                        <th>Orjinal Link</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $shortLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($link->id); ?></td>
                            <td><a href="<?php echo e(route('shorten.link', $link->code)); ?>" target="_blank"><?php echo e(route('shorten.link', $link->code)); ?></a> (<?php echo e($link->visit); ?>)</td>
                            <td><?php echo e($link->link); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
      </div>
    </div>
</div>
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
<?php if(session()->get('success')): ?>
    Swal.fire({
        icon: 'success',
        title: '<?php echo e(session()->get('success')); ?>',
        showConfirmButton: false,
        timer: 1500
    })
<?php endif; ?>
</script>
</html><?php /**PATH D:\Projeler\shortlink\resources\views/index.blade.php ENDPATH**/ ?>