<template>
  <CRow>
    <CCol col="12">
      <CCard no-header>
        <CCardBody>
          <CForm>
            <template slot="header">
             Edit Block id:  {{ $route.params.id }}
            </template>
            <CAlert :show.sync="dismissCountDown" color="primary" fade>
              ({{dismissCountDown}}) {{ message }}
            </CAlert>
             <CSelect label="Departments" :value.sync="department_id" :plain="true" :options="departments">
            </CSelect>
            <CInput type="text" label="Name" placeholder="Name" v-model="name"></CInput>
            <CInput type="text" label="Info" placeholder="Info" v-model="info"></CInput>
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
        departments          : [],
        showMessage          : false,
        message              : '',
        dismissSecs          : 7,
        dismissCountDown     : 0,
        showDismissibleAlert : false
    }
  },
  methods: {
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
            self.message     = 'Successfully created block.';
            self.showAlert();
            self.name        = '';
            self.info        = '';
            department_id    = '';
            departments      = self.departments;
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
    axios.get(  this.$apiAdress + '/api/blocks/edit?token=' + localStorage.getItem("api_token") + '&id=' + '' )    
    .then(function (response) {
        response.data.departments.forEach(element => {
          let options = {value: element.id, label: element.name};
          self.departments.push(options);
        });
        if(response.data.departments.length > 0){
          self.department_id = response.data.departments[response.data.departments.length - 1].id;
        }        
    }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
    });
  }
}
</script>