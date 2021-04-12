<template>
  <CRow>
    <CCol col="12">
      <CCard>
        <CCardBody>
          <CDataTable striped small fixed :items="items" :fields="fields">
            <template slot="value" slot-scope="data">
              <td v-html="data.item.value"></td>
            </template>
          </CDataTable>
           <CRow v-if="images.length > 0">
              <CCol col="2" class="mb-3">Image</CCol>
              <CCol col="6" class="mb-3">
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
        </CCardBody>
        <CCardFooter>
          <CButton color="secondary" @click="goBack">Back</CButton>
        </CCardFooter>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'
import VueUploadMultipleImage from 'vue-upload-multiple-image'
export default {
  name: 'ShowNew',
  data: () => {
    return {
      items: [],
      images: [],
      fields: [
        {key: 'key'},
        {key: 'value'},
      ],
    }
  },
  components: {
    VueUploadMultipleImage,
  },
  methods: {
    goBack() {
      this.$router.go(-1)
    },
    toKebabCase (str) {
      return str.replace(/([a-z])([A-Z0-9])/g, '$1-$2').toLowerCase()
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
    let self = this;
    axios.get(  this.$apiAdress + '/api/news/show?token=' + localStorage.getItem("api_token") + '&id=' + self.$route.params.id )
    .then(function (response) {
      const item = Object.entries(response.data);
      if(response.data.image != "" && response.data.image != null){
        let img = { path : response.data.image, highlight : 1, default : 1, name : '1.jpg', };
        self.images.push(img);
      }
      let items = item.filter(function(i) {
        if(i[0] != 'image'){
          return true;
        }
        return false;
      });
      self.items = items.map(([key, value]) => {return {key: key, value: value}});
    }).catch(function (error) {
      console.log(error);
      // self.$router.push({ path: '/login' });
    });
  }
}
</script>
