@extends('layouts.template')

@section('title')
    Caja del mes
@endsection

@section('subtitle')
    Reportes
@endsection

@section('content')
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            {{-- <h3 class="card-title">
                Caja
                <span class="text-muted mt-3 font-weight-bold font-size-sm">
                    @php
                        Carbon::setLocale('es');
                        echo Carbon::parse(date('Y'))->translatedFormat('D d M Y');
                    @endphp
                </span>
            </h3> --}}
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">Caja</span>
                <span class="text-muted mt-3 font-weight-bold font-size-sm">
                    @php
                        use Carbon\Carbon;
                        Carbon::setLocale('es');
                        echo Carbon::parse(date('Y'))->translatedFormat('M Y');
                    @endphp
                </span>
            </h3>

        </div>
        <div class="card-body">

            <div class="form-group">
                <label class="font-weight-bold">Ingreso Total (Bs.)</label>
                <input type="text" class="form-control form-control-solid" value="{{ $datos['total'] }}" readonly/>
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Caja Roja (Bs.)</label>
                <input type="text" class="form-control form-control-solid" value="{{ $datos['caja_roja'] }}" readonly/>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Caja Verde (Bs.)</label>
                <input type="text" class="form-control form-control-solid" value="{{ $datos['caja_verde'] }}" readonly/>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">F. Secos (Bs.)</label>
                <input type="text" class="form-control form-control-solid" value="{{ $datos['f_secos'] }}" readonly/>
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Wafles (Bs.)</label>
                <input type="text" class="form-control form-control-solid" value="{{ $datos['wafles'] }}" readonly/>
            </div>
        </div>
    </div>



@endsection


@section('scripts')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.6')}}"></script>
    <!--end::Page Vendors-->

    <!--begin::Page Scripts(used by this page)-->
    <script src="{{asset('assets/js/pages/crud/datatables/basic/scrollable.js?v=7.0.6')}}"></script>
    <!--end::Page Scripts-->
@endsection
