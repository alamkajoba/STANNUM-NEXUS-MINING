<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste de présence</title>
    <style>
        @page { size: A4; margin: 18mm; }
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size:12px; color:#222 }
        .header { display:flex; align-items:center; gap:12px; border-bottom:2px solid #0b3d91; padding-bottom:10px; margin-bottom:12px }
        .logo { width:80px; height:80px; object-fit:contain }
        .company { font-size:20px; font-weight:800; color:#0b3d91 }
        .subtitle { font-size:13px; color:#333 }
        .company-meta { font-size:11px; color:#444; margin-top:6px }
        table { border-collapse: collapse; width: 100%; margin-top:8px; page-break-inside: auto }
        thead { display: table-header-group }
        tbody { display: table-row-group }
        th, td { border: 1px solid #666; padding: 8px; text-align: center; vertical-align: middle }
        th { background: #0b3d91; color: #fff; font-weight:600 }
        .name { text-align: left; padding-left:10px; font-weight:600 }
        .cell-empty { width:18px; height:18px; display:inline-block; border:1px solid #333; }
        .status-present { background:#1ea64b; color:#fff; padding:4px 6px; border-radius:4px; font-weight:700 }
        .status-absent { background:#d64545; color:#fff; padding:4px 6px; border-radius:4px; font-weight:700 }
        .status-justified { background:#f0ad4e; color:#000; padding:4px 6px; border-radius:4px; font-weight:700 }
        .footer { margin-top:18px; font-size:12px; color:#444 }
        .meta { font-size:11px; color:#666 }
        .contact { font-size:11px; color:#333; margin-top:6px }
    </style>
</head>
<body>
    @php
        $logoPath = public_path('img/thot1.jpg');
        $logo = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : null;
    @endphp

    <div class="header">
        @if($logo)
            <img class="logo" src="data:image/jpeg;base64,{{ $logo }}" alt="thot-engineering logo" />
        @else
            <div style="width:80px;height:80px;background:#eee;display:flex;align-items:center;justify-content:center;color:#999">Logo</div>
        @endif
        <div>
            <div class="company">Thot-Engineering</div>
            <div class="subtitle">Liste de présence hebdomadaire</div>
            <div class="company-meta">Adresse: , Ville — Tél:  — Email: info@thot-engineering.com</div>
            <div class="meta">Semaine du {{ \Carbon\Carbon::parse($weekDates[0])->translatedFormat('d F Y') }} au {{ \Carbon\Carbon::parse($weekDates[6])->translatedFormat('d F Y') }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:40%">Agent</th>
                @foreach($weekDates as $wd)
                    <th>{{ \Carbon\Carbon::parse($wd)->translatedFormat('D d') }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $emp)
                <tr>
                    <td class="name">{{ $emp['full_name'] }}</td>
                    @foreach($weekDates as $wd)
                        <td><div class="cell-empty"></div></td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <div>Signature responsable: _________________________</div>
        <div style="margin-top:6px" class="meta">Généré le {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</div>
    </div>
</body>
</html>
