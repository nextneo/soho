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
              <CCol col="12" class="mb-3">
                <vue-upload-multiple-image
                  @upload-success="uploadImageSuccess"
                  @before-remove="beforeRemove"
                  @edit-image="editImage"
                  :data-images="images"
                  :maxImage = "10"
                  ></vue-upload-multiple-image>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="3">
                <!-- Code -->
                <CInput type="text" label="Code" placeholder="Code" v-model="code"
                  :invalid-feedback="invalidFeedback('code')"
                  :is-valid="isValid('code')"></CInput>
              </CCol>
              <CCol col="3">
                <!-- User -->
                <CInput type="text"  placeholder="User" label="User"  v-model="user_name"  disabled="disabled"
                  :invalid-feedback="invalidFeedback('user_id')"
                  :is-valid="isValid('user_id')">
                  <template #append>
                    <CButton color="success" class="btn-sm" @click="showModalUser()"><CIcon name="cil-magnifying-glass"/></CButton>
                  </template>
                </CInput>
                <CInput type="text" v-model="user_id" class="d-none"></CInput>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="3">
                <!-- Block -->
                <CInput type="text" placeholder="Block" label="Block" v-model="block_name" disabled="disabled"
                  :invalid-feedback="invalidFeedback('block_id')"
                  :is-valid="isValid('block_id')">
                  <template #append>
                    <CButton color="success" class="btn-sm" @click="showModalBlock()"><CIcon name="cil-magnifying-glass"/></CButton>
                  </template>
                </CInput>
                <CInput type="text" v-model="block_id" class="d-none"></CInput>
              </CCol>
              <CCol col="3">
                <!-- Floor -->
                <CInput type="number" label="Floor" placeholder="Floor" min="0" v-model="floor"
                  :invalid-feedback="invalidFeedback('floor')"
                  :is-valid="isValid('floor')"></CInput>
              </CCol>
              <CCol col="3">
                <!-- Acreage -->
                <CInput type="text" label="Acreage" placeholder="Acreage" v-model="acreage"
                  :invalid-feedback="invalidFeedback('acreage')"
                  :is-valid="isValid('acreage')"></CInput>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="3">
                <!-- TotalBedroom -->
                <CInput type="number" label="Total bedroom" placeholder="Total bedroom" v-model="total_bedroom"
                  :invalid-feedback="invalidFeedback('total_bedroom')"
                  :is-valid="isValid('total_bedroom')"></CInput>
              </CCol>
              <CCol col="3">
                <!-- TotalToilet -->
                <CInput type="number" label="Total toilet" placeholder="Total toilet" v-model="total_toilet"
                  :invalid-feedback="invalidFeedback('total_toilet')"
                  :is-valid="isValid('total_toilet')"></CInput>
              </CCol>
              <CCol col="6">
                <!-- RoomView -->
                <CInput type="text" label="Room view" placeholder="Room view" v-model="room_view"
                  :invalid-feedback="invalidFeedback('room_view')"
                  :is-valid="isValid('room_view')"></CInput>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="6">
                <!-- SellingPrice -->
                <div role="group" class="form-group">
                  <label for="selling-price"> Selling price </label>
                  <CMoney v-model="selling_price" :zero="true" :is-vaild="isValid('selling_price')" :invalid-feedback="invalidFeedback('selling_price')"></CMoney>
                </div>
              </CCol>
              <CCol col="6">
                <!-- RentalPrice -->
                <label for="rental-price"> Rental price </label>
                <CMoney v-model="rental_price" :zero="true" :is-vaild="isValid('rental_price')" :invalid-feedback="invalidFeedback('rental_price')"></CMoney>
              </CCol>
            </CRow>

            <!-- Info -->
            <label for="info">Info</label>
            <ckeditor v-model="info" id="info" class="mb-2"></ckeditor>
            <!-- Status -->
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
            <br><br><br>

            <!-- Save button -->
            <CButton color="info" @click="store()">Save</CButton>
            <!-- Back button -->
            <CButton color="secondary ml-2" @click="goBack">Back</CButton>
          </CForm>
        </CCardBody>
      </CCard>
    </CCol>
    <CCol col="12">
      <SearchApartments ref="childComponent" @return="callBack"></SearchApartments>
    </CCol>
    <CCol col="12">
      <SearchBlocks ref="childComponentBlock" @return="callBackBlock"></SearchBlocks>
    </CCol>
    <CCol col="12">
      <SearchUsers ref="childComponentUser" @return="callBackUser"></SearchUsers>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'
import SearchApartments from './SearchApartments.vue'
import SearchBlocks from '../blocks/SearchBlocks.vue'
import SearchUsers from '../users/SearchUsers.vue'
import CMoney from '../../components/CMoney.vue'
import VueUploadMultipleImage from 'vue-upload-multiple-image'

export default {
  name: 'CreateApartment',
  props: {
    caption: {
      type: String,
      default: 'Apartment id'
    },
  },
  data: () => {
    return {
        block_id            : '',
        block_name          : '',
        user_id             : '',
        user_name           : '',
        code                : '',
        floor               : '',
        acreage             : '',
        total_bedroom       : '',
        total_toilet        : '',
        room_view           : '',
        selling_price       : '',
        rental_price        : '',
        info                : '',
        status              : 'Available',
        showMessage         : false,
        message             : '',
        dismissSecs         : 7,
        dismissCountDown    : 0,
        showDismissibleAlert: false,
        errors              : [],
        status_list         : ['Available','Selling','Rented','Sold','Unavailable'],
        colors              : ['success','primary','warning','danger','dark'],
        money: {
          decimal: ',',
          precision: 0,
          masked: false
        },
        images: []
    }
  },
  components: {
    SearchApartments,
    SearchBlocks,
    SearchUsers,
    CMoney,
    VueUploadMultipleImage,
  },
  methods: {
    invalidFeedback(field){
      return typeof this.errors[field] === 'undefined' ? '' : this.errors[field][0];
    },
    isValid(field){
      if (this.errors.length == 0) {
        return null;
      }
      return typeof this.errors[field] === 'undefined';
    },
    goBack() {
      this.$router.go(-1)
      // this.$router.replace({path: '/Apartments'})
    },
    store() {
        let self = this;
        let image_paths = [];
        self.images.forEach(element => {
          image_paths.push(element.path);
        });
        axios.post(  this.$apiAdress + '/api/apartments/store?token=' + localStorage.getItem("api_token"),
          {
            'block_id'     : self.block_id,
            'block_name'   : self.block_name,
            'user_id'      : self.user_id,
            'user_name'    : self.user_name,
            'code'         : self.code,
            'floor'        : self.floor,
            'acreage'      : self.acreage,
            'total_bedroom': self.total_bedroom,
            'total_toilet' : self.total_toilet,
            'room_view'    : self.room_view,
            'selling_price': self.selling_price,
            'rental_price' : self.rental_price,
            'info'         : self.info,
            'status'       : self.status,
            'images'       : image_paths,
          }
        )
        .then(function (response) {
          if (response.data.status == 'error') {
            self.errors = response.data.errors;
            console.log(self.errors);
          }else{
            self.block_id      = '';
            self.block_name    = '';
            self.user_id       = '';
            self.user_name     = '';
            self.code          = '';
            self.floor         = '';
            self.acreage       = '';
            self.total_bedroom = '';
            self.total_toilet  = '';
            self.room_view     = '';
            self.selling_price = '';
            self.rental_price  = '';
            self.info          = '';
            self.status        = 'Available';
            self.message       = 'Successfully created apartment.';
            self.images        = [];
            self.errors        = [];
            self.showAlert();
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
    showModal(){
      this.$refs.childComponent.show();
    },
    showModalBlock(){
      this.$refs.childComponentBlock.show();
    },
    showModalUser(){
      this.$refs.childComponentUser.show();
    },
    callBack(item){
      // this.block_id   = item.block_id;
      // this.block_name = item.block_name;
    },
    callBackBlock(item){
      this.block_id   = item.id;
      this.block_name = item.name;
    },
    callBackUser(item){
      this.user_id   = item.id;
      this.user_name = item.full_name;
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
    }
  },
  mounted: function(){
  }
}
</script>
