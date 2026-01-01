<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* RESET POUR L'IMPRESSION */
    @media screen {
        body { background-color: #e0e0e0; padding: 2cm 0; margin: 0; }
        .bulletin-container { 
            box-shadow: 0 0 20px rgba(0,0,0,0.2); 
            margin: auto;
        }
    }

    /* CONFIGURATION A4 */
    .bulletin-container {
        width: 21cm;
        height: 29.7cm; /* Hauteur A4 fixe */
        background: #fff;
        border: 1px solid #000;
        font-family: 'Arial Narrow', Arial, sans-serif;
        font-size: 12px;
        color: #000;
        display: flex;
        flex-direction: column; /* Permet de pousser le footer vers le bas */
        justify-content: space-between;
        padding: 1.5cm; /* Marges intérieures */
        box-sizing: border-box;
    }
    

    .header-section { display: flex; justify-content: space-between; margin-bottom: 10px; }
    .logo-area img { height: 70px; }
    .company-details { text-align: left; font-size: 10px; line-height: 1.3; }

    .bulletin-title { border-top: 1px solid #000; border-bottom: 1px solid #000; background: #f2f2f2; text-transform: uppercase; font-size: 14px; }

    table { border-collapse: collapse; }
    .table-info-section { border: 1px solid #000; }
    .inner-table td { padding: 3px 8px; }
    
    .table-main th, .table-main td { border: 1px solid #000; padding: 5px 8px; }
    .table-main thead { background: #f2f2f2; }
    
    .inner-table-bordered th, .inner-table-bordered td { border: 1px solid #000; padding: 4px 8px; }
    .bg-gray { background: #f2f2f2 !important; }

    .summary-stripe { display: flex; border: 1px solid #000; background: #f2f2f2; font-weight: bold; text-align: center; }
    .stripe-item, .stripe-value { flex: 1; padding: 6px; }

    .footer-section { display: flex; justify-content: space-between; align-items: flex-end; }
    .net-summary { width: 55%; border: 1px solid #000; padding: 12px; background: #fafafa; }
    .net-row { display: flex; justify-content: space-between; margin-bottom: 4px; }
    .net-final { border-top: 1px solid #000; padding-top: 8px; margin-top: 8px; }

    .stamp-area { width: 40%; text-align: center; }
    .stamp-box { border: 1px solid #000; width: 170px; height: 120px; margin: 0 auto; background: #fff; }
    .stamp-label { font-size: 10px; font-weight: bold; margin-top: 5px !important; }

    .bottom-legal-info { font-size: 10px; width: 100%; }
    .border-top-dark { border-top: 2px solid #000 !important; }

    @media print {
        @page { size: A4; margin: 0; }
        body { margin: 0; padding: 0; background: none; }
        .bulletin-container { 
            width: 21cm; 
            height: 29.7cm; 
            border: none; /* On retire la bordure extérieure à l'impression */
            padding: 1.5cm;
            box-shadow: none;
        }
        .total-row {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            background-color: rgb(41, 5, 88) !important;
            color: white !important;
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