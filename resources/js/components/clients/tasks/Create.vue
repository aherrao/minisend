<template>
    <div>
    <div class="card card-default">
        <form id="form_task">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group row border-5">
                            <div class="col-md-1">
                                <label class="pull-right text-sm">Title<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-md-11">
                                <input v-validate="'required|alpha_spaces_num'" v-model="task.name" class="form-control" name="name" dusk="name" placeholder="Name">
                                <ul class="list-group">
                                  <li class="list-group-item text-danger border-0" v-for="error in errors.collect('name')">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="pull-right text-sm">Type<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-md-9">
                                        <treeselect
                                            v-model="task.task_type_id"
                                            v-validate="'required'"
                                            :name="'task_type_id'"
                                            :options="taskTypeOptions"/>
                                        <ul class="list-group">
                                          <li class="list-group-item text-danger border-0" v-for="error in errors.collect('task_type_id')">{{ error }}</li>
                                        </ul>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="pull-right text-sm">Sprint<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-md-9">
                                        <treeselect
                                            v-model="task.sprint_id"
                                            v-validate="'required'"
                                            :name="'sprint_id'"
                                            :options="sprintOptions"/>
                                        <ul class="list-group">
                                          <li class="list-group-item text-danger border-0" v-for="error in errors.collect('sprint_id')">{{ error }}</li>
                                        </ul>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="pull-right text-sm">Project</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-1">
                                <label class="pull-right text-sm">Description</label>
                            </div>
                            <div class="col-md-11">
                                <VueTrix v-model="task.description" placeholder="enter your content..."/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="pull-right text-sm">Status<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-md-9">
                                        <treeselect
                                            v-model="task.task_status_type_id"
                                            v-validate="'required'"
                                            :name="'task_status_type_id'"
                                            :options="taskStatusOptions"/>
                                        <ul class="list-group">
                                          <li class="list-group-item text-danger border-0" v-for="error in errors.collect('task_status_type_id')">{{ error }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="pull-right text-sm">Priority<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-md-9">
                                        <treeselect
                                            v-model="task.task_priority_type_id"
                                            v-validate="'required'"
                                            :name="'task_priority_type_id'"
                                            :options="taskPriorityOptions"/>
                                        <ul class="list-group">
                                          <li class="list-group-item text-danger border-0" v-for="error in errors.collect('task_priority_type_id')">{{ error }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="pull-right text-sm">Parent Task Id</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" v-model="task.parent_task_id" placeholder="any task id">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="pull-right text-sm">Assignee<i class="text-danger">*</i></label>
                                    </div>
                                    <div class="col-md-9">
                                        <treeselect
                                            v-model="task.assignee_id"
                                            v-validate="'required'"
                                            :name="'assignee_id'"
                                            :options="userOptions"/>
                                        <ul class="list-group">
                                          <li class="list-group-item text-danger border-0" v-for="error in errors.collect('assignee_id')">{{ error }}</li>
                                        </ul>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="pull-right text-sm">Developer</label>
                                    </div>
                                    <div class="col-md-9">
                                        <treeselect
                                            v-model="task.developer_id"
                                            :options="userOptions"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="pull-right text-sm">QA</label>
                                    </div>
                                    <div class="col-md-9">
                                        <treeselect
                                            v-model="task.qa_id"
                                            :options="userOptions"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="pull-right text-sm">Story Points</label>
                                    </div>
                                    <div class="col-md-9">
                                        <treeselect
                                            v-model="task.story_points"
                                            :options="storyPointOptions"/> 
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="putaskTypell-right text-sm">Estimattion</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input v-model="task.estimated_time" class="form-control" name="estimated_time" dusk="estimated_time" placeholder="00:00:00">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label class="pull-right text-sm">Spend Time</label>
                                    </div>
                                    <div class="col-md-9">
                                       <input v-model="task.spend_time" class="form-control" name="spend_time" dusk="spend_time" placeholder="00:00:00">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="pull-right">Assignee</label>
                            </div>
                            <div class="col-md-6">
                                <a v-if="task.assignee_id > 0" :href="'/profiles/'+task.assignee_id">{{ userNames[task.assignee_id] }}</a>
                               <span v-else>-</span>
                            </div>
                         </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="pull-right">Task Id</label>
                            </div>
                            <div class="col-md-6">
                                <a v-if="task.id > 0" :href="'/tasks/'+task.id">{{ '#'+task.id }}</a>
                                <span v-else>New</span>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-md-6">
                                <label class="pull-right">Reporter</label>
                            </div>
                            <div class="col-md-6">
                                <a v-if="task.created_by">{{ userNames[task.created_by] }}</a>
                                <span v-else>You</span>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-md-6">
                                <label class="pull-right">Reported</label>
                            </div>
                            <div class="col-md-6">
                                <a v-if="task.created_at">{{ task.created_at }}</a>
                                <span v-else>Now</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="pull-right">Project</label>
                            </div>
                            <div class="col-md-6">
                                <a v-if="task.sprint_id">{{ task.project_id }}</a>
                                <span v-else>-</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="pull-right">Sprint</label>
                            </div>
                            <div class="col-md-6">
                                <a v-if="task.sprint_id" :href="'/sprints/'+task.sprint_id">{{ sprintNames[task.sprint_id] }}</a>
                                <span v-else>-</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="pull-right">Watcher</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <treeselect
                                    v-model="task.watchers"
                                    :multiple="true"
                                    :options="userOptions"/> 
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-info float-right" @click="submit">Save</button>
              <a href="/tasks" type="btn btn-link" class="btn btn-link float-right">Cancel</a>
            </div>
        </form>
        <div class="card card-default" v-if="task.id">
            <div class="card-body">
                <h3>Task Notes</h3>
                <div class="row">
                    <div class="col-md-12">
                        <VueTrix v-model="task.note" placeholder="enter your note content..."/>
                    </div>
                </div>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-danger float-right" @click="addNote">Add Note</button>
              <a href="/tasks" type="btn btn-link" class="btn btn-link float-right">Clear</a>
            </div>
            <div class="card-body">
                <div class="tab-pane" id="timeline">
                    <ul class="timeline timeline-inverse">
                      <li class="time-label">
                        <span class="bg-danger"> {{ task.created_at}}</span>
                      </li>
                      <li v-for="note in task.task_notes">
                        <i class="fa fa-envelope bg-primary"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> {{ note.created_at}}</span>

                            <h3 class="timeline-header">
                                <a href="javascript:void(0);">{{ userNames[note.created_by] }}</a> added a note
                            </h3>
                
                          <div class="timeline-body" v-html="note.note"></div>
                        </div>
                      </li>
                    </ul>
                  </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    export default {
        props: ['prop_task', 'prop_options'],
        data () {
            return {
                task: {},
                value:[],
                sprintNames: [],
                sprintOptions: [],
                userNames: [],
                userOptions: [],
                storyPointOptions: [],
                taskTypeOptions: [],
                taskStatusOptions: [],
                taskPriorityOptions: [],
            }
        },
        computed: {
          errors: {
            get: function () {
              return this.errors
            },
            set: function () {
                // set
            }
          }
        },
        created() {
            this.setDefault();
        },
        methods: {
            setDefault() {
                this.task = (Array.isArray(this.prop_task)) ? {} : this.prop_task;
                this.sprintOptions = this.prop_options.sprints;
                this.sprintNames = this.prop_options.sprint_names;
                this.userNames = this.prop_options.user_names;
                this.userOptions = this.prop_options.users;
                this.storyPointOptions = this.prop_options.story_points;
                this.taskTypeOptions = this.prop_options.task_types;
                this.taskStatusOptions = this.prop_options.status_types;
                this.taskPriorityOptions = this.prop_options.priority_types;
            },
            submit() {
                if(this.errors.items.length > 0) {
                    this.$toasted.error("<b>*Error: Invalid form details.</b>", {position: 'bottom-right'});
                    return false;
                }
                
                var intId = (this.task.id) ? this.task.id : '';
                var strMethod = (this.task.id) ? 'put' : 'post';
                
                axios({
                    method: strMethod,
                    url: '/tasks/' + intId,
                    data: this.task
                }).then(response => {
                    if(response.data.message) {
                        this.$toasted.success("<b>Done : "+response.data.message+"</b>", {position: 'bottom-right'});
                        window.location.href = "/tasks";
                    }
                }).catch(error => {
                    if (error.response.status === 422) {
                        for (const index in error.response.data.errors){
                            this.errors.items.push({vmId:this.errors.vmId, field: index, msg:error.response.data.errors[index][0]});
                        }
                        this.$toasted.error("<b>*Error: "+error.response.data.message+"</b>", {position: 'bottom-right'});
                    }
                });
            },
            addNote() {
                if(!this.task.note) {
                    this.$toasted.error("<b>*Error: Please fill note.</b>", {position: 'bottom-right'});
                    return false;
                }
                axios.post('/tasks/add-note/' + this.task.id, {note:this.task.note}).then(response => {
                    this.task.task_notes = response.data;
                    this.$toasted.success("<b>Done : Note added successfully</b>", {position: 'bottom-right'});
                })
            }
        }
    }
</script>