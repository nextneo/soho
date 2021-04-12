<template>
  <CRow>
    <CCol col="12">
      <CCard no-header>
        <CCardBody>
          <CForm>
            <template slot="header">
              Edit Category id:  {{ $route.params.id }}
            </template>
            <CAlert :show.sync="dismissCountDown" color="primary" fade>
              ({{dismissCountDown}}) {{ message }}
            </CAlert>
            <CInput type="text" label="Name" placeholder="Name" v-model="name"
              :invalid-feedback="typeof errors['name'] === 'undefined' ? '' : errors['name'][0]"
              :is-valid="typeof errors['name'] === 'undefined'"></CInput>
            <label for="info">Info</label>
            <ckeditor v-model="info" id="info" class="mb-2"></ckeditor>
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
  name: 'EditCategory',
  props: {
    caption: {
      type: String,
      default: 'Category id'
    },
  },
  data: () => {
    return {
        id                   : '',
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
      // this.$router.replace({path: '/Category'})
    },
    update() {
        let self = this;
        axios.post(  this.$apiAdress + '/api/category/update?token=' + localStorage.getItem("api_token"),
          {
            id              : self.$route.params.id,
            name            : self.name,
            info            : self.info,
          }
        )
        .then(function (response) {
          if (response.data.status == 'error') {
            self.errors = response.data.errors;
          }else{
            self.message = 'Successfully updated Category.';
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
    axios.get(  this.$apiAdress + '/api/category/edit?token=' + localStorage.getItem("api_token") + '&id=' + self.$route.params.id )
    .then(function (response) {
        self.name = response.data.name;
        self.info = response.data.info;
    }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
    });
  }
}
</script>