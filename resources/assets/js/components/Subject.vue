<template>  
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="form-group">
                <label for="name" class="col-form-label">Ime</label>

                <input id="name" type="text" class="form-control" name="ime" v-model="name" autofocus>
            </div>

            <div class="form-group">
                <label for="prezime" class="col-form-label">Prezime</label>

                <input id="prezime" type="text" class="form-control" name="prezime" v-model="prezime">
            </div>

            <div class="form-group">
                <label for="srname" class="col-form-label">Srednje Ime</label>

                <input id="srname" type="text" class="form-control" name="srednje" v-model="srname">
            </div>

            <div class="form-group">
                <label for="date" class="col-form-label">DOB</label>
                    <input class="form-control" type="date" id="date" v-model="dob" name="rodjen">
            </div>

            <div class="mb-2">
                <p class="mb-2">Pol</p>
                <div class="custom-control custom-radio custom-control-inline">
                    <input v-model="pol" class="custom-control-input" type="radio" id="muski" value="m" name="pol">
                    <label class="custom-control-label" for="muski">
                        Muski
                    </label>
                </div>

                <div class="custom-control custom-radio custom-control-inline">
                    <input v-model="pol" class="custom-control-input" type="radio" id="zenski" value="f" name="pol">
                    <label class="custom-control-label" for="zenski">
                        Zenski
                    </label>
                </div>
            </div>
            

            <div class="form-group">
                <label for="komentar">Komentar</label>
                <textarea class="form-control" id="komentar" rows="3" v-model="komentar" name="komentar"></textarea>
            </div>

            <div class="mt-3">
                <div class="d-flex">
                    <p class="flex-grow-1 text-center h4">Studije</p>
                    <p v-if="cekiram" class="text-center flex-grow-1 h4">Grupe<button @click="remove" type="button"
                    class="btn btn-danger btn-sm ml-3">X</button></p>
                </div>

                <div class="row" v-for="studija in studije" :key="studija.id">
                    <div class="col-md-6 mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" :id=studija.id v-model="checked[studija.id]" name="studije[]" :value=studija.id>
                            <label class="custom-control-label" :for=studija.id>{{studija.name}}</label>
                        </div>
                        
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card" v-if="checked[studija.id]" style="width: 18rem;">
                            <ul v-for="s in studija.groups" :key=s.id class="list-group list-group-flush">
                                <li class="list-group-item" >
                                    <div class="form-check" >
                                    <input  class="form-check-input"  type="radio" :value=s.id v-model="selected[s.study_id]" :id=s.id+studija.name :name="`grupe[${studija.id}] `">   
                                    <label class="form-check-label" :for=s.id+studija.name>
                                        {{s.name}}
                                    </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary my-5">
                Save
            </button>
        </div>
    </div>  

</template>

<script>
export default {
    data(){
        return {
            name: '',
            prezime: '',
            srname: '',
            dob: '',
            komentar: '',
            pol: '',
            studije: [],
            selected: {},
            checked: {}
            
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
        }
    },
    methods: {
        remove() {
            this.selected = {}    
        },

        // send(){
        //     axios.post('/subject', {
        //             ime: this.name,
        //             prezime: this.prezime,
        //             srednje: this.srname,
        //             rodjen: this.dob,
        //             komentar: this.komentar,
        //             studija: this.checked,
        //             grupa: this.selected,
        //             pol: this.pol,
                
        //         }).then(() => {
        //             window.location.href = "/subject";
        //         })
        //         .catch(function (error) {
        //             console.log(error);
        //         });
        //         //  window.flash('Novi Ispitanik dodat')
        // }
    },
    mounted(){
        axios.get('/api')
            .then((response) => {
            this.studije = response.data
            })
            .catch(function (error) {
                console.log(error);
            });
    }
}
</script>




