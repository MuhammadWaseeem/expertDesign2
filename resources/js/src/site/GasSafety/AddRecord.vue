<template>
    <vx-card title="LANDLORD/HOME OWNER GAS SAFETY RECORD" >
        <div class="mt-5">
            <form-wizard color="rgba(var(--vs-primary), 1)" errorColor="rgba(var(--vs-danger), 1)" :title="null" :subtitle="null" finishButtonText="Submit">
                <!-- tab 1 content -->
                <tab-content title="Step 1" class="mb-5" icon="feather icon-home" :before-change="validateStep1">

                    <!-- tab 1 content -->
                    <form data-vv-scope="step-1">
                        <legend><b>DETAILS OF THE CONTRACTOR</b></legend>
                        <div class="vx-row">
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Trading Title"  v-model="form1.assessmentCarriedOutBy" class="w-full" name="trading_title" v-validate="'required|alpha'" />
                                <span class="text-danger">{{ errors.first('step-1.trading_title') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Post Code:"  v-model="form1.assessmentCarriedOutBy" class="w-full" name="post_code" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-1.Post Code:') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Gas Safe No:"  v-model="form1.propertyType" class="w-full" name="gas_safe_no" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-1.gas_safe_no') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Telephone No:"  v-model="form1.propertyType2" class="w-full" name="telephone_no" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-1.telephone_no') }}</span>
                            </div>
                            <div class="vx-col md:w-1/1 w-full mt-5">
                                <vs-textarea v-model="form1.propertyAddress" label="Address:"  name="address" class="mb-0 md:mt-10 mt-6" rows="3" v-validate="'required'"/>
                                <span class="text-danger">{{ errors.first('step-1.address') }}</span>
                            </div>
                        </div>
                    </form>
                </tab-content>

                <!-- tab 2 content -->
                <tab-content title="Step 2" class="mb-5" icon="feather icon-briefcase" :before-change="validateStep2">
                    <form data-vv-scope="step-2">
                        <legend ><b>ADDRESS OF THE INSTALLATION</b></legend><br>
                        <div class="vx-row">
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Post Code:"  v-model="form2.defect" class="w-full" name="post_code_2" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-2.post_code_2') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Telephone No:"  v-model="form2.recommendation" class="w-full" name="telephone_no_2" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-2.telephone_no_2') }}</span>
                            </div>
                            <div class="vx-col md:w-1/1 w-full mt-5">
                                <vs-textarea v-model="form1.propertyAddress" label="Address:"  name="address_2" class="mb-0 md:mt-10 mt-6" rows="3" v-validate="'required'"/>
                                <span class="text-danger">{{ errors.first('step-1.address_2') }}</span>
                            </div>
                        </div>
                    </form>
                </tab-content>

                <!-- tab 3 content -->
                <tab-content title="Step 3" class="mb-5" icon="feather icon-image" :before-change="validateStep3">
                    <form data-vv-scope="step-3">
                        <legend><b>DETAILS OF CLIENT/LANDLORD</b></legend><br>
                        <div class="vx-row">
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Post Code:"  v-model="form2.defect" class="w-full" name="post_code_3" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-3.post_code_3') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Telephone No:"  v-model="form2.recommendation" class="w-full" name="telephone_no_3" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-3.telephone_no_2') }}</span>
                            </div>
                            <div class="vx-col md:w-1/1 w-full mt-5">
                                <vs-textarea v-model="form1.propertyAddress" label=" Client Address:"  name="client_address" class="mb-0 md:mt-10 mt-6" rows="3" v-validate="'required'"/>
                                <span class="text-danger">{{ errors.first('step-3.client_address') }}</span>
                            </div>
                        </div>
                    </form>
                </tab-content>

                <!-- tab 4 content -->
                <tab-content title="Step 4" class="mb-5" icon="feather icon-image" :before-change="validateStep4">
                    <form data-vv-scope="step-4">
                        <legend><b>2- Little used outlets</b></legend><br>
                        <div class="vx-row">
                            <div class="vx-col md:w-1/2 w-full">
                                <label>Are there any water outlets that are used less than once per week e.g. in guest bathrooms?</label>
                                <vs-switch v-model="form4.isWaterOutlet" name="boiler" color="primary"  icon-pack="feather" vs-icon="icon-check"/>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Defect/Risk"  v-model="form4.defect" class="w-full" name="defect_risk_3" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-4.defect_risk_3') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Location"  v-model="form4.location" class="w-full" name="location_3" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-4.location_3') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Recommendation"  v-model="form4.recommendation" class="w-full" name="recommendation_3" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-4.recommendation_3') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Responsible person: Landlord/tenant/other"  v-model="form4.responsiblePerson" class="w-full" name="responsible_person_3" v-validate="'required'" /><br>
                                <span class="text-danger">{{ errors.first('step-4.responsible_person_3') }}</span>
                            </div>
                        </div>
                    </form>
                </tab-content>

                <!-- tab 5 content -->
                <tab-content title="Step 5" class="mb-5" icon="feather icon-image" :before-change="validateStep5">
                    <form data-vv-scope="step-5">
                        <legend><b>3- Shower heads</b></legend><br>
                        <div class="vx-row">
                            <div class="vx-col md:w-1/2 w-full">
                                <label>Are there any showers in the property?</label>
                                <vs-switch v-model="form5.isShower" name="showers_property" color="primary"  icon-pack="feather" vs-icon="icon-check"/>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Defect/Risk"  v-model="form5.defect" class="w-full" name="defect_risk_4" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-5.defect_risk_4') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Location"  v-model="form5.location" class="w-full" name="location_4" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-5.location_4') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Recommendation"  v-model="form5.recommendation" class="w-full" name="recommendation_4" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-5.recommendation_4') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Responsible person: Landlord/tenant/other"  v-model="form5.responsiblePerson" class="w-full" name="responsible_person_4" v-validate="'required'" /><br>
                                <span class="text-danger">{{ errors.first('step-5.responsible_person_4') }}</span>
                            </div>
                        </div>
                        <legend><b>4- Dead legs and redundant pipework</b></legend><br>
                        <div class="vx-row">
                            <div class="vx-col md:w-1/2 w-full">
                                <label>Are there any dead legs in the property?</label>
                                <vs-switch v-model="form5.isDeadLegs" name="showers_property" color="primary"  icon-pack="feather" vs-icon="icon-check"/>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Defect/Risk"  v-model="form5.deadLegsDefect" class="w-full" name="defect_risk_5" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-5.defect_risk_5') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Location"  v-model="form5.deadLegsLocation" class="w-full" name="location_5" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-5.location_5') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Recommendation"  v-model="form5.deadLegsRecommendation" class="w-full" name="recommendation_5" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-5.recommendation_5') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Responsible person: Landlord/tenant/other"  v-model="form5.deadLegsResponsiblePerson" class="w-full" name="responsible_person_5" v-validate="'required'" /><br>
                                <span class="text-danger">{{ errors.first('step-5.responsible_person_5') }}</span>
                            </div>

                        </div>
                    </form>
                </tab-content>

                <!-- tab 6 content -->
                <tab-content title="Step 6" class="mb-5" icon="feather icon-image" :before-change="validateStep6">
                    <form data-vv-scope="step-6">
                        <legend><b>5- Unoccupied properties</b></legend><br>
                        <div class="vx-row">
                            <div class="vx-col md:w-1/2 w-full">
                                <label>Is the property left unoccupied for periods of time, e.g. in the case of student lettings over the summer holiday or at Christmas/New Year?</label>
                                <vs-switch v-model="form6.isLeftUnOccupied" name="periods_of_time" color="primary"  icon-pack="feather" vs-icon="icon-check"/>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Defect/Risk"  v-model="form6.defect" class="w-full" name="defect_risk_6" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-6.defect_risk_6') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Recommendation"  v-model="form6.recommendation" class="w-full" name="recommendation_6" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-6.recommendation_6') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Responsible person: Landlord/tenant/other"  v-model="form6.responsiblePerson" class="w-full" name="responsible_person_6" v-validate="'required'" /><br>
                                <span class="text-danger">{{ errors.first('step-6.responsible_person_6') }}</span>
                            </div>
                        </div>
                        <legend><b>6- Advice to tenants</b></legend><br>
                        <div class="vx-row">
                            <div class="vx-col md:w-1/2 w-full">
                                <label>Has advice been given to the tenants as to the risks of Legionnaires Disease in a domestic setting and their responsibilities to minimise risk?</label>
                                <vs-switch v-model="form6.hasAdvoice" name="risks_tenants" color="primary"  icon-pack="feather" vs-icon="icon-check"/>
                            </div>
                        </div>
                    </form>
                </tab-content>
                <!-- tab 7 content -->
                <tab-content title="Step 7" class="mb-5" icon="feather icon-image" :before-change="validateStep7">
                    <form data-vv-scope="step-7">
                        <h2>Risk Assessment Review</h2><br>
                        <legend><b>If any of the following are true, please tick the box on the right.</b></legend><br>
                        <div class="vx-row">
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <span class="w-full" >Has there been a change to the water system or the way it is used by occupants?</span>
                            </div>
                            <div class="vx-col md:w-2/5 w-full mt-5">
                                <vs-checkbox v-model="form7.useByOccupants"></vs-checkbox>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <span class="w-full">Has there been a change to the use of the building where the system is installed?</span>
                            </div>
                            <div class="vx-col md:w-2/5 w-full mt-5">
                                <vs-checkbox v-model="form7.isSystemIsntalled"></vs-checkbox>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <span class="w-full">Is there new information available about risks or control measures?</span>
                            </div>
                            <div class="vx-col md:w-2/5 w-full mt-5">
                                <vs-checkbox v-model="form7.isControllMeasure"></vs-checkbox>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <span class="w-full">When testing the temperature of the water in the system, does hot water flow from any outlets at a temperature of below 50C?</span>
                            </div>
                            <div class="vx-col md:w-2/5 w-full mt-5">
                                <vs-checkbox v-model="form7.isBelowTemprature50"></vs-checkbox>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <span class="w-full">When testing the temperature of water in the system, does cold water flow from any outlets at a temperature of above 20C?</span>
                            </div>
                            <div class="vx-col md:w-2/5 w-full mt-5">
                                <vs-checkbox v-model="form7.isBelowTemprature20"></vs-checkbox>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <span class="w-full">Are the current tenants and their visitors more susceptible due to their age, health or lifestyle?</span>
                            </div>
                            <div class="vx-col md:w-2/5 w-full mt-5">
                                <vs-checkbox v-model="form7.isThereCurrenctTenants"></vs-checkbox>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <span class="w-full">Has there been a case of Legionnaires Disease associated with the system?</span>
                            </div>
                            <div class="vx-col md:w-2/5 w-full mt-5">
                                <vs-checkbox v-model="form7.isLegionnaires"></vs-checkbox>
                            </div>
                        </div>
                    </form>
                </tab-content>
            </form-wizard>
        </div>
    </vx-card>
</template>

<script>
    import { FormWizard, TabContent } from 'vue-form-wizard'
    import 'vue-form-wizard/dist/vue-form-wizard.min.css'
    import Datepicker from 'vuejs-datepicker';
    // For custom error message
    import { Validator } from 'vee-validate'
    const dict = {
        custom: {
            // tab1
            ass_date: {
                required: 'Assessment date is required',
            },
            carried_out_by: {
                required: 'Assessment carried out by is required',
                alpha: 'Assessment carried out by may only contain alphabetic characters'
            },
            property_type: {
                required: 'Describe property type is required',
            },
            type_cold_system: {
                required: 'This field  is required',
            },
            property_address: {
                required: 'Property Address is required',
            },

            // tab2
            defect_risk: {
                required: 'This Field is required',
            },
            recommendation: {
                required: 'This Field is required',
            },
            responsible_person: {
                required: 'This Field is required',
            },
            location: {
                required: 'This Field is required',
            },

            // tab3
            defect_risk_2: {
                required: 'This Field is required',
            },
            recommendation_2: {
                required: 'This Field is required',
            },
            responsible_person_2: {
                required: 'This field is required',
            },
            // tab4
            defect_risk_3: {
                required: 'This field is required',
            },
            recommendation_3: {
                required: 'This field is required',
            },
            responsible_person_3: {
                required: 'This field is required',
            },
            location_3: {
                required: 'This field is required',
            },

            // tab4

            defect_risk_4: {
                required: 'This field is required',
            },
            recommendation_4: {
                required: 'This field is required',
            },
            responsible_person_4: {
                required: 'This field is required',
            },
            location_4: {
                required: 'This field is required',
            },

            // tab5

            defect_risk_5: {
                required: 'This field is required',
            },
            recommendation_5: {
                required: 'This field is required',
            },
            responsible_person_5: {
                required: 'This field is required',
            },
            location_5: {
                required: 'This field is required',
            },

            // tab6

            defect_risk_6: {
                required: 'This field is required',
            },
            recommendation_6: {
                required: 'This field is required',
            },
            responsible_person_6: {
                required: 'This field is required',
            },

        }
    }

    // register custom messages
    Validator.localize('en', dict)

    export default {
        data () {
            return {
                form1:{
                    'propertyAddress':'',
                    'dateOfAssessment':'',
                    'assessmentCarriedOutBy':'',
                    'propertyType':'',
                    'tenent':'',
                    'typeColdWater':'',
                },
                form2:{
                    'propertyType':'',
                    'isColdWaterTemprature':'',
                    'isHotWaterTemprature':'',
                    'defect':'',
                    'recommendation':'',
                    'responsiblePerson':'',
                    'isOnePresent':'',
                    'isTightFitingLid':'',
                    'isTankClean':'',
                    'waterTemp':'',
                    'isTankInsulated':'',
                    'coldeWaterDefect':'',
                    'coldWaterRecommendation':'',
                    'coldWaterResponsiblePerson':'',
                    'location':'',
                },
                form3:{
                    'isBoilerSetting':'',
                    'defect':'',
                    'recommendation':'',
                    'responsiblePerson':'',
                },
                form4:{
                    'isWaterOutlet':'',
                    'location':'',
                    'defect':'',
                    'recommendation':'',
                    'responsiblePerson':'',
                },
                form5:{
                    'isShower':'',
                    'location':'',
                    'defect':'',
                    'recommendation':'',
                    'responsiblePerson':'',
                    'deadLegsDefect':'',
                    'deadLegsRecommendation':'',
                    'deadLegsResponsiblePerson':'',
                    'isDeadLegs':'',
                    'deadLegsLocation':'',
                },
                form6:{
                    'isLeftUnOccupied':'',
                    'defect':'',
                    'recommendation':'',
                    'responsiblePerson':'',

                    'hasAdvoice':'',
                    'advoiceDefect':'',
                    'advoiceRecommendation':'',
                    'advoiceResponsiblePerson':'',
                },
                form7:{
                    'isChangeSystem':'',
                    'isChangeBuilding':'',
                    'isNewInformation':'',
                    'isBelowTemprature50':'',
                    'isAboveTemprature20':'',
                    'isCurrenctTenants':'',
                    'isLegionnaires':'',
                },
            }
        },
        methods: {
            addData () {
                let data=[
                    {
                        form1:this.form1,
                        form2:this.form2,
                        form3:this.form3,
                        form4:this.form4,
                        form5:this.form5,
                        form6:this.form6,
                        form7:this.form7,
                    }
                ]
                // Loading
                this.$vs.loading()
                this.$http.post('/risk-assessment',data)
                    .then((response)=>{
                        this.$vs.loading.close()
                        console.log(response)

                        // this.pagination = response.data.pagination;
                    })
                    .catch((error)=>{
                        this.$vs.loading.close()
                    });
            },
            validateStep1 () {
                return new Promise((resolve, reject) => {
                    this.$validator.validateAll('step-1').then(result => {
                        if (result) {
                            resolve(true)
                        } else {
                            reject('correct all values')
                        }
                    })
                })
            },
            validateStep2 () {
                return new Promise((resolve, reject) => {
                    this.$validator.validateAll('step-2').then(result => {
                        if (result) {
                            resolve(true)
                        } else {
                            reject('correct all values')
                        }
                    })
                })
            },
            validateStep3 () {
                return new Promise((resolve, reject) => {
                    this.$validator.validateAll('step-3').then(result => {
                        if (result) {
                            resolve(true)
                        } else {
                            reject('correct all values')
                        }
                    })
                })
            },
            validateStep4 () {
                return new Promise((resolve, reject) => {
                    this.$validator.validateAll('step-4').then(result => {
                        if (result) {
                            resolve(true)
                        } else {
                            reject('correct all values')
                        }
                    })
                })
            },
            validateStep5 () {
                return new Promise((resolve, reject) => {
                    this.$validator.validateAll('step-5').then(result => {
                        if (result) {
                            resolve(true)
                        } else {
                            reject('correct all values')
                        }
                    })
                })
            },
            validateStep6 () {
                return new Promise((resolve, reject) => {
                    this.$validator.validateAll('step-6').then(result => {
                        if (result) {
                            resolve(true)
                        } else {
                            reject('correct all values')
                        }
                    })
                })
            },
            validateStep7 () {
                return new Promise((resolve, reject) => {
                    this.$validator.validateAll('step-7').then(result => {
                        if (result) {
                            this.addData();
                            resolve(true)
                        } else {
                            reject('correct all values')
                        }
                    })
                })
            }
        },
        components: {
            FormWizard,
            TabContent,
            Datepicker
        }
    }
</script>
