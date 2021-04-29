<template>
    <div class="card card-default">
        <form id="form_task">
            <div class="card-footer">
              <button type="button" class="btn btn-danger float-right" @click="edit">Edit</button>
              <a href="/tasks" type="btn btn-link" class="btn btn-link float-right">Cancel</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Name<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-md-6">
                                <span>{{ task.name }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Key<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-md-6">
                                <span>{{ task.key }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">URL</label>
                            </div>
                            <div class="col-md-6">
                                <span>{{ task.url }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Project Lead</label>
                            </div>
                            <div class="col-md-6">
                                <span v-if= userOptions[task.lead_id]>{{ userOptions[task.lead_id] }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Project Teammates</label>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group">
                                  <li class="list-group-item border-0" v-for="assignee in task.teammates">{{ userOptions[assignee] }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['prop_task', 'prop_user_options'],
        data () {
            return {
                task: {},
                userOptions: []
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
                this.task = this.prop_task;
                this.userOptions = this.prop_user_options;
            },
            edit() {
                window.location.href = '/tasks/' + this.task.id + '/edit';
            }
        }
    }
</script>