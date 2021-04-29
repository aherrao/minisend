<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="/users/create" class="btn btn-danger pull-right"> Create User </a>
                        <a href="" class="btn btn-default pull-right"><i class="fa fa-filter" aria-hidden="true"></i></a>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-info text-uppercase">
                                    <th>#ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Is Admin</th>                                    
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th colspan='2'>Actions</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input class="form-control" type='text' v-model="name" @keyup="fetchDetails(name, 'name');"></td>
                                    <td><input class="form-control" type='text' v-model="email" @keyup="fetchDetails(email, 'email');"></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in this.paginatedDetails">
                                <td>{{ item.id }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.email }}</td>
                                <td>{{ is_admin[item.is_admin] }}</td>                                
                                <td>{{ item.created_at }}</td>
                                <td>{{ item.updated_at }}</td>
                                <td><a class="btn btn-link" :href="'/users/' + item.id"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                <td><a class="btn btn-link" :href="'/users/' + item.id + '/edit'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
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
        props: ['prop_users', 'prop_options'],
        data () {
            return {
                paginatedDetails: [],
                is_admin:[],
                name: null,
                email: null,
                searchArr: {},
                totalPages: null,
            }
        },
        created() {
            this.setDefault();
        },
        methods: {
            setDefault() {                
                this.paginatedDetails = this.prop_users['data'];
                this.is_admin = this.prop_options.is_admin;
                this.totalPages = this.prop_users['last_page'];                        
            },
            clickCallback(pageNum) {
                this.searchArr['name'] = this.name;
                this.searchArr['email'] = this.email;
                this.searchArr['page'] = pageNum;
                axios.get('/users', { params:  this.searchArr  } ).then(response => {
                    this.paginatedDetails = response.data['data'];
                });
            },
            fetchDetails(val,type){
                this.searchArr['name'] = this.name;
                this.searchArr['email'] = this.email;
                axios.get('/users', { params:  this.searchArr  } ).then(response => {
                    this.paginatedDetails = response.data['data'];
                    this.totalPages = response.data['last_page'];
                });
              }
        }
    }
</script>
