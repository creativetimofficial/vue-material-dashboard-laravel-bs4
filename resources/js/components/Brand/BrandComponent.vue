<template>
    <div class="container-fluid mt--7">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="float-left">Consultar Marcas</h1>
                    <div class="float-right">
                        <a href="/brands/create" class="btn btn-success align-right">Adicionar Nova</a>
                    </div>
                </div>

                <div class="card-body">
                        <data-table
                        url="/brands/dataTable"
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
                    label: 'name',
                    name: 'name',
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
                {
                label: '',
                name: 'Excluir',
                orderable: false,
                classes: {
                    'btn': true,
                    'btn-danger': true,
                    'btn-sm': true,
                },
                event: "click",
                handler: this.deletebrand,
                component: ButtonComponent,
            	},
                {
                label: '',
                name: 'Editar',
                orderable: false,
                classes: {
                    'btn': true,
                    'btn-info': true,
                    'btn-sm': true,
                },
                event: "click",
                handler: this.editbrand,
                component: ButtonComponent,
            	},
            ]
        }
    },
    components: {
        // eslint-disable-next-line
        ButtonComponent,
    },
    methods: {
        formatDate(data){
            const dataSplit1 = data.split("T");
            const date = dataSplit1[0];
            const miliHour = dataSplit1[1].split(".");
            const hour = miliHour[0];
            return date +"  "+ hour;
        },
        deletebrand(data) {
            axios.delete('/brands/' + data.id)
            .then( response=> {
                this.alert('Marca excluída com sucesso!', 'success', 1200);
                setTimeout(() => {  location.reload(); }, 1300);
                
            }).catch(error => {
                this.alert('Erro ao excluir Marca', 'error', 1200)
                console.log(error)
            });
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

        editbrand(data) {
            window.location.href = `/brands/${data.id}`
        },
    }
    
}
</script>
 