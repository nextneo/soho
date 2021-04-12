<template>
  <CRow>
    <CCol col="12">
      <CCard>
        <CCardHeader>
          Category id:  {{ $route.params.id }}
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
  name: 'ShowCategory',
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
    // getCategoryData (id) {
    //   const Category = CategorysData.find((Category, index) => index + 1 == id)
    //   const CategoryDetails = Category ? Object.entries(Category) : [['id', 'Not found']]
    //   return CategoryDetails.map(([key, value]) => { return { key, value } })
    // },
    goBack() {
      this.$router.go(-1)
    },
    toKebabCase (str) {
      return str.replace(/([a-z])([A-Z0-9])/g, '$1-$2').toLowerCase()
    },
  },
  mounted: function(){
    let self = this;
    axios.get(  this.$apiAdress + '/api/category/show?token=' + localStorage.getItem("api_token") + '&id=' + self.$route.params.id )
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
