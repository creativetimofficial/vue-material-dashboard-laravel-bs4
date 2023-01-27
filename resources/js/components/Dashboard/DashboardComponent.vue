<template>
    <div class="container-fluid mt--7">
        <div class="row">
            </div>
            <div class="container-fluid mt--17">
        <div class="row mt-5 justify-content-md-left">
            <div class="col-xl-10">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Overview</h6>
                                <h2 class="mb-10">Receita<i class="fa fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Valor total de vendas feitas por dia"></i></h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart  h-auto p-auto" >
                            <canvas id="chart-total-revenue" class="chart-total-revenue"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 justify-content-md-left">
            <div class="col-xl-10">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Overview</h6>
                                <h2 class="mb-0">Vendas <i class="fa fa-question-circle"  data-toggle="tooltip" data-placement="top" title="Quantidade total de vendas feitas por dia"></i></h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart h-auto">
                            <canvas id="chart-total-sales" class="chart-total-sales"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 justify-content-md-left">
            <div class="col-xl-10">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                <h2 class="text-white mb-0">Ticket Médio <i class="fa fa-question-circle"  data-toggle="tooltip" data-placement="top" title="O valor do ticket médio é a receita divida pela quantidade de vendas"></i></h2>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart h-auto">
                            <canvas id="chart-average-ticket" class="chart-average-ticket"></canvas> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card shadow">
                </div>
            </div>
        </div>    
    </div>
 
 
 </template>

<script>
    import Chart from 'chart.js/auto';
    export default{
    
    data() {
        return {
            dashboardAverage: { type: Object, default: () => ({}) },
            dashboardSales: { type: Object, default: () => ({}) },
            dashboardRevenue: { type: Object, default: () => ({}) },
        }
    },
    
    mounted() {
        axios.get('/home/getDatas')
	    	.then(response => {
	    	    this.dashboard = response.data
                this.dashboardRevenue = this.getDashboardRevenue();
                this.dashboardSales = this.getDashboardSales();
                this.dashboardAverage = this.getDashboardAverege();
        
                this.graphicRevenue();
                this.graphicSales();
                this.graphicAverege();
            })
            .catch(error => {
                console.log(error)
            });
    },
    methods:{
        getDashboardRevenue() {
            var revenue = [];
            var dashs =  this.dashboard;
            var partner = [];
            var count = Object.keys(dashs).length;
            var arr = [];

            $.each(dashs, function(index, value) {
                partner.push(index);
                for(var i = 0; i<value.length; i++ ){
                    if(value[i]['type'] == 'total_revenue'){
                        console.log(arr[value[i]['date']])
                        if(arr[value[i]['date']] == undefined) {
                            arr[value[i]['date']] = [];
                        }
                        arr[value[i]['date']][partner.length - 1] = value[i]['value'];
                    }  
                }
            }),

            revenue.push(partner);

            $.each(Object.assign({}, arr), function(index, value) {
                var dates = [];
                for(var i = 0; i<partner.length; i++ ){
                    if(i == 0){
                        dates.push(index);
                    }
                    if(value[i] == undefined) {
                        dates.push(0); 
                    } else { 
                        dates.push(value[i])
                    }     
                }  
                revenue.push(dates);   
                    
            });
            return revenue
        },
          
        getDashboardSales() {
            var sales = [];
            var dashs = this.dashboard;
            var partner = [];
            var count = Object.keys(dashs).length;
            var arr = [];

            $.each(dashs, function(index, value) {
                partner.push(index);
                for(var i = 0; i<value.length; i++ ){
                    if(value[i]['type'] == 'total_sales'){
                        if(arr[value[i]['date']] == undefined) {
                            arr[value[i]['date']] = [];
                        }
                        arr[value[i]['date']][partner.length - 1] = value[i]['value']; 
                    }  
                }
            }),

            sales.push(partner);

            $.each(Object.assign({}, arr), function(index, value) {
                var dates = [];
                for(var i = 0; i<partner.length; i++ ){
                    if(i == 0){
                        dates.push(index);
                    }
                    if(value[i] == undefined) {
                        dates.push(0); 
                    } else { 
                        dates.push(value[i])
                    }     
                }  
                sales.push(dates);   
            });

            return sales
        },

        getDashboardAverege() {
            var average = [];
            var dashs = this.dashboard;
            var partner = [];
            var count = Object.keys(dashs).length;
            var arr = [];
            $.each(dashs, function(index, value) {
                partner.push(index);
                for(var i = 0; i<value.length; i++ ){
                    if(value[i]['type'] == 'average_ticket'){
                        if(arr[value[i]['date']] == undefined) {
                            arr[value[i]['date']] = [];
                        }
                        arr[value[i]['date']][partner.length - 1] = value[i]['value']; 
                  }  
                }
            });

            average.push(partner);

            $.each(Object.assign({}, arr), function(index, value) {
                var dates = [];
                for(var i = 0; i<partner.length; i++ ){
                    if(i == 0){
                        dates.push(index);
                    }
                    if(value[i] == undefined) {
                        dates.push(0); 
                    }else{ 
                        dates.push(value[i])
                    }     
                }  
                average.push(dates);   
            });
            
            return average
        },
          
        graphicRevenue(){
            const ctx = document.getElementById('chart-total-revenue');
            var revenue = this.dashboardRevenue;
            var time_labels = Object.values(revenue.slice(1).map(element => element[0])),
            partners = Object.values(revenue[0]),
            revenue_datasets = [],

            bg = [
                'rgba(27, 158, 119, 0.5)',
                'rgba(217, 95, 2, 0.5)',
                'rgba(117, 112, 179, 0.5)',
                'rgba(231, 41, 138, 0.5)',
                'rgba(102, 166, 30, 0.5)',
                'rgba(230, 171, 2, 0.5)',
                'rgba(166, 118, 29, 0.5)',
                'rgba(102, 102, 102, 0.5)'
            ],
            bc = [
                'rgb(27, 158, 119)',
                'rgb(217, 95, 2)',
                'rgb(117, 112, 179)',
                'rgb(231, 41, 138)',
                'rgb(102, 166, 30)',
                'rgb(230, 171, 2)',
                'rgb(166, 118, 29)',
                'rgb(102, 102, 102)'
            ]

            for (let i = 1; i < partners.length + 1; i++) {
                revenue_datasets.push({
                    label: partners[i - 1],
                    data: Object.values(revenue.slice(1).map(element => element[i])),
                    backgroundColor: bg[i - 1],
                    borderColor: bc[i - 1],
                    fill: false,
                    tension: 0.4,
                    pointStyle: 'circle',
                    pointRadius: 5,
                    pointHoverRadius: 6
                })
            }
                    
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    datasets: revenue_datasets,
                    labels: time_labels
                },
                options: {
                    plugins: {}
                }
            });
        },
        graphicSales(){
            var sales = this.dashboardSales;
            var time_labels = Object.values(sales.slice(1).map(element => element[0])),
            partners = Object.values(sales[0]),
            sales_datasets = [],

            bg = [
                'rgba(27, 158, 119, 0.5)',
                'rgba(217, 95, 2, 0.5)',
                'rgba(117, 112, 179, 0.5)',
                'rgba(231, 41, 138, 0.5)',
                'rgba(102, 166, 30, 0.5)',
                'rgba(230, 171, 2, 0.5)',
                'rgba(166, 118, 29, 0.5)',
                'rgba(102, 102, 102, 0.5)'
            ],
            bc = [
                'rgb(27, 158, 119)',
                'rgb(217, 95, 2)',
                'rgb(117, 112, 179)',
                'rgb(231, 41, 138)',
                'rgb(102, 166, 30)',
                'rgb(230, 171, 2)',
                'rgb(166, 118, 29)',
                'rgb(102, 102, 102)'
            ]
           
            for (let i = 1; i < partners.length + 1; i++) {
                sales_datasets.push({
                    label: partners[i - 1],
                    data: Object.values(sales.slice(1).map(element => element[i])),
                    backgroundColor: bg[i - 1],
                    borderColor: bc[i - 1],
                    borderWidth: 2,
                    borderRadius: Number.MAX_VALUE,
                    borderSkipped: false,
                })
            }
       
            const ctx = document.getElementById('chart-total-sales');
                    
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    datasets: sales_datasets,
                    labels: time_labels,
                    
                     },
                options: {
                    legend: {
                        labels: {}
                    },
                }
            }); 
        },
        
        graphicAverege(){
            var ticket = this.dashboardAverage;
            var time_labels = Object.values(ticket.slice(1).map(element => element[0])),
            partners = Object.values(ticket[0]),
            ticket_datasets = [],

            bg = [
                'rgba(27, 235, 119, 0.5)',
                'rgba(255, 147, 22, 0.5)',
                'rgba(149, 52, 179, 0.4)',
                'rgba(231, 41, 138, 0.5)',
                'rgba(102, 166, 30, 0.5)',
                'rgba(230, 171, 2, 0.5)',
                'rgba(166, 118, 29, 0.5)',
                'rgba(102, 102, 102, 0.5)'
            ],
            bc = [
                'rgb(27, 235, 119)',
                'rgb(255, 123, 20)',
                'rgb(149, 52, 179)',
                'rgb(231, 41, 138)',
                'rgb(102, 166, 30)',
                'rgb(230, 171, 2)',
                'rgb(166, 118, 29)',
                'rgb(102, 102, 102)'
            ]
           
            for (let i = 1; i < partners.length + 1; i++) {
                ticket_datasets.push({
                    label: partners[i - 1],
                    data: Object.values(ticket.slice(1).map(element => element[i])),
                    backgroundColor: bg[i - 1],
                    borderColor: bc[i - 1],
                    borderWidth: 2,
                    borderRadius: 5,
                    borderSkipped: false,
                })
            }
            const ctx = document.getElementById('chart-average-ticket');
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    datasets: ticket_datasets,
                    labels: time_labels,
                },
                options: {
                    plugins: {
                        legend: {
                            labels: {     
                                color: 'white',
                            }
                        }
                    },
                    scales: {
                        y: {
                            ticks: { color: 'white', beginAtZero: true }
                        },
                        x: {
                            ticks: { color: 'white', beginAtZero: true }
                        }
                    }
                }
            }); 
        },
    }
}
</script>
 