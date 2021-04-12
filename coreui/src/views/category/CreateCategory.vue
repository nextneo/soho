<template>
  <CRow>
    <CCol col="12">
      <CCard no-header>
        <CCardBody>
          <CForm>
            <template slot="header">
             Create Category
            </template>
            <CAlert :show.sync="dismissCountDown" color="primary" fade>
              ({{dismissCountDown}}) {{ message }}
            </CAlert>
            <CInput type="text" label="Name" placeholder="Category Name" v-model="name"
              :invalid-feedback="typeof errors['name'] === 'undefined' ? '' : errors['name'][0]"
              :is-valid="typeof errors['name'] === 'undefined'"></CInput>
            <label for="info">Info</label>
            <ckeditor v-model="info" id="info" class="mb-2"></ckeditor>
            <CButton color="info" @click="store()">Save</CButton>
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
  name: 'CreateCategory',
  props: {
    caption: {
      type: String,
      default: 'Category id'
    },
  },
  data: () => {
    return {
        name                 : '',
        info                 : '',
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
      // this.$router.replace({path: '/Categorys'})
    },
    store() {
        let self = this;
        axios.post(this.$apiAdress + '/api/category/store?token=' + localStorage.getItem("api_token"),
          { 'name': self.name , 'info': self.info }
        )
        .then(function (response) {
          if (response.data.status == 'error') {
            self.errors = response.data.errors;
          }else{
            self.message     = 'Successfully created Category.';
            self.showAlert();
            self.name        = '';
            self.info        = '';
            self.errors      = [];
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
  }
}
</script>