<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="/projects/create" class="btn btn-danger pull-right"> Create project </a>
                    </div>
                    <div class="card-body p-0">
                      <table class="table table-striped">
                        <thead>
                            <tr class="bg-info text-uppercase">
                            <th>#ID</th>
                            <th>Project Name</th>
                            <th>Key</th>
                            <th>Url</th>
                            <th>Created By</th>
                            <th>Updated By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th colspan='2'>Actions</th>
                          </tr>
                          <tr>
                            <td></td>
                            <td><input class="form-control" type='text' v-model="projectname" @keyup="fetchDetails(projectname, 'projectname');"></td>
                            <td><input class="form-control" type='text' v-model="key" @keyup="fetchDetails(key, 'key');"></td>
                            <td><input class="form-control" type='text' v-model="url" @keyup="fetchDetails(url, 'url');"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="item in this.paginatedDetails">
                            <td>{{ item.id }}</td>
                            <td>{{ item.name }}</td>
                            <td>{{ item.key }}</td>
                            <td><a :href="item.url"> {{ item.url }} </a></td>
                            <td>{{ userNames[item.created_by] }}</td>
                            <td>{{ userNames[item.updated_by] }}</td>
                            <td>{{ item.created_at }}</td>
                            <td>{{ item.updated_at }}</td>
                            <td><a class="btn btn-link" :href="'/projects/' + item.id"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            <td><a class="btn btn-link" :href="'/projects/' + item.id + '/edit'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
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
    props: ['prop_projects', 'prop_options'],
    data () {
      return {
        projectname: null,
        key: null,
        url: null,
        paginatedDetails: [],
        userNames: [],
        searchArr: {},
        totalPages: null,
      }
    },
    created() {
      this.setDefault();
    },    
    methods: {
      setDefault() {        
        this.paginatedDetails = this.prop_projects['data'];
        this.userNames = this.prop_options.user_names;
        this.totalPages = this.prop_projects['last_page'];        
      },
      clickCallback(pageNum) {
        this.searchArr['projectname'] = this.projectname;
        this.searchArr['key'] = this.key;
        this.searchArr['url'] = this.url;
        this.searchArr['page'] = pageNum;
        axios.get('/projects', { params:  this.searchArr  } ).then(response => {
            this.paginatedDetails = response.data['data'];
        });
      },
      fetchDetails(val,type){
        this.searchArr['projectname'] = this.projectname;
        this.searchArr['key'] = this.key;
        this.searchArr['url'] = this.url;        

        axios.get('/projects', { params:  this.searchArr  } ).then(response => {
            this.paginatedDetails = response.data['data'];
            this.totalPages = response.data['last_page'];
        });
      }
    }
  }    
</script>
