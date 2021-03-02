<template>
    <div class="container properties">
        <div class="row">
            <div class="col-lg-4 d-flex align-items-stretch" v-for="(property,index) in properties" :key="index">
                <property-show
                    :title=property.title
                    :image="property.images[0].url"
                    :text="property.description"
                    :value="property.rent_price"
                    :neighborhood="property.address.neighborhood"
                    :city="property.address.city"
                    :state="property.address.state"
                    :id="property.id"
                />

            </div>
        </div>

    </div>
</template>

<script>
import propertyShow from "./show";
export default {
    props: ['properties'],
    components: {
        propertyShow
    }

}
</script>

<style scoped>
    .properties{
        padding-top: 40px;
        width: 100%;
    }
</style>
