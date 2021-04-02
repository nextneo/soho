<template>
  <CRow>
    <CCol col="12">
      <CCard>
        <CCardHeader>
          Block id:  {{ $route.params.id }}
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
  name: 'ShowBlock',
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
    getBlockData (id) {
      const Block = BlocksData.find((Block, index) => index + 1 == id)
      const BlockDetails = Block ? Object.entries(Block) : [['id', 'Not found']]
      return BlockDetails.map(([key, value]) => { return { key, value } })
    },
    goBack() {
      this.$router.go(-1)
    }
  },
  mounted: function(){
    let self = this;
    axios.get(  this.$apiAdress + '/api/blocks/show?token=' + localStorage.getItem("api_token") + '&id=' + self.$route.params.id )
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
