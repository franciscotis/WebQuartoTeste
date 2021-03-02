<template>
    <main-layout>
        <div class="title">
            <h1>Painel Administrativo</h1>
        </div>
        <b-container>
            <div class="content">
                <b-table striped hover :items="items" responsive="sm">
                    <template #cell(acao)="data">
                        <router-link :to="{name: 'edit', params: {id:data.item.id}}">
                            <b-button variant="info">Editar</b-button>
                        </router-link>
                         <b-button v-on:click="apagar(`${data.item.id}`)" variant="danger">Apagar</b-button>
                    </template>
                </b-table>
            </div>
        </b-container>

    </main-layout>
</template>

<script>
import MainLayout from "../layouts/main";
export default{
    components: {
        MainLayout
    },
    data: function (){
        return {
            properties: [],
            items: []
        }
    },
    methods: {
        getProperties(){
            axios.get('api/get_all')
                .then( response => {
                    this.properties = response.data
                    this.items = this.properties.map( property => {
                        return {id: property.id, titulo: property.title, descricao:property.description, disponibilidade: property.available, acao:''}
                    } )
                    console.log(this.properties)
                })
                .catch( error => {
                    console.log(error);
                });
        },
        apagar(id){
            axios.delete(`api/property/${id}`)
            .then( response => {
                let index = this.items.findIndex(item => item.id === id);
                this.items.splice(index,1);
            })
            .catch(error => {
                console.log(error);
            });
        }
    },
    created(){
        this.getProperties();
    }
}
</script>

<style scoped>
    .title{
        text-align: center;
        padding-top: 30px;
    }

</style>
