<template>  
<form @submit.prevent="send"  @input="errors.clear($event.target.name)">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="form-group">
                <label for="name" class="col-form-label">First name</label>

                <input id="name" type="text" class="form-control mb-2" name="firstName" v-model="firstName" required autofocus>

                <span class="text-danger" 
                    v-if="errors.has('firstName')" 
                    v-text="errors.get('firstName')">
                </span>
            </div>

            <div class="form-group">
                <label for="prezime" class="col-form-label">Last name</label>

                <input id="prezime" name="lastName" type="text" class="form-control mb-2" v-model="lastName" required>

                <span class="text-danger" 
                    v-if="errors.has('lastName')" 
                    v-text="errors.get('lastName')">
                </span>
            </div>

            <div class="form-group">
                <label for="srname" class="col-form-label">Middle name</label>

                <input id="srname" name="middleName" type="text" class="form-control mb-2" v-model="middleName" required>

                <span class="text-danger" 
                    v-if="errors.has('middleName')" 
                    v-text="errors.get('middleName')">
                </span>
            </div>

            <div class="form-group">
                <label for="date" class="col-form-label">Date of birth</label>
                <input class="form-control mb-2" type="date" id="date" v-model="dob" name="dob" required>

                <span class="text-danger" 
                    v-if="errors.has('dob')" 
                    v-text="errors.get('dob')">
                </span>
            </div>

            <div class="mb-3">
                <p class="mb-2">Gender</p>
                <div class="custom-control custom-radio custom-control-inline">
                    <input v-model="gender" name="gender" class="custom-control-input" type="radio" id="muski" value="m" required>
                    <label class="custom-control-label" for="muski">
                        Male
                    </label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                    <input v-model="gender" name="gender" class="custom-control-input" type="radio" id="zenski" value="f">
                    <label class="custom-control-label" for="zenski">
                        Female
                    </label>
                </div>

                <p class="text-danger mt-2" 
                    v-if="errors.has('gender')" 
                    v-text="errors.get('gender')">
                </p>
            </div>
            

            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea class="form-control mb-2" name="comment" id="comment" rows="3" v-model="comment"></textarea>
            </div>

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
                            <input type="radio" class="custom-control-input" :id=study.id v-model="checked[study.id]" :value=study.id :name="`studies[${study.id}]`">
                            <label class="custom-control-label" :for=study.id>{{study.name}}</label>
                        </div>
                        
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card" v-if="checked[study.id]" style="width: 18rem;">
                            <ul v-for="s in study.groups" :key=s.id class="list-group list-group-flush">
                                <li class="list-group-item" >
                                    <div class="custom-control custom-radio" >
                                    <input  class="custom-control-input"  type="radio" :value=s.id v-model="selected[s.study_id]" :id=s.id+study.name @input="clear">   
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
                <span class="text-danger" 
                    v-if="errors.has('studies')" 
                    v-text="errors.get('studies')">
                </span>
            </div>
            
            <button :disabled="errors.any()" type="submit" class="btn btn-primary my-5">
                Save
            </button>
        </div>
    </div>  
</form>
</template>

<script>
import {Errors} from './../classes.js'
export default {
    data(){
        return {
            firstName: '',
            lastName: '',
            middleName: '',
            dob: '',
            gender: '',
            comment: '',
            studies: [],
            selected: {},
            checked: {},
            errors: new Errors()
            
        }
    },
    computed: {
        emptyGroups() {
            return Object.keys(this.selected).length > 0
        },
        cekiram(){
            return Object.keys(this.checked).length !== 0
        },
        studiesValues(){
            return _.keys(_.pickBy(this.checked));
        },
    },
    methods: {
        clear(){
            if(this.errors.has('groups')) {
                this.errors.clear('groups')
            } 
        },
        remove() {
            this.selected = {}    
        },
        removeStudies() {
            this.checked = {}    
        },

        send(){
            if (Object.keys(this.selected).length !== Object.keys(this.checked).length) {
                return
            }
            axios.post('/subject', {
                firstName: this.firstName,
                lastName: this.lastName,
                middleName: this.middleName,
                dob: this.dob,
                gender: this.gender,
                comment: this.comment,
                studies: this.studiesValues,
                groups: this.selected,
                
            
            }).then(() => {
                window.location.href = "/subject";
            })
            .catch((error) => this.errors.record(error.response.data.errors));
        }
    },
    mounted(){
        axios.get('/api')
            .then((response) => {
            this.studies = response.data
            })
            .catch(function (error) {
                console.log(error);
            });
    }
}
</script>




