<template>
  <CRow>
    <CCol col="12">
      <CCard no-header>
        <CCardBody>
          <CForm>
            <template slot="header">
             dsada Edit Department id:  {{ $route.params.id }}
            </template>
            <CAlert
              :show.sync="dismissCountDown"
              color="primary"
              fade
            >
              ({{dismissCountDown}}) {{ message }}
            </CAlert>
            <CInput type="text" label="Name" placeholder="Name" v-model="name"></CInput>
            <CInput type="text" label="Block" placeholder="block" v-model="total_block"></CInput>
            <CInput type="text" label="Floor" placeholder="floor" v-model="total_floor"></CInput>
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
  name: 'EditDepartment',
  props: {
    caption: {
      type: String,
      default: 'Department id'
    },
  },
  data: () => {
    return {
        name: '',
        total_floor: '',
        total_block: '',
        showMessage: false,
        message: '',
        dismissSecs: 7,
        dismissCountDown: 0,
        showDismissibleAlert: false
    }
  },
  methods: {
    goBack() {
      this.$router.go(-1)
      // this.$router.replace({path: '/Departments'})
    },
    store() {
        let self = this;
        axios.post(  this.$apiAdress + '/api/departments/store?token=' + localStorage.getItem("api_token"),
          { 'name': self.name , 'total_floor': self.total_floor , 'total_block': self.total_block}
        )
        .then(function (response) {
            self.name = '';
            self.total_floor = '';
            self.total_block = '';
            self.message = 'Successfully created note.';
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
              self.$router.push({ path: 'login' }); 
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
