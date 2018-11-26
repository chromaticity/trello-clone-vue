<template>
    <div class="container">
        <div class="row justify-content-center">
            <draggable element="div" class="col-md-12" v-model="categories" :options="dragOptions">
                <transition-group class="row">
                    <div class="col-md-4" v-for="element,index in categories" :key="element.id">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{element.name}}</h4>
                            </div>
                            <div class="card-body card-body-dark">
                                <draggable :options="dragOptions" element="div" @end="changeOrder" v-model="element.tasks">
                                    <transition-group :id="element.id">
                                        <div v-for="task,index in element.tasks" :key="task.category_id+','+task.order" class="transit-1" :id="task.id">
                                            <div class="small-card">
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
            </draggable>
        </div>
    </div>
</template>