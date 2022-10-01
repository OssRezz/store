<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="hb btn btn-outline-danger colorRed">
            <i class="fas fa-bars" id="iconHb"></i>
        </button>
        <!-- Drop -->
        <div class="ml-auto">
            <form action="{{ url('user/logout') }}" method="POST">
                @csrf
                <div class="d-grid">
                    <button class="btn btn-outline-danger border-0 btn-sm">Cerrar
                        sesion <i class="fas fa-sign-out-alt"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</nav>
