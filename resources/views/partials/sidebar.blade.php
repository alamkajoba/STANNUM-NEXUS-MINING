<ul style="background-color: rgb(46, 13, 167);" class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-0">
                    {{-- <i class="fas fa-user-md"></i> --}}
                </div>
                <img src="{{asset('img/stannumlogo.jpeg')}}" height="50px" width="150px" alt="">
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard.dashboard')}}">
                    <i style="color:white;" class="fas fa-home"></i>
                    <span style="color:white;">Acceuil</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div style="color:white;" class="sidebar-heading">
                Paiements et avances
            </div>

            {{--Paiements--}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePaiements"
                    aria-expanded="true" aria-controls="collapsePaiements">
                    <i style="color:white;" class="fas fa-currency"></i>
                    <span style="color:white;">Paiements</span> 
                </a>
                <div id="collapsePaiements" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('payment.create') }}">
                            Effectuer un paiement
                        </a>
                        <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('payment.index') }}">
                            Liste des paiements 
                        </a>
                    </div>
                </div>
            </li>

            {{--Advance--}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdvance"
                    aria-expanded="true" aria-controls="collapseAdvance">
                    <i style="color:white;" class="fas fa-currency"></i>
                    <span style="color:white;">Avance sur salaire</span> 
                </a>
                <div id="collapseAdvance" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('advance.index') }}">
                            Liste des Avances
                        </a>
                        <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('advance.create')}}">
                            Effectuer une avance
                        </a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div style="color:white;" class="sidebar-heading">
               Gestion des Agents
            </div>

            {{--Employee--}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployee"
                    aria-expanded="true" aria-controls="collapseEmployee">
                    <i style="color:white;" class="fas fa-users"></i>
                    <span style="color:white;">Agents</span> 
                </a>
                <div id="collapseEmployee" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('employee.index') }}">
                            Liste des agents 
                        </a>
                        <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('employee.create') }}">
                            Ajouter un agent
                        </a>
                        <hr style="color:rgb(46, 13, 167);">

                        <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('family.create') }}">
                            Situation Famille
                        </a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div style="color:white;" class="sidebar-heading">
               Gestion des Categories
            </div>


            {{--Category--}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
                    aria-expanded="true" aria-controls="collapseCategory">
                    <i style="color:white;" class="fas fa-users"></i>
                    <span style="color:white">Categories</span> 
                </a>
                <div id="collapseCategory" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('category.index') }}">
                            Liste des categories
                        </a>
                        <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('category.create') }}">
                            Ajouter une categorie
                        </a>
                    </div>
                </div>
            </li>

            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div style="color:white;" class="sidebar-heading">
               Retenues
            </div>

            {{--Deduction--}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDeduction"
                    aria-expanded="true" aria-controls="collapseDeduction">
                    <i style="color:white;" class="fas fa-users"></i>
                    <span style="color:white">Retenue sur salaire</span> 
                </a>
                <div id="collapseDeduction" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('deduction.index') }}">
                            Retenue sur salaire
                        </a>

                        <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('deduction.create') }}">
                            Ajouter Retenue sur salaire
                        </a>
                    </div>
                </div>
            </li>


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>