<template>
    <div>
        <div>
            <b-card
                :img-src=image
                img-top
                tag="article"
                class="mb-2 h-100 card"
            >
                <p class="value">R${{formatPrice(value)}} por mês</p>
                <b-card-title :title="title" class="card-title"/>
                <p class="location"><span class="map-symbol"><font-awesome-icon
                    icon="map-marker-alt" /></span> {{neighborhood}},{{city}} - {{state}}</p>
                <b-card-text class="card-text">
                    {{text}}
                </b-card-text>

                <router-link :to="{name: 'show', params: {id}}">
                    <b-button class="btn-detalhes">Ver Detalhes</b-button>
                </router-link>
            </b-card>
        </div>
    </div>
</template>

<script>

export default {
    props: ['id','title','image','text','value','neighborhood','city','state'],
    methods:{
        formatPrice(value){
            let val = (value/1).toFixed(2).replace('.', ',')
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }
    }

}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300,600&display=swap');
    .mb-2{
        max-width: 20rem;
        font-family: 'Hind Madurai', sans-serif;

    }

    .btn-detalhes{
        width: 100%;
        background: #38CE8A;
        border: none;
    }

    .card{
        width: 100vw;
    }

    .card-title{
        font-weight: 600;
        font-size: 1.3rem;
        color: #313a46;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    .card-text{
        font-family: 'Hind Madurai', sans-serif;
        font-weight: 300;
        color: #98a6ad;
        font-size: 0.8rem;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    .card-img-top {
        width: 100%;
        height: 15vw;
        object-fit: cover;
    }

    .value{
        font-weight: 600;
        color: #38CE8A;
        font-size: 0.9rem;
    }

    .location{
        color: #98a6ad;
        font-size: 0.9rem;
    }
</style>
