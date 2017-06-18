<style>
</style>
<template>
    <tr>
        <!--<td>{{ index + from }}</td>-->
        <td>
                <span v-if="enrollment.validated == '1'">
                    <input type="checkbox" checked="true" class="flat-red" @click="setValidated('0')">
                </span>
            <span v-else>
                    <input type="checkbox" class="flat-red"  @click="setValidated('1')">
                </span>
        </td>
        <td>
            <span v-if="!editingName"  @dblclick="editName" >{{enrollment.name}}</span>
            <span v-else @keyup.enter="editName">
                                <input class="form-control" v-focus v-model="enrollment.name" size="50" @keyup.enter="saveName" @keyup.esc="unneditName"></span>
            <i class="fa fa-edit" style="font-size:20px;color:blue;" aria-hidden="true" v-show="!editingName" @click="editName"/>
            <i class="fa fa-check" style="font-size:20px;color:green;" aria-hidden="true" v-show="editingName" @click="saveName"/>
            <i class="fa fa-close" style="font-size:20px;color:red;" aria-hidden="true" v-show="editingName" @click="unneditName"/>
        </td>
        <td>
            <span v-if="!editingFinished"  @dblclick="editFinished" >{{enrollment.finished}}</span>
            <span v-else @keyup.enter="editFinished">
                                <input class="form-control" v-focus v-model="enrollment.finished" size="50" @keyup.enter="saveFinished" @keyup.esc="unneditFinished"></span>
            <i class="fa fa-edit" style="font-size:20px;color:blue;" aria-hidden="true" v-show="!editingFinished" @click="editFinished"/>
            <i class="fa fa-check" style="font-size:20px;color:green;" aria-hidden="true" v-show="editingFinished" @click="saveFinished"/>
            <i class="fa fa-close" style="font-size:20px;color:red;" aria-hidden="true" v-show="editingFinished" @click="unneditFinished"/>
        </td>
        <td>
            <span v-if="!editingStudy"  @dblclick="editStudy" >{{enrollment.study_id}}</span>
            <span v-else @keyup.enter="editStudy">
                                <input class="form-control" v-focus v-model="enrollment.study_id" size="50" @keyup.enter="saveStudy" @keyup.esc="unneditStudy"></span>
            <i class="fa fa-edit" style="font-size:20px;color:blue;" aria-hidden="true" v-show="!editingStudy" @click="editStudy"/>
            <i class="fa fa-check" style="font-size:20px;color:green;" aria-hidden="true" v-show="editingStudy" @click="saveStudy"/>
            <i class="fa fa-close" style="font-size:20px;color:red;" aria-hidden="true" v-show="editingStudy" @click="unneditStudy"/>
        </td>
        <td>
            <span v-if="!editingCourse"  @dblclick="editCourse" >{{enrollment.course_id}}</span>
            <span v-else @keyup.enter="editCourse">
                                <input class="form-control" v-focus v-model="enrollment.course_id" size="50" @keyup.enter="saveName" @keyup.esc="unneditName"></span>
            <i class="fa fa-edit" style="font-size:20px;color:blue;" aria-hidden="true" v-show="!editingName" @click="editName"/>
            <i class="fa fa-check" style="font-size:20px;color:green;" aria-hidden="true" v-show="editingName" @click="saveName"/>
            <i class="fa fa-close" style="font-size:20px;color:red;" aria-hidden="true" v-show="editingName" @click="unneditName"/>
        </td>
        <td>
            <span v-if="!editingClassroom"  @dblclick="editClassroom" >{{enrollment.classroom_id}}</span>
            <span v-else @keyup.enter="editClassroom">
                                <input class="form-control" v-focus v-model="enrollment.classroom_id" size="50" @keyup.enter="saveClassroom" @keyup.esc="unneditClassroom"></span>
            <i class="fa fa-edit" style="font-size:20px;color:blue;" aria-hidden="true" v-show="!editingClassroom" @click="editClassroom"/>
            <i class="fa fa-check" style="font-size:20px;color:green;" aria-hidden="true" v-show="editingClassroom" @click="saveClassroom"/>
            <i class="fa fa-close" style="font-size:20px;color:red;" aria-hidden="true" v-show="editingClassroom" @click="unneditClassroom"/>
        </td>
        <td>
            <span class="btn btn-md btn-danger"  @click="deleteEnrollment(index,enrollment.id)">
                <i class='fa fa-fw fa-trash'/>
            </span>
            <span class="btn btn-md btn-info" @click="editEnrollment(index,enrollment.id)">
                <i class='fa fa-fw fa-edit'/>
            </span>
        </td>
    </tr>
</template>
<script>

    export default {
        props: ['enrollment','index','from'],

        data() {
            return {
                editing: false,
                editingValidated: false,
                editingName: false,
                editingFinished: false,
                editingClassroom: false,
                editingCourse: false,
                editingStudy: false,
                uri: 'api/v1/enrollments',
                n: this.enrollment.priority,
            }
        },
        created() {
            //console.log('Component enrollment created.');
        },
        methods: {
            editEnrollment: function() {
                return this.editingName = true;
            },
            //Name methods:
            editName: function() {
                return this.editingName = true;
            },
            unneditName: function() {
                return this.editingName = false;
            },
            saveName: function() {
                this.editEnrollmentApi();
                return this.editingName = false;
            },
            //Name methods:
            editFinished: function() {
                return this.editingFinished = true;
            },
            unneditFinished: function() {
                return this.editingFinished = false;
            },
            saveFinished: function() {
                this.editEnrollmentApi();
                return this.editingFinished = false;
            },
            //Study methods:
            editStudy: function() {
                return this.editingStudy = true;
            },
            unneditStudy: function() {
                return this.editingStudy = false;
            },
            saveStudy: function() {
                this.editEnrollmentApi();
                return this.editingStudy = false;
            },
            //Course methods:
            editCourse: function() {
                return this.editingCourse = true;
            },
            unneditCourse: function() {
                return this.editingCourse = false;
            },
            saveCourse: function() {
                this.editEnrollmentApi();
                return this.editingCourse = false;
            },
            //Course methods:
            editClassroom: function() {
                return this.editingClassroom = true;
            },
            unneditClassroom: function() {
                return this.editingClassroom = false;
            },
            saveClassroom: function() {
                this.editEnrollmentApi();
                return this.editingClassroom = false;
            },
            //Validated methods:
            setValidated: function(done) {
                this.enrollment.validated=done;
                this.editEnrollmentApi();
            },
            //Fer peticions al editar.
            editEnrollmentApi: function() {
                axios.put(this.uri +'/'+this.enrollment.id,{
                    name: this.enrollment.name,
                    validated: this.enrollment.validated,
                    course_id: this.enrollment.course_id,
                    classroom_id: this.enrollment.classroom_id,
                    study_id: this.enrollment.study_id
                }).then((response) => {
                    console.log(response);
                }, (response) => {
                    sweetAlert("Oops...", "Something went wrong!", "error");
                    console.log(response);
                });
            },
            //No puc usar nom delete perquè és un keyword de javascript.
            deleteEnrollment: function(index,id) {
                console.log("Deleting enrollment");
                //Per enviarli al pare.
                this.$emit('enrollment-deleted',index,id);
            }
        },
        directives: {
            focus: {
                // directive definition
                inserted: function (el) {
                    // Focus the element
                    el.focus()
                }
            }
        }
    }
</script>

