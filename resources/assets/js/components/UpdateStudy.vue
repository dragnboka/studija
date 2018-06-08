<template>
    <div>
        <h2 class="text-center mb-4 font-weight-bold">Add new tasks and groups</h2>
        <form @submit.prevent @keydown.enter.prevent>
            <div class="row">
                
                <div class="col-md-6">
                    <p class="text-center h3">Tasks</p>
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
                            <input class="flex-grow-1 list-group-p form-control" type="text" v-model="taskInput.value" name="tasks[]" readonly>
                            <button @click="onDeleteTask(taskInput.id)" type="button"
                            class="ml-3 btn btn-danger btn-sm">X</button>
                        </li>
                    </ul>  
                    
                </div>
                    
                <div class="col-md-6">
                    <p class="text-center h3">Groups</p>
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
                            <input class="flex-grow-1 list-group-p form-control" type="text" v-model="groupInput.value" name="groups[]" readonly>
                            <button @click="onDeleteGroup(groupInput.id)" type="button"
                            class="ml-3 btn btn-danger btn-sm">X</button>
                        </li>
                    </ul>     
                </div>
                
            </div>
        
            <div class="form-group row mt-5">
                <div class="col-md-6 mx-auto d-flex justify-content-center">
                    <button @click="send" type="submit" class="btn btn-primary mr-3">
                        Add
                    </button>
                    <button @click="cancel" type="submit" class="btn btn-primary">
                        Cancel
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
                this.taskInputs.push(newTask)
                this.task = ''
            },
            onDeleteTask (id) {
                this.taskInputs = this.taskInputs.filter(task => task.id !== id)
            },
            onAddGroup () {
                if(this.group == ''){
                    return
                }
                const newGroup = {
                id: Math.random() * Math.random() * 1000,
                value: this.group
                }
                this.groupInputs.push(newGroup)
                this.group = ''
            },
            onDeleteGroup (id) {
                this.groupInputs = this.groupInputs.filter(group => group.id !== id)
            },
            send(){
                if (this.taskInputs.length == 0 && this.groupInputs.length == 0) {
                    return
                }
                axios.post(`/study/${this.studyId}`, {
                    id: this.studyId,
                    tasks: this.taskInputsValues,
                    groups: this.taskGroupsValues
                }).then(() => {
                    window.location.href = `/study/${this.studyId}`;
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            cancel(){
                return window.location.href = `/study/${this.studyId}`;
            }
        },
        computed: {
            taskInputsValues(){
                return this.taskInputs.map((task) => task.value)
            },
            taskGroupsValues(){
                return this.groupInputs.map((task) => task.value)
            }
        }
    }
</script>
