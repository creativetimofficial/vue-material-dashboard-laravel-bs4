<template>
    <div class="container-fluid mt--7">
        <div class="modal fade" id="ImportProductCsv" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Importar CSV de Produtos</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form class="d-inline hidden-edit-form" method="put" @submit.prevent="routeSendCsv">
                        <input type="hidden" name="_token" :value="csrf">
                        <div class="form-group csv-import-file">
                            <input type="file" name="csv" class="form-control-file" v-on:change="onFileChange">
                        </div>
                        <div class="modal-footer d-flex flex-row mt--4">
                            <div class="loader mr-4" id="spinnerInsertCsv" style="display: none"></div>
                            <button type="submit" class="btn btn-sm btn-primary mt-2" id="sendCsv">Enviar CSV</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="float-left">Consultar Produtos</h1>
                        <div class="float-right">
                            <a href="/products/create" class="btn btn-success align-right">Adicionar Novo</a>
                            <button class="btn btn-success align-right" @click="sendProductCsv">Importar CSV</button>
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
            ],
            file: ""
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
        sendProductCsv() {
            $("#ImportProductCsv").modal()
        },
        routeSendCsv() {
            this.showLoading('sendCsv','spinnerInsertCsv');
            let formData = new FormData();
            formData.append('file', this.file);
            axios.post('/products/sendCsvProducts', formData)
                .then(response => {
                    this.alert('Template importado com sucesso!', 'success', 1200)
                    this.hideLoading('sendCsv','spinnerInsertCsv');
                })
                    .catch(error => {
                    this.alert('Não foi possível importar template.', 'error', 2000)
                    this.hideLoading('sendCsv','spinnerInsertCsv');
                })
            $("#ImportHotelCsv").modal('hide')
        },
        onFileChange(e) {
            this.file = e.target.files[0];
        },
        showLoading(idButton, idSpinner){
            document.getElementById(idSpinner).style.display="block"
            document.getElementById(idButton).disabled = true
        },
        hideLoading(idButton, idSpinner){
            document.getElementById(idButton).disabled = false
            document.getElementById(idSpinner).style.display="none"
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
 