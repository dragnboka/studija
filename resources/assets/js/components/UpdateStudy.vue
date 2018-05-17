<template>
    <div>
        <h2 class="text-center mb-4 font-weight-bold">Dodaj nove grupe i taskove</h2>
        <form @submit.prevent @keydown.enter.prevent>
            <div class="row">
                
                <div class="col-md-6">
                    <p class="text-center h3">Task</p>
                    <div class="input-group mb-3">
                        <input @keyup.enter="onAddTask" type="text" class="form-control" v-model.trim="task">
                        <div class="input-group-append">
                            <button @click="onAddTask" class="btn btn-outline-primary" type="button">Add Task</button>
                        </div>
                    </div>

                    <ul class="list-group"
                            v-for="(taskInput) in taskInputs"
                            :key="taskInput.id">
                            <li class="list-group-item d-flex mb-2">
                                <p class="flex-grow-1 list-group-p">{{taskInput.value}}</p>
                                <button @click="onDeleteTask(taskInput.id)" type="button"
                                class="ml-3 btn btn-danger btn-sm">X</button>
                            </li>
                    </ul>  
                    
                </div>
                    
                <div class="col-md-6">
                    <p class="text-center h3">Grupa</p>
                    <div class="input-group mb-3">
                        <input @keyup.enter="onAddGroup" v-model.trim="group" type="text" class="form-control" >
                        <div class="input-group-append">
                            <button @click="onAddGroup" class="btn btn-outline-primary" type="button">Add Group</button>
                        </div>
                    </div>

                    <ul class="list-group"
                            v-for="(groupInput) in groupInputs"
                            :key="groupInput.id">
                        <li class="list-group-item d-flex mb-2">
                            <p class="flex-grow-1 list-group-p">{{groupInput.value}}</p>
                            <button @click="onDeleteGroup(groupInput.id)" type="button"
                            class="ml-3 btn btn-danger btn-sm">X</button>
                        </li>
                    </ul>     
                </div>
                
            </div>
        
            <div class="form-group row mt-5">
                <div class="col-md-6 mx-auto d-flex justify-content-center">
                    <button @click="send" type="submit" class="btn btn-primary">
                        Dodaj
                    </button>
                </div>
            </div>
        
        </form>
    </div>
</template>

<script>
    export default {
        props: ['studyId'],
        data () {
            return {
                task: '',
                group: '',
                taskInputs: [],
                groupInputs: [],
            }
        },
        methods: {
            onAddTask () {
                if(this.task == ''){
                    return
                }
                const newTask = {
                id: Math.random() * Math.random() * 1000,
                value: this.task
                }
                this.taskInputs.unshift(newTask)
                this.task = ''
            },
            onDeleteTask (id) {
                this.taskInputs = this.taskInputs.filter(task => task.id !== id)
            },
            onAddGroup () {
                const newGroup = {
                id: Math.random() * Math.random() * 1000,
                value: this.group
                }
                this.groupInputs.unshift(newGroup)
                this.group = ''
            },
            onDeleteGroup (id) {
                this.groupInputs = this.groupInputs.filter(group => group.id !== id)
            },
            send(){
                axios.post(`/study/${this.studyId}`, {
                    id: this.studyId,
                    tasks: this.taskInputs,
                    groups: this.groupInputs
                }).then(() => {
                    window.location.href = `/study/${this.studyId}`;
                })
                .catch(function (error) {
                    console.log(error);
                });

            }
        }
    }
</script>
