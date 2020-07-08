<template>
    <div>

    <div class="row"> 
            <div class="col-lg-8"> <b>Gestión de productos</b> </div>
            <div class="col-lg-4">  <button class="btn btn-info pull-right rounder"   id="nuevo"  @click="nuevo()"  >  Crear producto </button> </div>
            
    </div>

      <hr/>

      <div class="row"> 
            <div class="col-lg-6"> 

            <div class="input-group">
                    <span class="input-group-addon">Producto</span>
                    <input type="text" class="form-control" placeholder="Nombre del producto" id="producto" v-model="producto">
                    <span class="input-group-btn"> <button class="btn btn-info" type="button" id="buscar" @click="search()" >Buscar</button>  </span>
            </div>

            </div>
            <div class="col-lg-6">  
                    <div class="checkbox pull-right"> 
                        <label>  <input type="checkbox" value="T" class="estado-ch"  name="filterStatus" @click="state($event)">  Mostrar Todos  </label>
                        <label>  <input type="checkbox" value="A" class="estado-ch" name="filterStatus"  @click="state($event)"> Activos </label>
                        <label>  <input type="checkbox" value="I" class="estado-ch" name="filterStatus"  @click="state($event)"> Inactivos </label>
                        <label>  <input type="checkbox" value="P" class="estado-ch" name="filterStatus"  @click="state($event)"> Pendientes </label>
                    </div>
             </div>
      </div>


    </div>
</template>

<style>
    .rounder{
        border-radius: 50px;
      }
</style>

<script>
    import EventBus from "../event-bus";

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            search: function(){
                EventBus.$emit('updateSearch', this.producto); 
            },
            state: function(e){
                let data={ ch:e.target.checked, val: e.target.value};
                EventBus.$emit('updateState', data); 
            },
            nuevo: function(){
                EventBus.$emit('newProduct'); 
            }
        },
        data() {
            return {
                producto:""
            }
        }
    }
</script>
