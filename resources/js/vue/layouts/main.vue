<template>
    <div>
        <navbar/>
        <div class="content">
            <slot></slot>
        </div>
    </div>
</template>

<script>
import navbar from "../components/navbar";
    export default{
        components:{
            navbar
        }

    }
</script>

<style scoped>

    body{
        background-color: white;
        height: 100vh;
    }

    .content{
        background: white;
        height: 100%;


    }
</style>
