<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="" class="btn btn-default pull-right"><i class="fa fa-filter" aria-hidden="true"></i></a>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-info text-uppercase">
                                    <th>#ID</th>
                                    <th>Subject</th>
                                    <th>To Email</th>
                                    <th>From Email</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th colspan='1'>Actions</th>
                                </tr>
                                <tr>
                                    <td><input class="form-control" type='text' v-model="id" @keyup="fetchDetails(id, 'id');"></td>
                                    <td><input class="form-control" type='text' v-model="subject" @keyup="fetchDetails(subject, 'subject');"></td>
                                    <td><input class="form-control" type='text' v-model="to_email" @keyup="fetchDetails(to_email, 'to_email');"></td>
                                    <td><input class="form-control" type='text' v-model="from_email" @keyup="fetchDetails(from_email, 'from_email');"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in this.paginatedDetails">
                                <td>{{ item.id }}</td>
                                <td>{{ item.subject }}</td>
                                <td>{{ item.to_email }}</td>
                                <td>{{ item.from_email }}</td>
                                <td><p :class="'text-' + item.status_type.icon">{{ item.status }} </p></td>
                                <td>{{ item.created_at }}</td>
                                <td>{{ item.updated_at }}</td>
                                <td><a class="btn btn-link" :href="'/emails/' + item.id"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <paginate
                            :page-count="this.totalPages"
                            :click-handler="clickCallback"
                            :prev-text="'Prev'"
                            :next-text="'Next'"
                            :container-class="'pagination'"
                            :page-class="'page-item'"
                            :page-link-class="'page-link'"
                            :prev-class="'page-item'"
                            :prev-link-class="'page-link'"
                            :next-class="'page-item'"
                            :next-link-class="'page-link'">
                        </paginate>
                  </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['prop_emails'],
        data () {
            return {
                paginatedDetails: [],
                id: null,
                subject: null,
                to_email: null,
                from_email: null,
                searchArr: {},
                totalPages: null,
            }
        },
        created() {
            this.setDefault();
        },
        methods: {
            setDefault() {
                this.paginatedDetails = this.prop_emails['data'];
                this.totalPages = this.prop_emails['last_page'];
            },
            clickCallback(pageNum) {
                this.searchArr['id'] = this.id;
                this.searchArr['subject'] = this.subject;
                this.searchArr['to_email'] = this.to_email;
                this.searchArr['from_email'] = this.from_email;
                this.searchArr['page'] = pageNum;
                axios.get('/emails', { params:  this.searchArr  } ).then(response => {
                    this.paginatedDetails = response.data['data'];
                });
            },
            fetchDetails(val,type){
                this.searchArr['id'] = this.id;
                this.searchArr['subject'] = this.subject;
                this.searchArr['to_email'] = this.to_email;
                this.searchArr['from_email'] = this.from_email;
                axios.get('/emails', { params:  this.searchArr  } ).then(response => {
                    this.paginatedDetails = response.data['data'];
                    this.totalPages = response.data['last_page'];
                });
              }
        }
    }
</script>
