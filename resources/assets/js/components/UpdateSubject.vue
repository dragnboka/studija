<template>
<form @submit.prevent="send">
    <div class="mt-3">
        <div class="d-flex">
            <p class="flex-grow-1 text-center h4">Studies<button v-if="studiesValues.length > 0" @click="removeStudies" type="button"
            class="btn btn-danger btn-sm ml-3">X</button></p>
            <p v-if="cekiram" class="text-center flex-grow-1 h4">Groups<button v-if="emptyGroups" @click="remove" type="button"
            class="btn btn-danger btn-sm ml-3">X</button></p>
        </div>

        <div class="row" v-for="study in studies" :key="study.id">
            <div class="col-md-6 mb-4">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" :id=study.id v-model="selectedStudies[study.id]" :value=study.id :name="`studies[${study.id}]`" @input="clear('studies')">
                    <label class="custom-control-label" :for=study.id>{{study.name}}</label>
                </div>
                
            </div>

           <div class="col-md-6 mb-4">
                <div class="card" v-if="selectedStudies[study.id]" style="width: 18rem;">
                    <ul v-for="s in study.groups" :key=s.id class="list-group list-group-flush">
                        <li class="list-group-item" >
                            <div class="custom-control custom-radio" >
                            <input  class="custom-control-input"  type="radio" :value=s.id v-model="selectedGroups[s.study_id]" :id=s.id+study.name @input="clear('groups')">   
                            <label class="custom-control-label" :for=s.id+study.name>
                                {{s.name}}
                            </label>
                            </div>
                        </li>
                    </ul>
                    <p class="text-danger m-0 p-3" 
                        v-if="errors.has('groups')" 
                        v-text="errors.get('groups')">
                    </p>
                </div> 
            </div>
        </div>
        <p class="text-danger" 
            v-if="errors.has('studies')" 
            v-text="errors.get('studies')">
        </p>

        <p class="text-danger" 
            v-if="errors.has('both')" 
            v-text="errors.get('both')">
        </p>
        
        <template v-if="errorsF.length">
            <p class="text-danger" v-for="(error,i) in errorsF" :key="i">{{ error }}</p>
        </template>

        <button :disabled="errors.any()" type="submit" class="btn btn-primary my-5 m-r3">
            Add
        </button>

        <a :href="cancel" class="btn btn-primary my-5">
            Cancel
        </a>
    </div>
</form>           
</template>

<script>
import {Errors} from './../classes.js'
export default {
    props: [
        'id'
    ],
    data(){
        return {
            studies: [],
            selectedGroups: {},
            selectedStudies: {},
            grupe: [],
            errors: new Errors(),
            errorsF:[],            
        }
    },
    computed: {
        emptyGroups() {
            return Object.keys(this.selectedGroups).length > 0
        },
        cekiram(){
            return Object.keys(this.selectedStudies).length !== 0
        },
        studiesValues(){
            return _.keys(_.pickBy(this.selectedStudies));
        },
        cancel(){
            return `/subject/${this.id}`
        }
    },
    methods: {
        clear(name){
            if(this.errors.has(name)) {
                this.errors.clear(name)
            } 
        },
        send(){
            this.errorsF = [];
            
            if(_.isEmpty(this.selectedStudies) || _.isEmpty(this.selectedGroups)) {
                this.errorsF.push("You must select at least one study and one group");
                return;
            }

            if (Object.keys(this.selectedGroups).length !== Object.keys(this.selectedStudies).length) {
                this.errorsF.push("Select study and group together");
                return
            }
            axios.post(`/subject/${this.id}`, {
                studies: this.selectedStudies,
                groups: this.selectedGroups,
            }).then(() => {
                window.location.href = `/subject/${this.id}`;
            })
            .catch((error) => this.errors.record(error.response.data.errors));
        },
        remove() {
            this.selectedGroups = {}    
        },
        removeStudies() {
            this.selectedStudies = {}    
        },
        
        
    },
    mounted(){
        axios.get(`/api/${this.id}`)
            .then((response) => {
            this.studies = response.data
            })
            .catch(function (error) {
                console.log(error);
            });
    }
}
</script>




