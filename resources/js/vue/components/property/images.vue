<template>
    <div>
        <swiper ref="mySwiper" :options="swiperOptions">
            <swiper-slide v-for="(image,index) in images" :key="index">
                <img :src="image.url" style="max-width: 700px; max-height: 400px;"/>
            </swiper-slide>
            <div class="swiper-pagination" slot="pagination"></div>
        </swiper>
    </div>
</template>

<script>
import { Swiper, SwiperSlide, directive } from 'vue-awesome-swiper'
import 'swiper/swiper-bundle.css'
    export default {
        props: {
            images: {
                type: Array
            }
        },
        data() {
            return {
                swiperOptions: {
                    pagination: {
                        el: '.swiper-pagination'
                    },
                }
            }
        },
        components: {
            Swiper,
            SwiperSlide
        },
        directives: {
            swiper: directive
        },
        created() {
        },
        computed: {
            swiper() {
                return this.$refs.mySwiper.$swiper
            }
        },
        mounted() {
            this.swiper.slideTo(3, 1000, false)
        }
    }
</script>

<style scoped>
    .img-swiper{
        width: 100%;
        height: auto;
    }
</style>

