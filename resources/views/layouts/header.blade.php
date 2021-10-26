<!--begin::Header Nav-->
<ul class="menu-nav ">
    <li class="menu-item  menu-item-open menu-item-here menu-item-submenu menu-item-rel menu-item-open menu-item-here"
        data-menu-toggle="click" aria-haspopup="true"><a href="javascript:;" class="menu-link menu-toggle"><span
                class="menu-text">Ventas</span><i class="menu-arrow"></i></a>
        <div class="menu-submenu menu-submenu-classic menu-submenu-left">
            <ul class="menu-subnav">
                {{-- <li class="menu-item  menu-item-active " aria-haspopup="true"> --}}
                <li class="menu-item " aria-haspopup="true">
                    <a href="{{ route('ventas') }}" class="menu-link "><span class="menu-text">
                            Ventas del dia
                        </span><span class="menu-desc"></span></a>
                </li>
                <li class="menu-item " aria-haspopup="true">
                    <a href="{{ route('transacciones') }}" class="menu-link "><span class="menu-text">
                            Transacciones del dia
                        </span><span class="menu-desc"></span></a>
                </li>
                <li class="menu-item " aria-haspopup="true">
                    <a href="{{ route('caja') }}" class="menu-link "><span class="menu-text">
                            Caja
                        </span><span class="menu-desc"></span></a>
                </li>
                <li class="menu-item " aria-haspopup="true">
                    <a href="{{ route('ventas.deudas') }}" class="menu-link "><span class="menu-text">
                            Registro de Deudores
                        </span><span class="menu-desc"></span></a>
                </li>
                <li class="menu-item " aria-haspopup="true">
                    <a href="{{ route('ventas.registro') }}" class="menu-link "><span class="menu-text">
                            Registro de Ventas
                        </span><span class="menu-desc"></span></a>
                </li>
            </ul>
        </div>
    </li>
</ul>
<!--end::Header Nav-->
