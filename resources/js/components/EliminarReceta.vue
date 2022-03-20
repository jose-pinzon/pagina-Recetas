<template>
<div>

<input type="submit"
class="btn btn-danger d-block w-100  mb-2"
value="Eliminar *"
@click="eliminarReceta"> <!-- TODO:forma con vue -->


</div>
</template>

<script>
import axios from 'axios'
export default {

    props:{
        id:{
            type:String,
        }
    },

    methods:{
        eliminarReceta(){
            this.$swal({
                title: 'Desea eliminar esta receta?',
                text: "Una vez eliminada no se podra recuperar!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminarlo!'
                }).then((result) => {
                if (result.isConfirmed) {

                    const params = {
                        id:this.id
                    }
                    //hacer la peticion
                    axios.post(`/recetas/${this.id}`, {params, _method:'delete'})
                    .then(Response => {
                        this.$swal({
                        title:'Eliminado!',
                        text:'Receta eliminada correctamente.',
                        icon:'success'
                        })

                        //Eliminar elemento del dom
                this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);
                    }).catch(error =>console.log(error))


                }
                })
        }
    }

}
</script>

<style>

</style>
