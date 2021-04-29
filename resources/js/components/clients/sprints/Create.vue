<template>
    <div class="card card-default">
        <form id="form_sprint">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Project<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-md-6">
                                <treeselect
                                    v-model="sprint.project_id"
                                    :disabled="sprint.id > 0"
                                    v-validate="'required'"
                                    :name="'project_id'"
                                    :options="projectOptions"/>
                                <ul class="list-group">
                                  <li class="list-group-item text-danger border-0" v-for="error in errors.collect('project_id')">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Name<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-md-6">
                                <input v-validate="'required|alpha_spaces'" v-model="sprint.name" class="form-control" name="name" dusk="name" placeholder="Name">
                                <ul class="list-group">
                                  <li class="list-group-item text-danger border-0" v-for="error in errors.collect('name')">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Description</label>
                            </div>
                            <div class="col-md-6">
                                 <textarea v-model="sprint.description" class="form-control textarea" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Start Date</label>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <datepicker 
                                        v-model="sprint.start_date" 
                                        input-class="form-control" 
                                        placeholder="MM/DD/YYYY">
                                    </datepicker>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Release Date</label>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <datepicker v-model="sprint.release_date" input-class="form-control" placeholder="MM/DD/YYYY"></datepicker>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-info float-right" @click="submit">Save</button>
              <a href="/sprints" type="btn btn-link" class="btn btn-link float-right">Cancel</a>
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
                value:[],
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
                this.sprint = (Array.isArray(this.prop_sprint)) ? {} : this.prop_sprint;
                this.projectOptions = this.prop_project_options;
            },
            submit() {
                if(this.errors.items.length > 0) {
                    this.$toasted.error("<b>*Error: Invalid form details.</b>", {position: 'bottom-right'});
                    return false;
                }
                
                var intId = (this.sprint.id) ? this.sprint.id : '';
                var strMethod = (this.sprint.id) ? 'put' : 'post';
                
                axios({
                    method: strMethod,
                    url: '/sprints/' + intId,
                    data: this.sprint
                }).then(response => {
                    if(response.data.message) {
                        this.$toasted.success("<b>Done : "+response.data.message+"</b>", {position: 'bottom-right'});
                        window.location.href = "/sprints";
                    }
                }).catch(error => {
                    if (error.response.status === 422) {
                        for (const index in error.response.data.errors){
                            this.errors.items.push({vmId:this.errors.vmId, field: index, msg:error.response.data.errors[index][0]});
                        }
                        this.$toasted.error("<b>*Error: "+error.response.data.message+"</b>", {position: 'bottom-right'});
                    }
                });
            }
        }
    }
</script>