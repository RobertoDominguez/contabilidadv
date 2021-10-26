@extends('layouts.template')

@section('title')
    Crear venta
@endsection

@section('title')
    Ventas
@endsection

@section('content')

    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">
                Crear Venta
            </h3>
            <div class="card-toolbar">
                <div class="example-tools justify-content-center">

                </div>
            </div>
        </div>
        <form action="{{ route('venta.store') }}" method="POST" class="form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Verifica los datos!<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="form-group">
                    <label>Nombre</label>
                    <input type="name" class="form-control form-control-solid" name="nombre"
                        placeholder="Introduce el nombre del cliente..." value="{{ old('nombre') }}" required />
                </div>
                <div class="form-group">
                    <label>Observaciones</label>
                    <input type="name" class="form-control form-control-solid" name="observaciones"
                        placeholder="Introduce la observacion si existe..." value="{{ old('observaciones') }}" />
                </div>

                <div class="form-group">
                    <label>Productos</label>
                    <div class="table-responsive">
                        <table class="table table-head-custom table-head-bg table-vertical-center" id="productos_table">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col"> </th>
                                    <th scope="col"> </th>
                                    <th scope="col">Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($productos as $producto)
                                    <tr>
                                        <th scope="row">{{ $producto->nombre }}</th>
                                        <td>
                                            <input class="btn btn-primary mr-2" type="button" onclick="sub_row(this);"
                                                value="-" data-index="{{ $i }}">
                                        </td>
                                        <td>
                                            <input class="btn btn-primary mr-2" type="button" onclick="add_row(this);"
                                                value="+" data-index="{{ $i }}">
                                        </td>
                                        <th scope="row">
                                            <center>
                                                <input name="nombres_producto[]" value="{{ $producto->nombre }}" hidden>
                                                <input name="productos[]" value="{{ $producto->id }}" hidden>
                                                <input class="form-control form-control-solid" name="values[]" value="0"
                                                    readonly>
                                            </center>
                                        </th>
                                    </tr>
                                    @php
                                        $i = $i + 1;
                                    @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group">
                    <label>Total (Bs.)</label>
                    <input type="number" step="0.01" min="0" max="999" class="form-control form-control-solid" name="total"
                        placeholder="Introduce el total de la venta" value="{{ old('total') }}" required />
                </div>

                <div class="form-group">
                    <div class="checkbox-inline">
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" name="pagado" checked="checked">
                            <span></span>
                            Pagado
                        </label>
                    </div>
                    <span class="form-text text-muted">Desmarca si aún no se realizará el pago</span>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary mr-2" value="Guardar">
                <a href="{{ route('ventas') }}" type="reset" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>


@endsection

@section('scripts')

    <script type="text/javascript">
        function add_row(obj) {
            var i = parseInt(obj.dataset.index, 10);
            // console.log(i);

            var rowvalue = document.getElementsByName('values[]')[i].value
            var value = parseInt(rowvalue)

            if (value < 100) {
                value = value + 1
            }

            document.getElementsByName('values[]')[i].value = value

            // console.log(value);

            // var table = document.getElementById('productos_table');
            // for (var r = 0, n = table.rows.length; r < n; r++) {
            //     for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
            //         //console.log(table.rows[r].cells[c].innerText);
            //         if (table.rows[r].cells[c].innerText == "0") {
            //             table.rows[r].cells[c].innerText = 1
            //         }
            //     }
            // }
        }

        function sub_row(obj) {
            var i = parseInt(obj.dataset.index, 10);
            // console.log(i);

            var rowvalue = document.getElementsByName('values[]')[i].value
            var value = parseInt(rowvalue)

            if (value > 0) {
                value = value - 1
            }

            document.getElementsByName('values[]')[i].value = value
        }
    </script>

    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.6') }}"></script>
    <!--end::Page Vendors-->

    <!--begin::Page Scripts(used by this page)-->
    <script src="assets/js/pages/crud/datatables/basic/scrollable.js?v=7.0.6')}}"></script>
    <!--end::Page Scripts-->
@endsection
