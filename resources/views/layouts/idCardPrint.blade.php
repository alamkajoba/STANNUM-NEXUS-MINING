<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
:root {
    --brand-color: #1e3a8a; /* Bleu foncé institutionnel */
    --accent-color: #ef4444; /* Rouge pour le niveau d'accès */
    --text-color: #111827;
}

.id-card {
    width: 54mm;
    height: 86mm;
    background: #ffffff;
    border-radius: 4mm;
    border: 1px solid #d1d5db;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    position: relative;
    font-family: Arial, sans-serif;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    margin: 20px auto;
}

/* En-tête colorée */
.header {
    background: var(--brand-color);
    color: white;
    padding: 10px;
    text-align: center;
}

.company-logo {
    font-weight: bold;
    font-size: 14pt;
    letter-spacing: 1px;
}

.access-level {
    background: var(--accent-color);
    font-size: 7pt;
    padding: 2px 5px;
    border-radius: 2px;
    margin-top: 5px;
    display: inline-block;
}

/* Zone Photo */
.photo-area {
    padding: 15px 0;
    display: flex;
    justify-content: center;
}

.photo-placeholder {
    width: 32mm;
    height: 32mm;
    border: 3px solid var(--brand-color);
    border-radius: 50%;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
    overflow: hidden;
}

.photo-placeholder svg {
    width: 25mm;
}

/* Zone Texte */
.info-area {
    text-align: center;
    padding: 0 10px;
    flex-grow: 1;
}

.agent-name {
    font-size: 12pt;
    color: var(--text-color);
    margin: 5px 0;
    text-transform: uppercase;
}

.agent-role {
    font-size: 9pt;
    color: #4b5563;
    margin-bottom: 5px;
}

.id-number {
    font-family: 'Courier New', monospace;
    font-size: 8pt;
    font-weight: bold;
    background: #f9fafb;
    display: inline-block;
    padding: 2px 6px;
}

/* Bas de carte */
.footer {
    height: 18mm;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 10px;
    border-top: 1px solid #e5e7eb;
}

.qr-code {
    width: 12mm;
    height: 12mm;
    background: #000; /* Simule le QR Code */
    border: 1px solid #fff;
}

.security-seal {
    font-size: 6pt;
    font-weight: bold;
    color: #9ca3af;
    transform: rotate(-90deg);
}

/* --- RÉGLAGES IMPRESSION --- */
@media print {
    body { background: white; }
    .id-card {
        margin: 0;
        box-shadow: none;
        page-break-inside: avoid;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
}

.id-card-back {
    width: 54mm;
    height: 86mm;
    background: #ffffff;
    border-radius: 4mm;
    border: 1px solid #d1d5db;
    display: flex;
    flex-direction: column;
    font-family: Arial, sans-serif;
    margin: 20px auto;
    position: relative;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* Bande magnétique (optionnelle, pour le look) */
.stripe {
    width: 100%;
    height: 10mm;
    background: #1f2937;
    margin-top: 5mm;
}

.content-back {
    padding: 15px;
    flex-grow: 1;
}

.instructions h3 {
    font-size: 8pt;
    font-weight: bold;
    margin-bottom: 5px;
    color: #1e3a8a;
    border-bottom: 1px solid #e5e7eb;
}

.instructions ul {
    padding-left: 12px;
    margin: 0;
}

.instructions li {
    font-size: 6.5pt;
    color: #374151;
    margin-bottom: 4px;
    line-height: 1.2;
}

.return-address {
    margin-top: 10px;
    font-size: 6pt;
    color: #6b7280;
    text-align: center;
}

/* Zone de signature */
.signature-area {
    margin-top: 15px;
    text-align: center;
}

.signature-line {
    width: 80%;
    margin: 0 auto;
    border-top: 1px solid #000;
    padding-top: 2px;
    font-size: 5pt;
    color: #9ca3af;
    text-transform: uppercase;
}

/* Code-barres en bas */
.barcode-area {
    padding: 10px;
    text-align: center;
    background: #f9fafb;
}

.barcode {
    width: 100%;
    height: 8mm;
    background: repeating-linear-gradient(
        90deg,
        #000,
        #000 1px,
        #fff 1px,
        #fff 3px,
        #000 3px,
        #000 4px
    );
}

.serial-number {
    font-family: 'Courier New', monospace;
    font-size: 7pt;
    display: block;
    margin-top: 3px;
}

@media print {
    .id-card-back {
        margin: 0;
        box-shadow: none;
        page-break-before: always; /* Pour imprimer sur une nouvelle page/face */
    }
}

@media print {
    /* Supprime les marges du navigateur pour ne pas décaler le badge */
    @page {
        size: 54mm 86mm;
        margin: 0;
    }

    body {
        margin: 0;
        padding: 0;
    }

    .badge-page {
        width: 54mm;
        height: 86mm;
        page-break-after: always; /* Force le Verso sur une nouvelle face */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* On retire les ombres et les marges d'écran pour l'impression */
    .id-card, .id-card-back {
        margin: 0;
        box-shadow: none;
        border: 1px solid #eee; /* Bordure très fine pour la découpe */
    }
}
</style>
</head>
<body>
    <div class="row">
        {{$slot}} 
    </div>


    

        {{-- <script>
            // Attend que toute la page (images, styles) soit chargée
            window.onload = function() {
                // Un petit délai de 500ms pour s'assurer que le rendu CSS est fini
                setTimeout(function() {
                    window.print();
                }, 500);
            };
        </script> --}}
</body>
</html>