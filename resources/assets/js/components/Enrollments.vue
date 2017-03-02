<template>
    Main content
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Afegir Tasca</h3>
            </div>
            <div class="box-body">

                <div class="input-group">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <span class="form-label">Device Name</span>
                            <input type="text" class="form-control" name="device_name" placeholder="Device Name"
                                   v-model="device">
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <span class="form-label">Enrollment Name</span>
                            <input type="text" class="form-control" name="enrollment_name" placeholder="Enrollment Name"
                                   v-model="name">
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                            <span class="form-label">New Value</span>
                            <input type="text" class="form-control" name="new_value" placeholder="New Value"
                                   v-model="value">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <span class="form-label">Date Start</span>
                            <input type="text" class="form-control" name="date_str" placeholder="Date Start"
                                   v-model="date_start">
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <span class="form-label">Date End</span>
                            <input type="text" class="form-control" name="date_end" placeholder="Date End"
                                   v-model="date_end">
                        </div>
                    </div>

                    <button class="btn center-block btn-primary"
                            @click="addEnrollment">Create Enrollment</button>

                </div>

            </div>
        </div>

        <!-- /.box -->

        <div class="row">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Tasques</h3>
                </div>
                <div class="box-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <div class="box-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="width: 10px">#</th>
                                    <th class="col-lg-2 col-md-2 col-sm-12 col-xs-12">Device Name</th>
                                    <th class="col-lg-2 col-md-2 col-sm-12 col-xs-12">Enrollment Name</th>
                                    <th class="col-lg-2 col-md-2 col-sm-12 col-xs-12">Value</th>
                                    <th class="col-lg-2 col-md-2 col-sm-12 col-xs-12">Date Start</th>
                                    <th class="col-lg-2 col-md-2 col-sm-12 col-xs-12">Date End</th>
                                    <th class="col-lg-2 col-md-2 col-sm-12 col-xs-12">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <enrollment v-for="(enrollment, index) in enrollments"
                                        v-bind:enrollment="enrollment"
                                        v-bind:index="index"
                                        v-bind:from="from"
                                        @enrollment-deleted="deleteEnrollment">
                                </enrollment>
                                </tbody>
                            </table>
                        </div>
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
    </section>
    /.content
</template>
<style>
    .form-label{
        font-weight: bold;
    }
</style>
<script>
    import Pagination from './Pagination.vue'
    import Enrollment from './Enrollment.vue'
    export default {
        components: {Pagination, Enrollment},
        data () {
            return {
                uri: '/api/v1/enrollment',
                editing: false,
                enrollments: [],
                visibility: 'all',// 'active' 'completed'
                device: '',
                name: '',
                value: '',
                date_start: '',
                date_end: '',
                perPage: 5,
                from: 0,
                to: 0,
                total: 0,
                page: 1
            }
        },
        computed: {
//            filteredEnrollments: function () {
//                var filters = {
//                    all: function (enrollments) {
//                        return enrollments;
//                    },
//                    active: function (enrollments) {
//                        return enrollments.filter(function (enrollment) {
//                            return !enrollment.done;
//                        });
//                    },
//                    completed: function (enrollments) {
//                        return enrollments.filter(function (enrollment) {
//                            return enrollment.done;
//                        });
//                    }
//                }
//                return filters[this.visibility](this.enrollments);
//            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            pageChanged: function (pageNum) {
                this.page = pageNum;
                this.fetchPage(pageNum);
            },
            addEnrollment: function () {
                var device = this.device && this.device.trim();
                var name = this.name && this.name.trim();
                var value = this.value && this.value.trim();
                var date_start = this.date_start && this.date_start.trim();
                var date_end = this.date_end && this.date_end.trim();
                if (!value) {
                    return;
                }
                var enrollment = {
                    device: device,
                    name: name,
                    value: value,
                    date_start: date_start,
                    date_end: date_end
                };
                //this.filteredEnrollments.push(enrollment);
                this.device = '';
                this.name = '';
                this.value = '';
                this.date_start = '';
                this.date_end = '';
                this.addEnrollmentApi(enrollment);
                this.fetchPage(this.page);
            },
            setVisibility: function (visibility) {
                this.visibility = visibility;
            },
            reverseMessage: function () {
                this.message = this.message.split('').reverse().join('');
            },
            fetchData: function () {
                return this.fetchPage(1);
            },
            addEnrollmentApi: function (enrollment) {
                axios.post(this.uri, {
                    device: enrollment.device,
                    name: enrollment.name,
                    value: enrollment.value,
                    date_start: enrollment.date_start,
                    date_end: enrollment.date_end
                }).then((response) => {
                    console.log(response);
                }, (response) => {
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            fetchPage: function (page) {
                axios.get(this.uri + '?page=' + page).then((response) => {
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
            deleteEnrollment: function (index, id) {
                var out = this;
                sweetAlert({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function () {
                    sweetAlert(
                        'Deleted!',
                        'Your enrollment has been deleted.',
                        'success'
                    )
                    out.deleteEnrollmentApi(id);
                    out.fetchPage(out.page);
                })
            },
            deleteEnrollmentApi: function (id) {
                axios.delete(this.uri + '/' + id).then((response) => {
                    console.log(response);
                }, (response) => {
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            }
        }
    }
</script>
