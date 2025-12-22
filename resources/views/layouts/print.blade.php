<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CONFIGURATION FORMAT A4 */
        @media screen {
            body { background-color: #525659; padding: 20px; margin: 0; }
            .bulletin-container {
                width: 21cm;
                /* On retire le min-height fixe qui cause la page vide */
                margin: 0 auto;
                background-color: white;
                padding: 1.2cm;
                box-shadow: 0 0 15px rgba(0,0,0,0.5);
            }
        }

        @media print {
            @page { 
                size: A4; 
                margin: 0; /* On laisse le padding du container gérer les marges */
            }
            body { background: white; margin: 0; padding: 0; }
            .bulletin-container {
                width: 21cm;
                margin: 0;
                padding: 1.2cm;
                box-shadow: none;
                /* Empêche le navigateur d'ajouter une page si le contenu frôle le bord */
                page-break-after: avoid; 
            }
            .no-print { display: none !important; }
        }

        body { font-family: Arial, sans-serif; color: #000; font-size: 11px; }

        /* ENTETE */
        .section-header {
            display: flex;
            align-items: stretch;
            gap: 20px;
            width: 100%;
            margin-bottom: 15px;
        }

        .bloc-gauche, .bloc-droite {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .titre-section {
            text-decoration: underline;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
            margin-bottom: 5px;
        }

        .table-mini {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        .table-mini td { border: 1px solid #000; padding: 2px 6px; }
        .label-gris { background-color: #f2f2f2; width: 45%; }

        .cadre-salarie {
            border: 1px solid #000;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .table-inner { width: 100%; border-collapse: collapse; }
        .table-inner td { border: none !important; padding: 2px 8px; }

        .regime-travail {
            border-top: 1px solid #000;
            padding: 4px 8px;
            font-size: 10px;
            margin-top: auto;
            background-color: #fafafa;
        }

        /* TABLEAU PRINCIPAL */
        .table-principal {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            margin-top: 5px;
        }
        .table-principal th { border: 1px solid #000; padding: 5px; background: #f8f9fa; text-align: center; }
        .table-principal td { border-left: 1px solid #000; border-right: 1px solid #000; padding: 3px 10px; height: 18px; }
        
        .ligne-categorie { background-color: #eee; font-weight: bold; text-decoration: underline; border: 1px solid #000; }

        .barre-net {
            display: flex;
            background-color: rgb(46, 13, 167) !important;
            color: #fff !important;
            border: 1px solid #000;
            -webkit-print-color-adjust: exact;
        }
        .label-net { flex: 1; padding: 8px 15px; font-weight: bold; font-size: 13px; }
        .valeur-net { width: 180px; text-align: right; padding: 8px 15px; font-weight: bold; font-size: 13px; }

        /* SIGNATURES */
        .footer-signatures {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 30px;
        }
        .bloc-signature { width: 220px; }
        .titre-signature { text-decoration: underline; font-weight: bold; font-size: 10px; margin-bottom: 5px; }
        .espace-signature { height: 60px; }
    </style>
</head>
<body>
    <div class="row">
        {{$slot}} 
    </div>


    

    <script>
        // Attend que toute la page (images, styles) soit chargée
        window.onload = function() {
            // Un petit délai de 500ms pour s'assurer que le rendu CSS est fini
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>