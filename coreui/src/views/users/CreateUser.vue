<template>
  <CRow>
    <CCol col="12">
      <CCard no-header>
        <CCardBody>
          <CForm>
            <template slot="header">
              Create User
            </template>
            <CAlert
              :show.sync="dismissCountDown"
              color="primary"
              fade
            >
              ({{dismissCountDown}}) {{ message }}
            </CAlert>
            <CInput type="text" label="Name" placeholder="Name" v-model="name"></CInput>
            <CInput type="text" label="Email" placeholder="Email" v-model="email"></CInput>
            <!-- <CInput type="text" label="EmailVerifiedAt" placeholder="Email verified at" v-model="email_verified_at"></CInput> -->
            <CInput type="text" label="Password" placeholder="Password" v-model="password"></CInput>
            <CInput type="text" label="Roles" placeholder="Roles" v-model="menuroles"></CInput>
            <CInput type="text" label="Status" placeholder="Status" v-model="status"></CInput>
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
  name: 'EditUser',
  props: {
    caption: {
      type: String,
      default: 'User id'
    },
  },
  data: () => {
    return {
        name                : '',
        email               : '',
        password            : '',
        menuroles           : '',
        status              : '',
        showMessage         : false,
        message             : '',
        dismissSecs         : 7,
        dismissCountDown    : 0,
        showDismissibleAlert: false
    }
  },
  methods: {
    goBack() {
      this.$router.go(-1)
      // this.$router.replace({path: '/Users'})
    },
    store() {
        let self = this;
        axios.post(  this.$apiAdress + '/api/users/store?token=' + localStorage.getItem("api_token"),
          { 
            'name'     : self.name,
            'email'    : self.email,
            'password' : self.password,
            'menuroles': self.menuroles,
            'status'   : self.status
          }
        )
        .then(function (response) {
            self.name      = '';
            self.email     = '';
            self.password  = '';
            self.menuroles = '';
            self.status    = '';
            self.message   = 'Successfully created user.';
            self.showAlert();
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
