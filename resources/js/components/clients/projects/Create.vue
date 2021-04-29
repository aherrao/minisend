<template>
    <div class="card card-default">
        <form id="form_project">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Name<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-md-6">
                                <input v-validate="'required|alpha_spaces'" v-model="project.name" class="form-control" name="name" dusk="name" placeholder="Name">
                                <ul class="list-group">
                                  <li class="list-group-item text-danger border-0" v-for="error in errors.collect('name')">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Key<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-md-6">
                                <input v-validate.continues="'required|alpha_spaces|max:20'" v-model="project.key" class="form-control" name="key" dusk="key" placeholder="Project Identifire">
                                <ul class="list-group">
                                  <li class="list-group-item text-danger border-0" v-for="error in errors.collect('key')">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">URL</label>
                            </div>
                            <div class="col-md-6">
                                <input v-validate="'required|url'" v-model="project.url" class="form-control" name="url" dusk="url" placeholder="URL">
                                <ul class="list-group">
                                  <li class="list-group-item text-danger border-0" v-for="error in errors.collect('url')">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Project Lead</label>
                            </div>
                            <div class="col-md-6">
                                <treeselect
                                    v-model="project.lead_id"
                                    :options="userOptions"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Project Teammates</label>
                            </div>
                            <div class="col-md-6">
                                <treeselect
                                    v-model="project.teammates"
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
              <a href="/projects" type="btn btn-link" class="btn btn-link float-right">Cancel</a>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['prop_project', 'prop_user_options'],
        data () {
            return {
                project: {},
                value:[],
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
                this.project = (Array.isArray(this.prop_project)) ? {} : this.prop_project;
                this.userOptions = this.prop_user_options;
            },
            submit() {
                if(this.errors.items.length > 0) {
                    this.$toasted.error("<b>*Error: Invalid form details.</b>", {position: 'bottom-right'});
                    return false;
                }
                
                var intId = (this.project.id) ? this.project.id : '';
                var strMethod = (this.project.id) ? 'put' : 'post';
                
                axios({
                    method: strMethod,
                    url: '/projects/' + intId,
                    data: this.project
                }).then(response => {
                console.log(response.data);
                    if(response.data.message) {
                        this.$toasted.success("<b>Done : "+response.data.message+"</b>", {position: 'bottom-right'});
                        window.location.href = "/projects";
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