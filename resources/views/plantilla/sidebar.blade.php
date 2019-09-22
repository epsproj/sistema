<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li @click="menu=0" class="nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon fa fa-desktop"></i> Escritorio
                </a>
            </li>
            <li class="nav-title bg-dropbox">Modulo1</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-university"></i>nivel1</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=1" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-database"></i>Tipo Obra</a>
                    </li>
                    <li @click="menu=2" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-users"></i>submodulo</a>
                    </li>
                    <li @click="menu=3" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-columns"></i>submodulo</a>
                    </li>
                    <li @click="menu=4" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-book"></i>submodulo</a>
                    </li>
                </ul>
            </li>
            <li class="nav-title bg-tumblr">Modulo2</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-sign-out"></i>submodulo</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=5" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa  fa-share"></i>Estado Factibilidad</a>
                    </li>
                </ul>
            </li>
            <li @click="menu=6" class="nav-item">
                <a class="nav-link" href="#"><i class="nav-icon fa fa-user-circle-o"></i>submodulo</a>
            </li>
            <li class="nav-title bg-google-plus">modulo3</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-plus-square"></i>submodulo</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=7" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-shopping-cart"></i>submodulo</a>
                    </li>
                    <li @click="menu=8" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-address-book"></i>submodulo</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-universal-access"></i>submodulo</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=9" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-briefcase"></i>submodulo</a>
                    </li>
                    <li @click="menu=10" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-link"></i>submodulo</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fa fa-line-chart"></i>submodulo</a>
                <ul class="nav-dropdown-items">
                    <li @click="menu=11" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-bar-chart"></i>submodulo</a>
                    </li>
                    <li @click="menu=12" class="nav-item">
                        <a class="nav-link" href="#"><i class="nav-icon fa fa-area-chart"></i>submodulo</a>
                    </li>
                </ul>
            </li>
            <li class="nav-title bg-facebook">modulo4</li>
            <li @click="menu=13" class="nav-item">
                <a class="nav-link" href="#"><i class="nav-icon fa fa-info-circle"></i>Ayuda <span class="badge badge-light">PDF</span></a>
            </li>
            <li @click="menu=14" class="nav-item">
                <a class="nav-link" href="#"><i class="nav-icon fa fa-question-circle"></i>Acerca de...</a>
            </li>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
