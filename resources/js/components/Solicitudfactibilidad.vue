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
                        <i class="fa fa-align-justify"></i> Solicitudes 
                        <button type="button" @click="abrirModal('solicitudfactibilidad','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class=" row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarSolicitudfactibilidad(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarSolicitudfactibilidad(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-responsive-sm table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>direccion de la obra</th>
                                    <th>codigo inmueble</th>
                                     <th>No expediente</th>
                                      <th>Expediente interno</th>
                                       <th>No finca</th>
                                        <th>No. folio</th>
                                        <th>Libro</th>
                                        <th>No. catastral</th>
                                        <th>Solvencia Municipal</th>
                                        <th>Observaciones</th>
                                        <th>longitud</th>
                                        <th>ancho</th>
                                        <th>profundidad</th>
                                        <th>diametro de tubo</th>
                                        <th>diametro colector</th>
                                        <th>Tipo de obra</th>
                                        <th>Ejecutor</th>
                                        <th>Propietario</th>
                                        <th>Estado</th>

                                   
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="solicitudfactibilidad in arraySolicitudfactibilidad" :key="solicitudfactibilidad.id">
                                    <td>
                                        <button type="button" @click="abrirModal('solicitudfactibilidad','actualizar',solicitudfactibilidad)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        
                                        <template v-if="solicitudfactibilidad.estado">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarPersona(solicitudfactibilidad.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>

                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarPersona(solicitudfactibilidad.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>

                                    </td>
                                     <td v-text="solicitudfactibilidad.direccionobra"></td>
                                    <td v-text="solicitudfactibilidad.codigoinmueble"></td>
                                     <td v-text="solicitudfactibilidad.noexpediente"></td>
                                      <td v-text="solicitudfactibilidad.noexpedienteinterno"></td>
                                       <td v-text="solicitudfactibilidad.nofinca"></td>
                                        <td v-text="solicitudfactibilidad.nofolio"></td>
                                        <td v-text="solicitudfactibilidad.libro"></td>
                                        <td v-text="solicitudfactibilidad.nocatastral"></td>
                                        <td v-text="solicitudfactibilidad.solvenciamunicipal"></td>
                                        <td v-text="solicitudfactibilidad.observacion"></td>
                                        <td v-text="solicitudfactibilidad.longitud"></td>
                                        <td v-text="solicitudfactibilidad.ancho"></td>
                                        <td v-text="solicitudfactibilidad.profundidad"></td>
                                        <td v-text="solicitudfactibilidad.diametrotubo"></td>
                                        <td v-text="solicitudfactibilidad.diametrocolector"></td>
                                        <td v-text="solicitudfactibilidad.nombre_tipoobra"></td>
                                        <td v-text="solicitudfactibilidad.nombre_ejecutor"></td>
                                        <td v-text="solicitudfactibilidad.nombre_persona"></td>
                                        <td v-text="solicitudfactibilidad.nombre_estadofactibilidad"></td>

                                    <td>
                                        <div v-if="solicitudfactibilidad.estado">
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
                                
                                <div class="col-4">
                                <label class="col-md-3 form-control-label" for="text-input" >Propietario</label>
                                <select class="form-control" v-model="idpersona">
                                    <option value="0" disabled>Seleccione</option>
                                    <option v-for="persona in arrayPersona" :key="persona.id" :value="persona.id" v-text="persona.nombre"></option>
                                    </select> 
                                </div>
                                <div class="col-4">
                                    <label class="col-md-3 form-control-label" for="text-input" >Ejecutor</label>
                                <select class="form-control" v-model="idejecutor">
                                    <option value="0" disabled>Seleccione</option>
                                    <option v-for="ejecutor in arrayEjecutor" :key="ejecutor.id" :value="ejecutor.id" v-text="ejecutor.nombre"></option>
                                    </select> 
                                </div>
                                <div class="col-4">
                                    <label class="col-md-3 form-control-label" for="text-input" >Obra</label>
                                <select class="form-control" v-model="idtipoobra">
                                    <option value="0" disabled>Seleccione</option>
                                    <option v-for="tipoobra in arrayTipoobra" :key="tipoobra.id" :value="tipoobra.id" v-text="tipoobra.nombre"></option>
                                    </select>
                                </div>
                            </div>            

                            <div class="form-group row">
                                
                                <div class="col-6">
                                <label class="col-md-6 form-control-label" for="text-input" >Estado</label>
                                <select class="form-control" v-model="idestadofactibilidad">
                                    <option value="0" disabled>Seleccione</option>
                                    <option v-for="estadofactibilidad in arrayEstadofactibilidad" :key="estadofactibilidad.id" :value="estadofactibilidad.id" v-text="estadofactibilidad.nombre"></option>
                                    </select> 
                                </div>
                                <div class="col-4">
                                <label class="col-md-6 form-control-label" for="text-input" >Direccion</label>
                                <input type="text" v-model="direccionobra"  class="form-control" placeholder="Direccion">

                                </div>
                            </div>   


                            <div class="form-group row">
                                
                                <div class="col-4">
                                <label class="col-md-6 form-control-label" for="text-input" >inmueble</label>
                                <input type="text" v-model="codigoinmueble"  class="form-control" placeholder="inmueble">

                                </div>
                                <div class="col-4">
                                    <label class="col-md-3 form-control-label" for="text-input" >expediente</label>
                                <input type="text" v-model="noexpediente"  class="form-control" placeholder="expediene">
                                </div>
                                <div class="col-4">
                                <label class="col-md-6 form-control-label" for="text-input" >Direccion</label>
                                <input type="text" v-model="direccionobra"  class="form-control" placeholder="Direccion">

                                </div>
                            </div>   

                            <div class="form-group row">
                                
                                <div class="col-4">
                                <label class="col-md-6 form-control-label" for="text-input" >No expediente</label>
                                <input type="text" v-model="noexpediente"  class="form-control" placeholder="No expediente">

                                </div>
                                <div class="col-8">
                                    <label class="col-md-3 form-control-label" for="text-input" >Expediente interno</label>
                                <input type="text" v-model="noexpedienteinterno"  class="form-control" placeholder="Expediente interno">
                                </div>
                            </div>  

                            <div class="form-group row">
                                
                                <div class="col-4">
                                <label class="col-md-5 form-control-label" for="text-input" >finca</label>
                                <input type="text" v-model="noexpediente"  class="form-control" placeholder="No expediente">

                                </div>
                                <div class="col-4">
                                    <label class="col-md-5 form-control-label" for="text-input" >folio</label>
                                <input type="text" v-model="noexpedienteinterno"  class="form-control" placeholder="Expediente interno">
                                </div>
                                <div class="col-4">
                                    <label class="col-md-5 form-control-label" for="text-input" >libro</label>
                                <input type="text" v-model="noexpedienteinterno"  class="form-control" placeholder="Expediente interno">
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
                            <button type="button" v-if="tipoAccion == 1" class="btn btn-primary" @click="registrarSolicitudfactibilidad()">Guardar</button>
                            <button type="button" v-if="tipoAccion == 2" class="btn btn-primary" @click="actualizarSolicitudfactibilidad()">Actualizar</button>
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
                solicitudfactibilidad_id: 0,
                nombre_persona:'',
                nombre_ejecutor:'',
                nombre_estadofactibilidad:'',
                nombre_tipoobra:'',
                idtipoobra : 0,
                idejecutor : 0,
                idpersona : 0,
                idestadofactibilidad : 0,
                direccionobra : '',
                codigoinmueble : '',
                noexpediente : '',
                noexpedienteinterno : '',
                nofinca : '',
                nofolio : '',
                libro : '',
                nocatastral : '',
                solvenciamunicipal : '',
                observacion : '',
                longitud : '',
                ancho : '',
                diametrotubo : '',
                diametrocolector : '',
                
                arraySolicitudfactibilidad: [],
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
                buscar : '',
                arrayPersona:[] ,
                arrayEjecutor:[]  ,
                arrayEstadofactibilidad:[]  ,
                arrayTipoobra:[]  


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
            listarSolicitudfactibilidad (page,buscar,criterio) {
                let me=this;
                var url = '/solicitudfactibilidad?page=' + page + '&buscar='+ buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response){
                    var respuesta = response.data;
                    me.arraySolicitudfactibilidad = respuesta.solicitudfactibilidades.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error){
                    console.log(error);
                })
            },
            selectPersona(){
                 let me=this;
                var url='/persona/selectPersona';
                axios.get(url).then(function (response) {
                   
                    var respuesta=response.data;
                    me.arrayPersona=respuesta.personas;
                  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            },
            selectEjecutor(){
                 let me=this;
                var url='/ejecutor/selectEjecutor';
                axios.get(url).then(function (response) {
                   
                    var respuesta=response.data;
                    me.arrayEjecutor=respuesta.ejecutores;
                  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            },
            selectEstadofactibilidad(){
                 let me=this;
                var url='/estadofactibilidad/selectEstadofactibilidad';
                axios.get(url).then(function (response) {
                   
                    var respuesta=response.data;
                    me.arrayEstadofactibilidad=respuesta.estadofactibilidades;
                  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            },
            selectTipoobra(){
                 let me=this;
                var url='/tipoobra/selectTipoobra';
                axios.get(url).then(function (response) {
                   
                    var respuesta=response.data;
                    me.arrayTipoobra=respuesta.tipoobras;
                  
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //actualizala pagina actual
                me.pagination.current_page = page;
                //enviar la peticion para visualizar la data de esta pàgina
                me.listarSolicitudfactibilidad(page,buscar,criterio);
            },
            registrarSolicitudfactibilidad(){
                if(this.validarPersona()){
                    return;
                }

                let me = this;

                axios.post('/solicitudfactibilidad/registrar',{
                    'direccionobra' : this.direccionobra,
                    'codigoinmueble' : this.codigoinmueble,
                    'noexpediente' : this.noexpediente,
                    'noexpedienteinterno' : this.noexpedienteinterno,
                    'nofinca' : this.nofinca,
                    'nofolio' : this.nofolio,
                    'libro' : this.libro,
                    'nocatastral' : this.nocatastral,
                    'solvenciamunicipal' : this.solvenciamunicipal,
                    'observacion' : this.observacion,
                    'longitud' : this.longitud,
                    'ancho' : this.ancho,
                    'diametrotubo' : this.diametrotubo,
                    'diametrocolector' : this.diametrocolector,
                    'idtipoobra' : this.idtipoobra,
                    'idejecutor' : this.idejecutor,
                    'idpersona' : this.idpersona,
                    'idestadofactibilidad' : this.idestadofactibilidad
                    

                }).then(function (response){
                    me.cerrarModal();
                    me.listarSolicitudfactibilidad(1,'','nombre');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarSolicitudfactibilidad(){
                if(this.validarPersona()){
                    return;
                }

                let me = this;

                axios.put('/solicitudfactibilidad/actualizar',{
                    'direccionobra' : this.direccionobra,
                    'codigoinmueble' : this.codigoinmueble,
                    'noexpediente' : this.noexpediente,
                    'noexpedienteinterno' : this.noexpedienteinterno,
                    'nofinca' : this.nofinca,
                    'nofolio' : this.nofolio,
                    'libro' : this.libro,
                    'nocatastral' : this.nocatastral,
                    'solvenciamunicipal' : this.solvenciamunicipal,
                    'observacion' : this.observacion,
                    'longitud' : this.longitud,
                    'ancho' : this.ancho,
                    'diametrotubo' : this.diametrotubo,
                    'diametrocolector' : this.diametrocolector,
                    'idtipoobra' : this.idtipoobra,
                    'idejecutor' : this.idejecutor,
                    'idpersona' : this.idpersona,
                    'idestadofactibilidad' : this.idestadofactibilidad,
                    'id' : this.solicitudfactibilidad_id
                }).then(function (response){
                    me.cerrarModal();
                    me.listarSolicitudfactibilidad(1,'','nombre');
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
                        me.listarSolicitudfactibilidad(1,'','nombre');
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
                        me.listarSolicitudfactibilidad(1,'','nombre');
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
                this.nombre_persona='';
                  this.nombre_ejecutor='';
                  this.nombre_estadofactibilidad='';
                this.nombre_tipoobra='';
                this.direccionobra = '';
                 this.codigoinmueble = '';
                this.noexpediente = '';
                this.noexpedienteinterno = '';
                 this.nofinca = '';
                this.nofolio = '';
                this.libro = '';
                this.nocatastral = '';
                this.solvenciamunicipal = '';
                this.observacion = '';
                this.longitud = '';
                this.ancho = '';
                 this.diametrotubo = '';
                this.diametrocolector = '';
                this.idtipoobra = 0;
                this.idejecutor = 0;
                this.idpersona = 0;
                this.idestadofactibilidad = 0;
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "solicitudfactibilidad":
                    {
                        switch (accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                
                                this.tituloModal = 'Registar Solicitud';
                                this.nombre_persona='';
                                this.nombre_ejecutor='';
                                this.nombre_estadofactibilidad='';
                                this.nombre_tipoobra='';
                                this.direccionobra = '';
                                this.codigoinmueble = '';
                                this.noexpediente = '';
                               this.noexpedienteinterno = '';
                                this.nofinca = '';
                               this.nofolio = '';
                               this.libro = '';
                               this.nocatastral = '';
                                this.solvenciamunicipal = '';
                                this.observacion = '';
                                this.longitud = '';
                                this.ancho = '';
                               this.diametrotubo = '';
                                this.diametrocolector = '';
                                this.idtipoobra = 0;
                                this.idejecutor = 0;
                                this.idpersona = 0;
                                this.idestadofactibilidad = 0;
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Solicitud';
                                this.solicitudfactibilidad_id = data['id'];
                                this.idtipoobra = data['idtipoobra'];
                                this.idejecutor = data['idejecutor'];
                                this.idpersona = data['idpersona'];
                                this.idestadofactibilidad = data['idestadofactibilidad'];
                                this.direccionobra = data['direccionobra'];
                                this.codigoinmueble = data['codigoinmueble'];
                                this.noexpediente = data['noexpediente'];
                                this.noexpedienteinterno = data['noexpedienteinterno'];
                                this.nofinca = data['nofinca'];
                                this.nofolio = data['nofolio'];
                                this.libro = data['libro'];
                                this.nocatastral = data['nocatastral'];
                                this.solvenciamunicipal = data['solvenciamunicipal'];
                                this.observacion = data['observacion'];
                                this.longitud = data['longitud'];
                                this.ancho = data['ancho'];
                                this.diametrotubo = data['diametrotubo'];
                                this.diametrocolector = data['diametrocolector'];
                               
                                this.tipoAccion = 2;
                                break;
                            }
                        }
                    }
                }
                this.selectPersona();
                this.selectEjecutor();
                this.selectEstadofactibilidad();
                this.selectTipoobra();
            }
        },
        mounted() {
            let me=this;
            this.listarSolicitudfactibilidad(1,this.buscar,this.criterio);
        }
    }
</script>

<style >
    .modalcontent{
        width: 50% !important;
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