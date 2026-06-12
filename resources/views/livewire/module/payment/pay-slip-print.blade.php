<div>
<style>
    .bulletin-container {
        width: 21cm;
        height: 29.7cm;
        margin: 0 auto;
        padding: 0;
        background-color: white;
        font-family: 'Arial', sans-serif;
        font-size: 11px;
        color: #333;
    }
    
    .content-wrapper {
        padding: 0.5cm;
        height: 100%;
    }
    
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.3cm;
        border-bottom: 2px solid #333;
        padding-bottom: 0.2cm;
    }
    
    .logo-area {
        width: 15%;
    }
    
    .logo-area img {
        max-width: 100%;
        height: auto;
    }
    
    .company-details {
        flex: 1;
        margin-left: auto;
        margin-right: 0;
        padding-right: 0.3cm;
        text-align: right;
    }
    
    .company-details h6 {
        margin: 0;
        font-size: 14px;
        font-weight: bold;
    }
    
    .company-details p {
        margin: 2px 0;
        font-size: 10px;
    }
    
    .bulletin-title {
        text-align: center;
        font-weight: bold;
        font-size: 13px;
        margin: 0.2cm 0;
        padding: 0.15cm 0;
        border-bottom: 1px solid #666;
    }
    
    .table-info-section {
        width: 100%;
        margin: 0.3cm 0;
        border-collapse: collapse;
    }
    
    .table-info-section td {
        padding: 0;
        vertical-align: top;
    }
    
    .inner-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .inner-table tr {
        height: 1.4em;
    }
    
    .inner-table td {
        padding: 3px 4px;
        border-bottom: 1px solid #ddd;
        font-size: 10px;
    }
    
    .inner-table tr:last-child td {
        border-bottom: 1px solid #333;
    }
    
    .table-main {
        width: 100%;
        margin: 0.3cm 0;
        border-collapse: collapse;
        border: 1px solid #333;
    }
    
    .table-main thead {
        background-color: #eb5252;
        color: #333;
        font-weight: bold;
    }
    
    .table-main th {
        padding: 5px;
        text-align: left;
        font-size: 10px;
        border: 1px solid #333;
    }
    
    .table-main tbody tr {
        height: 1.6em;
    }
    
    .table-main td {
        padding: 3px 5px;
        border: 1px solid #ddd;
        font-size: 10px;
    }
    
    .table-main tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }
    
    .table-main tbody tr:last-child {
        background-color: #818181;
        color: #333;
        font-weight: bold;
        border: 1px solid #333;
    }
    
    .table-main tbody tr:last-child td {
        border: 1px solid #333;
    }
    
    .inner-table-bordered {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #333;
    }
    
    .inner-table-bordered thead {
        background-color: #eb5252;
        color: #333;
        font-weight: bold;
    }
    
    .inner-table-bordered th {
        padding: 4px;
        text-align: left;
        font-size: 10px;
        border: 1px solid #333;
    }
    
    .inner-table-bordered td {
        padding: 3px 5px;
        border: 1px solid #ddd;
        font-size: 10px;
    }
    
    .inner-table-bordered tbody tr {
        height: 1.4em;
    }
    
    .inner-table-bordered tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }
    
    .inner-table-bordered tbody tr.total-row {
        background-color: #818181;
        color: #333;
        font-weight: bold;
        border: 1px solid #333;
    }
    
    .inner-table-bordered tbody tr.total-row td {
        border: 1px solid #333;
    }
    
    .summary-row {
        background-color: #c8c8c8;
        font-weight: bold;
        border-top: 2px solid #333;
        border-bottom: 2px solid #333;
    }
    
    .dashed-separator {
        border-top: 2px dashed #666;
    }
    
    .net-salary-row {
        background-color: #dcffdc;
        color: #28a745;
        font-weight: bold;
    }
    
    .bottom-legal-info {
        border-top: 2px solid #333;
        padding-top: 0.3cm;
        margin-top: 0.3cm;
        font-size: 9px;
    }
    
    .signature-section {
        display: flex;
        justify-content: space-between;
        margin-top: 1cm;
        padding: 0 0.5cm;
    }
    
    .signature-line {
        text-align: center;
        width: 35%;
    }
    
    .signature-line-text {
        border-top: 1px solid #333;
        padding-top: 0.1cm;
        min-height: 0.8cm;
    }
    
    @media print {
        body {
            margin: 0;
            padding: 0;
        }
        .bulletin-container {
            width: 21cm;
            height: 29.7cm;
            page-break-after: always;
            margin: 0;
        }
        .print-hidden {
            display: none !important;
        }
    }
</style>

<!-- @if(session()->has('success'))
    <div id="alert-success" class="alert alert-success fade show text-center"
        role="alert"
        style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
                z-index: 9999; width: auto; min-width: 320px; max-width: 90%;">
        {{ session('success') }}
    </div>
@endif -->
@if(session()->has('danger'))
    <div id="alert-danger" class="alert alert-danger fade show text-center"
        role="alert"
        style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
                z-index: 9999; width: auto; min-width: 320px; max-width: 90%;">
        {{ session('danger') }}
    </div>
@endif

<div class="flex justify-between items-center mb-4 print:hidden" style="width: 21cm; margin: 20px auto 0 auto;">
    <button 
        onclick="window.print()" 
        style="background-color: rgb(46, 13, 167);" 
        class="btn text-white py-2 px-4 my-3 rounded shadow"
    >
        <i class="fas fa-print mr-2"></i> IMPRIMER LE BULLETIN
    </button>

    <a 
        href="{{ route('payment.create')}}"
        style="background-color: rgb(86, 92, 102);" 
        class="btn text-white py-2 px-4 my-3 rounded shadow"
    >
        <i class="fas fa-arrow-left mr-2"></i> Retour
    </a>
</div>

<div class="bulletin-container bg-white">
    <div class="content-wrapper">
        <div class="header-section">
            <div class="logo-area">
                <img src="{{asset('img/thot1.jpg')}}" alt="Logo">
            </div>
            <div class="company-details">
                <h6 class="fw-bold m-0">Thot-Engineering</h6>
                <p class="m-0">N° TVA: </p>
                <p class="m-0">NF: </p>
                <p class="m-0">RCCM: 2</p>
                <p class="m-0 text-primary">www.thot-engineering.com</p>
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
                        <tr><td>Salaire de base :</td><td class="fw-bold">  {{ number_format(data_get($payment, 'slipPrint.baseSalary', 0), 2, ',', '.') }}</td></tr>
                        <tr><td>Indemnité Chairman :</td><td>-</td></tr>
                        <tr><td>Annuité :</td><td>-</td></tr>
                        <tr><td>Indemnité Rétention :</td><td>-</td></tr>
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
                <tr style="background-color: rgb(209, 154, 95)" class="text-dark">
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
                    <td>Heures Sup. :</td><td class="text-center">{{ $payment?->slipPrint['overtimes'] }}</td><td class="text-end">  {{ number_format($payment?->slipPrint['overtimesPay'], 2, ',', '.') }}</td>
                    <td>Heures Sup :</td><td></td><td></td>
                </tr>
                <tr>
                    <td>Prime d'assiduité :</td><td class="text-center">-</td><td class="text-end">  {{ number_format($payment?->slipPrint['assuduity'], 2, ',', '.') }}</td>
                    <td>Prime d'assiduité :</td><td></td><td></td>
                </tr>
                <tr>
                    <td>Prime de risque :</td><td class="text-center">-</td><td class="text-end">  {{ number_format($payment?->slipPrint['risk'], 2, ',', '.') }}</td>
                    <td>Prime de risque :</td><td></td><td></td>
                </tr>
                <tr>
                    <td>Prime de rendement :</td><td class="text-center">-</td><td class="text-end">  {{ number_format($payment?->slipPrint['performance'], 2, ',', '.') }}</td>
                    <td>Prime de rendement :</td><td></td><td></td>
                </tr>
                <tr>
                    <td>Jour incapacité :</td><td class="text-center">{{ $payment?->slipPrint['justify'] }}</td><td class="text-end">  {{ number_format($payment?->slipPrint['justifyPay'], 2, ',', '.') }}</td>
                    <td></td><td></td><td></td>
                </tr>
                <tr style="background-color: rgb(129, 129, 129)" class="text-dark fw-bold">
                    <td width="25%" class="text-end">Total</td><td colspan="2" class="text-end ">  {{ number_format($payment?->slipPrint['totalAddiction'], 2, ',', '.') }}</td>
                    <td width="25%" class="text-end">Remunération Brute :</td><td colspan="2" class="text-end">  {{ number_format($payment?->slipPrint['brutDue'], 2, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>


        {{-- Avantage et deduction --}}
        <div style="margin: 0.3cm 0;">
            <table class="w-100" style="border-collapse: collapse;">
                <tr>
                    <td width="50%" class="p-0 align-top" style="padding-right: 0.1cm;">
                        <table class="w-100 inner-table-bordered">
                            <thead><tr style="background-color: rgb(209, 154, 95)" class="total-row text-dark fw-bold"><th width="50%">Avantage Social</th><th width="20%">Jr</th><th>Montant</th></tr></thead>
                            <tbody>
                                <tr><td>Logement :</td><td class="text-center">-</td><td class="text-end">  {{ number_format($payment?->slipPrint['housing'], 2, ',', '.') }}</td></tr>
                                <tr><td>Transport :</td><td class="text-center">-</td><td class="text-end">  {{ number_format($payment?->slipPrint['transportation'], 2, ',', '.') }}</td></tr>
                                <tr><td>Allocation familliale :</td><td class="text-center">-</td><td class="text-end">  {{ number_format($payment?->slipPrint['familialAllocation'], 2, ',', '.') }}</td></tr>
                                <tr style="background-color: rgb(129, 129, 129)" class="text-dark fw-bold"><td colspan="2">Total Avantages</td><td class="text-end">  {{ number_format($payment?->slipPrint['totalAdvantage'], 2, ',', '.') }}</td></tr>
                            </tbody>
                        </table>
                    </td>
                    <td width="50%" class="p-0 align-top" style="padding-left: 0.1cm;">
                        <table class="w-100 inner-table-bordered">
                            <thead><tr style="background-color: rgb(209, 154, 95)" class="total-row text-dark fw-bold"><th width="50%">Déduction</th><th width="20%">Taux</th><th>Montant</th></tr></thead>
                            <tbody>
                                @if($payment?->slipPrint['refundAdvanceAmount'] > 0)
                                    <tr><td>Remboursement Crédit :</td><td class="text-end">{{$payment?->slipPrint['toRefundAdvance']}}%</td><td class="text-end">{{ number_format($payment?->slipPrint['refundAdvanceAmount'], 2, ',', '.') }}</td></tr>
                                @endif
                                <tr><td>CNSS :</td><td class="text-end">{{$payment?->slipPrint['CNSS']}}%</td><td class="text-end">{{ number_format($payment?->slipPrint['CNSSAmount'], 2, ',', '.') }}</td></tr>
                                <tr><td>INPP :</td><td class="text-end">{{$payment?->slipPrint['INPP']}}%</td><td class="text-end">{{ number_format($payment?->slipPrint['INPPAmount'], 2, ',', '.') }}</td></tr>
                                <tr><td>ONEM :</td><td class="text-end">{{$payment?->slipPrint['ONEM']}}%</td><td class="text-end">{{ number_format($payment?->slipPrint['ONEMAmount'], 2, ',', '.') }}</td></tr>
                                <tr><td>IPR :</td><td class="text-end">{{$payment?->slipPrint['IPR']}}%</td><td class="text-end">{{ number_format($payment?->slipPrint['IPRAmount'], 2, ',', '.') }}</td></tr>
                                <tr><td>Rétenue :</td><td class="text-end">{{$payment?->slipPrint['salaryDeduction']}}%</td><td class="text-end">{{ number_format($payment?->slipPrint['salaryDeductionAmount'], 2, ',', '.') }}</td></tr>
                                <tr style="background-color: rgb(129, 129, 129)" class="text-dark fw-bold"><td colspan="2">Total Déductions</td><td class="text-end">{{ number_format($payment?->slipPrint['totalDeduction'], 2, ',', '.') }}</td></tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <table class="table-info-section inner-table-bordered w-100 mt-3">
            <tbody class="text-dark">
                <tr class="summary-row">
                    <td colspan="2" width="70%" class="text-end">Salaire brute (Montant imposable)</td>
                    <td class="text-end">{{ number_format(data_get($payment, 'slipPrint.brutSalary', 0), 2, ',', '.') }} USD</td>
                </tr>
                <tr class="dashed-separator">
                    <td width="10%" class="text-center">-</td>
                    <td width="60%">Total déduction (CNSS + INPP + IPR + ONEM + Rétenue)</td>
                    <td class="text-end fw-bold" style="color: red;">{{ number_format(data_get($payment, 'slipPrint.totalDeduction', 0), 2, ',', '.') }} USD</td>
                </tr>
                <tr class="net-salary-row">
                    <td colspan="2" width="70%" class="text-end"> Salaire net (À payer)</td>
                    <td class="text-end">{{$payment?->netSalary->formatTo('en_US')}}</td>
                </tr>
            </tbody>
        </table>

        <div class="bottom-legal-info">
            <div class="d-flex justify-content-between px-2" style="margin-bottom: 0.2cm;">
                <span><strong>CNSS :</strong> {{$payment?->employee?->enrollment?->cnssNumber}}</span>
                <span><strong>Email :</strong> {{$payment?->employee?->enrollment?->proMail}}</span>
            </div>
            
            <div class="signature-section">
                <div class="signature-line">
                    <div style="height: 1.2cm;"></div>
                    <div class="signature-line-text">Signature pour réception</div>
                </div>
                <div class="signature-line">
                    <div style="height: 1.2cm;"></div>
                    <div class="signature-line-text">La Direction</div>
                </div>
            </div>
            
            <div class="text-center mt-2 pb-1" style="font-size: 8px; color: #666;">
                <em>Ceci est un bulletin généré par l'ordinateur et la signature n'est pas requise</em>
            </div>
        </div>
    </div>
</div>
</div>