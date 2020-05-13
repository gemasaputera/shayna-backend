@extends('layouts.default')

@section('content')
  <div class="card">
    <div class="card-header">
      <strong>Tambah Barang</strong>
    </div>
    <div class="card-body card-block">
      <form action="{{ route('products.store') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="name" class="form-control-label">Nama Barang</label>
          <input
            class="form-control @error('name') is-invalid @enderror"
            type="text"
            name="name"
            placeholder="Masukkan nama barang"
            value="{{ old('name') }}"
          />
          @error('name')<div class="text-muted">{{$message}}</div>@enderror
        </div>
        <div class="form-group">
          <label for="type" class="form-control-label">Tipe Barang</label>
          <input
            class="form-control @error('type') is-invalid @enderror"
            type="text"
            name="type"
            placeholder="Masukkan tipe barang"
            value="{{ old('type') }}"
          />
          @error('type')<div class="text-muted">{{$message}}</div>@enderror
        </div>
        <div class="form-group">
          <label for="description" class="form-control-label">Deskripsi Barang</label>
          <textarea 
            name="description"
            placeholder="Masukkan deskripsi barang"
            class="form-control ckeditor @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
          @error('description')<div class="text-muted">{{$message}}</div>@enderror
        </div>
        <div class="form-group">
          <label for="price" class="form-control-label">Harga Barang</label>
          <input
            class="form-control @error('price') is-invalid @enderror"
            type="number"
            name="price"
            placeholder="Masukkan harga barang"
            value="{{ old('price') }}"
          />
          @error('price')<div class="text-muted">{{$message}}</div>@enderror
        </div>
        <div class="form-group">
          <label for="quantity" class="form-control-label">Stok Barang</label>
          <input
            class="form-control @error('quantity') is-invalid @enderror"
            type="number"
            name="quantity"
            placeholder="Masukkan stok barang"
            value="{{ old('quantity') }}"
          />
          @error('quantity')<div class="text-muted">{{$message}}</div>@enderror
        </div>
        <div class="form-group">
          <button class="btn btn-primary btn-block" type="submit">Tambah Barang</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('after-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
                .create( document.querySelector( '.ckeditor' ) )
                .then( editor => {
                        console.log( editor );
                } )
                .catch( error => {
                        console.error( error );
                } );
    </script>
@endpush