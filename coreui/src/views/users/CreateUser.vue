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
              <CCol col="2" class="mb-3">
                Image
              </CCol>
              <CCol col="4" class="mb-3">
                <div id="my-strictly-unique-vue-upload-multiple-image" style="display: flex; justify-content: center;">
                  <vue-upload-multiple-image
                    @upload-success="uploadImageSuccess"
                    @before-remove="beforeRemove"
                    @edit-image="editImage"
                    idUpload="myIdUpload"
                    editUpload="myIdEdit"
                    :maxImage = "1"
                    :data-images='images'
                    ></vue-upload-multiple-image>
                </div>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="6">
                <!-- full name -->
                <CInput type="text" label="Full name" placeholder="Full name" v-model="full_name"
                  :invalid-feedback="invalid_feedback('full_name')"
                  :is-valid="invalid_feedback('full_name') == ''"></CInput>
              </CCol>
              <CCol col="3">
                <CInput type="text" label="Short name" placeholder="Short name" v-model="short_name"
                 :invalid-feedback="invalid_feedback('short_name')"
                 :is-valid="invalid_feedback('short_name') == ''"></CInput>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="6">
                <CInput type="text" label="Email" placeholder="Email" v-model="email"
                  :invalid-feedback="invalid_feedback('email')"
                  :is-valid="invalid_feedback('email') == ''"></CInput>
              </CCol>
              <CCol col="3">
                <CInput type="password" label="Password" placeholder="Password" v-model="password"
                  :invalid-feedback="invalid_feedback('password')"
                  :is-valid="invalid_feedback('password') == ''"></CInput>
              </CCol>
              <CCol col="3">
                <CSelect label="Roles" :value.sync="menuroles" :plain="true" :options="roles_list"></CSelect>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="3">
                <!-- Phone -->
                <CInput type="number" maxlength="10" label="Phone" placeholder="Phone" v-model="phone"
                  :invalid-feedback="invalid_feedback('phone')"
                  :is-valid="invalid_feedback('phone') == ''"></CInput>
              </CCol>
              <CCol col="3">
                <!-- Identity Card -->
                <CInput type="text" label="Identity Card" placeholder="Identity Card" v-model="identity_card"
                  :invalid-feedback="invalid_feedback('identity_card')"
                  :is-valid="invalid_feedback('identity_card') == ''"></CInput>
              </CCol>
              <CCol col="3">
                <!-- birth_day -->
                <CInput type="date" id="birth_day" label="Birth Day" placeholder="date" format='yyyy/mm/dd' v-model="birth_day"
                  :invalid-feedback="invalid_feedback('birth_day')"
                  :is-valid="invalid_feedback('birth_day') == ''"></CInput>
              </CCol>
              <CCol col="3">
                <CSelect label="Gender" :value.sync="gender" :plain="true" :options="gender_list"></CSelect>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="6">
                <!-- Facebook -->
                <CInput type="text" label="Facebook" placeholder="Facebook" v-model="facebook"
                  :invalid-feedback="invalid_feedback('facebook')"
                  :is-valid="invalid_feedback('facebook') == ''"></CInput>
              </CCol>
              <CCol col="6">
                <!-- Note -->
                <CInput type="text" label="Note" placeholder="Note" v-model="note"
                  :invalid-feedback="invalid_feedback('note')"
                  :is-valid="invalid_feedback('note') == ''"></CInput>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="12">
                <br><label for="status">Status</label><br>
                <div v-for="(state, key) in status_list" :key="key" class="d-inline-block">
                  <CSwitch
                    class="mx-1"
                    :color="colors[key]"
                    variant="3d"
                    v-model="status"
                    type="radio"
                    name="status"
                    :checked="status == state"
                    @update:checked="changeStatus(state)"
                    :value="state"
                  />
                  <label for="status" class="mr-4 d-inline-block">{{ state }}</label>
                </div>
              </CCol>
            </CRow>
            <!-- Save button -->
            <CButton color="info" @click="store()">Save</CButton>
            <!-- Back button -->
            <CButton color="secondary ml-2" @click="goBack">Back</CButton>
          </CForm>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import VueUploadMultipleImage from 'vue-upload-multiple-image'
import axios from 'axios'
export default {
  name: 'EditUser',
  components: {
    VueUploadMultipleImage,
  },
  props: {
    caption: {
      type: String,
      default: 'User id'
    },
  },
  data: () => {
    return {
        full_name           : '',
        short_name          : '',
        phone               : '',
        identity_card       : '',
        birth_day           : '',
        gender              : 'Woman',
        facebook            : '',
        note                : '',
        images              : [],
        email               : '',
        password            : '',
        menuroles           : 'admin',
        status              : 'Active',
        showMessage         : false,
        message             : '',
        dismissSecs         : 7,
        dismissCountDown    : 0,
        showDismissibleAlert: false,
        errors              : [],
        status_list         : ['Active','Inactive','Pending','Banned'],
        colors              : ['success','secondary','warning','danger'],
        gender_list         : ['Woman', 'Man', 'Undefined'],
        roles_list          : ['admin', 'user'],
    }
  },
  methods: {
    invalid_feedback(field) {
      return typeof this.errors[field] === 'undefined' ? '' : this.errors[field][0];
    },
    goBack() {
      this.$router.go(-1)
      // this.$router.replace({path: '/Users'})
    },
    store() {
        let self = this;
        self.gender = self.gender == "Man" ? 1 : self.gender == "Woman" ? 0 : 2;
        axios.post(this.$apiAdress + '/api/users/store?token=' + localStorage.getItem("api_token"),
          {
            'full_name'     : self.full_name,
            'short_name'    : self.short_name,
            'phone'         : self.phone,
            'identity_card' : self.identity_card,
            'birth_day'     : self.birth_day,
            'gender'        : self.gender,
            'facebook'      : self.facebook,
            'note'          : self.note,
            'email'         : self.email,
            'password'      : self.password,
            'menuroles'     : self.menuroles,
            'status'        : self.status,
            'images'        : self.images,
          }
        )
        .then(function (response) {
            if (response.data.status == 'error') {
                self.errors = response.data.errors;
            }else{
              self.message        = 'Successfully created user.';
              self.showAlert();
              self.full_name      = '';
              self.short_name     = '';
              self.phone          = '';
              self.identity_card  = '';
              self.gender         = '';
              self.facebook       = '';
              self.note           = '';
              self.email          = '';
              self.password       = '';
              self.birth_day      = '';
              self.menuroles      = '';
              self.images         = [];
              self.status         = 'Active';
              self.errors         = [];
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
    changeStatus(val){
      this.status = val
    },
    countDownChanged (dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
    showAlert () {
      this.dismissCountDown = this.dismissSecs
    },
    uploadImageSuccess(formData, index, fileList) {
      //console.log('data', formData, index, fileList)
      // Upload image api
      // axios.post('http://your-url-upload', formData).then(response => {
      //   console.log(response)
      // })
	    this.images = [];
      this.images.push(fileList[0]);
    },
    beforeRemove (index, done, fileList) {
      // console.log('index', index, fileList)
      var r = confirm("Are you sure to remove the image?")
      if (r == true) {
        done()
      } else {
      }
    },
    editImage (formData, index, fileList) {
      // console.log('edit data', formData, index, fileList)
    },
  },
  mounted: function(){
  }
}
</script>
