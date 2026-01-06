<ul style="background-color: rgb(46, 13, 167);" class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            {{-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-0">
                    <i class="fas fa-user-md"></i>
                </div>
                
            </a> --}}

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
                    <i style="color:white;" class="fa fa-credit-card"></i>
                    <span style="color:white;">Paiements</span> 
                </a>
                <div id="collapsePaiements" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('effectuer un paiement')
                            <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('payment.create') }}">
                                Effectuer un paiement
                            </a>
                        @endcan
                        @can('voir un  paiement')
                            <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('payment.index') }}">
                                Liste des paiements 
                            </a>
                        @endcan
                    </div>
                </div>
            </li>

            

            {{--Advance--}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdvance"
                    aria-expanded="true" aria-controls="collapseAdvance">
                    <i style="color:white;" class="fa fa-credit-card" aria-hidden="true"></i>
                    <span style="color:white;">Avance sur salaire</span> 
                </a>
                <div id="collapseAdvance" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('liste avance sur salaire')
                            <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('advance.index') }}">
                                Liste des Avances
                            </a>
                        @endcan
                        @can('effectuer une avance sur salaire')
                            <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('advance.create')}}">
                                Effectuer une avance
                            </a>
                        @endcan
                        <hr style="color:rgb(46, 13, 167);">
                        <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('advance.history') }}">
                            Historique des remboursement
                        </a> 
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div style="color:white;" class="sidebar-heading">
               Agents et Notifications
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
                        @can('voir un  agent')
                            <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('employee.index') }}">
                                Liste des agents 
                            </a>
                        @endcan
                        @can('creer un  agent')
                            <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('employee.create') }}">
                                Ajouter un agent
                            </a>
                        @endcan
                        <hr style="color:rgb(46, 13, 167);">

                        @can('creer un membre de famille')
                            <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('family.create') }}">
                                Situation Famille
                            </a> 
                        @endcan
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNotifies"
                    aria-expanded="true" aria-controls="collapseNotifies">
                    <i style="color:white;" class="fa fa-envelope" aria-hidden="true"></i>
                    <span style="color:white;">Notifications</span> 
                </a>
                <div id="collapseNotifies" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('notify.payNotify') }}">
                            Notification des paiements
                        </a>
                        <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('notify.noteNotify') }}">
                            Notes internes
                        </a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div style="color:white;" class="sidebar-heading">
               Gestion des Fonctions
            </div>


            {{--Functions--}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
                    aria-expanded="true" aria-controls="collapseCategory">
                    <i style="color:white;" class="fa fa-cogs"></i>
                    <span style="color:white">Fonctions</span> 
                </a>
                <div id="collapseCategory" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('voir une categorie')
                            <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('function.index') }}">
                                Liste des Fonctions
                            </a>    
                        @endcan

                        @can('creer une categorie')
                            <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('function.create') }}">
                                Ajouter une Fonction
                            </a>
                        @endcan
                    </div>
                </div>
            </li>

            

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div style="color:white;" class="sidebar-heading">
               Déductions
            </div>

            {{--Deduction--}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDeduction"
                    aria-expanded="true" aria-controls="collapseDeduction">
                    <i style="color:white;" class="fa fa-cogs"></i>
                    <span style="color:white">Déductions sur salaire</span> 
                </a>
                <div id="collapseDeduction" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @can('voir les deduction')
                            <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('deduction.index') }}">
                                Rétenue sur salaire
                            </a>   
                        @endcan

                        @can('creer les deductio')
                            <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('deduction.create') }}">
                                Ajouter Rétenue sur salaire
                            </a>  
                        @endcan
                    </div>
                </div>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div style="color:white;" class="sidebar-heading">
               Utilisateurs
            </div>

            {{--Users--}}

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser"
                    aria-expanded="true" aria-controls="collapseUser">
                    <i style="color:white;" class="fas fa-user"></i>
                    <span style="color:white">Gestion utilisateurs</span> 
                </a>
                <div id="collapseUser" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        @can('voir un utilisateur')
                            <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('user.index') }}">
                                Liste des utilisateurs
                            </a>
                        @endcan

                        @can('creer un utilisateur')
                            <a style="color:rgb(46, 13, 167);" class="collapse-item" href="{{ route('user.create') }}">
                                Ajouter un utilisateur
                            </a>
                        @endcan
                    </div>
                </div>
            </li>


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>