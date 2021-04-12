<template>
  <CRow>
    <CCol col="12">
      <CCard no-header>
        <CCardHeader>
          Apartment id:  {{ $route.params.id }}
        </CCardHeader>
        <CCardBody>
          <CDataTable 
            striped 
            small 
            fixed
            :items="items" 
            :fields="fields">
            <template slot="value" slot-scope="data">
              <td v-html="data.item.value"></td>
            </template>
          </CDataTable>
          <CRow>
              <CCol col="6" class="mb-3" style="padding-left:24px" >
                Images
              </CCol>
              <CCol col="6" class="mb-3">
                <vue-upload-multiple-image
                  @upload-success="uploadImageSuccess"
                  @before-remove="beforeRemove"
                  @edit-image="editImage"
                  :data-images="images"
                  :maxImage = "images.length"
                  ></vue-upload-multiple-image>
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
  name: 'ShowApartment',
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
    getApartmentData (id) {
      const Apartment = ApartmentsData.find((Apartment, index) => index + 1 == id)
      const ApartmentDetails = Apartment ? Object.entries(Apartment) : [['id', 'Not found']]
      return ApartmentDetails.map(([key, value]) => { return { key, value } })
    },
    goBack() {
      this.$router.go(-1)
    },
    uploadImageSuccess(formData, index, fileList) {
      console.log('data', formData, index, fileList)
      // Upload image api
      // axios.post('http://your-url-upload', formData).then(response => {
      //   console.log(response)
      // })
      this.images = fileList;
    },
    beforeRemove (index, done, fileList) {
      console.log('index', index, fileList)
      var r = confirm("remove image")
      if (r == true) {
        done()
      } else {
      }
    },
    editImage (formData, index, fileList) {
      console.log('edit data', formData, index, fileList)
    },
  },
  mounted: function(){
    let self = this;
    axios.get(  this.$apiAdress + '/api/apartments/show?token=' + localStorage.getItem("api_token") + '&id=' + self.$route.params.id )
    .then(function (response) {
      const item = Object.entries(response.data);
      for(var i = 0; i < response.data.images.length; i++){
        let img = {};
        if(i == 0){
          img = { path : response.data.images[i], highlight : 1, default : 1, name : i + '.jpg', };
        }else{
          img = { path : response.data.images[i], highlight : 0, default : 0, name : i + '.jpg', };
        }
        self.images.push(img);
      }
      let items = item.filter(function(i) {
        if(i[0].includes("image")){
          return false;
        }
        return true;
      });
      self.items = items.map(([key, value]) => {return {key: key, value: value}});
    }).catch(function (error) {
      console.log(error);
      // self.$router.push({ path: '/login' });
    });
  }
}
</script>
