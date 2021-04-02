<template>
  <CRow>
    <CCol col="12">
      <CCard no-header>
        <CCardBody>
          <CForm>
            <template slot="header">
              Edit Apartment id:  {{ $route.params.id }}
            </template>
            <CAlert
              :show.sync="dismissCountDown"
              color="primary"
              fade
            >
              ({{dismissCountDown}}) {{ message }}
            </CAlert>
            <CInput type="text" label="Code" placeholder="Code" v-model="code"></CInput>
            <CInput type="text" label="Block" placeholder="Block" v-model="block_id"></CInput>
            <CInput type="number" label="Floor" placeholder="Floor" v-model="floor"></CInput>
            <CInput type="text" label="Acreage" placeholder="Acreage" v-model="acreage"></CInput>
            <CInput type="number" label="TotalBedroom" placeholder="TotalBedroom" v-model="total_bedroom"></CInput>
            <CInput type="number" label="TotalToilet" placeholder="TotalToilet" v-model="total_toilet"></CInput>
            <CInput type="text" label="RoomView" placeholder="RoomView" v-model="room_view"></CInput>
            <CInput type="number" label="SellingPrice" placeholder="SellingPrice" v-model="selling_price"></CInput>
            <CInput type="number" label="RentalPrice" placeholder="RentalPrice" v-model="rental_price"></CInput>
            <CInput type="text" label="Info" placeholder="Info" v-model="info"></CInput>
            <CInput type="text" label="Status" placeholder="Status" v-model="status"></CInput>
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
  name: 'EditApartment',
  props: {
    caption: {
      type: String,
      default: 'Apartment id'
    },
  },
  data: () => {
    return {
        block_id             : '',
        code                 : '',
        floor                : '',
        acreage              : '',
        total_bedroom        : '',
        total_toilet         : '',
        room_view            : '',
        selling_price        : '',
        rental_price         : '',
        info                 : '',
        status               : '',
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
      // this.$router.replace({path: '/Apartments'})
    },
    update() {
        let self = this;
        axios.post(  this.$apiAdress + '/api/apartments/update?token=' + localStorage.getItem("api_token"),
          {
            id            : self.$route.params.id,
            block_id      : self.block_id,
            code          : self.code,
            floor         : self.floor,
            acreage       : self.acreage,
            total_bedroom : self.total_bedroom,
            total_toilet  : self.total_toilet,
            room_view     : self.room_view,
            selling_price : self.selling_price,
            rental_price  : self.rental_price,
            info          : self.info,
            status        : self.status
          }
        )
        .then(function (response) {
            self.message = 'Successfully updated apartment.';
            self.showAlert();
        }).catch(function (error) {
            console.log(error);
            // self.$router.push({ path: '/login' });
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
    axios.get(  this.$apiAdress + '/api/apartments/edit?token=' + localStorage.getItem("api_token") + '&id=' + self.$route.params.id )
    .then(function (response) {
      self.block_id      = response.data.block_id,
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
    }).catch(function (error) {
        console.log(error);
        // self.$router.push({ path: '/login' });
    });
  }
}
</script>
