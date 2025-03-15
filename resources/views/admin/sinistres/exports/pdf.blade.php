<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des Sinistres</title>
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
            text-align: right;
        }
        .logo {
            width: 80px;
            height: auto;
            margin-right: 20px;
        }
        .header-text {
            flex-grow: 1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background: white;
        }
        th {
            background-color: #00008f;
            color: white;
            font-weight: bold;
            padding: 12px 8px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        td {
            padding: 12px 8px;
            border-bottom: 1px solid #e5e7eb;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
            display: inline-block;
        }
        .status-en_attente { background: #fef3c7; color: #92400e; }
        .status-en_cours { background: #dbeafe; color: #1e40af; }
        .status-expertise { background: #e0e7ff; color: #3730a3; }
        .status-validé { background: #d1fae5; color: #065f46; }
        .status-refusé { background: #fee2e2; color: #991b1b; }
        .payment-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
            display: inline-block;
        }
        .payment-paid { background: #d1fae5; color: #065f46; }
        .payment-unpaid { background: #fee2e2; color: #991b1b; }
        .method-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 4px;
        }
        .method-cheque { background: #e0e7ff; color: #3730a3; }
        .method-virement { background: #dbeafe; color: #1e40af; }
        .method-details {
            font-size: 9px;
            color: #6b7280;
            margin-top: 2px;
            display: block;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            background: #f3f4f6;
            border-radius: 8px;
            font-size: 10px;
            color: #6b7280;
        }
        .small-text {
            font-size: 9px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <img src="{{ public_path('img/logo.jpg') }}" alt="Logo" class="logo">
            <div class="header-text">
                <h1>Liste des Sinistres</h1>
                <p>Généré le {{ now()->format('d/m/Y à H:i') }}</p>
            </div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>N° Sinistre</th>
                <th>Client</th>
                <th>Véhicule</th>
                <th>Date</th>
                <th>Type</th>
                <th>Statut</th>
                <th>Paiement</th>
                <th>Mode</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sinistres as $sinistre)
                <tr>
                    <td>{{ $sinistre->numero_sinistre }}</td>
                    <td>
                        {{ $sinistre->user->name }}<br>
                        <span class="small-text">{{ $sinistre->user->email }}</span>
                    </td>
                    <td>
                        {{ $sinistre->marque }} {{ $sinistre->modele }}<br>
                        <span class="small-text">{{ $sinistre->immatriculation }}</span>
                    </td>
                    <td>
                        {{ $sinistre->date_sinistre->format('d/m/Y') }}<br>
                        <span class="small-text">{{ $sinistre->heure_sinistre }}</span>
                    </td>
                    <td>
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
                    <td>
                        <span class="status-badge status-{{ $sinistre->status }}">
                            {{ ucfirst(str_replace('_', ' ', $sinistre->status)) }}
                        </span>
                    </td>
                    <td>
                        @php
                            $totalPayments = $sinistre->payments->sum('amount');
                            $isPaid = $totalPayments > 0;
                        @endphp
                        <span class="payment-badge payment-{{ $isPaid ? 'paid' : 'unpaid' }}">
                            {{ $isPaid ? number_format($totalPayments, 2) . ' MAD' : 'Non payé' }}
                        </span>
                    </td>
                    <td>
                        @if($sinistre->payments->isNotEmpty())
                            @php
                                $payment = $sinistre->payments->last();
                                $methodLabels = [
                                    'cheque' => 'Chèque',
                                    'virement' => 'Virement'
                                ];
                            @endphp
                            <span class="method-badge method-{{ $payment->payment_method }}">
                                {{ $methodLabels[$payment->payment_method] ?? ucfirst($payment->payment_method) }}
                            </span>
                        @else
                            <span class="small-text text-gray-500">-</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Ce document est généré automatiquement par le système de gestion des sinistres.</p>
        <p>Pour plus d'informations, veuillez contacter le service client au 01 23 45 67 89.</p>
    </div>
</body>
</html> 