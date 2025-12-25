<div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i style="color:rgb(0, 0, 0);" class="fas fa-fw fa-users"></i>
            Retenues sur salaire en pourcentage
        </h1>
        <div>
            <a href="{{ route('deduction.index')}}" style="background-color: rgb(46, 13, 167);" class="btn text-white">Voir la liste</a>
        </div>
    </div>

    {{-- NOTIFY --}}
    @if (session()->has('danger'))
        <div id="alert-success" 
            class="alert alert-danger fade show text-center"
            role="alert"
            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
                    z-index: 9999; width: fit-content; min-width: 500px;">
            {{ session('danger') }}
        </div>
    @endif
    {{-- table --}}
    <div class="justify-content-between card-header">
        <form wire:submit="updateDeduction">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <label for="CNSS">CNSS</label>
                        <input 
                            id="CNSS"
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="CNSS"
                        >
                        @error('CNSS')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

                        <label for="INPP">INPP</label>
                        <input 
                            id="INPP"
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="INPP"
                        >
                        @error('INPP')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

                        <label for="IPR">Impot Professionnel sur Remuneration</label>
                        <input 
                            id="IRP"
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="IPR"
                        >
                        @error('IPR')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

                        <label for="workDay">ONEM</label>
                        <input 
                            id="ONEM"
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="ONEM"
                        >
                        @error('ONEM')
                            <span class="text-danger">Indamnite transport</span>
                        @enderror

                        <label for="deductionSalary">Retenue sur salaire</label>
                        <input 
                            id="deductionSalary"
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="deductionSalary"
                        >
                        @error('deductionSalary')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror

                        <label for="refundAmount">Taux remboursement avance sur salaire</label>
                        <input 
                            id="refundAmount"
                            class="form-control"
                            type="text"
                            placeholder=""
                            wire:model="refundAdvanceAmount"
                        >
                        @error('refundAmount')
                            <span class="text-danger">Verifiez ce champ</span>
                        @enderror
                    </div>

                    <div class="col-md-6">

        
                        
                    </div>
                </div>
                <div>
                    <button type="submit" style="background-color: rgb(46, 13, 167);" class="btn text-white py-2 my-3">
                        Valider
                    </button>
                </div>
            </div>
        </form>
    </div>  
</div>



