<div>

    <div class="bulletin-container">
        <h4 class="titre-bulletin text-center">Bulletin de paie {{$motif}}</h4>
        <hr>
        <div class="section-header">
            <div class="bloc-gauche">
                <div class="titre-section">Employeur</div>
                <div class="d-flex align-items-center mb-2">
                    <div>
                        <img src="{{asset('img/stannumlogo.jpeg')}}" height="100px" width="300px" alt="">
                    </div>
                </div>
                
                <table class="table-mini">
                    <tr><td class="label-gris">Adresse:</td><td>40 AV Mandrinier</td></tr>
                    <tr><td class="label-gris">Quartier:</td><td>Bel-air camp</td></tr>
                    <tr><td class="label-gris">Téléphone:</td><td></td></tr>
                </table>

                <table class="table-mini mt-2">
                    <tr><td class="fw-bold">Jours prestés:</td><td class="text-center fw-bold">{{$actifDay}} jours</td></tr>
                    <tr><td>Jours Maladie:</td><td class="text-center">--------</td></tr>
                    <tr><td>Jours Incapacité:</td><td class="text-center">--------</td></tr>
                    <tr><td>Jours Absence:</td><td class="text-center">--------</td></tr>
                    <tr><td class="label-gris">Tps travail:</td><td class="text-center">48 / SEMAINE</td></tr>
                    <tr><td class="label-gris">Heures:</td><td class="text-center small">48/SEM - 8/JOURS</td></tr>
                </table>
            </div>

            <div class="bloc-droite">
                <div class="titre-section text-center">Salarié</div>
                <div class="cadre-salarie">
                    <table class="table-mini table-inner mb-0">
                        <tr><td width="45%"><strong>NOM :</strong></td><td>{{$middleName}}</td></tr>
                        <tr><td><strong>POSTNOM :</strong></td><td>{{$lastName}}</td></tr>
                        <tr><td><strong>PRENOM :</strong></td><td>{{$firstName}}</td></tr>
                        <tr><td><strong>N° MAT :</strong></td><td>{{$matricule}}</td></tr>
                        <tr><td>Catégorie :</td><td>{{$nameCategory}}</td></tr>
                        <tr><td>Fonction :</td><td class="fw-bold text-uppercase">{{$nameCategory}}</td></tr>
                        <tr><td>Sexe :</td><td>{{$gender}}</td></tr>
                        <tr><td>N° INSS :</td><td>--------</td></tr>
                    </table>
                    <div class="regime-travail">
                        Régime : 
                    </div>
                </div>
            </div>
        </div>

        <table class="table-principal">
            <thead>
                <tr>
                    <th width="35%">Désignation</th>
                    <th>Quantité</th>
                    <th>Base</th>
                    <th>Taux</th>
                    <th>Gain</th>
                    <th>Retenue</th>
                    <th>Montant Net</th>
                </tr>
            </thead>
            <tbody>
                {{-- Acivites normales --}}
                <tr>
                    <td>Activité Normale</td>
                    <td class="text-center">{{$workDay}}</td>
                    <td class="text-center">{{$dayAmount}}</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$amount}}</td>
                    <td class="text-center">0</td>
                    <td class="text-center">{{$amount}}</td>
                </tr>
                <tr>
                    <td>Jours incapacité</td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                </tr>
                <tr>
                    <td>Heures supplémentaires</td>
                    <td class="text-center">{{$overtimes}}</td>
                    <td class="text-center">{{$hourAmount}}</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$overtimesPay}}</td>
                    <td class="text-center">0</td>
                    <td class="text-center">{{$overtimesPay}}</td>
                </tr>
                <tr>
                    <td>Jours feriés</td>
                    <td class="text-center">0</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">0</td>
                    <td class="text-center">-</td>
                </tr>
                <tr>
                    <td>Prime d'assuduité</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center"></td>
                    <td class="text-center">{{$assudityBonus}}</td>
                    <td class="text-center">0</td>
                    <td class="text-center">{{$assudityBonus}}</td>
                </tr>
                <tr>
                    <td>Prime de risque</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$riskBonus}}</td>
                    <td class="text-center">0</td>
                    <td class="text-center">{{$riskBonus}}</td>
                </tr>
                <tr>
                    <td>Prime de rendement</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$performanceBonus}}</td>
                    <td class="text-center">0</td>
                    <td class="text-center">{{$performanceBonus}}</td>
                </tr>
                <tr class="fw-bold">
                    <td>Remuneration due</td><td colspan="3" class="text-end border-top border-dark"></td><td class="text-center border-top border-dark">{{$totalAmount}}</td><td class="text-center">-</td><td class="text-center">{{$totalAmount}}</td>
                </tr>

                {{-- Avantages --}}
                <tr class="ligne-categorie"><td colspan="7">Avantages</td></tr>
                <tr>
                    <td>Indemnité transport</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$transportationCost}}</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$transportationCost}}</td>
                </tr>
                <tr>
                    <td>Ration</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$lunch}}</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$lunch}}</td>
                </tr>

                {{-- Deductions --}}
                <tr class="ligne-categorie"><td colspan="7">Retenues</td></tr>
                <tr>
                    <td>CNSS</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$CNSS}}%</td> 
                    <td class="text-center">-</td> 
                    <td class="text-center">{{$CNSSAmount}}</td> 
                    <td class="text-center">{{$CNSSAmount}}</td> 
                </tr>
                <tr>
                    <td>INPP</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$INPP}}%</td> 
                    <td class="text-center">-</td> 
                    <td class="text-center">{{$INPPAmount}}</td> 
                    <td class="text-center">{{$INPPAmount}}</td>
                </tr>
                <tr>
                    <td>ONEM</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$ONEM}}%</td> 
                    <td class="text-center">-</td> 
                    <td class="text-center">{{$ONEMAmount}}</td> 
                    <td class="text-center">{{$ONEMAmount}}</td>
                </tr>
                <tr>
                    <td>IPR</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$IPR}}%</td> 
                    <td class="text-center">-</td> 
                    <td class="text-center">{{$IPRAmount}}</td> 
                    <td class="text-center">{{$IPRAmount}}</td>
                </tr>
                <tr>
                    <td>Avance sur Salaire</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$amountAdvance?? "-"}}</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center"></td>
                    <td class="text-center">-</td>
                </tr>
                <tr>
                    <td>Remboursement/mois</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$refundAdvanceAmount}}%</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$refundAdvance_Amount}}</td>
                    <td class="text-center">{{$refundAdvance_Amount}}</td>
                </tr>
                <tr>
                    <td>Retenue sur Salaire</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$deductionSalary}}%</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{$deductionSalaryAmount}}</td>
                    <td class="text-center">{{$deductionSalaryAmount}}</td>
                </tr>
                <tr>
                    <td>Autres retenues</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                    <td class="text-center">-</td>
                </tr>
            </tbody>
        </table>

        <div class="barre-net">
            <div class="label-net">NET À PAYER :</div>
            <div class="valeur-net">$ {{$netAmount}}</div>
        </div>

        <div class="footer-signatures">
            <div class="bloc-signature">
                <p class="titre-signature">SIGNATURE POUR RÉCEPTION</p>
                <div class="espace-signature"></div>
            </div>

            <div class="bloc-signature text-end">
                <p class="titre-signature">LA DIRECTION</p>
                <div class="espace-signature"></div>
            </div>
        </div>
    </div>
</div>