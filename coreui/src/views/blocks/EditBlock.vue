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
                <p>Block ID: {{ $route.params.id }}</p>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="7">
                <CInput type="text" label="Name" placeholder="Name" v-model="name"
                  :invalid-feedback="typeof errors['name'] === 'undefined' ? '' : errors['name'][0]"
                  :is-valid="typeof errors['name'] === 'undefined'"></CInput>
              </CCol>
              <CCol col="5">
                 <CInput type="text" label="Departments" v-model="department_name" disabled="disabled"></CInput>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="12">
                  <label for="info">Info</label>
                  <ckeditor v-model="info" id="info" class="mb-2"></ckeditor>
              </CCol>
            </CRow>
            <CButton color="info" @click="update()">Save</CButton>
            <CButton color="secondary ml-2" @click="goBack">Back</CButton>
          </CForm>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'
export default {
  name: 'EditBlock',
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
  methods: {
    goBack() {
      this.$router.go(-1)
      // this.$router.replace({path: '/Blocks'})
    },
    update() {
        let self = this;
        axios.post(  this.$apiAdress + '/api/blocks/update?token=' + localStorage.getItem("api_token"),
          {
            id              : self.$route.params.id,
            name            : self.name,
            info            : self.info,
            department_id   : self.department_id,
          }
        )
        .then(function (response) {
          if (response.data.status == 'error') {
            self.errors = response.data.errors;
          }else{
            self.message = 'Successfully updated Block.';
            self.showAlert();
            self.errors = [];
          }
        }).catch(function (error) {
           if(error.response.data.message == 'The given data was invalid.'){
              self.message = '';
              for (let key in error.response.data.errors) {
                if (error.response.data.errors.hasOwnProperty(key)) {
                  self.message += error.response.data.errors[key][0] + '  ';
                }
              }
              self.showAlert();
            }else{
              console.log(error);
              // self.$router.push({ path: 'login' });
            }
        });
    },
    countDownChanged (dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
    showAlert () {
      this.dismissCountDown = this.dismissSecs
    },
  },
  mounted: function(){
    let self = this;
    axios.get(  this.$apiAdress + '/api/blocks/edit?token=' + localStorage.getItem("api_token") + '&id=' + self.$route.params.id )
    .then(function (response) {
        self.name = response.data.name;
        self.info = response.data.info;
        self.department_id = response.data.department_id;
        self.department_name = response.data.department_name;
    }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
    });
  }
}
</script>