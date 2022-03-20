<template>
    <div>
        <span >{{fecha_Creacion}}</span>
    </div>
</template>
<script>


export default {
    props:{
        fecha:{
            type:String,
            require:false
        }
    },
    computed:{
        fecha_Creacion(){
            return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY');
        }
    },

}
</script>
