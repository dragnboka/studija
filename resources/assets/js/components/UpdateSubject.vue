<template>
    <div class="mt-3">
        <div class="d-flex">
            <p class="flex-grow-1 text-center h4">Studije</p>
            <p v-if="cekiram" class="text-center flex-grow-1 h4">Grupe<button @click="remove" type="button"
            class="btn btn-danger btn-sm ml-3">X</button></p>
        </div>

        <!-- <select name="" id="">
            <option v-for="studija in studije" :key="studija.id" value=""> {{studija.name}}</option>
        </select> -->
        <div class="row" v-for="studija in studije" :key="studija.id">
            <div class="col-md-6 mb-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input"  name="studije[]" v-model="checked[studija.id]" :value=studija.id  :id=studija.id>
                    <label class="custom-control-label" :for=studija.id>{{studija.name}}</label>
                </div>
                
            </div>

            <div class="col-md-6 mb-4">
                <div class="card" v-if="checked[studija.id]" style="width: 18rem;">
                    <ul v-for="s in studija.groups" :key=s.id class="list-group list-group-flush">
                        <li class="list-group-item" >
                            <div class="form-check" >
                            <input  class="form-check-input"  type="radio"  :value=s.id v-model="selected[s.study_id]" :name="`grupe[${studija.id}] `" :id=s.id+studija.name>   
                            <label class="form-check-label" :for=s.id+studija.name>
                                {{s.name}}
                            </label>
                            </div>
                        </li>
                    </ul>
                </div>           
            </div>
        </div>
        <button type="submit" class="btn btn-primary my-5">
            Edit
        </button>
    </div>
            
</template>

<script>
export default {
    props: [
        'id'
    ],
    data(){
        return {
            studije: [],
            selected: {},
            checked: {},
            grupe: []            
        }
    },
    computed: {
        cekiram(){
            for (var key in this.checked) {
                if (this.checked[key] == true) {
                    return true
                }
            }
            
            //return Object.keys(this.checked).length !== 0
        },
    },
    methods: {
        remove() {
            this.selected = {}    
        },
        
        
    },
    mounted(){
        axios.get(`/api/${this.id}`)
            .then((response) => {
            this.studije = response.data
            })
            .catch(function (error) {
                console.log(error);
            });
    }
}
</script>




