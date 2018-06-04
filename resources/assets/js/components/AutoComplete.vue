<template>
 <div>
  <form action="" @submit.prevent="send">
  <input type="text" placeholder="what are you looking for?" v-model="query" v-on:keyup="autoComplete" class="form-control">
  <div class="panel-footer" v-if="results.length || studies.length">
   <ul class="list-group">
    <li class="list-group-item bg-info" v-if="results.length">subjekti</li>
    <li class="list-group-item p-0" v-for="result in results"  :key="result.id">
     <a class="d-block p-2" :href="`/subject/${result.id}`">{{ result.ime }} {{ result.prezime }}</a>
    </li>
    <li class="list-group-item bg-info" v-if="studies.length">studije</li>
    <li class="list-group-item p-0" v-for="study in studies" :key="study.id">
     <a class="d-block p-2" :href="`/study/${study.id}`">{{ study.name }}</a>
    </li>
   </ul>
  </div>
  </form>
 </div>
</template>
<script>
 export default{
  data(){
   return {
    query: '',
    results: [],
    studies: []
   }
  },
  methods: {
   autoComplete(){
    this.results = [];
    this.studies = [];
    if(this.query.length > 0){
     axios.get('/api/search',{params: {query: this.query}}).then(response => {
      this.results = response.data.subjects;
      this.studies = response.data.studies;
     });
    }
   },
   send(){
       return window.location.href = `/search?query=${this.query}`;
   }
  }
 }
</script>

<style scoped>
.list-group-item:hover a {
    background-color: aquamarine;
    text-decoration: none;
    color: black
}
</style>
