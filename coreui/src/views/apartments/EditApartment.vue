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
                <CInput type="text" label="Code" placeholder="Code" v-model="code" disabled="disabled"
                  :invalid-feedback="typeof errors['code'] === 'undefined' ? '' : errors['code'][0]"
                  :is-valid="typeof errors['code'] === 'undefined'"></CInput>
              </CCol>
              <CCol col="3">
                <!-- User -->
                <CInput type="text"  placeholder="User" label="User"  v-model="user_name"  disabled="disabled"
                  :invalid-feedback="typeof errors['user_id'] === 'undefined' ? '' : errors['user_id'][0]"
                  :is-valid="typeof errors['user_id'] === 'undefined'">
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
                  :invalid-feedback="typeof errors['block_id'] === 'undefined' ? '' : errors['block_id'][0]"
                  :is-valid="typeof errors['block_id'] === 'undefined'">
                  <template #append>
                    <CButton color="success" class="btn-sm" @click="showModalBlock()"><CIcon name="cil-magnifying-glass"/></CButton>
                  </template>
                </CInput>
                <CInput type="text" v-model="block_id" class="d-none"></CInput>
              </CCol>
              <CCol col="3">
                <!-- Floor -->
                <CInput type="number" label="Floor" placeholder="Floor" min="0" v-model="floor"
                  :invalid-feedback="typeof errors['floor'] === 'undefined' ? '' : errors['floor'][0]"
                  :is-valid="typeof errors['floor'] === 'undefined'"></CInput>
              </CCol>
              <CCol col="3">
                <!-- Acreage -->
                <CInput type="text" label="Acreage" placeholder="Acreage" v-model="acreage"
                  :invalid-feedback="typeof errors['acreage'] === 'undefined' ? '' : errors['acreage'][0]"
                  :is-valid="typeof errors['acreage'] === 'undefined'"></CInput>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="3">
                <!-- TotalBedroom -->
                <CInput type="number" label="Total bedroom" placeholder="Total bedroom" v-model="total_bedroom"
                  :invalid-feedback="typeof errors['total_bedroom'] === 'undefined' ? '' : errors['total_bedroom'][0]"
                  :is-valid="typeof errors['total_bedroom'] === 'undefined'"></CInput>
              </CCol>
              <CCol col="3">
                <!-- TotalToilet -->
                <CInput type="number" label="Total toilet" placeholder="Total toilet" v-model="total_toilet"
                  :invalid-feedback="typeof errors['total_toilet'] === 'undefined' ? '' : errors['total_toilet'][0]"
                  :is-valid="typeof errors['total_toilet'] === 'undefined'"></CInput>
              </CCol>
              <CCol col="6">
                <!-- RoomView -->
                <CInput type="text" label="Room view" placeholder="Room view" v-model="room_view"
                  :invalid-feedback="typeof errors['room_view'] === 'undefined' ? '' : errors['room_view'][0]"
                  :is-valid="typeof errors['room_view'] === 'undefined'"></CInput>
              </CCol>
            </CRow>
            <CRow>
              <CCol col="6">
                <!-- SellingPrice -->
                <div role="group" class="form-group">
                  <label for="selling-price"> Selling price </label>
                  <money id="selling-price" placeholder="Selling price" v-model="selling_price" v-bind="money" class="form-control text-right"></money>
                </div>
              </CCol>
              <CCol col="6">
                <!-- RentalPrice -->
                <label for="rental-price"> Rental price </label>
                <money id="rental-price" placeholder="Rental price" v-model="rental_price" v-bind="money" class="form-control text-right"></money>
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
            <CButton color="info" @click="update()">Save</CButton>
            <!-- Back button -->
            <CButton color="secondary ml-2" @click="goBack">Back</CButton>
          </CForm>
        </CCardBody>
      </CCard>
    </CCol>
    <!-- <CCol col="12">
      <SearchApartments ref="childComponent" @return="callBack"></SearchApartments>
    </CCol> -->
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
import { Money } from 'v-money'
import { freeSet } from '@coreui/icons'
import VueUploadMultipleImage from 'vue-upload-multiple-image'

export default {
  name: 'EditApartment',
  freeSet,
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
    Money,
    VueUploadMultipleImage,
  },
  methods: {
    goBack() {
      this.$router.go(-1)
      // this.$router.replace({path: '/Apartments'})
    },
    update() {
        let self = this;
        let image_paths = [];
        self.images.forEach(element => {
          image_paths.push(element.path);
        });
        axios.post(  this.$apiAdress + '/api/apartments/update?token=' + localStorage.getItem("api_token"),
          {
            id           : self.$route.params.id,
            block_id     : self.block_id,
            block_name   : self.block_name,
            user_id      : self.user_id,
            user_name    : self.user_name,
            code         : self.code,
            floor        : self.floor,
            acreage      : self.acreage,
            total_bedroom: self.total_bedroom,
            total_toilet : self.total_toilet,
            room_view    : self.room_view,
            selling_price: self.selling_price,
            rental_price : self.rental_price,
            info         : self.info,
            status       : self.status,
            images       : image_paths,
          }
        )
        .then(function (response) {
          if (response.data.status == 'error') {
            self.errors = response.data.errors;
          }else{
            self.message = 'Successfully updated apartment.';
            self.showAlert();
            self.errors      = [];
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
    showModalBlock(){
      this.$refs.childComponentBlock.show();
    },
    showModalUser(){
      this.$refs.childComponentUser.show();
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
    },
  },
  mounted: function(){
    let self = this;
    axios.get(  this.$apiAdress + '/api/apartments/edit?token=' + localStorage.getItem("api_token") + '&id=' + self.$route.params.id )
    .then(function (response) {
      self.block_id      = response.data.block_id,
      self.block_name    = response.data.block_name,
      self.user_id       = response.data.user_id,
      self.user_name     = response.data.user_name,
      self.code          = response.data.code,
      self.floor         = response.data.floor,
      self.acreage       = response.data.acreage,
      self.total_bedroom = response.data.total_bedroom,
      self.total_toilet  = response.data.total_toilet,
      self.room_view     = response.data.room_view,
      self.selling_price = response.data.selling_price,
      self.rental_price  = response.data.rental_price,
      self.info          = response.data.info,
      self.status        = response.data.status
      for(var i = 0; i < response.data.images.length; i++){
        let img = {};
        if(i == 0){
          img = { path : response.data.images[i], highlight : 1, default : 1, name : i + '.jpg', };
        }else{
          img = { path : response.data.images[i], highlight : 0, default : 0, name : i + '.jpg', };
        }
        self.images.push(img);
      }
    }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
    });
  }
}
</script>