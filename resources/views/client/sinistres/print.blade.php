<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Déclaration de sinistre - {{ $sinistre->numero_sinistre }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #374151;
        }
        .header {
            margin-bottom: 30px;
            padding: 20px;
            background: #f3f4f6;
            border-radius: 8px;
        }
        .header-content {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 10px;
        }
        .header h1 {
            color: #00008f;
            font-size: 24px;
            margin: 0 0 5px 0;
        }
        .header p {
            color: #6b7280;
            margin: 0;
        }
        .logo {
            width: 80px;
            height: auto;
            margin-right: 20px;
        }
        .header-text {
            flex-grow: 1;
        }
        .section {
            margin-bottom: 20px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        .section-title {
            color: #00008f;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .info-group {
            margin-bottom: 10px;
        }
        .info-label {
            color: #6b7280;
            font-size: 10px;
            text-transform: uppercase;
            margin-bottom: 2px;
        }
        .info-value {
            color: #111827;
            font-size: 12px;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
        }
        .status-en_cours { background: #fef3c7; color: #92400e; }
        .status-validé { background: #d1fae5; color: #065f46; }
        .status-refusé { background: #fee2e2; color: #991b1b; }
        .status-expertise { background: #e0e7ff; color: #3730a3; }
        .footer {
            margin-top: 30px;
            padding: 20px;
            background: #f3f4f6;
            border-radius: 8px;
            text-align: center;
            font-size: 10px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <img src="{{ public_path('img/logo.jpg') }}" alt="Logo" class="logo">
            <div class="header-text">
                <h1>Déclaration de sinistre</h1>
                <p>N° {{ $sinistre->numero_sinistre }}</p>
                <p>Généré le {{ now()->format('d/m/Y à H:i') }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-6">
        <div class="section">
            <div class="section-title">Informations du véhicule</div>
            <div class="grid">
                <div class="info-group">
                    <div class="info-label">Immatriculation</div>
                    <div class="info-value">{{ $sinistre->immatriculation }}</div>
                </div>
                <div class="info-group">
                    <div class="info-label">Marque</div>
                    <div class="info-value">{{ $sinistre->marque }}</div>
                </div>
                <div class="info-group">
                    <div class="info-label">Modèle</div>
                    <div class="info-value">{{ $sinistre->modele }}</div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Informations du sinistre</div>
            <div class="grid">
                <div class="info-group">
                    <div class="info-label">Date</div>
                    <div class="info-value">{{ $sinistre->date_sinistre->format('d/m/Y') }}</div>
                </div>
                <div class="info-group">
                    <div class="info-label">Heure</div>
                    <div class="info-value">{{ $sinistre->heure_sinistre }}</div>
                </div>
                <div class="info-group">
                    <div class="info-label">Type</div>
                    <div class="info-value">
                        @php
                            $typesSinistres = [
                                'vol_tentative_vol' => 'Vol et tentative de vol',
                                'vandalisme_degradations' => 'Vandalisme et dégradations volontaires',
                                'incendie_explosion' => 'Incendie et explosion',
                                'bris_glaces' => 'Bris de glaces',
                                'collision_route' => 'Collission de la Route'
                            ];
                        @endphp
                        {{ $typesSinistres[$sinistre->type_sinistre] ?? ucfirst(str_replace('_', ' ', $sinistre->type_sinistre)) }}
                    </div>
                </div>
                <div class="info-group">
                    <div class="info-label">Statut</div>
                    <div class="info-value">
                        <span class="status-badge status-{{ $sinistre->status }}">
                            {{ ucfirst(str_replace('_', ' ', $sinistre->status)) }}
                        </span>
                    </div>
                </div>
                <div class="info-group">
                    <div class="info-label">Lieu</div>
                    <div class="info-value">{{ $sinistre->lieu_sinistre }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Description et circonstances</div>
        <div class="info-group">
            <div class="info-label">Description des dommages</div>
            <div class="info-value">{{ $sinistre->description }}</div>
        </div>
        <div class="info-group" style="margin-top: 15px;">
            <div class="info-label">Circonstances</div>
            <div class="info-value">{{ $sinistre->circonstances }}</div>
        </div>
    </div>

    <div class="footer">
        <p>Ce document est généré automatiquement par le système de gestion des sinistres.</p>
        <p>Pour plus d'informations, veuillez contacter le service client.</p>
    </div>
</body>
</html> 