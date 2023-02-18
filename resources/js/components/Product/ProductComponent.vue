<template>
    <div class="container-fluid mt--7">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="float-left">Consultar Produtos</h1>
                    <div class="float-right">
                        <a href="/products/create" class="btn btn-success align-right">Adicionar Novo</a>
                    </div>
                </div>

                <div class="card-body">
                        <data-table
                        url="/products/dataTable"
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
                    label: 'description',
                    name: 'description',
                    orderable: true,
                },
                {
                    label: 'price',
                    name: 'price',
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
                handler: this.deleteProduct,
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
                handler: this.editProduct,
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
        deleteProduct(data) {
            axios.delete('/products/' + data.id)
            .then( response=> {
                this.alert('Produto excluído com sucesso!', 'success', 1200);
                setTimeout(() => {  location.reload(); }, 1300);
                
            }).catch(error => {
                this.alert('Erro ao excluir Protuto', 'error', 1200)
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

        editProduct(data) {
            window.location.href = `/products/${data.id}`
        },
    }
    
}
</script>
 