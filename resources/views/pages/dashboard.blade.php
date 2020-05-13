@extends('layouts.default')

@push('after-style')
    <link rel="stylesheet" href="{{asset('assets/css/lib/datatable/dataTables.bootstrap.min.css')}}">
@endpush
@section('content')

            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="pe-7s-cash"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text">Rp. <span class="count">{{ $income }}</span></div>
                                            <div class="stat-heading">Penghasilan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="pe-7s-cart"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-text"><span class="count">{{ $sales }}</span></div>
                                            <div class="stat-heading">Penjualan</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->
                <!--  /Traffic -->
                <div class="clearfix"></div>
                <!-- Orders -->
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="box-title">Pembelian Terbaru </h4>
                                </div>
                                <div class="card-body--">
                                    <div class="table-stats order-table ov-h">
                                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Nomor</th>
                                            <th>Total Transaksi</th>
                                            <th>Transaksi Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                        $i=1;
                                        @endphp
                                        @forelse($items as $item)
                                            <tr>
                                            <td>{{ $i++ }}</td>
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
                            </div> <!-- /.card -->
                        </div>  <!-- /.col-lg-8 -->

                        <div class="col-xl-4">
                            <div class="row">
                                <div class="col-lg-6 col-xl-12">
                                    <div class="card br-0">
                                        <div class="card-body">
                                            <div class="chart-container ov-h">
                                                <div id="flotPie1" class="float-chart"></div>
                                            </div>
                                        </div>
                                    </div><!-- /.card -->
                                </div>
                            </div>
                        </div> <!-- /.col-md-4 -->
                    </div>
                </div>
                <!-- /.orders -->
            <!-- /#add-category -->
            </div>
            <!-- .animated -->
@endsection

@push('after-script')

<script>
        jQuery(document).ready(function($) {
            "use strict";

            // Pie chart flotPie1
            var piedata = [
                { label: "Pending", data: [[1,{{ $pie['pending'] }} ]], color: '#5c6bc0'},
                { label: "Gagal", data: [[1,{{ $pie['failed'] }} ]], color: '#ef5350'},
                { label: "Sukses", data: [[1,{{ $pie['success'] }} ]], color: '#66bb6a'}
            ];

            $.plot('#flotPie1', piedata, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        innerRadius: 0.65,
                        label: {
                            show: true,
                            radius: 2/3,
                            threshold: 1
                        },
                        stroke: {
                            width: 0
                        }
                    }
                },
                grid: {
                    hoverable: true,
                    clickable: true
                }
            });
            // Pie chart flotPie1  End
        });
    </script>
    
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