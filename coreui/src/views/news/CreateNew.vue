<template>
  <CRow>
    <CCol col="12">
      <CCard no-header>
        <CCardBody>
          <CForm>
            <template slot="header">
             Create New
            </template>
            <CAlert :show.sync="dismissCountDown" color="primary" fade>
              ({{dismissCountDown}}) {{ message }}
            </CAlert>
            <CRow>
              <CCol col="2" class="mb-3">Image</CCol>
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
            <!-- User -->
            <CInput type="text"  placeholder="Category" label="Category"  v-model="category_name"  disabled="disabled"
              :invalid-feedback="typeof errors['category_id'] === 'undefined' ? '' : errors['category_id'][0]"
              :is-valid="typeof errors['category_id'] === 'undefined'">
              <template #append>
                <CButton color="success" class="btn-sm" @click="showModalCategory()"><CIcon name="cil-magnifying-glass"/></CButton>
              </template>
            </CInput>
            <CInput type="text" v-model="category_id" class="d-none"></CInput>

            <CInput type="text" label="Title" placeholder="Title" v-model="title"
              :invalid-feedback="typeof errors['title'] === 'undefined' ? '' : errors['title'][0]"
              :is-valid="typeof errors['title'] === 'undefined'"></CInput>
            <!-- header -->
            <CInput type="text" label="Header" placeholder="Header" v-model="header"
              :invalid-feedback="typeof errors['header'] === 'undefined' ? '' : errors['header'][0]"
              :is-valid="typeof errors['header'] === 'undefined'"></CInput>
            <!-- Info -->
            <label for="body">Body</label>
            <ckeditor v-model="body" id="body" class="mb-2"></ckeditor>
            <!-- Footer -->
            <CInput type="text" label="Footer" placeholder="Footer" v-model="footer"
              :invalid-feedback="typeof errors['footer'] === 'undefined' ? '' : errors['footer'][0]"
              :is-valid="typeof errors['footer'] === 'undefined'"></CInput>
            <CButton color="info" @click="store()">Save</CButton>
            <CButton color="secondary ml-2" @click="goBack">Back</CButton>
          </CForm>
        </CCardBody>
      </CCard>
    </CCol>
    <CCol col="12">
      <SearchCategory ref="childComponentCategory" @return="callBackCategory"></SearchCategory>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'
import SearchCategory from '../category/SearchCategory.vue'
import VueUploadMultipleImage from 'vue-upload-multiple-image'
import { freeSet } from '@coreui/icons'
export default {
  name: 'CreateNew',
  freeSet,
  props: {
    caption: {
      type: String,
      default: 'New id'
    },
  },
  data: () => {
    return {
        category_id          : '',
        category_name        : '',
        title                : '',
        header               : '',
        body                 : '',
        footer               : '',
        showMessage          : false,
        message              : '',
        dismissSecs          : 7,
        dismissCountDown     : 0,
        showDismissibleAlert : false,
        errors               : [],
        images               : [],
    }
  },
  components: {
    SearchCategory,
    VueUploadMultipleImage,
  },
  methods: {
    goBack() {
      this.$router.go(-1)
      // this.$router.replace({path: '/News'})
    },
    store() {
        let self = this;
        let image = '';
        if(self.images.length > 0){
          image = self.images[0].path;
        }
        axios.post(this.$apiAdress + '/api/news/store?token=' + localStorage.getItem("api_token"),
          { 
            'category_id': self.category_id,
            'title'      : self.title ,
            'header'     : self.header,
            'body'       : self.body , 
            'footer'     : self.footer,
            'image'      : image,
          }
        )
        .then(function (response) {
          if (response.data.status == 'error') {
            self.errors = response.data.errors;
            if(response.data.errors.body){
              self.message = response.data.errors.body[0];
              self.showAlert();
            }
          }else{
            self.message      = 'Successfully created new.';
            self.showAlert();
            self.category_id  = '';
            self.title        = '';
            self.header       = '';
            self.body         = '';
            self.footer       = '';
            self.errors       = [];
            self.images       = [];
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
    showModalCategory(){
      this.$refs.childComponentCategory.show();
    },
    callBackCategory(item){
      this.category_id   = item.id;
      this.category_name = item.name;
    },
    uploadImageSuccess(formData, index, fileList) {
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