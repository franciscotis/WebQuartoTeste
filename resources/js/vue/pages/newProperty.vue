<template>
    <main-layout>
        <b-container>
            <alert v-if="form_success" message="Sucesso!" variant="success"/>
            <alert v-if="form_error" message="Ocorreu um erro. Por favor, Tente novamente!" variant="danger"></alert>
            <div class="form-content">

                <div class="title">
                    <h1 v-if="edit_mode">Edição de imóvel</h1>
                    <h1 v-else>Adição de imóvel</h1>
                </div>
                <b-form @submit="onSubmit" @reset="onReset" enctype="multipart/form-data">
                    <b-form-group
                        id="title"
                        label="Titulo"
                        label-for="title-input"
                        description="Título do imóvel"
                        class="form-input"
                    >
                        <b-form-input
                            id="title-input"
                            v-model="form.title"
                            type="text"
                            placeholder="Insira o título do imóvel aqui"
                            required
                        >


                        </b-form-input>

                    </b-form-group>

                    <b-form-group
                        id="description"
                        label="Descrição"
                        label-for="description-input"
                        description="Descrição do imóvel"
                        class="form-input"
                    >
                        <b-form-textarea
                            id="description-input"
                            v-model="form.description"
                            placeholder="Insira a descrição do imóvel aqui"
                            required
                        >

                        </b-form-textarea>

                    </b-form-group>

                    <b-form-group
                        id="rent-price"
                        label="Valor de Aluguel"
                        label-for="rent-price-input"
                        description="Valor de aluguel do imóvel"
                        class="form-input"
                    >
                        <b-form-input
                            id="rent-price-input"
                            v-model="form.rent_price"
                            type="number"
                            placeholder="Insira o valor de aluguel do imóvel aqui"
                            required
                        >
                        </b-form-input>

                    </b-form-group>

                    <b-form-group
                        id="available"
                        label="Disponibilidade"
                        label-for="available-input"
                        description="Disponibilidade do imóvel"
                        class="form-input"
                    >
                        <b-form-select
                            id="available-input"
                            v-model="form.available"
                            type="text"
                            :options="[{text:'Escolha...', value: null}, {text:'Disponível', value: true},{text:'Indisponível', value: false}]"
                            required
                        >

                        </b-form-select>

                    </b-form-group>

                    <b-form-group
                        v-if="edit_mode"
                        id="images"
                        label="Imagens Associadas"
                        label-for="all-images"
                        description="Clique em uma imagem caso deseja a remover"
                        class="form-input"
                    >
                        <b-row>
                            <b-col col md="4" v-for="(image,index) in this.images" :key="index">
                                    <input type="checkbox" name="ids[]" :id=image.id style="display: none;" class="css-checkbox" @click="selectImage(image.id)"/>
                                    <label class="css-label"
                                           style="width: 150px; height: 150px; margin-left: 25%;"
                                           :for=image.id>
                                    <img class="img-fluid" v-bind:src=image.url />
                                    </label>
                            </b-col>
                        </b-row>



                    </b-form-group>

                    <b-form-group
                        id="image"
                        label="Imagens"
                        label-for="image-input"
                        description="Imagens do imóvel"
                        class="form-input"
                    >
                        <b-form-file
                            id="image-input"
                            v-model="form.images"
                            :state="edit_mode? true : Boolean(form.images)"
                            type="text"
                            placeholder="Escolha os arquivos ou arraste aqui..."
                            drop-placeholder="Arraste os arquivos aqui..."
                            multiple
                            :required="edit_mode ? false : true"
                        >

                        </b-form-file>

                    </b-form-group>

                    <b-form-group
                        id="country"
                        label="País"
                        label-for="country-input"
                        description="País de Origem"
                        class="form-input"

                    >
                        <b-form-select
                            id="country-input"
                            v-model="form.country"
                            :options="[{text:'Brasil', value: 'Brasil'}]"
                            required
                            value="Brasil"
                        >

                        </b-form-select>

                    </b-form-group>

                    <b-form-group
                        id="state"
                        label="Estado"
                        label-for="state-input"
                        description="Estado de Origem"
                        class="form-input"
                    >
                        <b-form-select
                            id="state-input"
                            v-model="form.state"
                            :options="estados"
                            required
                        >

                        </b-form-select>

                    </b-form-group>

                    <b-form-group
                        id="city"
                        label="Cidade"
                        label-for="city-input"
                        description="Cidade de Origem"
                        class="form-input"
                    >
                        <b-form-select
                            id="city-input"
                            v-model="form.city"
                            :options="cidades"
                            required
                        >

                        </b-form-select>

                    </b-form-group>

                    <b-form-group
                        id="street"
                        label="Rua"
                        label-for="street-input"
                        description="Rua do imóvel"
                        class="form-input"
                    >
                        <b-form-input
                            id="street-input"
                            v-model="form.street"
                            type="text"
                            placeholder="Insira a rua do imóvel aqui"
                            required
                        >

                        </b-form-input>

                    </b-form-group>

                    <b-form-group
                        id="neighborhood"
                        label="Bairro"
                        label-for="neighborhood-input"
                        description="Bairro do imóvel"
                        class="form-input"
                    >
                        <b-form-input
                            id="neighborhood-input"
                            v-model="form.neighborhood"
                            type="text"
                            placeholder="Insira o bairro do imóvel aqui"
                            required
                        >

                        </b-form-input>

                    </b-form-group>

                    <b-form-group
                        id="number"
                        label="Número"
                        label-for="number-input"
                        description="Número do imóvel"
                        class="form-input"
                    >
                        <b-form-input
                            id="number-input"
                            v-model="form.number"
                            type="text"
                            placeholder="Insira o número do imóvel aqui"
                        >

                        </b-form-input>

                    </b-form-group>

                    <b-form-group
                        id="complement"
                        label="Complemento"
                        label-for="complement-input"
                        description="Complemento do imóvel"
                        class="form-input"
                    >
                        <b-form-textarea
                            id="street-input"
                            v-model="form.complement"
                            type="text"
                            placeholder="Insira o complemento do imóvel aqui"

                        >

                        </b-form-textarea>

                    </b-form-group>

                    <div class="botoes">
                        <b-button type="submit" variant="success">Enviar</b-button>
                        <b-button type="reset" variant="danger">Resetar</b-button>
                    </div>



                </b-form>
            </div>

        </b-container>
    </main-layout>

</template>

<script>
    import MainLayout from '../layouts/main'
    import brasil from '../../util/brasil.json';
    import alert from '../components/alert';
    export default{
        data(){
            return {
                images: [],
                cidades: [
                    {value: null, text:'Selecione um estado primeiro'}
                ],
                estados: [
                    { value: null, text: "Selecione um estado" },
                    { value: "AC", text: "Acre" },
                    { value: "AL", text: "Alagoas" },
                    { value: "AP", text: "Amapá" },
                    { value: "AM", text: "Amazonas" },
                    { value: "BA", text: "Bahia" },
                    { value: "CE", text: "Ceará" },
                    { value: "DF", text: "Distrito Federal" },
                    { value: "ES", text: "Espírito Santo" },
                    { value: "GO", text: "Goiás" },
                    { value: "MA", text: "Maranhão" },
                    { value: "MT", text: "Mato Grosso" },
                    { value: "MS", text: "Mato Grosso do Sul" },
                    { value: "MG", text: "Minas Gerais" },
                    { value: "PA", text: "Pará" },
                    { value: "PB", text: "Paraíba" },
                    { value: "PR", text: "Paraná" },
                    { value: "PE", text: "Pernambuco" },
                    { value: "PI", text: "Piauí" },
                    { value: "RJ", text: "Rio de Janeiro" },
                    { value: "RN", text: "Rio Grande do Norte" },
                    { value: "RS", text: "Rio Grande do Sul" },
                    { value: "RO", text: "Rondônia" },
                    { value: "RR", text: "Roraima" },
                    { value: "SC", text: "Santa Catarina" },
                    { value: "SP", text: "São Paulo" },
                    { value: "SE", text: "Sergipe" },
                    { value: "TO", text: "Tocantins" }
                ],
                brasil,
                form_success:false,
                form_error:false,
                form:{
                    title: this.title,
                    description: this.description,
                    rent_price:this.rent_price,
                    available: this.available,
                    images: '',
                    city: this.city,
                    state: this.state,
                    country: this.country,
                    street: this.street,
                    neighborhood:this.neighborhood,
                    number:this.number,
                    complement:this.complement,
                    newImages: []
                }
            }
        },

        props:{
            id: {
                default:''
            },
            title: {
                default: ''
            },
            description:{
                default: ''
            },
            rent_price:{
                default:''
            },
            available: {
                default: true
            },
            images: {
                default: ''
            },
            city: {
                default: ''
            },
            state: {
                default: null
            },
            country: {
                default: ''
            },
            street: {
                default: ''
            },
            neighborhood:{
                default: ''
            },
            number:{
                default:''
            },
            complement:{
                default: ''
            },
            edit_mode:{
                default: false
            }
        },

        watch:{
            'form.state': function(){
                this.cidades = brasil[this.form.state].cidades
            },

        },

        methods:{
            onSubmit(event){
                event.preventDefault()
                let formData = new FormData();
                formData.append('title',JSON.stringify(this.form.title));
                formData.append('description',JSON.stringify(this.form.description));
                formData.append('rent_price',JSON.stringify(this.form.rent_price));
                formData.append('available',JSON.stringify(this.form.available));
                for(let i= 0; i<this.form.images.length;i++){
                    formData.append(`image${i}`,this.form.images[i]);
                }
                if(this.edit_mode){
                    formData.append('newImages',JSON.stringify(this.form.newImages));
                    console.log(this.form.newImages)
                    formData.append('_method', 'PUT')
                }
                formData.append('city',JSON.stringify(this.form.city));
                formData.append('state',JSON.stringify(this.form.state));
                formData.append('country',JSON.stringify(this.form.country));
                formData.append('street',JSON.stringify(this.form.street));
                formData.append('neighborhood',JSON.stringify(this.form.neighborhood));
                formData.append('number',JSON.stringify(this.form.number));
                formData.append('complement',JSON.stringify(this.form.complement));

                if(this.edit_mode){
                    const config = {
                        header:{
                            'Content-Type': 'multipart/form-data',
                            _method: 'PUT'
                        },
                    };
                    axios.post(`api/property/${this.id}`,formData, config).then(response => {
                        if(response.status == 200){
                            this.form_success = true
                            window.scrollTo({
                                top: 0,
                                behavior:'smooth'
                            });
                            var self = this;
                            Object.keys(this.form).forEach(function(key,index) {
                                self.form[key] = '';
                            });
                        }
                    })
                        .catch(error => {
                            this.form_error = true
                            window.scrollTo({
                                top: 0,
                                behavior:'smooth'
                            });

                        })
                }else{
                    const config = {
                        header:{
                            'Content-Type': 'multipart/form-data',
                        },
                    };
                    axios.post('api/property',formData,config).then( response => {
                        if(response.status == 201){
                            this.form_success = true
                            window.scrollTo({
                                top: 0,
                                behavior:'smooth'
                            });
                            var self = this;
                            Object.keys(this.form).forEach(function(key,index) {
                                self.form[key] = '';
                            });
                        }
                    })
                        .catch(error => {
                            this.form_error = true
                            window.scrollTo({
                                top: 0,
                                behavior:'smooth'
                            });

                        })
                }



            },
            onReset(event){
                event.preventDefault()
                this.form.title= ''
                this.form.description=''
                this.form.rent_price=''
                this.form.available= true
                this.form.images= null
                this.form.city=''
                this.form.state=null
                this.form.country= ''
                this.form.street= ''
                this.form.neighborhood=''
                this.form.number=''
                this.form.complement=''
            },
            selectImage(id){
                const index = this.form.newImages.indexOf(id);
                if(index> -1){
                    this.form.newImages.splice(index,1)
                }else{
                    this.form.newImages.push(id);
                }
            }
        },

        components:{
            MainLayout,
            alert
        },
        created(){
            if(this.edit_mode){
                this.cidades = brasil[this.form.state].cidades.map(city => {
                    return {value: city, text:city}
                });
            }
            this.form.available = this.available ? true : false;
        }
    }
</script>


<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300,600&display=swap');

    .body, .content{
    }

    .form-content{
        padding-top: 50px;
        padding-bottom: 50px;
        max-width: 60%;
        margin-left: auto;
        margin-right: auto;


    }

.title{
        text-align: center;
        font-family: 'Hind Madurai', sans-serif;
        font-weight: 300;
    }

.botoes{
    text-align: center;
}


input[type=checkbox].css-checkbox:checked + label.css-label {
    background-position: 0 0;
    border: 3px solid #38CE8A;;
}
</style>
