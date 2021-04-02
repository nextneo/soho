<template>
  <CRow>
    <CCol col="14">
      <CCard>
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
              <td>{{data.item.value}}</td>              
            </template>
          </CDataTable>  
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
export default {
  name: 'ShowApartment',
  data: () => {
    return {
      items: [],
      fields: [
        {key: 'key'},
        {key: 'value'},
      ],
    }
  },
  methods: {
    getApartmentData (id) {
      const Apartment = ApartmentsData.find((Apartment, index) => index + 1 == id)
      const ApartmentDetails = Apartment ? Object.entries(Apartment) : [['id', 'Not found']]
      return ApartmentDetails.map(([key, value]) => { return { key, value } })
    },
    goBack() {
      this.$router.go(-1)
    }
  },
  mounted: function(){
    let self = this;
    axios.get(  this.$apiAdress + '/api/apartments/show?token=' + localStorage.getItem("api_token") + '&id=' + self.$route.params.id )
    .then(function (response) {
      const items = Object.entries(response.data);
      self.items = items.map(([key, value]) => {return {key: key, value: value}});
    }).catch(function (error) {
      console.log(error);
      // self.$router.push({ path: '/login' });
    });
  }
}
</script>
