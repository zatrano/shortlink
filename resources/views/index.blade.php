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
        <form method="POST" action="{{ route('generate.shorten.link.post') }}">
            @csrf
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
                    @foreach($shortLinks as $link)
                        <tr>
                            <td>{{ $link->id }}</td>
                            <td><a href="{{ route('shorten.link', $link->code) }}" target="_blank">{{ route('shorten.link', $link->code) }}</a> ({{ $link->visit }})</td>
                            <td>{{ $link->link }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
      </div>
    </div>
</div>
</body>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if(session()->get('success'))
    Swal.fire({
        icon: 'success',
        title: '{{ session()->get('success') }}',
        showConfirmButton: false,
        timer: 1500
    })
@endif
</script>
</html>