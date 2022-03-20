<template>

    <div>
        <span  class="like-btn" :class="{ 'like-active' : isActive }" @click="DarLike"></span>
        <p>{{ totalLikes  }} les gusta la Receta</p>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    props:{
        receta_id:{
            type:String,
            required:true,
        },
        like:{
            type:String,
            required:true
        },
        likes:{
            required:true
        }
    },
    data(){
        return{
            isActive:this.like,
            totalLikes:this.likes
        }
    },
    methods:{
        async DarLike(){
            try {
                const { data } = await  axios.post('/likes/' + this.receta_id)
                if (data.attached.length > 0) {
                    this.$data.totalLikes++
                } else {
                    this.$data.totalLikes--
                }

                this.isActive = !this.isActive


            } catch (error) {
                if(error.response.status === 401 ) return window.location = '/register'

            }
        }
    },

    computed:{

    }
}
</script>

<style>

</style>
