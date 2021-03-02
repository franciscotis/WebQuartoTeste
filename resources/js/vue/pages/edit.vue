<template>
    <div>
        <new-property
            :edit_mode="true"
            :title="property.title"
            :description="property.description"
            :rent_price="property.rent_price"
            :available="property.available"
            :images="property.images"
            :country="property.address.country"
            :state="property.address.state"
            :city="property.address.city"
            :street="property.address.street"
            :neighborhood="property.address.neighborhood"
            :number="property.address.number"
            :complement="property.address.complement"
            :id="property.id"
        />
    </div>
</template>


<script>
import newProperty from './newProperty'
    export default{
        components:{
            newProperty
        },
        data: function (){
            return{
                property: [],
            }
        },
        methods:{
          getInfo(){
              axios.get(`api/property/${this.$route.params.id}`)
                  .then( response => {
                      this.property = response.data
                  })
                  .catch(error => {
                      console.log(error)
                  });
          }
        },
        created(){
            this.getInfo();
        }
    }
</script>

<style scoped>

</style>
