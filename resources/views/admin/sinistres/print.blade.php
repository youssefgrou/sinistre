<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinistre {{ $sinistre->numero_sinistre }}</title>
    <style>
        @font-face {
            font-family: 'Roboto';
            src: url({{ storage_path('fonts/Roboto-Regular.ttf') }}) format("truetype");
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'Roboto';
            src: url({{ storage_path('fonts/Roboto-Medium.ttf') }}) format("truetype");
            font-weight: 500;
            font-style: normal;
        }
        @font-face {
            font-family: 'Roboto';
            src: url({{ storage_path('fonts/Roboto-Bold.ttf') }}) format("truetype");
            font-weight: bold;
            font-style: normal;
        }
        * {
            font-family: DejaVu Sans, sans-serif;
        }
        body {
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }
        .header {
            margin-bottom: 20px;
            border-bottom: 2px solid #00008f;
            padding-bottom: 15px;
        }
        .header-content {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .logo {
            width: 80px;
            height: auto;
        }
        .header-text {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .title {
            color: #00008f;
            font-size: 24px;
            margin: 0;
            line-height: 1.2;
        }
        .subtitle {
            color: #666;
            font-size: 14px;
            margin: 5px 0 0;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            color: #00008f;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        td {
            padding: 4px 8px;
            vertical-align: top;
        }
        .info-table {
            width: 100%;
        }
        .info-table td {
            padding: 4px 15px 4px 0;
        }
        .label {
            color: #666;
            font-size: 11px;
            width: 120px;
        }
        .value {
            color: #333;
            font-weight: 500;
            font-family: 'Roboto', sans-serif;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }
        .payment-info {
            margin-top: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 6px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <img src="{{ public_path('img/logo.jpg') }}" alt="Logo" class="logo">
            <div class="header-text">
                <h1 class="title">Déclaration de sinistre - {{ $sinistre->numero_sinistre }}</h1>
                <p class="subtitle">Généré le {{ now()->format('d/m/Y à H:i') }}</p>
            </div>
        </div>
    </div>

    <table>
        <tr>
            <td style="width: 50%;">
                <div class="section">
                    <h2 class="section-title">Informations du client</h2>
                    <table class="info-table">
                        <tr>
                            <td class="label">Nom</td>
                            <td class="value ">{{ $sinistre->user->name }}</td>
                        </tr>
                        <tr>
                            <td class="label">Email</td>
                            <td class="value">{{ $sinistre->user->email }}</td>
                        </tr>
                    </table>
                </div>
            </td>
            <td style="width: 50%;">
                <div class="section">
                    <h2 class="section-title">Informations du véhicule</h2>
                    <table class="info-table">
                        <tr>
                            <td class="label">Véhicule</td>
                            <td class="value">{{ $sinistre->marque }} {{ $sinistre->modele }}</td>
                        </tr>
                        <tr>
                            <td class="label">Immatriculation</td>
                            <td class="value">{{ $sinistre->immatriculation }}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <div class="section">
        <h2 class="section-title">Informations du sinistre</h2>
        <table class="info-table">
            <tr>
                <td style="width: 50%;">
                    <table class="info-table">
                        <tr>
                            <td class="label">Date du sinistre</td>
                            <td class="value">{{ $sinistre->date_sinistre->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td class="label">Heure</td>
                            <td class="value">{{ $sinistre->heure_sinistre }}</td>
                        </tr>
                        <tr>
                            <td class="label">Lieu</td>
                            <td class="value">{{ $sinistre->lieu_sinistre }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%;">
                    <table class="info-table">
                        <tr>
                            <td class="label">Type de sinistre</td>
                            <td class="value">
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
                            </td>
                        </tr>
                        <tr>
                            <td class="label">Statut</td>
                            <td class="value">
                                <span class="status-badge" style="
                                    background-color: {{ 
                                        $sinistre->status === 'en_attente' ? '#fef3c7' :
                                        ($sinistre->status === 'en_cours' ? '#dbeafe' :
                                        ($sinistre->status === 'expertise' ? '#f3e8ff' :
                                        ($sinistre->status === 'validé' ? '#dcfce7' :
                                        ($sinistre->status === 'refusé' ? '#fee2e2' : '#f3f4f6'))))
                                    }};
                                    color: {{
                                        $sinistre->status === 'en_attente' ? '#92400e' :
                                        ($sinistre->status === 'en_cours' ? '#1e40af' :
                                        ($sinistre->status === 'expertise' ? '#6b21a8' :
                                        ($sinistre->status === 'validé' ? '#166534' :
                                        ($sinistre->status === 'refusé' ? '#991b1b' : '#374151'))))
                                    }}
                                ">
                                    {{ ucfirst(str_replace('_', ' ', $sinistre->status)) }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        @if($sinistre->commentaire)
        <table class="info-table" style="margin-top: 10px;">
            <tr>
                <td class="label">Description</td>
                <td class="value" style="white-space: pre-wrap;">{{ $sinistre->commentaire }}</td>
            </tr>
        </table>
        @endif
    </div>

    <!-- Calculation Details Section -->
    <div class="section">
        <h2 class="section-title">Détails du calcul d'indemnisation</h2>
        <table class="info-table">
            <tr>
                <td style="width: 50%;">
                    <table class="info-table">
                        <tr>
                            <td class="label">Montant du sinistre</td>
                            <td class="value">{{ $sinistre->formatted_montant_sinistre }}</td>
                        </tr>
                        <tr>
                            <td class="label">Franchise</td>
                            <td class="value">{{ $sinistre->formatted_franchise }}</td>
                        </tr>
                    </table>
                </td>
                <td style="width: 50%;">
                    <table class="info-table">
                        <tr>
                            <td class="label">Taux de couverture</td>
                            <td class="value">{{ number_format($sinistre->taux_couverture, 2) }} %</td>
                        </tr>
                        <tr>
                            <td class="label">Indemnisation calculée</td>
                            <td class="value" style="font-weight: bold; color: #00008f;">
                                {{ $sinistre->formatted_indemnisation }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    @if($sinistre->payments->isNotEmpty())
    <div class="section">
        <h2 class="section-title">Informations de paiement</h2>
        <div class="payment-info">
            <table class="info-table">
                <tr>
                    <td style="width: 50%;">
                        <table class="info-table">
                            <tr>
                                <td class="label">Montant total</td>
                                <td class="value">{{ number_format($sinistre->payments->sum('amount'), 2, ',', ' ') }} €</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 50%;">
                        <table class="info-table">
                            <tr>
                                <td class="label">Méthode de paiement</td>
                                <td class="value">
                                    @php
                                        $lastPayment = $sinistre->payments->sortByDesc('created_at')->first();
                                        $methodMapping = [
                                            'cheque' => 'Chèque',
                                            'virement' => 'Virement',
                                            'especes' => 'Espèces'
                                        ];
                                        $paymentMethod = $methodMapping[$lastPayment->payment_method] ?? ucfirst($lastPayment->payment_method);
                                    @endphp
                                    {{ $paymentMethod }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    @endif

    <div class="footer">
        Ce document a été généré automatiquement et ne nécessite pas de signature.
    </div>
</body>
</html> 