
<template>
    <div class="vx-row">

        <!-- HORIZONTAL LAYOUT -->
        <div class="vx-col md:w-1/2 w-full mb-base">
            <vx-card title="Add Location">
                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <span>Location</span>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-input class="w-full" v-model="location" />
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col sm:w-2/3 w-full ml-auto">
                        <vs-button class="mr-3 mb-2" @click.prevent="addData('Location')">Add</vs-button>
                    </div>
                </div>
            </vx-card>
        </div>

        <!-- HORIZONTAL LAYOUT WITH ICON-->
        <div class="vx-col md:w-1/2 w-full mb-base">
            <vx-card title="Add Flue Type">
                <div class="vx-row mb-6">
                    <div class="vx-col sm:w-1/3 w-full">
                        <span>Flue Type</span>
                    </div>
                    <div class="vx-col sm:w-2/3 w-full">
                        <vs-input class="w-full" icon-pack="feather"  v-model="fluetype" />
                    </div>
                </div>
                <div class="vx-row">
                    <div class="vx-col sm:w-2/3 w-full ml-auto">
                        <vs-button class="mr-3 mb-2" @click.prevent="addData('Flue Type')">Add</vs-button>
                    </div>
                </div>
            </vx-card>
        </div>

        <!-- HORIZONTAL LAYOUT WITH ICON-->
        <div class="vx-col md:w-1/2 w-full mb-base">
            <vx-card title="Locations">
                <vs-table max-items="5" pagination :data="locationsAll">

                    <template slot="thead">
                        <vs-th>Location Name</vs-th>
                    </template>

                    <template slot-scope="{data}">
                        <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                            <vs-td :data="data[indextr].location_name">
                                {{data[indextr].location_name}}
                            </vs-td>
                        </vs-tr>
                    </template>
                </vs-table>
            </vx-card>
        </div>

        <!-- HORIZONTAL LAYOUT WITH ICON-->
        <div class="vx-col md:w-1/2 w-full mb-base">
            <vx-card title="Flue Type">
                <vs-table max-items="5" pagination :data="flueTypeAll">

                    <template slot="thead">
                        <vs-th>Flue Type</vs-th>
                    </template>

                    <template slot-scope="{data}">
                        <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                            <vs-td :data="data[indextr].type_name">
                                {{data[indextr].type_name}}
                            </vs-td>
                        </vs-tr>
                    </template>
                </vs-table>
            </vx-card>
        </div>
    </div>
</template>

<script>
    export default{
        data () {
            return {
                location: '',
                fluetype: '',
                locationsAll:{},
                flueTypeAll:{},
            }
        },
        methods: {
            addData(form){
                let data={};
                let error=false;
                switch (form) {
                    case "Location":
                        if (this.location){
                            data={location:this.location}
                        }else{
                            error=true;
                        }
                        break;
                    case "Flue Type":
                            if (this.fluetype){
                                data={fluetype:this.fluetype}
                            }else {
                                error = true;
                            }
                            break;
                    default:
                               return;
                        break;
                }
                if(error){
                    this.$vs.notify({
                        title: 'Invalid Data.',
                        text: form+' field is required.',
                        iconPack: 'feather',
                        icon: 'icon-alert-circle',
                        color: 'danger'
                    })
                }else{
                    this.$http.post('/location?form='+form,data)
                    .then((response)=>{
                        if(response.data.status){
                            this.location='';
                            this.fluetype='';
                            this.$vs.notify({
                                title: 'Success',
                                text: form+' Added Successfully.',
                                iconPack: 'feather',
                                icon: 'icon-alert-circle',
                                color: 'success'
                            })
                        }else{
                            if(response.data.error){
                                this.$vs.notify({
                                    title: 'Error',
                                    text: response.data.error,
                                    iconPack: 'feather',
                                    icon: 'icon-alert-circle',
                                    color: 'primary'
                                })
                            }else{
                                this.$vs.notify({
                                    title: 'Server Error ',
                                    text: 'Please try again later.',
                                    iconPack: 'feather',
                                    icon: 'icon-alert-circle',
                                    color: 'danger'
                                })
                            }

                        }
                    }).catch((error)=>{
                        if(error){
                            this.$vs.notify({
                                title: 'Server Error ',
                                iconPack: 'feather',
                                icon: 'icon-alert-circle',
                                color: 'danger'
                            })
                        }
                    });
                }
            },
            table(){
                this.locationsAll={}
                this.flueTypeAll={}
                this.$vs.loading();
                this.$http.get('/location').then((response)=>{
                    this.$vs.loading.close();
                    this.locationsAll=response.data.location
                    this.flueTypeAll=response.data.flueType
                }).catch((error)=>{
                    this.$vs.loading.close();
                })

            }

        },
        created() {
            this.table()
        }
    }
</script>
