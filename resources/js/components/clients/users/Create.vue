<template>
    <div class="card card-default">
        <form id="form_user">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Username<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-md-6">
                                <input v-validate="'required|alpha_spaces'" v-model="user.name" class="form-control" name="name" dusk="name" placeholder="Name">
                                <ul class="list-group">
                                  <li class="list-group-item text-danger border-0" v-for="error in errors.collect('name')">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Email<i class="text-danger">*</i></label>
                            </div>
                            <div class="col-md-6">
                                <input v-validate.continues="'required|email|max:255'" v-model="user.email" class="form-control" name="email" dusk="key" placeholder="email">
                                <ul class="list-group">
                                  <li class="list-group-item text-danger border-0" v-for="error in errors.collect('email')">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Admin</label>
                            </div>
                            <div class="col-md-6">
                                <input type="checkbox" v-model="user.is_admin" dusk="is_admin">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Password</label>
                            </div>
                            <div class="col-md-6">
                                <input type="password" v-validate.continues="'required|max:255'" v-model="user.password" class="form-control" name="password" dusk="password" placeholder="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Confirm Password</label>
                            </div>
                            <div class="col-md-6">
                                <input type="password" v-validate.continues="'required|max:255'" v-model="user.password_confirmation" class="form-control" name="password_confirmation" dusk="password_confirmation" placeholder="password confirmation">
                                <ul class="list-group">
                                  <li class="list-group-item text-danger border-0" v-for="error in errors.collect('password')">{{ error }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-info float-right" @click="submit">Save</button>
              <a href="/users" type="btn btn-link" class="btn btn-link float-right">Cancel</a>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['prop_user', 'prop_user_options'],
        data () {
            return {
                user: {},
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
                this.user = (Array.isArray(this.prop_user)) ? {} : this.prop_user;
                this.userOptions = this.prop_user_options;
            },
            submit() {
                if(this.errors.items.length > 0) {
                    this.$toasted.error("<b>*Error: Invalid form details.</b>", {position: 'bottom-right'});
                    return false;
                }
                
                var intId = (this.user.id) ? this.user.id : '';
                var strMethod = (this.user.id) ? 'put' : 'post';
                
                axios({
                    method: strMethod,
                    url: '/users/' + intId,
                    data: this.user
                }).then(response => {
                console.log(response.data);
                    if(response.data.message) {
                        this.$toasted.success("<b>Done : "+response.data.message+"</b>", {position: 'bottom-right'});
                        window.location.href = "/users";
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