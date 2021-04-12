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
                <p> User ID: [{{ $route.params.id }}]</p>
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
                  :invalid-feedback="typeof errors['full_name'] === 'undefined' ? '' : errors['full_name'][0]"
                  :is-valid="typeof errors['full_name'] === 'undefined'"></CInput>
              </CCol>
              <CCol col="3">
                <CInput type="text" label="Short name" placeholder="Short name" v-model="short_name"
                 :invalid-feedback="typeof errors['short_name'] === 'undefined' ? '' : errors['short_name'][0]"
                 :is-valid="typeof errors['short_name'] === 'undefined'"></CInput>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="6">
                <CInput type="text" label="Email" placeholder="Email" v-model="email"
                  :invalid-feedback="typeof errors['email'] === 'undefined' ? '' : errors['email'][0]"
                  :is-valid="typeof errors['email'] === 'undefined'"></CInput>
              </CCol>
              <CCol col="3">
                <CInput type="password" label="Password" placeholder="Password"  disabled="disabled"
                  :invalid-feedback="typeof errors['password'] === 'undefined' ? '' : errors['password'][0]"
                  :is-valid="typeof errors['password'] === 'undefined'"></CInput>
              </CCol>
              <CCol col="3">
                <CSelect label="Roles" :value.sync="menuroles" :plain="true" :options="roles_list"></CSelect>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="3">
                <!-- Phone -->
                <CInput type="number" label="Phone" placeholder="Phone" v-model="phone"
                  :invalid-feedback="typeof errors['phone'] === 'undefined' ? '' : errors['phone'][0]"
                  :is-valid="typeof errors['phone'] === 'undefined'"></CInput>
              </CCol>
              <CCol col="3">
                <!-- Identity Card -->
                <CInput type="text" label="Identity Card" placeholder="Identity Card" v-model="identity_card"
                  :invalid-feedback="typeof errors['identity_card'] === 'undefined' ? '' : errors['identity_card'][0]"
                  :is-valid="typeof errors['identity_card'] === 'undefined'"></CInput>
              </CCol>
              <CCol col="3">
                <!-- birth_day -->
                <CInput type="date" id="birth_day" label="Birth Day" placeholder="date" format='yyyy/mm/dd' v-model="birth_day"
                  :invalid-feedback="typeof errors['birth_day'] === 'undefined' ? '' : errors['birth_day'][0]"
                  :is-valid="typeof errors['birth_day'] === 'undefined'"></CInput>
              </CCol>
              <CCol col="3">
                <CSelect label="Gender" :value.sync="gender" :plain="true" :options="gender_list"></CSelect>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="6">
                <!-- Facebook -->
                <CInput type="text" label="Facebook" placeholder="Facebook" v-model="facebook"
                  :invalid-feedback="typeof errors['facebook'] === 'undefined' ? '' : errors['facebook'][0]"
                  :is-valid="typeof errors['facebook'] === 'undefined'"></CInput>
              </CCol>
              <CCol col="6">
                <!-- Note -->
                <CInput type="text" label="Note" placeholder="Note" v-model="note"
                  :invalid-feedback="typeof errors['note'] === 'undefined' ? '' : errors['note'][0]"
                  :is-valid="typeof errors['note'] === 'undefined'"></CInput>
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
            <CButton color="info" @click="update()">Save</CButton>
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
        gender              : '',
        facebook            : '',
        note                : '',
        images              : [],
        email               : '',
        menuroles           : '',
        status              : '',
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
    goBack() {
      this.$router.go(-1)
      // this.$router.replace({path: '/users'})
    },
    update() {
        let self = this;
        axios.post(  this.$apiAdress + '/api/users/update?token=' + localStorage.getItem("api_token"),
        {
            id            : self.$route.params.id,
            full_name     : self.full_name,
            short_name    : self.short_name,
            phone         : self.phone,
            identity_card : self.identity_card,
            birth_day     : self.birth_day,
            gender        : self.gender,
            facebook      : self.facebook,
            note          : self.note,
            email         : self.email,
            menuroles     : self.menuroles,
            status        : self.status,
            images        : self.images,
        })
        .then(function (response) {
            if (response.data.status == 'error') {
              self.errors = response.data.errors;
            }else{
              self.message = 'Successfully updated user.';
              self.showAlert();
              self.errors = [];
            }
        }).catch(function (error) {
            console.log(error);
            // self.$router.push({ path: '/login' });
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
      // console.log('data', formData, index, fileList)
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
    let self = this;
    axios.get(  this.$apiAdress + '/api/users/edit?token=' + localStorage.getItem("api_token") + '&id=' + self.$route.params.id )
    .then(function (response) {
        self.full_name      = response.data.full_name;
        self.short_name     = response.data.short_name;
        self.phone          = response.data.phone;
        self.identity_card  = response.data.identity_card;
        self.birth_day      = response.data.birth_day;
        self.gender         = response.data.gender;
        self.facebook       = response.data.facebook;
        self.note           = response.data.note;
        self.email          = response.data.email;
        self.menuroles      = response.data.menuroles;
        self.status         = response.data.status;     
        self.gender         = self.gender == 0 ? "Woman" : (self.gender == 1 ? "Man" : "Undefined");
        if(response.data.images != "" && response.data.images != null){
          let img = { path : response.data.images, highlight : 1, default : 1, name : '1.jpg', };
           self.images.push(img);
        }
    }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
    });
  }
}


</script>
