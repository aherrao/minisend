<template>
    <div class="card card-default">
        <form id="form_user">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">id</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ email.id }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Subject</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ email.subject }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">To Email</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ email.to_email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">From Email</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ email.from_email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Status</label>
                            </div>
                            <div class="col-md-6">
                                <p :class="'text-' + email.status_type.icon">{{ email.status }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Body</label>
                            </div>
                            <div class="col-md-6">
                                <p class="card-footer" v-html="email.body"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Attachments</label>
                            </div>
                            <div class="col-md-6">
                                <a :href="item.url" v-for="item in this.email.attachments">{{ item.name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Created At</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ email.created_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label class="pull-right">Updated At</label>
                            </div>
                            <div class="col-md-6">
                                <p>{{ email.updated_at }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <div class="card-footer">
                <a href="/emails" type="btn btn-link" class="btn btn-link float-right">Cancel</a>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['prop_email'],
        data () {
            return {
                email: {}
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
                this.email = this.prop_email;
            },
        }
    }
</script>
