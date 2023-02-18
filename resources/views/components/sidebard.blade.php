<nav id="sidebar" class="shadow-sm">
    <div class="sidebar-header d-flex justify-content-center">
        <img src="{{ asset('assets/images/sinlimite.jpg') }}" alt="" width="200" height="100" class="mt-2" />
    </div>

    <ul class="list-unstyled components">
        <li class="py-1">
            <a href="{{ url('admin/home') }}"
                class="btn btn-outline-danger rounded-0 text-start border-0 {{ request()->is('admin/home') || request()->is('admin/home/*') ? 'active' : '' }}">
                <i class="fas fa-home fa-xl"></i>
                Inicio
            </a>
        </li>
        <li class="py-1" {{ Auth::user()->roles_id != 1 ? 'hidden' : '' }}>
            <a href="{{ url('admin/reportes') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0 {{ request()->is('admin/reportes') || request()->is('admin/reportes/*') ? 'active' : '' }}">
                <i class="fa-solid fa-chart-pie fa-xl"></i> Reportes
            </a>
        </li>
        <li class="py-1" {{ Auth::user()->roles_id != 1 ? 'hidden' : '' }}>
            <a href="{{ url('admin/cuadres') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0 {{ request()->is('admin/cuadres') || request()->is('admin/cuadres/*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-invoice-dollar fa-xl"></i> Cuadre
            </a>
        </li>
        <li class="py-1">
            <a href="{{ url('admin/usuarios') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0 {{ request()->is('admin/usuarios') || request()->is('admin/usuarios/*') ? 'active' : '' }}">
                <i class="fa-solid fa-user fa-xl"></i> Usuarios
            </a>
        </li>
        <li class="py-1">
            <a href="{{ url('admin/productos') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0 {{ Request::is('admin/productos') || Request::is('admin/productos/*') ? 'active' : '' }}">
                <i class="fa-solid fa-boxes-stacked fa-xl"></i>
                Productos
            </a>
        </li>
        <li class="py-1">
            <a href="{{ url('admin/inventarios') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0 {{ Request::is('admin/inventarios') || Request::is('admin/inventarios/*') ? 'active' : '' }}">
                <i class="fa-solid fa-warehouse fa-xl"></i>
                Inventario
            </a>
        </li>
        <li class="py-1">
            <a href="{{ url('admin/ventas') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0 {{ Request::is('admin/ventas') ? 'active' : '' }}">
                <i class="fa-solid fa-cash-register fa-xl"></i>
                Ventas
            </a>
        </li>
        <li class="py-1">
            <a href="{{ url('admin/compras') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0 {{ Request::is('admin/compras') || Request::is('admin/compras/*') ? 'active' : '' }}">
                <i class="fa-solid fa-money-bill fa-xl"></i>
                Compras
            </a>
        </li>
        <li class="py-1">
            <a href="{{ url('admin/gastos') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0 {{ Request::is('admin/gastos') || Request::is('admin/gastos/*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-invoice-dollar fa-xl"></i>
                Gastos
            </a>
        </li>
        <li class="py-1">
            <a href="{{ url('admin/salidas') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0 {{ Request::is('admin/salidas') || Request::is('admin/salidas/*') ? 'active' : '' }}">
                <i class="fa-solid fa-dolly fa-xl"></i>
                Salidas
            </a>
        </li>
        <li class="py-1">
            <a href="{{ url('admin/ingresos') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0 {{ Request::is('admin/ingresos') || Request::is('admin/ingresos/*') ? 'active' : '' }}">
                <i class="fa-solid fa-people-carry-box fa-xl"></i>
                Ingresos
            </a>
        </li>
        <li class="py-1">
            <a href="{{ url('admin/detalleventa') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0 {{ Request::is('admin/detalleventa') || Request::is('admin/detalleventa/*') ? 'active' : '' }}">
                <i class="fa-solid fa-clock-rotate-left fa-xl"></i>
                Hitorial de ventas
            </a>
        </li>
        <li class="py-1">
            <a href="{{ url('admin/detallecompra') }}"
                class="btn btn-outline-danger text-start border-0 rounded-0 {{ Request::is('admin/detallecompra') || Request::is('admin/detallecompra/*') ? 'active' : '' }}">
                <i class="fa-solid fa-clock-rotate-left fa-xl"></i>
                Hitorial de compras
            </a>
        </li>
    </ul>
</nav>
