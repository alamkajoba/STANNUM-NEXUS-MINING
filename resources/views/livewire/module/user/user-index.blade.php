<div>
    @if (session()->has('success'))
        <div id="alert-success" 
            class="alert alert-success fade show text-center shadow-lg"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            {{ session('success') }}
        </div>
    @endif
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i style="color:rgb(0, 0, 0);" class="fas fa-fw fa-users"></i>
            Gestion du personnel administratif
        </h1>
        <div class="d-none d-sm-inline-block shadow-sm">
            <input wire:model.live="search" class="form-control" type="text" placeholder="Rechercher...">
        </div>
    </div>

    {{-- table --}}
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100px" cellspacing="0">
                
                    
                <thead>
                    <tr style="background-color: rgb(7, 7, 99)" class="text-white">
                        <th>n</th>
                        <th>Nom</th>
                        <th>Fonction</th>
                        <th colspan="1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($user as $users)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{ $users->name }}</td>
                            <td>{{ $users->getRoleNames()->first(); }}</td>
                            <td>
                                {{-- @can('peut assigner des permissions') --}}
                                    <a href="{{ route('permission.assign', $users->id)}}" style="background-color: rgb(2, 150, 9)" class="btn text-white">Assinger permissions</a>
                                {{-- @endcan --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-2.5 text-danger whitespace-nowrap text">
                                Oups! Aucun Produit trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>  
        {{-- paginate --}}
        <div class="mt-4">
            {{$user->links()}}
        </div>
    </div>  
</div>  

