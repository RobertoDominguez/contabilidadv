@extends('layouts.template')

@section('title')
    Transacciones del dia
@endsection

@section('subtitle')
    Transacciones
@endsection

@section('content')
    <!--begin::Advance Table Widget 8-->
    <div class="card card-custom gutter-b">
        <!--begin::Header-->
        <div class="card-header border-0 py-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label font-weight-bolder text-dark">Transacciones</span>
                <span class="text-muted mt-3 font-weight-bold font-size-sm">
                    @php
                        use Carbon\Carbon;
                        Carbon::setLocale('es');
                        echo Carbon::parse(date('Y'))->translatedFormat('D d M Y');
                    @endphp
                </span>
            </h3>
            <div class="card-toolbar">
                <a href="{{ route('transaccion.create') }}" class="btn btn-success font-weight-bolder font-size-sm"><span
                        class="svg-icon svg-icon-md svg-icon-white">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24" />
                                        <path
                                            d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                        <path
                                            d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                            fill="#000000" fill-rule="nonzero" />
                                    </g>
                                </svg> --}}
                        <!--end::Svg Icon-->
                    </span>Nueva Transaccion</a>
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
                            <th style="min-width: 200px" class="pl-7">
                                <span class="text-dark-75">Detalle</span>
                            </th>
                            <th style="min-width: 100px">Total</th>
                            <th style="min-width: 140px">Observaciones</th>
                            {{-- <th style="min-width: 50px">Estado</th> --}}
                            <th style="min-width: 110px">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transacciones as $transaccion)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">

                                        <div>
                                            <a class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                {{ $transaccion->detalle }}
                                            </a>
                                            {{-- <span class="text-muted font-weight-bold d-block">
                                                {{ $transaccion->observaciones }}
                                            </span> --}}
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                        {{ $transaccion->total . ' Bs.' }}
                                    </span>
                                    <span class="text-muted font-weight-bold">
                                        @php
                                            Carbon::setLocale('es');
                                            echo Carbon::parse($transaccion->created_at)->translatedFormat('D d M Y h:i');
                                        @endphp
                                    </span>
                                </td>
                                {{-- <td>

                                </td> --}}
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="text-muted font-weight-bold d-block">
                                            {{ $transaccion->observaciones }}
                                        </span>
                                    </div>
                                </td>
                                {{-- <td>
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
                                </td> --}}
                                <td class="pr-0 text-right">
                                    <div class="d-flex align-items-center">
                                        {{-- @if (!$venta->pagado)
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
                                        @endif --}}
                                        <a href="{{ route('transaccion.edit', $transaccion->id) }}"
                                            class="btn btn-icon btn-light btn-hover-primary btn-sm mx-3">
                                            <span class="svg-icon svg-icon-md svg-icon-primary">
                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Write.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
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
                                            </span>
                                        </a>
                                        <a href="{{ route('transaccion.destroy', $transaccion->id) }}"
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
                                            </span>
                                        </a>
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
                <span class="card-label font-weight-bolder text-dark">Caja de transacciones</span>
                <span class="text-muted mt-3 font-weight-bold font-size-sm">
                    @php
                        Carbon::setLocale('es');
                        echo Carbon::parse(date('Y'))->translatedFormat('D d M Y');
                    @endphp
                </span>
            </h3>

        </div>
        <div class="card-body">

            @php
                $total = 0;
                foreach ($transacciones as $transaccion) {
                    $total=$total+$transaccion->total;
                }
                
            @endphp

            <div class="form-group">
                <label class="font-weight-bold">Egreso Total (Bs.)</label>
                <input type="text" class="form-control form-control-solid" value="{{ $total }}" readonly />
            </div>
        </div>
    </div>



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
