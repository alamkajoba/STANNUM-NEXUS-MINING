<div class="bulletin-container bg-white">
    <div class="content-wrapper">
        <div class="header-section">
            <div class="logo-area">
                <img src="{{asset('img/logo.jfif')}}" alt="Logo">
            </div>
            <div class="company-details">
                <h6 class="fw-bold m-0">Stannum Nexus Mining SA</h6>
                <p class="m-0">N° TVA: 0171/DGI/DGE/DIG/MB/TVA/2011 | NF: A0708211 J</p>
                <p class="m-0">RCCM: CD/L'SHI/TRICOM/RCCM/13-B-0660</p>
                <p class="m-0 text-primary">www.stannum-nexus.com</p>
            </div>
        </div>

        <div class="bulletin-title text-center py-2 fw-bold mb-3">
            Bulletin de paie du mois de {{ $motif }}
        </div>

        <table class="table-info-section w-100 mb-3">
            <tr>
                <td width="60%" class="p-0 border-end border-dark">
                    <table class="w-100 inner-table">
                        <tr><td width="35%">Matricule :</td><td class="fw-bold">{{ $matricule }}</td></tr>
                        <tr><td>Nom :</td><td class="fw-bold text-uppercase">{{ $lastName }} {{ $middleName }} {{ $firstName }}</td></tr>
                        <tr><td>Fonction :</td><td></td></tr>
                        <tr><td>Num. Compte :</td><td>05130-XXXXXXXXX-XX</td></tr>
                    </table>
                </td>
                <td width="40%" class="p-0">
                    <table class="w-100 inner-table">
                        <tr><td width="55%">Catégorie Profess. :</td><td>{{ $nameCategory }}</td></tr>
                        <tr><td>Salaire de base :</td><td class="fw-bold">$ {{ number_format($dayAmount * 26, 2) }}</td></tr>
                        <tr><td>Jours du mois :</td><td>26</td></tr>
                        <tr><td>Jours Présent :</td><td>{{ $actifDay }}</td></tr>
                    </table>
                </td>
            </tr>
        </table>

        <table class="table-main w-100 mb-3">
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
                    <td>Base Mensuelle :</td><td class="text-center">{{ $workDay }}</td><td class="text-end">$ {{ number_format($amount, 2) }}</td>
                    <td>Base Mensuelle :</td><td></td><td></td>
                </tr>
                <tr>
                    <td>Heures Sup. :</td><td class="text-center">{{ $overtimes }}</td><td class="text-end">$ {{ number_format($overtimesPay, 2) }}</td>
                    <td>Heures Sup :</td><td></td><td></td>
                </tr>
                <tr class="total-row fw-bold border-top-dark">
                    <td colspan="2" class="text-end">Total</td><td class="text-end">$ {{ number_format($totalAmount, 2) }}</td>
                    <td colspan="2" class="text-end">Remunération Brute :</td><td class="text-end">$ {{ number_format($totalAmount, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <table class="table-split w-100 mb-3">
            <tr>
                <td width="50%" class="p-0 border-end border-dark align-top">
                    <table class="w-100 inner-table-bordered">
                        <thead><tr class="bg-gray"><th>Avantage Social</th><th width="20%">Jr</th><th>Montant</th></tr></thead>
                        <tbody>
                            <tr><td>Logement :</td><td></td><td class="text-end">$ {{ number_format($lunch * 0.7, 2) }}</td></tr>
                            <tr><td>Transport :</td><td class="text-center">26</td><td class="text-end">$ {{ number_format($transportationCost, 2) }}</td></tr>
                            <tr class="fw-bold bg-gray"><td>Total Avantages</td><td></td><td class="text-end">$ {{ number_format($transportationCost + ($lunch * 0.7), 2) }}</td></tr>
                        </tbody>
                    </table>
                </td>
                <td width="50%" class="p-0 align-top">
                    <table class="w-100 inner-table-bordered">
                        <thead><tr class="bg-gray"><th>Déduction</th><th>Montant</th></tr></thead>
                        <tbody>
                            <tr><td>IPR :</td><td class="text-end">$ {{ number_format($IPRAmount, 2) }}</td></tr>
                            <tr><td>CNSS :</td><td class="text-end">$ {{ number_format($CNSSAmount, 2) }}</td></tr>
                            <tr class="fw-bold bg-gray"><td>Total Déduction</td><td class="text-end">$ {{ number_format($IPRAmount + $CNSSAmount, 2) }}</td></tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>

        <div class="summary-stripe border-dark mb-4">
            <div class="stripe-item">SALAIRE BRUT</div>
            <div class="stripe-value border-end border-dark">$ {{ number_format($totalAmount + $transportationCost + ($lunch * 0.7), 2) }}</div>
            <div class="stripe-item">TOTAL DEDUCTION</div>
            <div class="stripe-value">$ {{ number_format($IPRAmount + $CNSSAmount, 2) }}</div>
        </div>

        <div class="footer-section">
            <div class="net-summary border-dark">
                <div class="net-row"><span>Salaire Brut :</span> <span>$ {{ number_format($totalAmount + $transportationCost + ($lunch * 0.7), 2) }}</span></div>
                <div class="net-row text-danger"><span>Total Déduction :</span> <span>$ {{ number_format($IPRAmount + $CNSSAmount, 2) }}</span></div>
                <div class="net-row net-final fw-bold h5 mb-0"><span>Salaire Net :</span> <span class="text-primary">$ {{ number_format($netAmount, 2) }}</span></div>
            </div>
            <div class="stamp-area">
                <div class="stamp-box"></div>
                <p class="stamp-label m-0">Cachet de l'entreprise</p>
            </div>
        </div>
    </div>

    <div class="bottom-legal-info border-top border-dark pt-2">
        <div class="d-flex justify-content-between px-2">
            <span>Numéro CNSS : 11988628355C </span>
            <span>Email : </span>
        </div>
        <div class="text-center mt-2 pb-2">
            <strong>Ceci est un bulletin généré par l'ordinateur et la signature n'est pas requise</strong>
        </div>
    </div>
</div>

