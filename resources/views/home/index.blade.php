@extends('layouts.main')

@section('title', 'Home')

@section('content')

<div class="row-fluid">	    
    <x-card size="col-12 col-xxl-10">
        <x-slot name="header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold">Home</h4>
            </div>
        </x-slot>

        <x-slot name="body">            
            <div class="row">
                <div class="col col-md-6">
                    <div class="card border-light shadow-sm mb-3">
                        <div class="card-body" style="width: 100%; height: 400px;">
                            <canvas id="graficoEncontristasPorGenero"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col col-md-6">
                    <div class="card border-light shadow-sm mb-3">
                        <div class="card-body" style="width: 100%; height: 400px;">
                            <canvas id="graficoEncontristasPorFraternidade"></canvas>
                        </div>
                    </div>
                </div>
            </div>   
        </x-slot>
    </x-card>     
</div>

@endsection

@push('grafico')
<script>
    const ctxGenero = document.getElementById('graficoEncontristasPorGenero');

    // Passa o array PHP direto como JSON válido para o JS
    const contagemGenero = JSON.parse(`@json($contagemGenero)`);

    // Extrai as chaves e valores do objeto
    const labelsGenero = Object.keys(contagemGenero);
    const dataGenero = Object.values(contagemGenero);

    new Chart(ctxGenero, {
        type: 'pie',
        data: {
            labels: labelsGenero,
            datasets: [{
                label: 'Total de Encontristas',
                data: dataGenero,
                borderWidth: 1,                
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                },
                title: {
                    display: true,
                    text: 'ENCONTRISTAS POR GÊNEROS'
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        const sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        const percentage = (value * 100 / sum).toFixed(1) + "%";
                        return `${percentage}`;
                    },
                    color: '#000',
                    font: { weight: 'bold' }
                }
            },
            animation: {
                duration: 3000,
                easing: 'easeOutQuart',
            }
        },
        plugins: [ChartDataLabels]
    });
</script>

<script>
    const ctxFraternidade = document.getElementById('graficoEncontristasPorFraternidade');

    // Passa o array PHP direto como JSON válido para o JS
    const contagemFraternidade = JSON.parse(`@json($contagemFraternidade)`);

    // Extrai as chaves e valores do objeto
    const labelsFraternidade = Object.keys(contagemFraternidade);
    const dataFraternidade = Object.values(contagemFraternidade);

    new Chart(ctxFraternidade, {
        type: 'doughnut',
        data: {
            labels: labelsFraternidade,
            datasets: [{
                label: 'Total de Encontristas',
                data: dataFraternidade,
                borderWidth: 1,                
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                },
                title: {
                    display: true,
                    text: 'ENCONTRISTAS POR FRATERNIDADE'
                },
                datalabels: {
                    formatter: (value, ctx) => {
                        const sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                        const percentage = (value * 100 / sum).toFixed(1) + "%";
                        return `${percentage}`;
                    },
                    color: '#000',
                    font: { weight: 'bold' }
                }
            },
            animation: {
                duration: 3000,
                easing: 'easeOutQuart',
            }
        },
        plugins: [ChartDataLabels]
    });
</script>
@endpush