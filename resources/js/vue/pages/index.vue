<template>
    <main-layout>
        <div>
            <div class="content">
                <property-view :properties="properties" />
            </div>
        </div>
    </main-layout>
</template>

<script>
    import listView from "../components/property/view";
    import PropertyShow from "../components/property/show";
    import PropertyView from "../components/property/view";
    import MainLayout from "../layouts/main";
    export default{
        components: {
            PropertyView,
            PropertyShow,
            listView,
            MainLayout
        },
        data: function (){
            return {
                properties: []
            }
        },
        methods: {
            getProperties(){
                axios.get('api/property')
                .then( response => {
                    this.properties = response.data
                })
                .catch( error => {
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


</style>
