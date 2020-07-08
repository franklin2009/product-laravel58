<template  id="bs-modal">

<div v-show="isShowModal">
    <transition name="modal">
      <div class="modal-mask">
        <div class="modal-wrapper">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" @click="isShowModal=false"> <span aria-hidden="true">&times;</span> </button>
                <h4 class="modal-title">{{ title }} </h4>
              </div>

              <div class="modal-body">
                 <div class="form-group" id="z-codigo" v-show="isNew">
                        <label for="codigo">Codigo * </label>
                        <input type="text" class="form-control" id="codigo" v-model="producto.codigo" maxlength="10">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre *</label>
                        <input type="text" class="form-control" id="nombre" v-model="producto.nombre" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripcion</label>
                        <input type="text" class="form-control" id="descripcion"  v-model="producto.descripcion" maxlength="200">
                    </div>
                    <div class="form-group">
                        <label for="existencia">Existencia</label>
                        <input type="text" class="form-control" id="existencia"  v-model="producto.existencia" maxlength="5"  @keypress="onlyNumber">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado"  v-model="producto.estado">
                             <option v-for="estado in estados" v-bind:value="estado.id" >{{ estado.name }}</option>
                        </select>
                    </div>
                    <div class="form-group" id="z-bodega" v-show="isNew">
                        <label for="bodega">Bodega</label>
                        <select class="form-control" id="bodega"  v-model="producto.id_bodega">
                             <option v-for="bodega in bodegas" v-bind:value="bodega.id" >{{ bodega.nombre }}</option>
                        </select>
                    </div>

                    <input type="hidden" class="form-control" id="id" v-model="producto.id">
              </div>

              <div class="modal-footer">
                    <button type="button" class="btn btn-default"  @click="isShowModal=false">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="guardar" @click="save()" >Guardar</button>
              </div>

            </div>
          </div>
        </div>
      </div>
    </transition>
</div>


    
</template>


<style>
.modal-mask {
  position: fixed;
  z-index: 9999;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-body {
  height:300px;
  overflow:auto;
}

</style>

<script>
    import EventBus from "../event-bus";
    import axios from 'axios';

    export default {
        mounted() {
            console.log('Component mounted.');
            let self = this;
            EventBus.$on('newProduct', function() {
                self.isNew=true;
                self.title="Crear Producto";
                self.producto={
                    id:0,
                    codigo:"",
                    nombre:"",
                    descripcion:"",
                    existencia:"",
                    estado:"A",
                    id_bodega:1
                };
                self.isShowModal=true;
            });
            EventBus.$on('editProduct', function(product) { 
                self.isNew=false;
                self.title="Editar Producto";
                 self.producto={
                    id:product.id,
                    codigo:product.codigo,
                    nombre:product.nombre,
                    descripcion:product.descripcion,
                    existencia:product.existencia,
                    estado:product.estado,
                    id_bodega:product.id_bodega,
                };
                self.isShowModal=true;
            });
        },
         methods: {
             onlyNumber: function ($event) {
                let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
                if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) {
                    $event.preventDefault();
                }
            },
            save: function () {
                    let self = this;
                    let url="producto/";
                    let data={
                        "id":this.producto.id,
                        "codigo":this.producto.codigo,
                        "nombre":this.producto.nombre,
                        "descripcion":this.producto.descripcion,
                        "existencia":this.producto.existencia,
                        "estado":this.producto.estado,
                        "id_bodega":this.producto.id_bodega,
                        "_token": $("#csrf_token").val(),
                        "isNew":this.isNew
                    };

                    if(this.isNew){
                        url+="create";
                        if(data.codigo=="" || data.nombre=="") {
                            alert("debes ingresar codigo y nombre");
                            return;
                        }
                    }else{
                        url+="update";
                        if(data.nombre=="") {
                            alert("debes ingresar  nombre");
                            return;
                        }
                    }
                    if(data.existencia=="") data.existencia=0;

                    axios.post(url,data).then(res => {
                        if(res.data.type == 'success'){
                                if(data.isNew) data.id=res.data.data;
                                EventBus.$emit('updateProduct',data); 
                                self.isShowModal=false;
                                alert(res.data.message);
                        } else {
                                self.isShowModal=false;
                                alert(res.data.message);
                        }
                    })
                    .catch(err => {
                        self.isShowModal=false;
                        alert("error interno "+err);
                    });

            }
        },
        props: ['bodegas'],
        data() {
            return {
                producto:{
                    id:0,
                    codigo:"",
                    nombre:"",
                    descripcion:"",
                    existencia:"",
                    estado:"A",
                    id_bodega:1
                },
                estados:[{id:'A', name:'Activo'},{id:'P', name:'Pendiente'},{id:'I', name:'Inactivo'}],
                isNew:true,
                isShowModal:false,
                title:''
            }
        }
    }
</script>
