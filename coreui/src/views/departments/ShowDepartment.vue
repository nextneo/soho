<template>
  <CRow>
    <CCol col="12">
      <CCard>
        <CCardHeader>
          Department id:  {{ $route.params.id }}
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
  name: 'ShowDepartment',
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
    getDepartmentData (id) {
      const Department = DepartmentsData.find((Department, index) => index + 1 == id)
      const DepartmentDetails = Department ? Object.entries(Department) : [['id', 'Not found']]
      return DepartmentDetails.map(([key, value]) => { return { key, value } })
    },
    goBack() {
      this.$router.go(-1)
    }
  },
  mounted: function(){
    let self = this;
    axios.get(  this.$apiAdress + '/api/departments/show?token=' + localStorage.getItem("api_token") + '&id=' + self.$route.params.id )
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
