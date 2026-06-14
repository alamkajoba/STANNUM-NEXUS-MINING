<div>
    <div class="id-card">
        <div class="header">
            <div class="company-logo"><img height="50px" src="{{asset('img/thot1.jpg')}}" alt="finallogo"></div>
            <div class="access-level">CARTE DE SERVICE</div>
        </div>

        <div class="photo-area">
            <div class="photo-placeholder">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
        </div>

        <div class="info-area mb-5">
            <h2 class="agent-name">{{$enrollment?->employee?->middleName}} {{$enrollment?->employee?->firstName}}</h2>
            <p class="agent-role">{{$enrollment?->functionType?->nameFunction}}</p>
            <div class="id-number">MAT: {{$enrollment?->matricule}}</div>
        </div>
    </div>

    <div class="id-card-back">
        <div class="stripe"></div> <div class="content-back">
            <section class="instructions">
                <h3>INSTRUCTIONS</h3>
                <ul>
                    <li>Ce badge est strictement personnel et non cessible.</li>
                    <li>Le port du badge est obligatoire dans l'enceinte des locaux.</li>
                    <li>En cas de perte, merci de contacter le service RH immédiatement.</li>
                </ul>
            </section>

            <section class="return-address">
                <strong>Si trouvé, merci de rapporter à :</strong><br>
                Service RH - STANNUM NEXUS MINING<br>
                Route kasenga 
            </section>

            <div class="signature-area">
                <div class="signature-line">Signature de l'agent</div>
            </div>
        </div>

        <div class="barcode-area">
            <div class="barcode"></div>
            <span class="serial-number">8845 2026 0001 99</span>
        </div>
    </div>
</div>