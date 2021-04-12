<template>
  <CRow>
    <CCol col="12">
      <CCard>
        <CCardBody>
          <CForm>
            <CRow class="align-middle">
              <CCol col="3">
                Block ID
              </CCol>
              <CCol col="3">
                 <CInput type="text" v-model="id" disabled="disabled"></CInput>
              </CCol>
              <CCol col="3">
                Block Name
              </CCol>
              <CCol col="3">
                 <CInput type="text" v-model="name" disabled="disabled"></CInput>
              </CCol>
            </CRow>
            <CRow class="align-middle">
              <CCol col="3">
                Departmant ID
              </CCol>
              <CCol col="3">
                 <CInput type="text" v-model="department_id" disabled="disabled"></CInput>
              </CCol>
              <CCol col="3">
                Departmant Name
              </CCol>
              <CCol col="3">
                 <CInput type="text" v-model="department_name" disabled="disabled"></CInput>
              </CCol>
            </CRow>

            <CRow class="align-middle">
              <CCol col="3">
                Info
              </CCol>
              <CCol col="9">
                   <span v-html="info"> </span>
              </CCol>
            </CRow>
          </CForm>
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
      department_id     : '',
      department_name   : '',
      id                : '',
      name              : '',
      info              : '',
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
      self.department_id = response.data.department_id;
      self.department_name = response.data.department_name;
      self.id = response.data.id;
      self.name = response.data.name;
      self.info = response.data.info;

      // const items = Object.entries(response.data);
      // self.items = items.map(([key, value]) => {return {key: key, value: value}});
    }).catch(function (error) {
      console.log(error);
      // self.$router.push({ path: '/login' });
    });
  }
}
</script>
