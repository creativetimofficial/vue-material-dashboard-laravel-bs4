<template>
    <div class="container-fluid mt--7">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="float-left">Consultar Comentários</h1>
                </div>

                <div class="card-body">
                        <data-table
                        url="/comments/dataTable"
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
import Swal from 'sweetalert2/dist/sweetalert2.js'
import ButtonComponent from "../ButtonComponent.vue";
import 'sweetalert2/src/sweetalert2.scss'
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
                    label: 'Id do Cliente',
                    name: 'clients_id',
                    orderable: true,
                },
                {
                    label: 'Id do Produto',
                    name: 'products_id',
                    orderable: true,
                },
                {
                    label: 'Título',
                    name: 'title',
                    orderable: true,
                },
                {
                    label: 'Nota',
                    name: 'rate',
                    orderable: true,
                },
                {
                    label: 'Status',
                    name: 'status',
                    orderable: true,
                    transform: ({data, name}) => this.formatStatus(data[name])
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
                {
                label: '',
                name: 'Desabilitar',
                orderable: false,
                classes: {
                    'btn': true,
                    'btn-danger': true,
                    'btn-sm': true,
                },
                event: "click",
                handler: this.disableComment,
                component: ButtonComponent,
            	},
                {
                label: '',
                name: 'Habilitar',
                orderable: false,
                classes: {
                    'btn': true,
                    'btn-info': true,
                    'btn-sm': true,
                },
                event: "click",
                handler: this.enableComment,
                component: ButtonComponent,
            	},
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
        formatStatus(data) {
            return data == 1 ? 'Ativo' : 'Inativo';
        },
        alert(message, icon, time) {
            Swal.fire({
                position: 'top-end',
                title: message,
                icon: icon,
                timer: time,
                toast: true,
                showConfirmButton: false
            })
        },
        disableComment(data) {
            axios.put('/comments/disable/' + data.id, {"status": 0})
            .then( response=> {
                this.alert('Comentário desabilitado com sucesso!', 'success', 1200);
                setTimeout(() => {  location.reload(); }, 1300);
                
            }).catch(error => {
                this.alert('Erro ao desabilitar Comentário', 'error', 1200)
                console.log(error)
            });
        },

        enableComment(data) {
            axios.put('/comments/disable/' + data.id, {"status": 1})
            .then( response=> {
                this.alert('Comentário desabilitado com sucesso!', 'success', 1200);
                setTimeout(() => {  location.reload(); }, 1300);
                
            }).catch(error => {
                this.alert('Erro ao desabilitar Comentário', 'error', 1200)
                console.log(error)
            });
        }
    }
    
}
</script>
 