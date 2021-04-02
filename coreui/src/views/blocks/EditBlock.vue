<template>
  <CRow>
    <CCol col="12">
      <CCard no-header>
        <CCardBody>
          <CForm>
            <template slot="header">
              Edit Block id:  {{ $route.params.id }}
            </template>
            <CAlert
              :show.sync="dismissCountDown"
              color="primary"
              fade
            >
              ({{dismissCountDown}}) {{ message }}
            </CAlert>
            <CSelect label="Departments" :value.sync="department_id" :plain="true" :options="departments" disabled="disabled">
            </CSelect>
            <CInput type="text" label="Name" placeholder="Name" v-model="name"></CInput>
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
            self.message = 'Successfully updated Block.';
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
    let self = this;
    axios.get(  this.$apiAdress + '/api/blocks/edit?token=' + localStorage.getItem("api_token") + '&id=' + self.$route.params.id )
    .then(function (response) {
        self.name = response.data.block.name;
        self.info = response.data.block.info;
        self.department_id = response.data.block.department_id;
        response.data.departments.forEach(element => {
          let options = {value: element.id, label: element.name};
          self.departments.push(options);
        });

    }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
    });
  }
}
</script>