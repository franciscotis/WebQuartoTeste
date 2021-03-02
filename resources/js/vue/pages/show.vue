<template>
    <main-layout>
        <div class="conteudo">
            <b-container>
                <b-row>
                    <b-col col md="6">
                        <property-images :images="this.property.images"/>
                    </b-col>

                    <b-col col md="6">
                        <div class="text">
                            <div class="title">
                                {{this.property.title}}
                            </div>
                            <hr/>
                            <div class="description">
                                <div class="price">
                                    <p>R$ {{this.property.rent_price}} por mês</p>
                                </div>
                                <p>{{this.property.description}}</p>
                            </div>

                            <div class="address">
                                <p>
                                    {{this.property.address.street}}, {{this.property.address.complement}}, {{this.property.address.street}} {{this.property.address.neighborhood}} - {{this.property.address.number}}
                                </p>
                                <p>
                                    {{this.property.address.city}} - {{this.property.address.state}} - {{this.property.address.country}}
                                </p>
                                <property-map :lat="this.property.address.lat" :lng="this.property.address.long" />

                            </div>

                        </div>
                    </b-col>
                </b-row>
            </b-container>

            <div class="recommendations">
                <property-recomendations :id="this.property.id"/>
            </div>
        </div>

    </main-layout>

</template>

<script>
    import PropertyImages from "../components/property/images";
    import MainLayout from '../layouts/main';
    import PropertyMap from "../components/property/pmap";
    import PropertyRecomendations from "../components/property/recommendations";
    export default{
        components: {PropertyRecomendations, PropertyMap, PropertyImages, MainLayout},
        data: function (){
            return{
                property: [],
            }
        },
        methods:{
            getProperty(){
                axios.get(`api/property/${this.$route.params.id}`)
                .then( response => {
                    this.property = response.data
                })
                .catch(error => {
                    console.log(error)
                })
            },

        },
        created(){
            this.getProperty();
        }
    }
</script>

<style scoped>
@import url('http://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300,600&display=swap');
    .conteudo{
        padding-top: 40px;
        font-family: 'Hind Madurai', sans-serif;
    }

    .title{
        font-weight: 600;
        font-size: 2rem;
        text-align: center;
        color: #313a46;
    }

    .description{
        text-align: center;
        color: #98a6ad;

    }

    .description .price{
        color: #38CE8A;
        font-size: 1rem;
        font-weight: bold;
    }

    .address{
        margin-top: 20px;
        color: #131516;
        text-align: center;
        font-weight: 600;
    }

</style>
