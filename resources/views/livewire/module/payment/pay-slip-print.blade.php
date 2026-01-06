<div class="bulletin-container bg-white">
    <div class="content-wrapper">
        <div class="header-section">
            <div class="logo-area">
                <img src="{{asset('img/finallogo.jpeg')}}" alt="Logo">
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
            Bulletin de paie du mois de {{ ucfirst(\Carbon\Carbon::parse($payment?->motif)->locale('fr')->translatedFormat('F Y')) }}
        </div>

        {{-- Indentification --}}
        <table class="table-info-section w-100">
            <tr>
                <td width="50%" class="p-0 border-end border-dark">
                    <table class="w-100 inner-table">
                        <tr><td width="35%">Matricule :</td><td class="fw-bold">{{ $payment?->employee?->enrollment?->matricule }}</td></tr>
                        <tr><td>Nom :</td><td class="fw-bold text-uppercase">{{ $payment?->employee?->lastName }} {{ $payment?->employee?->middleName }} {{ $payment?->employee?->firstName }}</td></tr>
                        <tr><td>Fonction :</td><td>{{ $payment?->slipPrint['function'] }}</td></tr>
                        <tr><td>Section :</td><td>{{ $payment?->slipPrint['section'] }}</td></tr>
                        <tr><td>Département :</td><td>{{ $payment?->slipPrint['department'] }}</td></tr>
                        <tr><td>Site :</td><td>{{ $payment?->slipPrint['site'] }}</td></tr>
                        <tr><td>Num. Compte :</td><td>{{ $payment?->slipPrint['acountNumber']}}</td></tr>
                        <tr><td>Nombre enfant :</td><td>{{ $payment?->slipPrint['childCount']}}</td></tr>
                    </table>
                </td>
                <td width="50%" class="p-0">
                    <table class="w-100 inner-table">
                        <tr><td>Catégorie profess :</td><td class="fw-bold">{{ $payment?->slipPrint['professionalCategory']}}-{{$payment?->slipPrint['echelon'] }}</td></tr>
                        <tr><td>Salaire de base :</td><td class="fw-bold">  {{ $payment?->slipPrint['baseSalary']  }}</td></tr>
                        <tr><td>Indemnite Chairman :</td><td>-</td></tr>
                        <tr><td>Annuité :</td><td>-</td></tr>
                        <tr><td>Indemnite Rétention :</td><td>-</td></tr>
                        <tr><td>Jours du mois :</td><td>{{ $payment?->slipPrint['workDay'] }}</td></tr>
                        <tr><td>Absence :</td><td>{{ $payment?->slipPrint['abscence'] }}</td></tr>
                        <tr><td>Date d'engagement:</td><td>{{ ucfirst(\Carbon\Carbon::parse($payment?->employee?->enrollment->startDate)->locale('fr')->translatedFormat('F Y')) }}</td></tr>
                    </table>
                </td>
            </tr>
        </table>

        {{-- Base et Primes --}}
        <table class="table-main w-100">
            <thead>
                <tr style="background-color: rgb(235, 82, 82)" class="text-dark">
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
                    <td>Heures Sup. :</td><td class="text-center">{{ $payment?->slipPrint['overtimes'] }}</td><td class="text-end">  {{ $payment?->slipPrint['overtimesPay']}}</td>
                    <td>Heures Sup :</td><td></td><td></td>
                </tr>
                <tr>
                    <td>Prime d'assiduité :</td><td class="text-center">-</td><td class="text-end">  {{ $payment?->slipPrint['assuduity']  }}</td>
                    <td>Prime d'assiduité :</td><td></td><td></td>
                </tr>
                <tr>
                    <td>Prime de risque :</td><td class="text-center">-</td><td class="text-end">  {{ $payment?->slipPrint['risk']  }}</td>
                    <td>Prime de risque :</td><td></td><td></td>
                </tr>
                <tr>
                    <td>Prime de rendement :</td><td class="text-center">-</td><td class="text-end">  {{ $payment?->slipPrint['performance']  }}</td>
                    <td>Prime de rendement :</td><td></td><td></td>
                </tr>
                <tr>
                    <td>Jour incapacité :</td><td class="text-center">{{ $payment?->slipPrint['justify'] }}</td><td class="text-end">  {{$payment?->slipPrint['justifyPay']  }}</td>
                    <td></td><td></td><td></td>
                </tr>
                <tr style="background-color: rgb(129, 129, 129)" class="text-dark fw-bold">
                    <td width="25%" class="text-end">Total</td><td colspan="2" class="text-end ">  {{ $payment?->slipPrint['totalAddiction'] }}</td>
                    <td width="25%" class="text-end">Remunération Brute :</td><td colspan="2" class="text-end">  {{ $payment?->slipPrint['brutDue'] }}</td>
                </tr>
            </tbody>
        </table>


        {{-- Avantage et deduction --}}
        <table class="w-100" style="border-collapse: collapse;">
            <tr>
                <td width="50%" class="p-0 align-top">
                    <table class="w-100 inner-table-bordered">
                        <thead><tr style="background-color: rgb(235, 82, 82)" class="total-row text-dark fw-bold"><th width="50%">Avantage Social</th><th width="20%">Jr</th><th>Montant</th></tr></thead>
                        <tbody>
                            <tr><td>Logement :</td><td class="text-center">-</td><td class="text-end">  {{$payment?->slipPrint['housing'] }}</td></tr>
                            <tr><td>Transport :</td><td class="text-center">-</td><td class="text-end">  {{$payment?->slipPrint['transportation'] }}</td></tr>
                            <tr><td>Allocation familliale :</td><td class="text-center">-</td><td class="text-end">  {{$payment?->slipPrint['familialAllocation'] }}</td></tr>
                            <tr style="background-color: rgb(129, 129, 129)" class="text-dark fw-bold"><td colspan="2">Total Avantages</td><td class="text-end">  {{$payment?->slipPrint['totalAdvantage'] }}</td></tr>
                            
                            
                        </tbody>
                    </table>
                </td>
                <td width="50%" class="p-0 align-top">
                    <table class="w-100 inner-table-bordered">
                        <thead><tr style="background-color: rgb(235, 82, 82)" class="total-row text-dark fw-bold"><th width="50%">Déduction</th><th width="20%">Taux</th><th>Montant</th></tr></thead>
                        <tbody>
                            <tr><td>Crédit :</td><td class="text-end">{{$payment?->slipPrint['toRefundAdvance']}}%</td><td class="text-end">  {{$payment?->slipPrint['toRefundAdvance'] }}</td></tr>
                            <tr><td>CNSS :</td><td class="text-end">{{$payment?->slipPrint['CNSS']}}%</td><td class="text-end">  {{$payment?->slipPrint['CNSSAmount'] }}</td></tr>
                            <tr><td>INPP :</td><td class="text-end">{{$payment?->slipPrint['INPP']}}%</td><td class="text-end">  {{$payment?->slipPrint['INPPAmount'] }}</td></tr>
                            <tr><td>ONEM :</td><td class="text-end">{{$payment?->slipPrint['ONEM']}}%</td><td class="text-end">  {{$payment?->slipPrint['ONEMAmount'] }}</td></tr>
                            <tr><td>IPR :</td><td class="text-end">{{$payment?->slipPrint['IPR']}}%</td><td class="text-end">  {{$payment?->slipPrint['IPRAmount'] }}</td></tr>
                            <tr><td>Retenue :</td><td class="text-end">{{$payment?->slipPrint['salaryDeduction']}} %</td><td class="text-end">  {{$payment?->slipPrint['salaryDeductionAmount'] }}</td></tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <table class="table-info-section inner-table-bordered w-100">
            <tbody>
                <tr style="background-color: rgb(129, 129, 129)" class="text-dark fw-bold">
                    <td colspan="2" width="35%" class="text-end">Salaire brute</td><td class="text-end ">{{$payment?->slipPrint['brutSalary'] }}</td>
                    <td colspan="2" width="35%" class="text-end">Total déduction :</td><td class="text-end">{{$payment?->slipPrint['totalDeduction'] }}</td>
                </tr>
            </tbody>
        </table>
        <table class="table-info-section w-100 mt-2">
            <td width="50%" class="p-0 align-top">
                <table class="w-100 inner-table-bordered">
                    
                    <tbody class="text-dark">
                        <tr><td colspan="2" width="70%">Salaire brute :</td><td class="text-end">{{$payment?->slipPrint['brutSalary'] }}</td></tr>
                        <tr><td colspan="2" width="70%">Total déduction  :</td><td class="text-end">{{$payment?->slipPrint['totalDeduction'] }}</td></tr>
                        <tr><td colspan="2" width="70%">Salaire net :</td><td class="text-end">{{$payment?->netSalary->formatTo('en_US')}}</td></tr>
                    </tbody>
                </table>
            </td>
            <td width="50%" class="inner-table-bordered"></td>
        </table>

    <div class="bottom-legal-info border-top border-dark pt-2">
        <div class="d-flex justify-content-between px-2">
            <span>Numéro CNSS : {{$payment?->employee?->enrollment?->cnssNumber}}</span>
            <span>Email : {{$payment?->employee?->enrollment?->proMail}}</span>
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

