<style>
</style>
<template>
    <tr>
        <td>{{ index + from }}</td>

        <td>
            <span v-if="!editingDevice"  @dblclick="editDevice" >{{enrollment.device}}</span>
            <span v-else @keyup.enter="editDevice">
                                <input class="form-control col-lg-2 col-md-2 col-sm-12 col-xs-12" v-focus v-model="enrollment.device" size="50" @keyup.enter="saveDevice" @keyup.esc="unneditDevice"></span>
            <i class="fa fa-edit" style="font-size:10px;color:blue;" aria-hidden="true" v-show="!editingDevice" @click="editDevice"/>
            <i class="fa fa-check" style="font-size:10px;color:green;" aria-hidden="true" v-show="editingDevice" @click="saveDevice"/>
            <i class="fa fa-close" style="font-size:10px;color:red;" aria-hidden="true" v-show="editingDevice" @click="unneditDevice"/>
        </td>

        <td>
            <span v-if="!editingName"  @dblclick="editName" >{{enrollment.name}}</span>
            <span v-else @keyup.enter="editName">
                                <input class="form-control col-lg-2 col-md-2 col-sm-12 col-xs-12" v-focus v-model="enrollment.name" size="50" @keyup.enter="saveName" @keyup.esc="unneditName"></span>
            <i class="fa fa-edit" style="font-size:10px;color:blue;" aria-hidden="true" v-show="!editingName" @click="editName"/>
            <i class="fa fa-check" style="font-size:10px;color:green;" aria-hidden="true" v-show="editingName" @click="saveName"/>
            <i class="fa fa-close" style="font-size:10px;color:red;" aria-hidden="true" v-show="editingName" @click="unneditName"/>
        </td>

        <td>
            <span v-if="!editingValue"  @dblclick="editValue" >{{enrollment.value}}</span>
            <span v-else @keyup.enter="editValue">
                                <input class="form-control col-lg-2 col-md-2 col-sm-12 col-xs-12" v-focus v-model="enrollment.value" size="50" @keyup.enter="saveValue" @keyup.esc="unneditValue"></span>
            <i class="fa fa-edit" style="font-size:10px;color:blue;" aria-hidden="true" v-show="!editingValue" @click="editValue"/>
            <i class="fa fa-check" style="font-size:10px;color:green;" aria-hidden="true" v-show="editingValue" @click="saveValue"/>
            <i class="fa fa-close" style="font-size:10px;color:red;" aria-hidden="true" v-show="editingValue" @click="unneditValue"/>
        </td>

        <td>
            <span v-if="!editingDateStart"  @dblclick="editDateStart" >{{enrollment.date_start}}</span>
            <span v-else @keyup.enter="editDateStart">
                                <input class="form-control col-lg-2 col-md-2 col-sm-12 col-xs-12" v-focus v-model="enrollment.date_start" size="50" @keyup.enter="saveDateStart" @keyup.esc="unneditDateStart"></span>
            <i class="fa fa-edit" style="font-size:10px;color:blue;" aria-hidden="true" v-show="!editingDateStart" @click="editDateStart"/>
            <i class="fa fa-check" style="font-size:10px;color:green;" aria-hidden="true" v-show="editingDateStart" @click="saveDateStart"/>
            <i class="fa fa-close" style="font-size:10px;color:red;" aria-hidden="true" v-show="editingDateStart" @click="unneditDateStart"/>
        </td>

        <td>
            <span v-if="!editingDateEnd"  @dblclick="editDateEnd" >{{enrollment.date_end}}</span>
            <span v-else @keyup.enter="editDateEnd">
                                <input class="form-control col-lg-2 col-md-2 col-sm-12 col-xs-12" v-focus v-model="enrollment.date_end" size="50" @keyup.enter="saveDateEnd" @keyup.esc="unneditDateEnd"></span>
            <i class="fa fa-edit" style="font-size:10px;color:blue;" aria-hidden="true" v-show="!editingDateEnd" @click="editDateEnd"/>
            <i class="fa fa-check" style="font-size:10px;color:green;" aria-hidden="true" v-show="editingDateEnd" @click="saveDateEnd"/>
            <i class="fa fa-close" style="font-size:10px;color:red;" aria-hidden="true" v-show="editingDateEnd" @click="unneditDateEnd"/>
        </td>

        <td>
            <span class="btn btn-xs btn-danger col-lg-2 col-md-2 col-sm-12 col-xs-12"  @click="deleteEnrollment(index,enrollment.id)">
                <i class='fa fa-fw fa-trash'/>
            </span>
            <span class="btn btn-xs btn-info col-lg-2 col-md-2 col-sm-12 col-xs-12" @click="editEnrollment(index,enrollment.id)">
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
                editingName: false,
                editingDevice: false,
                editingValue: false,
                editingDateStart: false,
                editingDateEnd: false,
                uri: 'api/v1/enrollment'
            }
        },
        created() {
            console.log('Component enrollment created.');
        },
        methods: {
            editEnrollment: function() {
                this.editingName = true;
                this.editingDevice = true;
                this.editingValue = true;
                this.editingDateStart = true;
                this.editingDateEnd = true;
            },
            //Device methods:
            editDevice: function() {
                return this.editingDevice = true;
            },
            unneditDevice: function() {
                return this.editingDevice = false;
            },
            saveDevice: function() {
                this.editEnrollmentApi();
                return this.editingDevice = false;
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
            //Value methods:
            editValue: function() {
                return this.editingValue = true;
            },
            unneditValue: function() {
                return this.editingValue = false;
            },
            saveValue: function() {
                this.editEnrollmentApi();
                return this.editingValue = false;
            },
            //DateStart methods:
            editDateStart: function() {
                return this.editingDateStart = true;
            },
            unneditDateStart: function() {
                return this.editingDateStart = false;
            },
            saveDateStart: function() {
                this.editEnrollmentApi();
                return this.editingDateStart = false;
            },
            //DateEnd methods:
            editDateEnd: function() {
                return this.editingDateEnd = true;
            },
            unneditDateEnd: function() {
                return this.editingDateEnd = false;
            },
            saveDateEnd: function() {
                this.editEnrollmentApi();
                return this.editingDateEnd = false;
            },
            //Fer peticions al editar.
            editEnrollmentApi: function() {
                axios.put(this.uri +'/'+this.enrollment.id,{
                    device: this.enrollment.device,
                    name: this.enrollment.name,
                    value: this.enrollment.value,
                    date_start: this.enrollment.date_start,
                    date_end: this.enrollment.date_end
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