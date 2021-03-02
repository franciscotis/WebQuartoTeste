<template>
    <div class="map-box">
        <GmapMap
            :center="{lat:parseFloat(this.lat), lng:parseFloat(this.lng)}"
            :zoom="18"
            map-type-id="terrain"
            style="width: 500px; height:200px; margin: 32px auto;"
        >
            <GmapMarker
                :key="index"
                v-for="(m, index) in markers"
                :position="m.position"
                :clickable="true"
                :draggable="true"
                @click="center=m.position"
            />
        </GmapMap>
    </div>

</template>

<script>
export default{
    props: ['lat','lng'],
    data(){
        return{
            markers: [{position:{lat:parseFloat(this.lat),lng:parseFloat(this.lng)}}],
        }
    },
    created(){
    }

}
</script>

<style scoped>
    .map-box{
        text-align: center;
        margin-left: auto;
        margin-right: auto;
    }
</style>
