<div>
    <div class="bulletin">
        <header class="header">
            <div class="entreprise">
                <h1>STANNUM NEXUS MINING SARL</h1>
                <p>49 Mandarinier Bel-air camps <br></p>
            </div>
            <div class="periode">
                <h2>Bulletin de paie</h2>
                <p>{{$motif}}</p>
            </div>
        </header>

        <section class="infos">
            <div>
                <strong>Salarie :</strong> {{$middleName}} {{$lastName}} {{$firstName}} <br>
                <strong>Poste :</strong> {{$nameCategory}}<br>
                <strong>Matricule :</strong> {{$matricule}} <br>
                <strong>Numero :</strong>  <br>
                <strong>Adresse :</strong>  <br>
            </div>
            <div>
                <strong>Temps de travail :</strong> {{$workDay}} jours<br>
                <strong>Poste :</strong> Poste <br>
                <strong>Matricule :</strong> Matricule <br>
            </div>
        </section>

        <table class="table-paie">
            <thead>
                <tr>
                    <th>Designation</th>
                    <th>Quantite</th>
                    <th>Base</th>
                    <th>Taux</th>
                    <th>Gain</th>
                    <th>Retenue</th>
                    <th>Montant Net</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Activite normale</td>
                    <td>{{$workDay}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="negatif">400$</td>
                </tr>
                <tr>
                    <td>Jour incapacite</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Heures supplementaires</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Prime d'assiduite</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Jours feries</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Prime de risque</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Prime de rendement</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <thead>
                    <tr>
                        <th>Remuneration due</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th> </th>
                    </tr>
                </thead>
                <tr>
                    <td>Indemnite transport</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Ration</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <thead>
                    <tr>
                        <th>Retenues</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th> </th>
                    </tr>
                </thead>
                <tr>
                    <td>CNSS</td>
                    <td></td>
                    <td></td>
                    <td>{{$CNSS}} %</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>INPP</td>
                    <td></td>
                    <td></td>
                    <td>{{$INPP}} %</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>ONEM</td>
                    <td></td>
                    <td></td>
                    <td>{{$ONEM}} %</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>IPR</td>
                    <td></td>
                    <td></td>
                    <td>{{$IPR}} %</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Avance sur salaire</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Remboursement /mois</td>
                    <td></td>
                    <td></td>
                    <td>{{$refundAdvanceAmount}} %</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Retenue sur salaire</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Autres retenues</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div class="total">
            <span>Net a payer</span>
            <span class="net">$ {{$netAmount}}</span>
        </div>
        <footer class="footer">
            <div class="signatures">
                <div class="left">Pour reception</div>
                <div class="left">La direction</div>
            </div>
            <p>Document a conserver</p>
        </footer>
    </div>

    <script>
        window.print();
    </script>
</div>

