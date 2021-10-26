@extends('layouts.template')

@section('title')
    Ventas con deudas
@endsection

@section('subtitle')
    Ventas
@endsection

@section('content')
    <!--begin::Advance Table Widget 8-->
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">Deudas en general</span>
                <span class="text-muted mt-3 font-weight-bold font-size-sm">
                    @php
                        use Carbon\Carbon;
                        Carbon::setLocale('es');
                        // echo Carbon::parse(date('Y'))->translatedFormat('D d M Y');
                    @endphp
                </span>
            </h3>
            {{-- <div class="card-toolbar">
                <a href="{{ route('venta.create') }}" class="btn btn-success font-weight-bolder font-size-sm"><span
                        class="svg-icon svg-icon-md svg-icon-white">
                    </span>Nueva Venta</a>
            </div> --}}
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
                            <th style="min-width: 50px">Estado</th>
                            <th style="min-width: 110px">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">

                                        <div>
                                            <a class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">
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
                                            echo Carbon::parse($venta->updated_at)->translatedFormat('D d M Y h:i');
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
                                <td>
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
                                <td class="pr-0 text-right">
                                    <div class="d-flex align-items-center">
                                        @if (!$venta->pagado)
                                            <a href="{{ route('venta.pagar', $venta->id) }}"
                                                class="pago-confirm btn btn-icon btn-light btn-hover-primary btn-sm mx-3"
                                                title="Pagar">
                                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                        viewBox="0 0 235.517 235.517"
                                                        style="enable-background:new 0 0 235.517 235.517;"
                                                        xml:space="preserve">
                                                        <g>
                                                            <path style="fill:#010002;"
                                                                d="M118.1,235.517c7.898,0,14.31-6.032,14.31-13.483c0-7.441,0-13.473,0-13.473
                                                                                            c39.069-3.579,64.932-24.215,64.932-57.785v-0.549c0-34.119-22.012-49.8-65.758-59.977V58.334c6.298,1.539,12.82,3.72,19.194,6.549
                                                                                            c10.258,4.547,22.724,1.697,28.952-8.485c6.233-10.176,2.866-24.47-8.681-29.654c-11.498-5.156-24.117-8.708-38.095-10.236V8.251
                                                                                            c0-4.552-6.402-8.251-14.305-8.251c-7.903,0-14.31,3.514-14.31,7.832c0,4.335,0,7.843,0,7.843
                                                                                            c-42.104,3.03-65.764,25.591-65.764,58.057v0.555c0,34.114,22.561,49.256,66.862,59.427v33.021
                                                                                            c-10.628-1.713-21.033-5.243-31.623-10.65c-11.281-5.755-25.101-3.72-31.938,6.385c-6.842,10.1-4.079,24.449,7.294,30.029
                                                                                            c16.709,8.208,35.593,13.57,54.614,15.518v13.755C103.79,229.36,110.197,235.517,118.1,235.517z M131.301,138.12
                                                                                            c14.316,4.123,18.438,8.257,18.438,15.681v0.555c0,7.979-5.776,12.651-18.438,14.033V138.12z M86.999,70.153v-0.549
                                                                                            c0-7.152,5.232-12.657,18.71-13.755v29.719C90.856,81.439,86.999,77.305,86.999,70.153z" />
                                                        </g>
                                                    </svg>

                                                </span>
                                            </a>
                                        @else
                                            <a class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3" title="Pagar">
                                                <span class="svg-icon svg-icon-md svg-icon-primary">
                                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                        viewBox="0 0 235.517 235.517"
                                                        style="enable-background:new 0 0 235.517 235.517;"
                                                        xml:space="preserve">
                                                        <g>
                                                            <path style="fill:#FFFF;"
                                                                d="M118.1,235.517c7.898,0,14.31-6.032,14.31-13.483c0-7.441,0-13.473,0-13.473
                                                                                        c39.069-3.579,64.932-24.215,64.932-57.785v-0.549c0-34.119-22.012-49.8-65.758-59.977V58.334c6.298,1.539,12.82,3.72,19.194,6.549
                                                                                        c10.258,4.547,22.724,1.697,28.952-8.485c6.233-10.176,2.866-24.47-8.681-29.654c-11.498-5.156-24.117-8.708-38.095-10.236V8.251
                                                                                        c0-4.552-6.402-8.251-14.305-8.251c-7.903,0-14.31,3.514-14.31,7.832c0,4.335,0,7.843,0,7.843
                                                                                        c-42.104,3.03-65.764,25.591-65.764,58.057v0.555c0,34.114,22.561,49.256,66.862,59.427v33.021
                                                                                        c-10.628-1.713-21.033-5.243-31.623-10.65c-11.281-5.755-25.101-3.72-31.938,6.385c-6.842,10.1-4.079,24.449,7.294,30.029
                                                                                        c16.709,8.208,35.593,13.57,54.614,15.518v13.755C103.79,229.36,110.197,235.517,118.1,235.517z M131.301,138.12
                                                                                        c14.316,4.123,18.438,8.257,18.438,15.681v0.555c0,7.979-5.776,12.651-18.438,14.033V138.12z M86.999,70.153v-0.549
                                                                                        c0-7.152,5.232-12.657,18.71-13.755v29.719C90.856,81.439,86.999,77.305,86.999,70.153z" />
                                                        </g>
                                                    </svg>
                                                </span>
                                            </a>
                                        @endif
                                    </div>
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
@endsection


@section('scripts')

    <script type="application/javascript">
        $('.pago-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal.fire({
                title: '¿Estas seguro?',
                text: "¡Esta venta sera pagada!",
                icon: "warning",
                buttonsStyling: false,
                showCancelButton: true,
                confirmButtonText: 'Si, pagar!',
                cancelButtonText: 'No, cancelar!',
                customClass: {
                    confirmButton: "btn font-weight-bold btn-success",
                    cancelButton: "btn font-weight-bold btn-danger"
                }
            }).then(function(value) {
                if (value) {
                    if (value.isConfirmed) {
                        window.location.href = url;
                    }
                }
            });
        });
    </script>

    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js?v=7.0.6') }}"></script>
    <!--end::Page Vendors-->

    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/js/pages/crud/datatables/basic/scrollable.js?v=7.0.6') }}"></script>
    <!--end::Page Scripts-->
@endsection
