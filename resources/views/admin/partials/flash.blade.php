@if ($errors -> any())
    <div class="alert alert-danger">
        <strong>Oops!!</strong>
        Ada masalah dalam memasukkan data, mari kita ulang <br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif
