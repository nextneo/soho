<template>
  <CRow>
    <CCol col="12">
      <CCard no-header>
        <CCardBody>
          <CForm>
            <CRow>
              <CCol col="12">
                <CAlert :show.sync="dismissCountDown" color="primary" fade>
                  ({{dismissCountDown}}) {{ message }}
                </CAlert>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="12">
                <p>Create Block</p>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="7">
                <CInput type="text" label="Name" placeholder="Name" v-model="name"
                  :invalid-feedback="invalidFeedback('name')"
                  :is-valid="isValid('name')"></CInput>
              </CCol>
              <CCol col="5">
                <CInput type="text" placeholder="Department" autocomplete="Department" label="Department" v-model="department_name" disabled="disabled"
                  :invalid-feedback="invalidFeedback('department_id')"
                  :is-valid="isValid('department_id')">
                  <template #append>
                    <CButton color="success" class="btn-sm" @click="showModal()"><CIcon name="cil-magnifying-glass"/></CButton>
                  </template>
                </CInput>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="12">
                  <label for="info">Info</label>
                  <ckeditor v-model="info" id="info" class="mb-2"></ckeditor>
              </CCol>
            </CRow>
            <CButton color="info" @click="store()">Save</CButton>
            <CButton color="secondary ml-2" @click="goBack">Back</CButton>
          </CForm>
        </CCardBody>
      </CCard>
    </CCol>
    <CCol col="12">
      <SearchDepartments ref="childComponent" @return="callBack"></SearchDepartments>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'
import SearchDepartments from '../departments/SearchDepartments.vue'

export default {
  name: 'CreateBlock',
  props: {
    caption: {
      type: String,
      default: 'Block id'
    },
  },
  data: () => {
    return {
        name                 : '',
        info                 : '',
        department_id        : '',
        department_name      : '',
        showMessage          : false,
        message              : '',
        dismissSecs          : 7,
        dismissCountDown     : 0,
        showDismissibleAlert : false,
        errors               : [],
    }
  },
  components: {
    SearchDepartments
  },
  methods: {
    invalidFeedback(field){
      return typeof this.errors[field] === 'undefined' ? '' : this.errors[field][0];
    },
    isValid(field){
      if (this.errors.length == 0) {
        return null;
      }

      return typeof this.errors[field] === 'undefined';
    },
    goBack() {
      this.$router.go(-1)
      // this.$router.replace({path: '/Blocks'})
    },
    store() {
        let self = this;
        axios.post(this.$apiAdress + '/api/blocks/store?token=' + localStorage.getItem("api_token"),
          { 'name': self.name , 'info': self.info, 'department_id': self.department_id }
        )
        .then(function (response) {
          if (response.data.status == 'error') {
            self.errors = response.data.errors;
          }else{
            self.message     = 'Successfully created block.';
            self.showAlert();

            self.name       = '';
            self.info       = '';
            department_id   = '';
            department_name = '';
            self.errors     = [];
          }
        }).catch(function (error) {

        });
    },
    countDownChanged (dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
    showAlert () {
      this.dismissCountDown = this.dismissSecs
    },
    showModal(){
      this.$refs.childComponent.show();
    },
    callBack(item){
      if(item != null){
        this.department_id = item.id;
        this.department_name = item.name;
      }
    },
  },
  mounted: function(){

  }
}
</script>