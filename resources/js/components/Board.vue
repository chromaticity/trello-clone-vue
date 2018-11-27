<template>
    <div class="container-fluid">
        <div class="row justify-content-left">
            <transition-group class="row">
                <div v-for="element,index in categories" :key="element.id">
                    <div class="card card-spacing">
                        <div class="card-header">
                            <h4 class="card-title">{{element.name}}</h4>
                        </div>
                        <div class="card-body card-body-dark">
                            <draggable :options="dragOptions" element="div" @end="changeOrder" v-model="element.tasks">
                                <transition-group :id="element.id">
                                    <div v-for="task,index in element.tasks" :key="task.category_id+','+task.order" class="transit-1" :id="task.id">
                                        <div class="small-card">
                                            <a href="#" @click="deleteTask(task.id)" v-on:click="element.tasks.splice(index, 1)"><i class="fa fa-trash delete-icon"></i></a>
                                            <textarea v-if="task === editingTask" class="text-input" @keyup.enter="endEditing(task)" @blur="endEditing(task)" v-model="task.name"></textarea>
                                            <label for="checkbox" v-if="task !== editingTask" @dblclick="editTask(task)">{{ task.name }}</label>
                                        </div>
                                    </div>
                                </transition-group>
                            </draggable>
                            <div class="small-card">
                                <h5 class="text-center" @click="addNew(index)">Add new card</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </transition-group>
        </div>
    </div>
</template>

<style scoped>
    .card {
        border:0;
        border-radius: 0.5rem;
    }
    .small-card {
        padding: 1rem;
        background: #f5f8fa;
        margin-bottom: 5px;
        border-radius: .25rem;
    }
    .card-body-dark{
        background-color: #ccc;
    }
    textarea {
        overflow: visible;
        outline: 1px dashed black;
        border: 0;
        padding: 6px 0 2px 8px;
        width: 100%;
        height: 100%;
        resize: none;
    }
    .card-spacing{
        float: right;
        margin-left: 15px;
        width: 350px;
    }
    .delete-icon {
        top: 0px;
        right: 0px;
    }
</style>

<script>
    import draggable from 'vuedraggable'
    export default {
        components: {
            draggable
        },
        data(){
            return {
                categories : [],
                editingTask : null
            }
        },
        methods : {
            addNew(id) {
                // allows you to add a task.
                let user_id = 1
                let name = "New task"
                let category_id = this.categories[id].id
                let order = this.categories[id].tasks.length

                axios.post('/api/task', {user_id, name, order, category_id}).then(response => {
                    this.categories[id].tasks.push(response.data.data)
                })
            },

            loadTasks() {
                // Loads all of the tasks upon initial load of the page.
                this.categories.map(category => {
                  axios.get(`/api/category/${category.id}/tasks`).then(response => {
                      category.tasks = response.data
                  })
              })
            },

            changeOrder(data){
                // Change the order/category of the task. However, changing orders is pretty finicky right now.
                let toTask = data.to
                let fromTask = data.from
                let task_id = data.item.id
                let category_id = fromTask.id == toTask.id ? null : toTask.id
                let order = data.newIndex == data.oldIndex ? false : data.newIndex

                if (order !== false) {
                    axios.put(`/api/task/${task_id}`, {order, category_id}).then(response => {
                        //
                    });
                }
            },

            endEditing(task) {
                this.editingTask = null

                axios.put(`/api/task/${task.id}`, {name: task.name}).then(response => {
                    //
                })
            },

            editTask(task){
                this.editingTask = task
            },

            deleteTask(taskId) {
                // delete task here via Axios request.
                axios.delete(`/api/task/${taskId}`).then(response => {
                    //
                    this.categories[taskId].tasks.push(response.data.data)
                });
            }
        },

        mounted(){
            let token = localStorage.getItem('userToken')

            axios.defaults.headers.common['Content-Type'] = 'application/json'
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + token

            axios.get('/api/category').then(response => {
                response.data.forEach((data) => {
                    this.categories.push({
                        id : data.id,
                        name : data.name,
                        tasks : []
                    })
                })
                this.loadTasks()
            })
        },
        computed: {
            dragOptions () {
              return  {
                animation: 1,
                group: 'description',
                ghostClass: 'ghost'
              };
            },
        },
        beforeRouteEnter (to, from, next) { 
            if ( ! localStorage.getItem('userToken')) {
                return next('login')
            }

            next()
        }
}
</script>