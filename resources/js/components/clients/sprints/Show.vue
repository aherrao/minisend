<template>
    <div class="card card-default">
        <form id="form_sprint">
            <div class="card-footer">
              <button type="button" class="btn btn-danger float-right" @click="edit">Edit</button>
              <a href="/sprints" type="btn btn-link" class="btn btn-link float-right">Cancel</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Project</label>
                            </div>
                            <div class="col-md-6">
                                <span v-if= projectOptions[sprint.project_id]>{{ projectOptions[sprint.project_id] }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Name</label>
                            </div>
                            <div class="col-md-6">
                                <span>{{ sprint.name }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Description</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ sprint.description }}</p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Start Date</label>
                            </div>
                            <div class="col-md-6">
                                <span>{{ sprint.start_date }}</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Release Date</label>
                            </div>
                            <div class="col-md-6">
                                <span>{{ sprint.release_date }}</span>
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
        props: ['prop_sprint', 'prop_project_options'],
        data () {
            return {
                sprint: {},
                projectOptions: []
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
                this.sprint = this.prop_sprint;
                this.projectOptions = this.prop_project_options;
            },
            edit() {
                window.location.href = '/sprints/' + this.sprint.id + '/edit';
            }
        }
    }
</script>