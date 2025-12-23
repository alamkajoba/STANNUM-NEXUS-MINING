<div class="bulletin-container bg-white">
    <div class="content-wrapper">
        <div class="header-section">
            <div class="logo-area">
                <img src="{{asset('img/logo.jfif')}}" alt="Logo">
            </div>
            <div class="company-details">
                <h6 class="fw-bold m-0">Stannum Nexus Mining sarl</h6>
                <p class="m-0">N° TVA: </p>
                <p class="m-0">NF: A2434832N</p>
                <p class="m-0">RCCM: CD/KNG/RCCM/24-B-02002</p>
                <p class="m-0 text-primary">www.stannum-nexus.com</p>
            </div>
        </div>

        <div class="bulletin-title text-center py-2 fw-bold">
            Bulletin de paie du mois de {{ $payment->motif }}
        </div>

        {{-- Indentification --}}
        <table class="table-info-section w-100">
            <tr>
                <td width="50%" class="p-0 border-end border-dark">
                    <table class="w-100 inner-table">
                        <tr><td width="35%">Matricule :</td><td class="fw-bold">{{ $payment->employee->matricule }}</td></tr>
                        <tr><td>Nom :</td><td class="fw-bold text-uppercase">{{ $payment->employee->lastName }} {{ $payment->employee->middleName }} {{ $payment->employee->firstName }}</td></tr>
                        <tr><td>Catégorie :</td><td>{{ $payment->employee?->category?->nameCategory }}</td></tr>
                        <tr><td>Fonction :</td><td>{{ $payment->employee->jobTitle }}</td></tr>
                        <tr><td>Affectation :</td><td>{{ $payment->employee->affectation }}</td></tr>
                        <tr><td>Num. Compte :</td><td>-</td></tr>
                        <tr><td>Nombre enfant :</td><td>-</td></tr>
                    </table>
                </td>
                <td width="50%" class="p-0">
                    <table class="w-100 inner-table">
                        <tr><td>Salaire de base :</td><td class="fw-bold">USD {{$payment->employee?->category?->amount}}</td></tr>
                        <tr><td>Indemnite Chairman :</td><td>-</td></tr>
                        <tr><td>Annuité :</td><td>-</td></tr>
                        <tr><td>Indemnite Rétention :</td><td></td></tr>
                        <tr><td>Jours du mois :</td><td>{{ $payment->employee?->category?->workDay }}</td></tr>
                        <tr><td>Jours Présent :</td><td>{{ $actifDay }}</td></tr>
                        <tr><td>Date d'engagement:</td><td>-</td></tr>
                    </table>
                </td>
            </tr>
        </table>

        {{-- Base et Primes --}}
        <table class="table-main w-100">
            <thead>
                <tr>
                    <th width="25%">Remunération</th>
                    <th width="10%">Jr/Hr</th>
                    <th width="15%">Montant</th>
                    <th width="25%">Arriérés</th>
                    <th width="10%">Jr/Hr</th>
                    <th width="15%">Montant</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Base Mensuelle :</td><td class="text-center">{{ $payment->employee?->category?->dayAmount }}</td><td class="text-end">USD {{$payment->employee?->category?->amount }}</td>
                    <td>Base Mensuelle :</td><td></td><td></td>
                </tr>
                <tr>
                    <td>Heures Sup. :</td><td class="text-center">{{ $payment->overtimes }}</td><td class="text-end">USD {{ $payment->overtimesPay}}</td>
                    <td>Heures Sup :</td><td></td><td></td>
                </tr>
                <tr>
                    <td>Prime d'assiduité :</td><td class="text-center">{{ $payment->assudityBonus }}</td><td class="text-end">USD {{ $payment->assudityBonus }}</td>
                    <td>Prime d'assiduité :</td><td></td><td></td>
                </tr>
                <tr>
                    <td>Prime de risque :</td><td class="text-center">{{ $payment->riskBonus }}</td><td class="text-end">USD {{ $payment->riskBonus }}</td>
                    <td>Prime de risque :</td><td></td><td></td>
                </tr>
                <tr>
                    <td>Prime de rendement :</td><td class="text-center">{{ $payment->performanceBonus }}</td><td class="text-end">USD {{ $payment->performanceBonus }}</td>
                    <td>Prime de rendement :</td><td></td><td></td>
                </tr>
                <tr style="background-color: rgb(41, 5, 88)" class="total-row text-white fw-bold">
                    <td width="25%" class="text-end">Total</td><td colspan="2" class="text-end ">USD {{ $totalBonus}}</td>
                    <td width="25%" class="text-end">Remunération Brute :</td><td colspan="2" class="text-end">USD {{ $totalBonus}}</td>
                </tr>
            </tbody>
        </table>


        {{-- Avantage et deduction --}}
        <table class="table-split w-100">
            <tr>
                <td width="50%" class="p-0 align-top">
                    <table class="w-100 inner-table-bordered">
                        <thead><tr class="bg-gray"><th width="50%">Avantage Social</th><th width="20%">Jr</th><th>Montant</th></tr></thead>
                        <tbody>
                            <tr><td>Logement :</td><td class="text-end"></td><td class="text-end">USD {{$payment->employee?->category?->housing}}</td></tr>
                            <tr><td>Transport :</td><td class="text-center"></td><td class="text-end">USD {{$payment->employee?->category?->transportationCost}}</td></tr>
                            <tr><td>Allocation familliale :</td><td class="text-center"></td><td class="text-end">USD {{$payment->employee?->category?->familialAllocation}}</td></tr>
                            <tr class="fw-bold bg-gray"><td colspan="2">Total Avantages</td><td class="text-end">USD {{$totalSocialBonus}}</td></tr>
                            
                            
                        </tbody>
                    </table>
                </td>
                <td width="50%" class="p-0 align-top">
                    <table class="w-100 inner-table-bordered">
                        <thead><tr class="bg-gray"><th width="50%">Déduction</th><th width="20%">Taux</th><th>Montant</th></tr></thead>
                        <tbody>
                            <tr><td>Crédit :</td><td class="text-end">{{$deduction->refundAdvanceAmount}}%</td><td class="text-end">USD 0</td></tr>
                            <tr><td>CNSS :</td><td class="text-end">{{$deduction->CNSS}}%</td><td class="text-end">USD {{$CNSS}}</td></tr>
                            <tr><td>INPP :</td><td class="text-end">{{$deduction->INPP}}%</td><td class="text-end">USD {{$INPP}}</td></tr>
                            <tr><td>ONEM :</td><td class="text-end">{{$deduction->ONEM}}%</td><td class="text-end">USD {{$ONEM}}</td></tr>
                            <tr><td>IPR :</td><td class="text-end">{{$deduction->IPR}}%</td><td class="text-end">USD {{$IPR}}</td></tr>
                            <tr><td>Retenue :</td><td class="text-end">{{$deduction->deductionSalary}} %</td><td class="text-end">USD {{$deductionSalary}}</td></tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <table class="table-main w-100">
            <tbody>
                <tr style="background-color: rgb(41, 5, 88)" class="total-row text-white fw-bold">
                    <td colspan="2" width="35%" class="text-end">Salaire brute</td><td class="text-end ">USD {{$brutSalary}}</td>
                    <td colspan="2" width="35%" class="text-end">Total déduction :</td><td class="text-end">USD {{$totalDeduction}}</td>
                </tr>
            </tbody>
        </table>
        <table class="table-info-section w-100 mt-2">
            <td width="50%" class="p-0 align-top">
                <table class="w-100 inner-table-bordered">
                    
                    <tbody class="text-dark">
                        <tr><td colspan="2" width="70%">Salaire brute :</td><td class="text-end">USD {{$brutSalary}}</td></tr>
                        <tr><td colspan="2" width="70%">Total déduction  :</td><td class="text-end">USD {{$totalDeduction}}</td></tr>
                        <tr><td colspan="2" width="70%">Salaire net :</td><td class="text-end">USD {{$totalSalary}}</td></tr>
                    </tbody>
                </table>
            </td>
            <td width="50%" class="inner-table-bordered"></td>
        </table>

    <div class="bottom-legal-info border-top border-dark pt-2">
        <div class="d-flex justify-content-between px-2">
            <span>Numéro CNSS : ---------------------------------------------</span>
            <span>Email : ----------------------------------------</span>
        </div>
        <div class="d-flex justify-content-between px-2 mt-5">
            <span>SIGNATURE POUR RECEPTION</span>
            <span>LA DIRECTION</span>
        </div>
        {{-- <div class="text-center mt-2 pb-2">
            <strong>Ceci est un bulletin généré par l'ordinateur et la signature n'est pas requise</strong>
        </div> --}}
    </div>
</div>

