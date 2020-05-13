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
            <h4 class="box-title">Daftar Transaksi Masuk</h4>
          </div>
          <div class="card-body--">
            <div class="table-stats order-table ov-h">
              <table id="bootstrap-data-table" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No Invoice</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Nomor</th>
                    <th>Total Transaksi</th>
                    <th>Transaksi Status</th>
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
                      <td>{{ $item->uuid }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->email }}</td>
                      <td>{{ $item->number }}</td>
                      <td>Rp {{ $item->transaction_total }}</td>
                      <td>
                        @if($item->transaction_status=='PENDING')
                          <span class="badge badge-info">
                        @elseif($item->transaction_status=='SUCCESS')
                          <span class="badge badge-success">
                        @elseif($item->transaction_status=='FAILED')
                          <span class="badge badge-danger">
                        @endif
                        {{ $item->transaction_status }}
                        </span>
                      </td>
                      <td>
                        @if($item->transaction_status=='PENDING')
                          <a href="{{ route('transactions.status', $item->id)}}?status=SUCCESS"
                            class="btn btn-success btn-sm">
                            <i class="fa fa-check"></i>  
                          </a>
                          <a href="{{ route('transactions.status', $item->id)}}?status=FAILED"
                            class="btn btn-warning btn-sm">
                            <i class="fa fa-times"></i>  
                          </a>
                        @endif
                        <a
                          href="#DetailModal"
                          data-remote="{{ route('transactions.show', $item->id) }}"
                          data-toggle="modal"
                          data-target="#DetailModal"
                          data-title="Detail Transaksi {{$item->uuid}}"
                          class="btn btn-info btn-sm">
                          <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('transactions.edit', $item->id) }}" class="btn btn-primary btn-sm">
                          <i class="fa fa-pencil"></i>
                        </a>
                        <form action="{{ route('transactions.destroy', $item->id) }}" method="post" class="d-inline">
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
