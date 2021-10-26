@extends('admin.layouts.template')

@section('title')
    Registro de ventas
@endsection

@section('subtitle')
    Ventas
@endsection

@section('content')

    @php
    use Carbon\Carbon;
    @endphp

    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">Ventas</span>
                <span class="text-muted mt-3 font-weight-bold font-size-sm">
                    @php
                        Carbon::setLocale('es');
                        if (is_null($fecha)) {
                            echo Carbon::parse(date('Y'))->translatedFormat('D d M Y');
                        } else {
                            echo Carbon::parse($fecha)->translatedFormat('D d M Y');
                        }
                        
                    @endphp
                </span>
            </h3>
            <div class="card-toolbar">
                <form action="{{ route('admin.ventas') }}" class="form-group row">
                    {{ csrf_field() }}
                    <div class="input-group date">
                        <input type="text" name="fecha" class="form-control" readonly value="{{ date('Y') }}"
                            id="kt_datepicker_3" onchange="this.form.submit()" />
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="la la-calendar"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>


    @foreach ($usuarios as $usuario)

        <!--begin::Advance Table Widget 8-->
        <div class="card card-custom gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Ventas de {{ $usuario->name }}</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">

                    </span>
                </h3>
                <div class="card-toolbar">

                </div>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body pt-0 pb-3">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table table-head-custom table-head-bg table-vertical-center">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th style="min-width: 160px" class="pl-7">
                                    <span class="text-dark-75">Nombre</span>
                                </th>
                                <th style="min-width: 100px">Total</th>
                                <th style="min-width: 140px">Producto</th>
                                <th style="min-width: 50px">Cantidad</th>
                                <th style="min-width: 110px">Estado</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuario->ventas as $venta)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">

                                            <div>
                                                <a
                                                    class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                    {{ $venta->nombre }}
                                                </a>
                                                <span class="text-muted font-weight-bold d-block">
                                                    {{ $venta->observaciones }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                            {{ $venta->total . ' Bs.' }}
                                        </span>
                                        <span class="text-muted font-weight-bold">
                                            @php
                                                Carbon::setLocale('es');
                                                echo Carbon::parse($venta->created_at)->translatedFormat('D d M Y h:i');
                                            @endphp
                                        </span>
                                    </td>
                                    <td>
                                        @foreach ($venta->detalles as $detalle)
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                {{ $detalle->nombre_producto }}
                                            </span>
                                            <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($venta->detalles as $detalle)
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                {{ $detalle->cantidad }}
                                            </span>
                                            <br>
                                        @endforeach
                                    </td>
                                    <td class="pr-0 text-right">
                                        {{-- <div class="d-flex align-items-center">
                                    <a href="{{ route('venta.edit', $venta->id) }}"
                                        class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                                        fill="#000000" fill-rule="nonzero"
                                                        transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) " />
                                                    <path
                                                        d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                                        fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span> </a>
                                    <a href="{{ route('venta.destroy', $venta->id) }}"
                                        class="delete-confirm btn btn-icon btn-light btn-hover-primary btn-sm"
                                        title="Delete">
                                        <span class="svg-icon svg-icon-md svg-icon-primary">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Trash.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path
                                                        d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                                        fill="#000000" fill-rule="nonzero" />
                                                    <path
                                                        d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                                        fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span> </a>
                                </div> --}}
                                        <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                            @if ($venta->pagado)
                                                <a class="btn font-weight-bold btn-light-success" data-toggle="modal"
                                                    data-target="#kt_datepicker_modal">Pagado</a>
                                            @else
                                                <a class="btn font-weight-bold btn-light-danger" data-toggle="modal"
                                                    data-target="#kt_datepicker_modal">Debe</a>
                                            @endif
                                        </span>

                                        <span class="text-muted font-weight-bold">
                                            @php
                                                Carbon::setLocale('es');
                                                if (!is_null($venta->fecha_pago)) {
                                                    echo Carbon::parse($venta->fecha_pago)->translatedFormat('D d M Y h:i');
                                                }
                                            @endphp
                                        </span>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end::Table-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Advance Table Widget 8-->
        <br>
    @endforeach


    <br>
    <br>
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
                        Carbon::setLocale('es');
                        if (is_null($fecha)) {
                            echo Carbon::parse(date('Y'))->translatedFormat('D d M Y');
                        } else {
                            echo Carbon::parse($fecha)->translatedFormat('D d M Y');
                        }
                    @endphp
                </span>
            </h3>

        </div>
        <div class="card-body">

            @php
                $total = 0;
                $caja_roja = 0;
                $caja_verde = 0;
                $f_secos = 0;
                $wafles = 0;
                foreach ($usuarios as $usuario) {
                    foreach ($usuario->ventas as $venta) {
                        if ($venta->pagado && Carbon::parse($venta->fecha_pago)->format('Y-m-d') == date('Y-m-d')) {
                            $total = $total + $venta->total;
                        }
                        foreach ($venta->detalles as $detalle) {
                            if ($detalle->nombre_producto == 'F. SECOS') {
                                $f_secos = $f_secos + 1;
                            }
                
                            if ($detalle->nombre_producto == 'WAFLES') {
                                $wafles = $wafles + 1;
                            }
                        }
                    }
                }
                
                $caja_roja = round($total * 0.6);
                $caja_verde = round($total * 0.4);
                $f_secos = $f_secos * 2;
                $wafles = $wafles * 4;
                $caja_verde = $caja_verde - $f_secos - $wafles;
            @endphp


            <div class="form-group">
                <label class="font-weight-bold">Ingreso Total (Bs.)</label>
                <input type="text" class="form-control form-control-solid" value="{{ $total }}" readonly />
            </div>
            <div class="form-group">
                <label class="font-weight-bold">Caja Roja (Bs.)</label>
                <input type="text" class="form-control form-control-solid" value="{{ $caja_roja }}" readonly />
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Caja Verde (Bs.)</label>
                <input type="text" class="form-control form-control-solid" value="{{ $caja_verde }}" readonly />
            </div>

            <div class="form-group">
                <label class="font-weight-bold">F. Secos (Bs.)</label>
                <input type="text" class="form-control form-control-solid" value="{{ $f_secos }}" readonly />
            </div>

            <div class="form-group">
                <label class="font-weight-bold">Wafles (Bs.)</label>
                <input type="text" class="form-control form-control-solid" value="{{ $wafles }}" readonly />
            </div>
        </div>
    </div>



@endsection


@section('scripts')
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.6') }}"></script>
    <!--end::Page Vendors-->

    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/js/pages/crud/datatables/basic/scrollable.js?v=7.0.6') }}"></script>
    <!--end::Page Scripts-->

    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js?v=7.0.6') }}"></script>
    <!--end::Page Scripts-->
@endsection
