<template>
    <vx-card title="Legionnaires Disease risk assessment & guidelines" >
        <div class="mt-5">
            <form-wizard color="rgba(var(--vs-primary), 1)" errorColor="rgba(var(--vs-danger), 1)" :title="null" :subtitle="null" finishButtonText="Submit">
                <!-- tab 1 content -->
                <tab-content title="Step 1" class="mb-5" icon="feather icon-home" :before-change="validateStep1">

                    <!-- tab 1 content -->
                    <form data-vv-scope="step-1">
                        <div class="vx-row">
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <label> Date of Assessment</label>
                                <datepicker placeholder="Select Date" class="w-full" name="ass_date" v-model="form1.dateOfAssessment" v-validate="'required'"></datepicker>
<!--                                <vs-textarea v-model="textarea" label="Short discription" class="mb-0 md:mt-10 mt-6" rows="3" />-->
<!--                                <vs-input label="First Name" v-model="firstName" class="w-full" name="first_name" v-validate="'required|alpha'" />-->
                                <span class="text-danger">{{ errors.first('step-1.ass_date') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Assessment carried out by"  v-model="form1.assessmentCarriedOutBy" class="w-full" name="carried_out_by" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-1.carried_out_by') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Describe property type"  v-model="form1.propertyType" class="w-full" name="property_type" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-1.property_type') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <label >Is there any tenant?</label>
                                <vs-switch v-model="form1.tenent" name="tank_insulted" color="primary"  icon-pack="feather" vs-icon="icon-check" />
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Type of  cold water system"  v-model="form1.typeColdWater" class="w-full" name="type_cold_system" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-1.type_cold_system') }}</span>
                            </div>
                            <div class="vx-col md:w-1/1 w-full mt-5">
                                <vs-textarea v-model="form1.propertyAddress" label="Property Address"  name="property_address" class="mb-0 md:mt-10 mt-6" rows="3" v-validate="'required'"/>
                                <span class="text-danger">{{ errors.first('step-1.property_address') }}</span>
                            </div>
                        </div>
                    </form>
                </tab-content>

                <!-- tab 2 content -->
                <tab-content title="Step 2" class="mb-5" icon="feather icon-home" :before-change="validateStep2">
                    <form data-vv-scope="step-2">
                        <legend ><b>1- Water Outlet Temperature</b></legend><br>
                        <div class="vx-row">
                                <div class="vx-col md:w-1/2 w-full">
                                <label>Is cold water temperature at outlets below 20°C?</label>
                                <vs-switch v-model="form2.isColdWaterTemprature" name="cold_water_temperature" color="primary"  icon-pack="feather" vs-icon="icon-check" />
                            </div>
                                <div class="vx-col md:w-1/2 w-full">
                                <label>Is the hot water temperature above 50°C at outlets?</label>
                                <vs-switch v-model="form2.isHotWaterTemprature" name="hot_water_temperature" color="primary"  icon-pack="feather" vs-icon="icon-check" />
                             </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input label="Defect/Risk"  v-model="form2.defect" class="w-full" name="defect_risk" v-validate="'required'" />
                                    <span class="text-danger">{{ errors.first('step-2.defect_risk') }}</span>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input label="Recommendation"  v-model="form2.recommendation" class="w-full" name="recommendation" v-validate="'required'" />
                                    <span class="text-danger">{{ errors.first('step-2.recommendation') }}</span>
                                </div>
                                <div class="vx-col md:w-1/2 w-full mt-5">
                                    <vs-input label="Responsible person: Landlord/tenant/other"  v-model="form2.responsiblePerson" class="w-full" name="responsible_person" v-validate="'required'" /><br>
                                    <span class="text-danger">{{ errors.first('step-2.responsible_person') }}</span>
                                </div>

                        </div>
                        <legend><b>2- Cold water storage tanks</b></legend><br>
                        <div class="vx-row">
                               <div class="vx-col md:w-1/2 w-full">
                                <label>Is there one present?</label>
                                <vs-switch v-model="form2.isOnePresent" name="one_present" color="primary"  icon-pack="feather" vs-icon="icon-check" />

                            </div>
                               <div class="vx-col md:w-1/2 w-full">
                                <label>Does it have a tight fitting lid?</label>
                                <vs-switch v-model="form2.isTightFitingLid" name="tight_fitting_lid" color="primary"  icon-pack="feather" vs-icon="icon-check" />
                             </div>
                               <div class="vx-col md:w-1/2 w-full" v-if="form2.isOnePresent">
                                <vs-input label="Location"  v-model="form2.location" class="w-full" name="location" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-2.location') }}</span>
                            </div>
                               <div class="vx-col md:w-1/2 w-full">
                                <label>Is the water in the tank clean and free from rust, debris, scale and organic matter?</label>
                                <vs-switch v-model="form2.isTankClean" name="tank_clean_free" color="primary"  icon-pack="feather" vs-icon="icon-check" />
                             </div>
                               <div class="vx-col md:w-1/2 w-full">
                                <label>Is the temperature of the water in the tank below 20°C?</label>
                                <vs-switch v-model="form2.waterTemp" name="water_tank_below" color="primary"  icon-pack="feather" vs-icon="icon-check" />
                             </div>
                               <div class="vx-col md:w-1/2 w-full">
                                <label>Is the tank insulated?</label>
                                <vs-switch v-model="form2.isTankInsulated" name="tank_insulted" color="primary"  icon-pack="feather" vs-icon="icon-check" />
                             </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Defect/Risk"  v-model="form2.coldeWaterDefect" class="w-full" name="cold_defect_risk" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-2.cold_defect_risk') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Recommendation"  v-model="form2.coldWaterRecommendation" class="w-full" name="cold_recommendation" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-2.cold_recommendation') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Responsible person: Landlord/tenant/other"  v-model="form2.coldWaterResponsiblePerson" class="w-full" name="cold_responsible_person" v-validate="'required'" /><br>
                                <span class="text-danger">{{ errors.first('step-2.cold_responsible_person') }}</span>
                            </div>

                        </div>
                    </form>
                </tab-content>

                <!-- tab 3 content -->
                <tab-content title="Step 3" class="mb-5" icon="feather icon-home" :before-change="validateStep3">
                    <form data-vv-scope="step-3">
                        <legend><b>1- Hot Water</b></legend><br>
                        <div class="vx-row">
                            <div class="vx-col md:w-1/2 w-full">
                                <label>Is the temperature setting on the boiler and/or hot water tank such that
                                    the hot water is heated to and stored at a temperature of 60°C?</label>
                                <vs-switch v-model="form3.isBoilerSetting" name="boiler" color="primary"  icon-pack="feather" vs-icon="icon-check" />
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Defect/Risk"  v-model="form3.defect" class="w-full" name="defect_risk_2" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-3.defect_risk_2') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Recommendation"  v-model="form3.recommendation" class="w-full" name="recommendation_2" v-validate="'required'" />
                                <span class="text-danger">{{ errors.first('step-3.recommendation_2') }}</span>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <vs-input label="Responsible person: Landlord/tenant/other"  v-model="form3.responsiblePerson" class="w-full" name="responsible_person_2" v-validate="'required'" /><br>
                                <span class="text-danger">{{ errors.first('step-3.responsible_person_2') }}</span>
                            </div>
                        </div>
                    </form>
                </tab-content>

                <!-- tab 4 content -->
                <tab-content title="Step 4" class="mb-5" icon="feather icon-home" :before-change="validateStep4">
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
                            <div class="vx-col md:w-1/2 w-full mt-5" v-if="form4.isWaterOutlet">
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
                <tab-content title="Step 5" class="mb-5" icon="feather icon-home" :before-change="validateStep5">
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
                            <div class="vx-col md:w-1/2 w-full mt-5" v-if="form5.isShower">
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
                            <div class="vx-col md:w-1/2 w-full mt-5" v-if="form5.isDeadLegs">
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
                <tab-content title="Step 6" class="mb-5" icon="feather icon-home" :before-change="validateStep6">
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
                <tab-content title="Step 7" class="mb-5" icon="feather icon-home" :before-change="validateStep7">
                    <form data-vv-scope="step-7">
                        <h2>Risk Assessment Review</h2><br>
                        <legend><b>If any of the following are true, please tick the box on the right.</b></legend><br>
                        <div class="vx-row">
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <span class="w-full" >Has there been a change to the water system or the way it is used by occupants?</span>
                            </div>
                            <div class="vx-col md:w-2/5 w-full mt-5">
                                <vs-checkbox v-model="form7.isChangeSystem"></vs-checkbox>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <span class="w-full">Has there been a change to the use of the building where the system is installed?</span>
                            </div>
                            <div class="vx-col md:w-2/5 w-full mt-5">
                                <vs-checkbox v-model="form7.isChangeBuilding"></vs-checkbox>
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
                                <vs-checkbox v-model="form7.isAboveTemprature20"></vs-checkbox>
                            </div>
                            <div class="vx-col md:w-1/2 w-full mt-5">
                                <span class="w-full">Are the current tenants and their visitors more susceptible due to their age, health or lifestyle?</span>
                            </div>
                            <div class="vx-col md:w-2/5 w-full mt-5">
                                <vs-checkbox v-model="form7.isCurrentTenants"></vs-checkbox>
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

            cold_defect_risk: {
                required: 'This Field is required',
            },
            cold_recommendation: {
                required: 'This Field is required',
            },
            cold_responsible_person: {
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
                id: this.$route.params.id,
                edit:false,
                form1:{
                    'propertyAddress':'',
                    'dateOfAssessment':'',
                    'assessmentCarriedOutBy':'',
                    'propertyType':'',
                    'tenent':false,
                    'typeColdWater':'',
                },
                form2:{
                    'isColdWaterTemprature':false,
                    'isHotWaterTemprature':false,
                    'defect':'',
                    'recommendation':'',
                    'responsiblePerson':'',
                    'isOnePresent':false,
                    'isTightFitingLid':false,
                    'isTankClean':false,
                    'waterTemp':false,
                    'isTankInsulated':false,
                    'coldeWaterDefect':'',
                    'coldWaterRecommendation':'',
                    'coldWaterResponsiblePerson':'',
                    'location':'',
                },
                form3:{
                    'isBoilerSetting':false,
                    'defect':'',
                    'recommendation':'',
                    'responsiblePerson':'',
                },
                form4:{
                    'isWaterOutlet':false,
                    'location':'',
                    'defect':'',
                    'recommendation':'',
                    'responsiblePerson':'',
                },
                form5:{
                    'isShower':false,
                    'location':'',
                    'defect':'',
                    'recommendation':'',
                    'responsiblePerson':'',
                    'deadLegsDefect':'',
                    'deadLegsRecommendation':'',
                    'deadLegsResponsiblePerson':'',
                    'isDeadLegs':false,
                    'deadLegsLocation':'',
                },
                form6:{
                    'isLeftUnOccupied':false,
                    'defect':'',
                    'recommendation':'',
                    'responsiblePerson':'',
                    'hasAdvoice':false,
                    // 'advoiceDefect':'',
                    // 'advoiceRecommendation':'',
                    // 'advoiceResponsiblePerson':'',
                },
                form7:{
                    'isChangeSystem':false,
                    'isChangeBuilding':false,
                    'isControllMeasure':false,
                    'isBelowTemprature50':false,
                    'isAboveTemprature20':false,
                    'isCurrentTenants':false,
                    'isLegionnaires':false,
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
                this.$http.post('/risk-assessment', {data:data})
                    .then((response)=>{
                        this.$vs.loading.close()
                       if(response.data.status){
                           this.$vs.notify({
                               title: 'Success',
                               text: 'Data Added Successfully.',
                               iconPack: 'feather',
                               icon: 'icon-alert-circle',
                               color: 'success'
                           });
                           this.reset();
                       }else{
                           this.$vs.notify({
                               title: 'Server Error.',
                               text: 'Please Try Again Later.',
                               iconPack: 'feather',
                               icon: 'icon-alert-circle',
                               color: 'danger'
                           });
                       }

                        // this.pagination = response.data.pagination;
                    })
                    .catch((error)=>{
                        this.$vs.loading.close()
                    });
            },
            updateData () {
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
                this.$http.put('/risk-assessment/'+this.id, {data:data})
                    .then((response)=>{
                        this.$vs.loading.close()
                       if(response.data.status){
                           this.$vs.notify({
                               title: 'Success',
                               text: 'Data Updated Successfully.',
                               iconPack: 'feather',
                               icon: 'icon-alert-circle',
                               color: 'success'
                           });
                           this.reset();
                       }else{
                           this.$vs.notify({
                               title: 'Server Error.',
                               text: 'Please Try Again Later.',
                               iconPack: 'feather',
                               icon: 'icon-alert-circle',
                               color: 'danger'
                           });
                       }

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
                            if(this.edit){
                                this.updateData();
                            }else{
                                this.addData();
                            }
                            resolve(true)
                        } else {
                            reject('correct all values')
                        }
                    })
                })
            },
            Get() {
                // Loading
                this.$vs.loading()
                this.$http.get('/risk-assessment/' + this.id)
                    .then(response => {
                        if (response.data.status) {
                            let data=response.data.data;
                            this.form1={
                                'propertyAddress':data.property_address,
                                    'dateOfAssessment':data.assessment_date,
                                    'assessmentCarriedOutBy':data.carried_by,
                                    'propertyType':data.property_type,
                                    'tenent':data.any_tenant,
                                    'typeColdWater':data.cold_water_system,
                            };
                            this.form2={
                                    'isColdWaterTemprature':data.is_cold_water_temperature_below_20,
                                    'isHotWaterTemprature':data.is_hot_water_temperature_50,
                                    'defect':data.defect,
                                    'recommendation':data.recommendation,
                                    'responsiblePerson':data.responsible_person,
                                    'isOnePresent':data.cold_tank_present,
                                    'isTightFitingLid':data.tight_fitting,
                                    'isTankClean':data.cold_tank_clean,
                                    'waterTemp':data.cold_water_below_20,
                                    'isTankInsulated':data.is_tank_insulated,
                                    'coldeWaterDefect':data.cold_water_defect,
                                    'coldWaterRecommendation':data.cold_water_recom,
                                    'coldWaterResponsiblePerson':data.cold_water_respon_person,
                                    'location':data.cold_tank_location,
                            }
                            this.form3={
                                'isBoilerSetting':data.hot_water_temp_60,
                                    'defect':data.defect_2,
                                    'recommendation':data.recommendation_2,
                                    'responsiblePerson':data.responsible_person_2,
                            }
                            this.form4={
                                'isWaterOutlet':data.any_water_outlets,
                                    'location':data.little_outlets_location,
                                    'defect':data.defect_3,
                                    'recommendation':data.recommendation_3,
                                    'responsiblePerson':data.responsible_person_3,
                            }
                            this.form5={
                                'isShower':data.any_showers_property,
                                    'location':data.shower_heads_location,
                                    'defect':data.defect_4,
                                    'recommendation':data.recommendation_4,
                                    'responsiblePerson':data.responsible_person_4,
                                    'deadLegsDefect':data.defect_5,
                                    'deadLegsRecommendation':data.recommendation_5,
                                    'deadLegsResponsiblePerson':data.responsible_person_5,
                                    'isDeadLegs':data.dead_legs_property,
                                    'deadLegsLocation':data.dead_legs_location,
                            }
                            this.form6={
                                'isLeftUnOccupied':data.unoccupied_properties_christmas,
                                    'defect':data.defect_6,
                                    'recommendation':data.recommendation_6,
                                    'responsiblePerson':data.responsible_person_6,
                                    'hasAdvoice':data.advice_to_tenants,
                            }
                            this.form7={
                                'isChangeSystem':data.change_water_system,
                                    'isChangeBuilding':data.change_use_of_building,
                                    'isControllMeasure':data.risks_control_measures,
                                    'isBelowTemprature50':data.review_temperature_below_50,
                                    'isAboveTemprature20':data.review_temperature_above_20,
                                    'isCurrentTenants':data.review_current_tenants,
                                    'isLegionnaires':data.review_legionnaires_disease
                                ,
                            }



                        } else {
                            this.$vs.notify({
                                title: 'Error',
                                text: response.data.msg,
                                iconPack: 'feather',
                                icon: 'icon-alert-circle',
                                color: 'danger'
                            });
                            this.$router.push('/risk-assessment/history');
                        }
                        this.$vs.loading.close();
                    })
                    .catch(error => {
                        this.$vs.loading.close();
                    });
            },
            reset(){
                this.form1={
                    'propertyAddress':'',
                        'dateOfAssessment':'',
                        'assessmentCarriedOutBy':'',
                        'propertyType':'',
                        'tenent':false,
                        'typeColdWater':'',
                };
                this.form2={
                    'isColdWaterTemprature':false,
                        'isHotWaterTemprature':false,
                        'defect':'',
                        'recommendation':'',
                        'responsiblePerson':'',
                        'isOnePresent':false,
                        'isTightFitingLid':false,
                        'isTankClean':false,
                        'waterTemp':false,
                        'isTankInsulated':false,
                        'coldeWaterDefect':'',
                        'coldWaterRecommendation':'',
                        'coldWaterResponsiblePerson':'',
                        'location':'',
                };
                this.form3={
                    'isBoilerSetting':false,
                        'defect':'',
                        'recommendation':'',
                        'responsiblePerson':'',
                };
                this.form4={
                    'isWaterOutlet':false,
                        'location':'',
                        'defect':'',
                        'recommendation':'',
                        'responsiblePerson':'',
                };
                this.form5={
                    'isShower':false,
                        'location':'',
                        'defect':'',
                        'recommendation':'',
                        'responsiblePerson':'',
                        'deadLegsDefect':'',
                        'deadLegsRecommendation':'',
                        'deadLegsResponsiblePerson':'',
                        'isDeadLegs':false,
                        'deadLegsLocation':'',
                };
                this.form6={
                    'isLeftUnOccupied':false,
                        'defect':'',
                        'recommendation':'',
                        'responsiblePerson':'',
                        'hasAdvoice':false,
                    // 'advoiceDefect':'',
                    // 'advoiceRecommendation':'',
                    // 'advoiceResponsiblePerson':'',
                };
                this.form7={
                    'isChangeSystem':false,
                        'isChangeBuilding':false,
                        'isControllMeasure':false,
                        'isBelowTemprature50':false,
                        'isAboveTemprature20':false,
                        'isCurrentTenants':false,
                        'isLegionnaires':false,
                };
                if(this.edit)this.$router.push('/risk-assessment/history');
            }
        },
        created(){
            if(this.id){
                this.edit=true;
                this.Get();
            }
        },
        components: {
            FormWizard,
            TabContent,
            Datepicker
        }
    }
</script>
<style>
    @media (max-width:360px){
        .wizard-footer-left{
            margin-left: 47px;
        }

    }
    @media (max-width:360px){
        .wizard-footer-right{
            margin-right: 56px;
            margin-top: 14px;
        }

    }
</style>
