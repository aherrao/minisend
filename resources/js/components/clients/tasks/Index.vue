<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="/tasks/create" class="btn btn-danger pull-right"> Create task </a>
                        <a href="" class="btn btn-default pull-right"><i class="fa fa-filter" aria-hidden="true"></i></a>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-info text-uppercase">
                                    <th>#ID</th>
                                    <th>Title</th>
                                    <th>Task Type</th>
                                    <th>Sprint</th>
                                    <th>Created By</th>
                                    <th>Updated By</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th colspan='2'>Actions</th>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><input class="form-control" type='text' v-model="title" @keyup="fetchDetails(title, 'title');"></td>
                                    <td></td>
                                    <td></td>
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
                                <td>{{ taskTypeNames[item.task_type_id] }}</td>
                                <td>{{ sprintNames[item.sprint_id] }}</td>
                                <td>{{ userNames[item.created_by] }}</td>
                                <td>{{ userNames[item.updated_by] }}</td>
                                <td>{{ item.created_at }}</td>
                                <td>{{ item.updated_at }}</td>
                                <td><a class="btn btn-link" :href="'/tasks/' + item.id"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                <td><a class="btn btn-link" :href="'/tasks/' + item.id + '/edit'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
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
        props: ['prop_paginate_tasks', 'prop_options'],
        data () {
            return {
                paginatedDetails: [],
                sprintNames: [],
                userNames: [],
                taskTypeNames:[],
                title: null,
                tasktype: null,
                sprint: null,                
                searchArr: {},
                totalPages: null,
            }
        },
        created() {
            this.setDefault();
        },
        methods: {
            setDefault() {
                this.paginatedDetails = this.prop_paginate_tasks['data'];
                this.sprintNames = this.prop_options.sprint_names;
                this.userNames = this.prop_options.user_names;
                this.taskTypeNames = this.prop_options.task_type_names;
                this.totalPages = this.prop_paginate_tasks['last_page'];        
                
            },
            clickCallback(pageNum) {
                this.searchArr['title'] = this.title;
                this.searchArr['tasktype'] = this.tasktype;
                this.searchArr['sprint'] = this.sprint;
                this.searchArr['page'] = pageNum;
                axios.get('/tasks', { params:  this.searchArr  } ).then(response => {
                    this.paginatedDetails = response.data['data'];
                });
            },
            fetchDetails(val,type){
                this.searchArr['title'] = this.title;
                this.searchArr['tasktype'] = this.tasktype;
                this.searchArr['sprint'] = this.sprint;        

                axios.get('/tasks', { params:  this.searchArr  } ).then(response => {
                    this.paginatedDetails = response.data['data'];
                    this.totalPages = response.data['last_page'];
                });
              }
        }
    }
</script>
