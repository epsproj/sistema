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
                        <i class="fa fa-align-justify"></i> Ejecutores
                        <button type="button" @click="abrirModal('ejecutor','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      
                                      <option value="direccion">Dirección</option>
                                      
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarEjecutor(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarEjecutor(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Cargo</th>
                                    <th>Direccion</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ejecutor in arrayEjecutor" :key="ejecutor.id">
                                    <td>
                                        <button type="button" @click="abrirModal('ejecutor','actualizar',ejecutor)" class="btn btn-warning btn-sm" >
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                       <template v-if="ejecutor.estado">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarEjecutor(ejecutor.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarEjecutor(ejecutor.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="ejecutor.nombre"></td>
                                    <td v-text="ejecutor.nombre_cargoejecutor"></td>
                                    <td v-text="ejecutor.direccion"></td>
                                    
                                    <td>
                                        <div v-if="ejecutor.estado">
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
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade"  tabindex="-1" :class="{'mostrar' : modal }" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                    <label class="col-md-3 form-control-label" for="text-input" >Cargo</label>
                                    <div class="col-md-9" >
                                        <select class="form-control" v-model="idcargoejecutor">
                                            <option value="0" disabled>Seleccione</option>
                                            <option v-for="cargoejecutor in arrayCargoejecutor" :key="cargoejecutor.id" :value="cargoejecutor.id" v-text="cargoejecutor.nombre"></option>
                                        </select>   
                                     </div>
                                    
                                </div>

                               
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input" >Nombre</label>
                                    <div class="col-md-9" >
                                        <input type="text" v-model="nombre"  class="form-control" placeholder="Nombre">
                                    </div>
                                    
                                </div>
                                 <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input" >Dirección</label>
                                    <div class="col-md-9" >
                                        <input type="text" v-model="direccion"  class="form-control" placeholder="Dirección">
                                    </div>
                                </div>
                               <div v-show="errorEjecutor" class="form-group row div-error">
                                   <div class="text-center text-error">
                                       <div v-for=" error in errorMostrarMsjEjecutor" :key="error" v-text="error"></div>
                                   </div>
                               </div>
                            </form>
                          
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()" >Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarEjecutor()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarEjecutor()">Actualizar</button>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            
        </main>
</template>

<script>

    export default {
        data(){
            return{
                ejecutor_id:0,
                idcargoejecutor:0,
                nombre_cargoejecutor:'',
                nombre:'',
                direccion:'',
                arrayEjecutor: [],
                modal : 0 ,
                tituloModal : '' ,
                tipoAccion : 0 ,
                //errores de validacion
                errorEjecutor : 0,
                //array que contiene los errores
                errorMostrarMsjEjecutor : []  ,
                pagination : {
                'total'   : 0,
                'current_page' :0,
                'per_page'  :0,
                'last_page' :0,
                'from'     :0,
                'to' :0,
                } ,
                offset:3,
                criterio : 'nombre',
                buscar : '',
                arrayCargoejecutor:[]   
             }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
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
            listarEjecutor(page,buscar,criterio){
                let me=this;
                var url='/ejecutor?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta=response.data;
                    me.arrayEjecutor=respuesta.ejecutores.data;
                    me.pagination=respuesta.pagination;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            },
            selectCargoejecutor(){
                 let me=this;
                var url='/cargoejecutor/selectCargoejecutor';
                axios.get(url).then(function (response) {
                   
                    var respuesta=response.data;
                    me.arrayCargoejecutor=respuesta.cargoejecutores;
                  
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
                let me =this;
                
                me.pagination.current_page=page;
                me.listarEjecutor(page,buscar,criterio);
            },
            registrarEjecutor(){

                if (this.validarEjecutor())
                {
                    return;
                }
                let me=this;
                
                axios.post('/ejecutor/registrar', {
                    //parametros del controlador recibira
                    'idcargoejecutor':this.idcargoejecutor,
                    'nombre': this.nombre,
                    'direccion':this.direccion

                }).then(function (response) {
                   me.cerrarModal();
                   me.listarEjecutor(1,'','nombre');
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
            },
            actualizarEjecutor(){

                if (this.validarEjecutor())
                {
                    return;
                }
                let me=this;
                
                axios.put('/ejecutor/actualizar', {
                    //parametros del controlador recibira
                    'idcargoejecutor': this.idcargoejecutor,
                    'direccion':this.direccion,
                    'nombre': this.nombre,
                    'id' : this.ejecutor_id
                    

                }).then(function (response) {
                   me.cerrarModal();
                   me.listarEjecutor(me.pagination.current_page,'','nombre');
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });

            },
            desactivarEjecutor(id){
               swal({
                title: '¿Esta seguro de desactivar al Ejecutor?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/ejecutor/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarEjecutor(me.pagination.current_page,'','nombre');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            activarEjecutor(id){
               swal({
                title: '¿Esta seguro de activar al Ejecutor?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/ejecutor/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarEjecutor(me.pagination.current_page,'','nombre');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            validarEjecutor(){
                this.errorEjecutor=0;
                this.errorMostrarMsjEjecutor=[];

                if(this.idcargoejecutor==0) this.errorMostrarMsjEjecutor.push("Seleccione un cargo");
                if(!this.nombre) this.errorMostrarMsjEjecutor.push("El nombre del ejecutor no puede estar vacío");
                if(!this.direccion) this.errorMostrarMsjEjecutor.push("La direccion no puede estar vacío");
                
                //validar si tiene algun error devuelve un 1
                if(this.errorMostrarMsjEjecutor.length) this.errorEjecutor=1;

                return this.errorEjecutor;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre_cargoejecutor='';
                this.direccion='';
                this.nombre='';
                this.idcargoejecutor=0;
                this.errorEjecutor=0;
                //cuando se cierra el modal borra el contenido de los mensajes de error
                this.errorCargoejecutor=0;
            },
            abrirModal(modelo, accion, data=[]){
                switch (modelo) {
                    case 'ejecutor':
                        {
                            switch (accion) {
                                case 'registrar':
                                    {
                                        this.modal=1;
                                        this.tituloModal='Ingresar Ejecutor',
                                        this.idcargoejecutor=0;
                                        this.nombre_cargoejecutor='';
                                        this.nombre='';
                                        this.direccion='';
                                        this.tipoAccion=1;
                                        break;

                                    }
                                case 'actualizar':
                                    {
                                        this.modal=1;
                                        this.tituloModal="Actualizar Ejecutor";
                                        this.tipoAccion=2;
                                        this.ejecutor_id=data['id'];
                                        this.idcargoejecutor=data['idcargoejecutor'];
                                        this.nombre=data['nombre'];
                                        this.direccion=data['direccion'];
                                        break;
                                    }
                                    
                                
                            }

                        }
                        
                
                }
                this.selectCargoejecutor();
            }

        },
        mounted() {
            let me=this;
            this.listarEjecutor(me.pagination.current_page,this.buscar,this.criterio);
        }
    }
</script>
<style>
    .modal-content{
        width: 80% ;
        position: relative;
        margin:100px auto;
   
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;

    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
    form{
        margin-top: 15px;
    }
</style>
