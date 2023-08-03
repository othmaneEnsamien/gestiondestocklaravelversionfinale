@extends('layouts.appdash')
@section('title', 'Dashboard')
@section('content')
    <style>
        .section {
            position: relative;
            z-index: 1;
        }
    </style>
    <div class="section section1 m-xl-3 ">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="col-6 pr-0 pt-3">
                                <h5 class="font-15">Total commandes</h5>
                                <h2 class="mb-3 font-18">{{ $totalCommandes }}</h2>
                                <!-- <p class="mb-0"><span class="col-green">10%</span> Increase</p> -->
                            </div>
                            <div class="col-6 pl-0">
                                <div class="banner-img">
                                    <img src="{{ asset('images/1.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="col-6 pr-0 pt-3">
                                <h5 class="font-15">Total clients</h5>
                                <h2 class="mb-3 font-18">{{ $totalClients }}</h2>
                                <!-- <p class="mb-0"><span class="col-orange">09%</span> Decrease</p> -->
                            </div>
                            <div class="col-6 pl-0">
                                <div class="banner-img">
                                    <img src="{{ asset('images/2.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="col-6 pr-0 pt-3">
                                <h5 class="font-15">Nouvel commande</h5>
                                <h2 class="mb-3 font-18">{{ $newCommandesToday }}</h2>
                                <!-- <p class="mb-0"><span class="col-green">18%</span>Increase</p> -->
                            </div>
                            <div class="col-6 pl-0">
                                <div class="banner-img">
                                    <img src="{{ asset('images/3.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="col-6 pr-0 pt-3">
                                <h5 class="font-15">Revenue mensuel</h5>

                                @foreach ($revenuMensuelCourant as $revenu)
                                    <tr>
                                        <h4>
                                            <td>{{ date('F', mktime(0, 0, 0, $revenu->mois, 1)) }}</td>
                                            <td>{{ $revenu->montant_total }} DHS</td>
                                        </h4>

                                    </tr>
                                @endforeach

                                <!-- <p class="mb-0"><span class="col-green">42%</span> Increase</p> -->
                            </div>
                            <div class="col-6 pl-0">
                                <div class="banner-img">
                                    <img src="{{ asset('images/4.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Roles et Permisions</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="chartRolesPermissions" style="width: 100%; height: 300px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Commandes Par Jour</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="chartCommandesParJour" style="width: 100%; height: 300px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Total Expenses and Income</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="expensesIncomeChart" style="width: 100%; height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <style>
        .section1 {
            position: relative;
            z-index: 1;
        }
    </style>

    <div class="section m-xl-3" style="margin-top: 50px">
        <!-- ... Vos autres éléments de contenu ... -->

        <div class="row">
            <!-- Tableau des 5 meilleurs clients -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Top 5 Clients</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom du client</th>
                                        <th>Nombre de commandes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topClients as $index => $client)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $client->nomclient }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 mr-3">
                                                        <div class="progress" style="height: 6px;">
                                                            <div class="progress-bar bg-primary" role="progressbar"
                                                                style="width: {{ ($client->commandes_count / $maxCommandes) * 100 }}%;"
                                                                aria-valuenow="{{ $client->commandes_count }}"
                                                                aria-valuemin="0" aria-valuemax="{{ $maxCommandes }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>{{ $client->commandes_count }}</div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Tableau des 5 meilleurs produits -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Top 5 Produits</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom du produit</th>
                                        <th>Nombre de commandes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topProducts as $index => $produit)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $produit->nomproduit }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 mr-3">
                                                        <div class="progress" style="height: 6px;">
                                                            <div class="progress-bar bg-primary" role="progressbar"
                                                                style="width: {{ ($produit->commandes_count / $maxCommandesProduits) * 100 }}%;"
                                                                aria-valuenow="{{ $produit->commandes_count }}"
                                                                aria-valuemin="0"
                                                                aria-valuemax="{{ $maxCommandesProduits }}"></div>
                                                        </div>
                                                    </div>
                                                    <div>{{ $produit->commandes_count }}</div>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h4>Produits presque en rupture de stock</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nom du produit</th>
                                        <th>Quantité en stock</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($productsOutOfStock as $index => $product)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $product->nomproduit }}</td>
                                            <td>{{ $product->mesure }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Aucun produit en rupture de stock</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4>Revenus mensuels des 10 derniers mois</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Mois</th>
                                        <th>Montant Total</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($revenuMensuel as $revenu)
                                        <tr>
                                            <td>{{ $revenu->mois }}</td>
                                            <td>{{ $revenu->montant_total }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Données pour le premier graphique (Roles et Permissions)
        const rolesCount = {!! json_encode(array_values($rolesCount)) !!};
        const permissionsCount = {!! json_encode(array_values($permissionsCount)) !!};
        const rolePermissionLabels = {!! json_encode(array_keys($rolesCount)) !!};

        // Données pour le deuxième graphique (Commandes par jour)
        const labels = {!! json_encode($labels) !!};
        const data = {!! json_encode($data) !!};

        // Initialiser les deux graphiques
        document.addEventListener('DOMContentLoaded', function() {
            // Premier graphique (Roles et Permissions)
            const ctxRolesPermissions = document.getElementById('chartRolesPermissions').getContext('2d');
            new Chart(ctxRolesPermissions, {
                type: 'bar',
                data: {
                    labels: rolePermissionLabels,
                    datasets: [{
                            label: 'Roles',
                            data: rolesCount,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Permissions',
                            data: permissionsCount,
                            backgroundColor: 'rgba(192, 75, 192, 0.2)',
                            borderColor: 'rgba(192, 75, 192, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Deuxième graphique (Commandes par jour)
            const ctxCommandesParJour = document.getElementById('chartCommandesParJour').getContext('2d');
            new Chart(ctxCommandesParJour, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Nombre de commandes par jour',
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        pointRadius: 5,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                        pointBorderColor: 'rgba(255, 255, 255, 1)',
                        pointHoverRadius: 7,
                        pointHoverBackgroundColor: 'rgba(75, 192, 192, 1)',
                        pointHoverBorderColor: 'rgba(255, 255, 255, 1)',
                        fill: true,
                        tension: 0.4 // Pour rendre les lignes plus courbées, ajustez cette valeur (0.4 est la valeur par défaut)
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Nombre de commandes',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Jour',
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Masquer la légende si vous ne voulez pas l'afficher
                        },
                        title: {
                            display: true,
                            text: 'Évolution du nombre de commandes par jour',
                            font: {
                                size: 18,
                                weight: 'bold'
                            }
                        }
                    }
                }
            });


        });
    </script>
    <script>
        // Données pour le graphique des dépenses et des revenus
        const expenses = {{ $expenses }};
        const income = {{ $income }};

        // Initialiser le graphique
        document.addEventListener('DOMContentLoaded', function() {
            const ctxExpensesIncome = document.getElementById('expensesIncomeChart').getContext('2d');
            new Chart(ctxExpensesIncome, {
                type: 'bar',
                data: {
                    labels: ['Expenses', 'Income'],
                    datasets: [{
                        data: [expenses, income],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.5)', // Red for expenses
                            'rgba(75, 192, 192, 0.5)', // Green for income
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endpush
