<template>
    <b-container>
        <div class="content">
            <div class="recommendation-title">
                <h1>Recomendações</h1>
            </div>
            <b-container>
                <b-row>
                    <div v-for="(property,index) in recommendations" :key="index"class="recommendation-card col-lg-3">
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
                </b-row>
            </b-container>


        </div>
    </b-container>

</template>

<script>
    import PropertyShow from "./show";
    export default{
        components: {PropertyShow},
        props:['id'],
        data: function (){
            return {
                recommendations: []
            }
        },
        methods:{
            getRecommendations(){
                axios.get(`api/recommendations/${this.id}`)
                .then( response => {
                    this.recommendations = response.data
                    console.log(this.recommendations);
                })
                .catch(error => {
                    console.log(error);
                })
            }
        },
        created(){
            this.getRecommendations();
        }
    }
</script>

<style scoped>
@import url('http://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300,600&display=swap');

    .recommendation-title{
        text-align: center;
        font-family: 'Hind Madurai', sans-serif;
        font-weight: 600;
        color: #38CE8A;

    }

.recommendation-card{
    margin: 0 30px;
}
</style>
