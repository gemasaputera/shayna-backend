@extends('layouts.default')

@push('after-style')
    <link rel="stylesheet" href="{{asset('assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">
@endpush
@section('content')
  <div class="orders">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="box-title">Daftar Foto Barang</h4>
          </div>
          <div class="card-body--">
            <div class="table-stats order-table ov-h">
              <table id="bootstrap-data-table" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Name Barang</th>
                    <th>Foto</th>
                    <th>Default</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                  $i=1;
                  @endphp
                  @forelse($items as $item)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $item->product->name }}</td>
                      <td><img src="{{ $item->photo }}"/></td>
                      <td>{{ $item->is_default?'Ya':'Tidak'}}</td>
                      <td>
                        <form action="{{ route('product-galleries.destroy', $item->id) }}" method="post" class="d-inline">
                          @csrf
                          @method('delete')
                          <button class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="7" class="text-center p-5">
                        Data tidak tersedia
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('after-script')
    <script src="{{ asset('assets/js/lib/data-table/datatables.min.js')}}"></script>
    <script src="{{ asset('assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/js/lib/data-table/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() { 
          $('#bootstrap-data-table').DataTable({
              lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
          });
      } );
    </script>
@endpush