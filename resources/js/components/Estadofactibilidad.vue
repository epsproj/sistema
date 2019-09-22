<template>
    <!-- Contenido Principal -->
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Estado Factibilidad
                    <button type="button" @click="abrirModal('estadofactibilidad','registrar')" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="nombre">Nombre</option>
                                    <option value="descripcion">Descripción</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarEstadofactibilidad(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarEstadofactibilidad(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="estadofactibilidad in arrayEstadofactibilidad" :key="estadofactibilidad.id">
                                <td>
                                    <button type="button" @click="abrirModal('estadofactibilidad','actualizar',estadofactibilidad)" class="btn btn-warning btn-sm">
                                        <i class="icon-pencil"></i>
                                    </button> &nbsp;
                                    
                                    <template v-if="estadofactibilidad.estado">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarEstadofactibilidad(estadofactibilidad.id)">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </template>

                                    <template v-else>
                                        <button type="button" class="btn btn-info btn-sm" @click="activarEstadofactibilidad(estadofactibilidad.id)">
                                            <i class="icon-check"></i>
                                        </button>
                                    </template>

                                </td>
                                <td v-text="estadofactibilidad.nombre"></td>
                                <td>
                                    <div v-if="estadofactibilidad.estado">
                                        <span class="badge badge-success">Activo</span>
                                    </div>
                                    <div v-else>
                                        <span class="badge badge-danger">Desactivado</span>
                                    </div>
                                    
                                </td>
                            </tr>
                            
                            
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.currente_page - 1,buscar,criterio)">Ant</a>
                            </li>
                            <li class="page-item active" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page">1</a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.currente_page + 1,buscar,criterio)">Sig</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombre" class="form-control" placeholder="Nombre del Estado de Factibilidad">
                                    <span class="help-block">(*) Ingrese el Estado de factibilidad</span>
                                </div>
                            </div>
                    
                            <div v-show="errorEstadofactibilidad" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjFactibilidad" :key="error" v-text="error">

                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion == 1" class="btn btn-primary" @click="registrarEstadofactibilidad()">Guardar</button>
                        <button type="button" v-if="tipoAccion == 2" class="btn btn-primary" @click="actualizarEstadofactibilidad()">Actualizar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
    </main>
    <!-- /Fin del contenido principal -->
</template>


<script>
    export default {
        data (){
            return {
                estadofactibilidad_id : 0,
                nombre: '',
                arrayEstadofactibilidad : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorEstadofactibilidad : 0,
                errorMostrarMsjFactibilidad : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page'  : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0
                },
                offset : 3,
                criterio : 'nombre',
                buscar : ''
            }
        },

        computed:{
            isActived: function() {
                return this.pagination.current_page;
            },
            //Calcular los elementos de la pagina
            pagesNumber: function() {
                if(!this.pagination.to){
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }

                var to = from + (this.offset *2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        
        methods : {
            listarEstadofactibilidad (page,buscar,criterio){
                let me = this;
                var url = '/estadofactibilidad?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response){
                    var respuesta = response.data;
                    me.arrayEstadofactibilidad = respuesta.estadofactibilidades.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error){
                    console.log(error);
                })
            },

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //actualizala pagina actual
                me.pagination.current_page = page;
                //enviar la peticion para visualizar la data de esta pàgina
                me.listarEstadofactibilidad(page,buscar,criterio);
            },

            registrarEstadofactibilidad(){
                if(this.validarEstadofactibilidad()){
                    return;
                }

                let me = this;

                axios.post('/estadofactibilidad/registrar',{
                    'nombre' : this.nombre
                }).then(function (response){
                    me.cerrarModal();
                    me.listarEstadofactibilidad(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },

            actualizarEstadofactibilidad(){
                if(this.validarEstadofactibilidad()){
                    return;
                }

                let me = this;

                axios.put('/estadofactibilidad/actualizar',{
                    'nombre' : this.nombre,
                    'id' : this.estadofactibilidad_id
                }).then(function (response){
                    me.cerrarModal();
                    me.listarEstadofactibilidad(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },

            desactivarEstadofactibilidad(id){
                swal({
                title: '¿Está seguro de desactivar el Estado de Factibilidad?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonStyling: false, 
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/estadofactibilidad/desactivar',{
                        'id' : id
                    }).then(function (response){
                        me.listarEstadofactibilidad(1,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                   
                }
                })
            },

            activarEstadofactibilidad(id){
                swal({
                title: '¿Está seguro de activar el Estado de Factibilidad?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonStyling: false, 
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/estadofactibilidad/activar',{
                        'id' : id
                    }).then(function (response){
                        me.listarEstadofactibilidad(1,'','nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                   
                }
                })
            },

            validarEstadofactibilidad(){
                this.errorEstadofactibilidad = 0;
                this.errorMostrarMsjFactibilidad = [];

                if(!this.nombre) this.errorMostrarMsjFactibilidad.push("El nombre del Estado de la Factibilidad no puede estar vacío.");

                if(this.errorMostrarMsjFactibilidad.length) this.errorEstadofactibilidad = 1;

                return this.errorEstadofactibilidad;
            },

            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.nombre = '';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case"estadofactibilidad":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registar Estado Factibilidad';
                                this.nombre = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Estado Factibilidad';
                                this.tipoAccion = 2;
                                this.estadofactibilidad_id = data['id'];
                                this.nombre = data ['nombre'];
                                break;
                            }
                        }
                    }
                }
            }
        },

        mounted() {
            this.listarEstadofactibilidad(1,this.buscar,this.criterio);
        }
    }
</script>


<style >
    .modalcontent{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>