<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-default">
                    <div class="card-header">BiciApp</div>
                    <div class="card-body">
                        <b-alert :show="alert.dismissCountDown"
                                 dismissible
                                 fade
                                 :variant="alert.variant"
                                 @dismissed="alert.dismissCountDown=0"
                                 @dismiss-count-down="countDownChanged">
                            {{alert.message}} {{alert.dismissCountDown}} seconds...
                        </b-alert>
                        <button class="btn btn-success float-lg-right" v-on:click="modalItem()">Create New</button>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SKU</th>
                                    <th>Description</th>
                                    <th>Country</th>
                                    <th>Category</th>
                                    <th>Producer</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(accessory, key, index) in accessories">
                                    <td>{{accessory.sku}}</td>
                                    <td>{{accessory.description}}</td>
                                    <td>{{accessory.country.name}}</td>
                                    <td>{{accessory.category.label}}</td>
                                    <td>{{accessory.producer.name}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" v-on:click="updateItem(accessory)">
                                            <i class="far fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger"  v-on:click="deleteItem(accessory,index)">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <b-modal ref="modalaccesory" title="Accesory"  @ok="saveItem">
            <b-form-group horizontal
                          :label-cols="4"
                          breakpoint="md"
                          label="SKU"
                          label-for="skuinput">
                <b-form-input v-model="item.sku" id="skuinput" ></b-form-input>
            </b-form-group>

            <b-form-group horizontal
                          :label-cols="4"
                          breakpoint="md"
                          label="Description"
                          label-for="textareainput">
                <b-form-textarea  v-model="item.description" id="textareainput"></b-form-textarea>
            </b-form-group>

            <b-form-group horizontal
                          :label-cols="4"
                          breakpoint="md"
                          label="Category"
                          label-for="categories">
                <b-form-select  v-model="item.category_id"
                               :options="categories"
                               value-field="id" text-field="label" class="mb-3" ></b-form-select>
            </b-form-group>

            <b-form-group horizontal
                          :label-cols="4"
                          breakpoint="md"
                          label="Producer"
                          label-for="categories">
                <b-form-select  v-model="item.producer_id"
                        :options="producers"
                        value-field="id" text-field="name" class="mb-3" ></b-form-select>
            </b-form-group>

            <b-form-group horizontal
                          :label-cols="4"
                          breakpoint="md"
                          label="Country"
                          label-for="Country">
                <b-form-select  v-model="item.country_id"
                        :options="countries"
                        value-field="id" text-field="name" class="mb-3" ></b-form-select>
            </b-form-group>
        </b-modal>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                alert:{
                    dismissSecs: 5,
                    dismissCountDown: 0,
                    showDismissibleAlert: false,
                    message:'',
                    variant:'warning'
                },
                categories:[],
                countries:[],
                producers:[],
                accessories: [
                    {country:{name:''},category:{label:''},producer:{name:''}}
                ],
                item:{
                    id:0,
                    sku:'',
                    description:'',
                    category_id:'',
                    producer_id:'',
                    country_id:''
                }
            };
        },
        mounted() {
            axios.get('/api/accessory')
                .then(response => {
                    this.accessories = response.data.data;
                    this.categories = response.data.catalogues.categories;
                    this.countries = response.data.catalogues.countries;
                    this.producers = response.data.catalogues.producers;
                });
        },
        methods:{
            modalItem: function (){
                this.item={
                    id:0,
                    sku:'',
                    description:'',
                    category_id:'',
                    producer_id:'',
                    country_id:''
                }
                this.$refs.modalaccesory.show()
            },
            saveItem: function() {
                if(this.item.id === 0)
                    axios.post('api/accessory',this.item).then(function (response) {
                        this.alert.dismissCountDown = 5;
                        this.$refs.modalaccesory.hide();
                        this.item={
                            sku:'',
                            description:'',
                            category_id:'',
                            producer_id:'',
                            country_id:''
                        };
                        this.accessories.push(response.data.data);
                    });
                else
                    axios.put('api/accessory/'+this.item.id,this.item).then(function (response) {
                        this.alert.dismissCountDown = 5;
                        this.$refs.modalaccesory.hide();
                        this.item={
                            sku:'',
                            description:'',
                            category_id:'',
                            producer_id:'',
                            country_id:''
                        }
                    });
            },
            countDownChanged (dismissCountDown) {
                this.alert.dismissCountDown = dismissCountDown
            },
            updateItem: function(item){
                this.$refs.modalaccesory.show()
                this.item = item;
            },

            deleteItem: function(item,index){
                axios.delete('api/accessory/'+item.id).then(function (response) {
                    this.alert.dismissCountDown = 5;
                    this.$refs.modalaccesory.hide();
                    this.accessories.splice(index, 1);
                });
            }
        }
    }
</script>
