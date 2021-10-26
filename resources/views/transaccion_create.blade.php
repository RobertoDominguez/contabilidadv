@extends('layouts.template')

@section('title')
    Crear transaccion
@endsection

@section('title')
    Transacciones
@endsection

@section('content')

    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">
                Crear Transaccion
            </h3>
            <div class="card-toolbar">
                <div class="example-tools justify-content-center">

                </div>
            </div>
        </div>
        <form action="{{ route('transaccion.store') }}" method="POST" class="form" enctype="multipart/form-data">
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
                    <label>Detalle</label>
                    <input type="name" class="form-control form-control-solid" name="detalle"
                        placeholder="Introduce el detalle de la transaccion..." value="{{ old('detalle') }}" required />
                </div>
                <div class="form-group">
                    <label>Observaciones</label>
                    <input type="name" class="form-control form-control-solid" name="observaciones"
                        placeholder="Introduce la observacion si existe..." value="{{ old('observaciones') }}" />
                </div>

                <div class="form-group">
                    <label>Total (Bs.)</label>
                    <input type="number" step="0.01" min="0" max="999" class="form-control form-control-solid" name="total"
                        placeholder="Introduce el total de la transaccion" value="{{ old('total') }}" required />
                </div>

                {{-- <div class="form-group">
                    <div class="checkbox-inline">
                        <label class="checkbox checkbox-success">
                            <input type="checkbox" name="pagado" checked="checked">
                            <span></span>
                            Pagado
                        </label>
                    </div>
                    <span class="form-text text-muted">Desmarca si aún no se realizará el pago</span>
                </div> --}}
            </div>
            <div class="card-footer">
                <input type="submit" class="btn btn-primary mr-2" value="Guardar">
                <a href="{{ route('transacciones') }}" type="reset" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>


@endsection

@section('scripts')


    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.6') }}"></script>
    <!--end::Page Vendors-->

    <!--begin::Page Scripts(used by this page)-->
    <script src="assets/js/pages/crud/datatables/basic/scrollable.js?v=7.0.6')}}"></script>
    <!--end::Page Scripts-->
@endsection
