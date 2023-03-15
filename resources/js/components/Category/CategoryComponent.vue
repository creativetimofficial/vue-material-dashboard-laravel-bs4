<template>
    <div class="container-fluid mt--7">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="float-left">Consultar Categorias</h1>
                    <div class="float-right">
                        <a href="/categories/create" class="btn btn-success align-right">Adicionar Novo</a>
                    </div>
                </div>

                <div class="card-body">
                        <data-table
                        url="/categories/dataTable"
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
                handler: this.deleteCategory,
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
                handler: this.editCategory,
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
        deleteCategory(data) {
            axios.delete('/categories/' + data.id)
            .then( response=> {
                this.alert('Categoria excluída com sucesso!', 'success', 1200);
                setTimeout(() => {  location.reload(); }, 1300);
                
            }).catch(error => {
                this.alert('Erro ao excluir Categoria', 'error', 1200)
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

        editCategory(data) {
            window.location.href = `/categories/${data.id}`
        },
    }
    
}
</script>
 