<template>
    <div class="container-fluid mt--7">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="float-left">Consultar Clientes</h1>
                </div>

                <div class="card-body">
                        <data-table
                        url="/client/dataTable"
                        :columns="columns"
                        >
                        </data-table>
                </div>
            </div>
        </div>
    </div>
</div>
  
</template>

<script>
    export default{
    
    data() {
        return {
            columns: [
                {
                    label: 'id',
                    name: 'id',
                    orderable: true,
                },
                {
                    label: 'name',
                    name: 'name',
                    orderable: true,
                },
                {
                    label: 'E-mail',
                    name: 'email',
                    orderable: true,
                },
                {
                    label: 'Última atualização',
                    name: 'updated_at',
                    orderable: true,
                    transform: ({data, name}) => this.formatDate(data[name])
                },
                {
                    label: 'Criado',
                    name: 'created_at',
                    orderable: true,
                    transform: ({data, name}) => this.formatDate(data[name])
                },
                // {
                // label: '',
                // name: 'View',
                // orderable: false,
                // classes: {
                //     'btn': true,
                //     'btn-primary': true,
                //     'btn-sm': true,
                // },
                // event: "click",
                // handler: this.displayRow,
                // component: ButtonComponent,
            	// },
            ]
        }
    },
    methods: {
        formatDate(data){
            const dataSplit1 = data.split("T");
            const date = dataSplit1[0];
            const miliHour = dataSplit1[1].split(".");
            const hour = miliHour[0];
            return date +"  "+ hour;
        },
    }
    
}
</script>
 