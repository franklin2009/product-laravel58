<template>
<div>
       <div class="row">
            <div class="col-lg-12">
            <table class="table table-striped" id="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Existencia</th>
                        <th>Bodega</th>
                        <th>Descripción</th>
                        <th>Editar</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(producto,index) in productList" :key="index">
                        <td>{{ producto.nombre }}</td>
                        <td>{{ producto.codigo }}</td>
                        <td>{{ producto.existencia }}</td>
                        <td>{{ mBodega(producto.id_bodega) }}</td>
                        <td>{{ producto.descripcion }}</td>
                        <td> <button class="btn btn-default editar" data-toggle="modal" data-target="#ProductoModal"  @click="editar(index)" >  <i class="glyphicon glyphicon-pencil"></i> </button></td>
                        <td>  <span class="label"  v-bind:class="{'label-success': producto.estado=='A','label-warning': producto.estado=='P', 'label-danger': producto.estado=='I'}" >{{ mEstado(producto.estado) }}</span> </td>
                    </tr>
                </tbody>
                <tfoot>
                        <tr >
                            <th colspan="7"> {{ productos.length }} productos registrados. [ Activos: {{ activos }} ] - [ Pendientes: {{ pendientes }} ] -  [ Inactivos: {{ inactivos }} ] </th>
                        </tr>
                </tfoot>

                </table>
        </div>
       </div>
</div>
</template>

<style>
    .table { border: 1px solid #0086f9; }
    .table > thead, .table > tfoot { 
          color:white;
          background: #0086f9;
      }
</style>

<script>
    import EventBus from "../event-bus";

    export default {
        mounted() {
            console.log('Component mounted.');
            let self = this;
            self.productList=self.productos;
            self.calcular();
            EventBus.$on('updateSearch', function(search) { 
                self.search=search;
                self.filterProducts();
            });
            EventBus.$on('updateState', function(state) { 
                if(state.ch) self.states.push(state.val);
                else self.states.splice(self.states.indexOf(state.val), 1);
                self.filterProducts();
            });
            EventBus.$on('updateProduct', function(product) { 
                let ind=-1;
                if(product.isNew){
                    self.productos.push(product);
                } else {
                     self.productos.forEach((p,i) => {
                         if(p.id==product.id)  ind=i;
                     });
                     if(ind > -1) self.$set(self.productos, ind, product);
                     //self.productos[ind]=product;
                }
                console.log("product >> ",product);
                self.calcular();
                self.filterProducts();
            });
        },
        methods: {
            mEstado: function (estado) {
                var val ="";
                this.estados.forEach(e => {
                    if(e.id==estado) val=e.name;
                });
                return val;
            },
            mBodega: function (bodega) {
                var val ="";
                this.bodegas.forEach(e => {
                    if(e.id==bodega) val=e.nombre;
                });
                return val;
            },
            filterProducts: function () {
                self=this;
                let product=self.productos;
                if(self.search!=""){
                    product=self.productos.filter(item => {
                        return item.nombre.toLowerCase().indexOf(self.search.toLowerCase()) > -1
                    });
                }
                if(self.states.length > 0){
                    product=product.filter(item => {
                        return self.states.filter( st=>{ return (st==item.estado || st=="T"); }).length > 0;
                    });
                }
                self.productList=product;
            },
            editar: function(index){
                EventBus.$emit('editProduct',this.productList[index]); 
            },
            calcular: function () {
                var ti=0,ta=0,tp=0;
                this.productos.forEach(p => { 
                    if(p.estado=='I') ti++;
                    if(p.estado=='P') tp++;
                    if(p.estado=='A') ta++;
                });
                this.activos=ta;
                this.pendientes=tp;
                this.inactivos=ti;
            }
        },
        props: ['productos', 'bodegas'],
        data() {
            return {
                estados:[{id:'A', name:'Activo'},{id:'P', name:'Pendiente'},{id:'I', name:'Inactivo'}],
                search:"",
                productList:[],
                states:[],
                activos:0,
                inactivos:0,
                pendientes:0
            }
        }

    }
</script>
