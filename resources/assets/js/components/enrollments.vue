<style>
</style>
<template>
    <div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add enrollment</h3>
            </div>
            <form role="form" action="#">
                <div class="box-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="name" class="form-control" id="name" placeholder="Enter enrollment name"
                               v-model="newEnrollment"
                               @keyup.enter="addEnrollment">
                    </div>
                </div>
            </form>
        </div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Enrollments</h3>
                <div class="btn-group">
                    <button type="button" class="btn btn-default">{{visibility}}</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" @click="setVisibility('all')">All</a></li>
                        <li><a href="#" @click="setVisibility('active')">Active</a></li>
                        <li><a href="#" @click="setVisibility('completed')">Completed</a></li>
                    </ul>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Validated</th>
                        <th>Enrollment</th>
                        <th>Finished</th>
                        <th>Study Id</th>
                        <th>Course Id</th>
                        <th>Classroom Id</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <enrollment v-for="(enrollment, index) in filteredEnrollments"
                          v-bind:enrollment="enrollment"
                          v-bind:index="index"
                          v-bind:from="from"
                          @enrollment-deleted="deleteEnrollment">
                    </enrollment>
                    </tbody>
                </table>
            </div>
            <div class="box-footer clearfix">
                <span class="pull-left">Showing {{ from }} to {{ to }} of {{ total }} entries </span>

                <pagination
                        :current-page="page"
                        :total-items="total"
                        @page-changed="pageChanged">
                </pagination>


            </div>
        </div>
    </div>
</template>
<script>
    import Pagination from './pagination.vue'

    import Enrollment from './enrollment.vue'

    export default {
        components : {Pagination,Enrollment},
        data() {
            return {
                uri: '/api/v1/enrollments',
                editing :false,
                enrollments: [
                ],
                visibility: 'all',// 'active' 'completed'
                newEnrollment: '',
                perPage: 5,
                from: 0,
                to: 0,
                total: 0,
                page: 1
            }
        },
        computed: {
            filteredEnrollments: function() {
                var filters = {
                    all:function(enrollments){
                        return enrollments;
                    },
                    active:function(enrollments){
                        return enrollments.filter(function(enrollment){
                            return !enrollment.done;
                        });
                    },
                    completed:function(enrollments){
                        return enrollments.filter(function(enrollment){
                            return enrollment.done;
                        });
                    }
                }
                return filters[this.visibility](this.enrollments);

            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            pageChanged: function(pageNum) {
                this.page=pageNum;
                this.fetchPage(pageNum);
            },
            addEnrollment: function() {
                var value = this.newEnrollment && this.newEnrollment.trim();
                if (!value) {
                    return;
                }
                var enrollment = {
                    name: value,
                    finished: 1,
                    study_id: false,
                    course_id: 1,
                    classroom_id: 1
                };
                this.filteredEnrollments.push(enrollment);
                this.newEnrollment = '';
                this.addEnrollmentApi(enrollment);
                this.fetchPage(this.page);
            },
            setVisibility: function(visibility) {
                this.visibility=visibility;
            },
            fetchData: function() {
                return this.fetchPage(1);
            },
            addEnrollmentApi: function(enrollment) {
                axios.post(this.uri, {
                    name: enrollment.name,
                    priority: enrollment.finished,
                    study_id: enrollment.study_id,
                    course_id: enrollment.course_id,
                    classroom_id: enrollment.classroom_id
                }).then((response) => {
                    console.log(response);
                }, (response) => {
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            fetchPage: function(page) {
                axios.get(this.uri+'?page=' + page).then((response) => {
                    this.enrollments = response.data.data;
                    this.perPage = response.data.per_page;
                    this.to = response.data.to;
                    this.from = response.data.from;
                    this.total = response.data.total;
                }, (response) => {
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            deleteEnrollment: function(index,id) {
                var out = this;
                swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this enrollment!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!"
                    }).then(function () {
                    swal(
                        "Deleted!", "Your enrollment has been deleted.", "success"
                    )

                    out.deleteEnrollmentApi(id);
                    out.fetchPage(out.page);
                    });
            },
            deleteEnrollmentApi: function(id) {
                axios.delete(this.uri + '/' + id).then((response) => {
                    console.log(response);
                }, (response) => {
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
        }

    }
</script>