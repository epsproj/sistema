<template>
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
                        <i class="fa fa-align-justify"></i> Personas
                        <button type="button" @click="abrirModal('persona','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPersona(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                     <th>Apellido</th>
                                      <th>Direccion</th>
                                       <th>Telefono</th>
                                        <th>Correo</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="persona in arrayPersona" :key="persona.id">
                                    <td>
                                        <button type="button" @click="abrirModal('persona','actualizar',persona)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        
                                        <template v-if="persona.estado">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarPersona(persona.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>

                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarPersona(persona.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>

                                    </td>
                                    <td v-text="persona.nombre"></td>
                                     <td v-text="persona.apellido"></td>
                                      <td v-text="persona.direccion"></td>
                                       <td v-text="persona.telefono"></td>
                                        <td v-text="persona.correo"></td>
                                    <td>
                                        <div v-if="persona.estado">
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
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
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
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Nombre ">
                                       
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Apellidos</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="apellido" class="form-control" placeholder="Apellidos">
                                       
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Dirección</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="direccion" class="form-control" placeholder="Direccion">
                                       
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Telefono</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="telefono" class="form-control" placeholder="Telefono">
                                       
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Correo</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="correo" class="form-control" placeholder="correo">
                                       
                                    </div>
                                </div>
                                <div v-show="errorPersona" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion == 1" class="btn btn-primary" @click="registrarPersona()">Guardar</button>
                            <button type="button" v-if="tipoAccion == 2" class="btn btn-primary" @click="actualizarPersona()">Actualizar</button>
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
        data () {
            return {
                Persona_id: 0,
                nombre : '',
                apellido : '',
                direccion : '',
                telefono : '',
                correo : '',
                arrayPersona: [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorPersona : 0,
                errorMostrarMsjPersona : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
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

                var to =from + (this.offset *2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = []
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods : {
            listarPersona (page,buscar,criterio) {
                let me=this;
                var url = '/persona?page=' + page + '&buscar='+ buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response){
                    var respuesta = response.data;
                    me.arrayPersona = respuesta.personas.data;
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
                me.listarPersona(page,buscar,criterio);
            },
            registrarPersona(){
                if(this.validarPersona()){
                    return;
                }

                let me = this;

                axios.post('/persona/registrar',{
                    'nombre' : this.nombre,
                    'apellido' : this.apellido,
                    'direccion' : this.direccion,
                    'telefono' : this.telefono,
                    'correo' : this.correo
                }).then(function (response){
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarPersona(){
                if(this.validarPersona()){
                    return;
                }

                let me = this;

                axios.put('/persona/actualizar',{
                    'nombre' : this.nombre,
                    'apellido' : this.apellido,
                    'direccion' : this.direccion,
                    'telefono' : this.telefono,
                    'correo' : this.correo,
                    'id' : this.Persona_id
                }).then(function (response){
                    me.cerrarModal();
                    me.listarPersona(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            desactivarPersona(id){
                swal({
                title: '¿Etá seguro de desactivar a la Persona?',
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

                    axios.put('/persona/desactivar',{
                        'id' : id
                    }).then(function (response){
                        me.listarPersona(1,'','nombre');
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
                    swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'El registro ha sido cancelado',
                    'error'
                    )
                }
                })
            },
            activarPersona(id){
                swal({
                title: '¿Etá seguro de activar a la Persona?',
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

                    axios.put('/persona/activar',{
                        'id' : id
                    }).then(function (response){
                        me.listarPersona(1,'','nombre');
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
                    swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'El registro ha sido cancelado',
                    'error'
                    )
                }
                })
            },
            validarPersona(){
                this.errorPersona = 0;
                this.errorMostrarMsjPersona = [];

                if(!this.nombre) this.errorMostrarMsjPersona.push("El nombre de Tipo de Obra no puede estar vacío.");

                if(this.errorMostrarMsjPersona.length) this.errorPersona = 1;

                return this.errorPersona;
            },
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.nombre = '';
                this.apellido = '';
                this.direccion = '';
                this.telefono = '';
                this.correo = '';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "persona":
                    {
                        switch (accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registar Persona';
                                this.nombre = '';
                                this.apellido = '';
                                this.direccion = '';
                                this.telefono = '';
                                this.correo = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Persona';
                                
                                this.Persona_id = data['id'];
                                this.nombre = data['nombre'];
                                this.apellido = data['apellido'];
                                this.direccion = data['direccion'];
                                this.telefono = data['telefono'];
                                this.correo = data['correo'];
                                this.tipoAccion = 2;
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarPersona(1,this.buscar,this.criterio);
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